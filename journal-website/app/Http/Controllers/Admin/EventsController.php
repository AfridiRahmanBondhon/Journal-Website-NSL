<?php

/**
 * @Nogor Solutions Ltd
 */

namespace App\Http\Controllers\Admin;

use App\Action\Util\DeleteAction;
use App\Http\Controllers\Base\BaseController;
use App\Http\Resources\Resource;
use App\Models\Category;
use App\Models\Events;
use App\Models\EventSchedule;
use App\Traits\ResizeTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EventsController extends BaseController
{
    use ResizeTrait;

    protected $resizeArr = [
        ['width' => 429, 'height' => 200],
        ['width' => 1326, 'height' => 735],
    ];

    protected $resize_type = 'perfect';

    public function index(Request $request)
    {
        $query = Events::with(['category:id,title'])->latest();
        $query->whereLike($request->field_name, $request->value);
        $query->whereAny('status', $request->status);

        if (! empty($request->category_id)) {
            $query->where('category_id', $request->category_id);
        }

        // Event date wise search.
        $startDate = $request->from_date;
        $endDate = $request->to_date;

        if (! empty($startDate) && ! empty($endDate)) {

            $startDate = vue_to_server_date($startDate);
            $endDate = vue_to_server_date($endDate);

            $query->whereDate('start_date', '>=', $startDate)
                ->whereDate('end_date', '<=', $endDate);
        }

        if ($request->allData) {
            return $query->get();
        } else {
            $datas = $query->paginate($request->pagination);

            return new Resource($datas);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.backend_app');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($this->validateCheck($request)) {
            try {
                DB::beginTransaction();
                $data = $request->except('event_schedules');
                $event_schedules = $request->event_schedules;
                $image = $request->image_base64;

                if (! empty($image)) {
                    $data['image'] = cloudflare(file: $image, folder: 'events', resizeSize: '600x600,200x200', base64: true);
                }

                if (empty($request->meta_tag)) {
                    unset($data['meta_tag']);
                }

                $res = Events::create($data);
                $this->scheduleCreate($event_schedules, $eventId = $res['id']);

                DB::commit();

                return $this->responseReturn('create', $res);
            } catch (Exception $ex) {
                DB::rollback();

                return response()->json(['exception' => $ex->errorInfo ?? $ex->getMessage()], 422);
            }
        }
    }

    /**
     * Schedule create
     *
     * @param [type] $event_schedules
     * @param [type] $eventId
     */
    public function scheduleCreate($event_schedules, $eventId): void
    {
        foreach ($event_schedules as $event_schedule) {

            if (
                $event_schedule['title'] != null && $event_schedule['schedule_time'] != null && $event_schedule['schedule_date'] != null
            ) {

                $schedule = new EventSchedule();
                $schedule->title = ($event_schedule['title'] != null) ? $event_schedule['title'] : null;
                $schedule->events_id = $eventId;
                $schedule->schedule_date = ($event_schedule['schedule_date'] != null) ? $event_schedule['schedule_date'] : null;
                $schedule->schedule_time = ($event_schedule['schedule_time'] != null) ? $event_schedule['schedule_time'] : null;
                $schedule->description = ($event_schedule['description'] != null) ? $event_schedule['description'] : '';
                $schedule->status = ($event_schedule['status'] != null) ? $event_schedule['status'] : 'deactive';
                $schedule->save();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Events  $events
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if ($request->format() == 'html') {
            return view('layouts.backend_app');
        }

        return Events::with('eventSchedules', 'category')->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Events $events)
    {
        return view('layouts.backend_app');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Events  $events
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, DeleteAction $delete)
    {
        if ($this->validateCheck($request, $id)) {
            try {
                DB::beginTransaction();
                $event = Events::find($id);
                $data = $request->except('eventScheduls');
                $eventSchedules = $request->event_schedules;
                $image = $request->image_base64;

                if (! empty($image) && is_base64($image)) {
                    @$delete->arrayImages($event->image);
                    $data['image'] = cloudflare(file: $image, folder: 'events', resizeSize: '600x600,200x200', base64: true);
                } else {
                    $data['image'] = $event->image;
                }

                if (empty($request->meta_tag)) {
                    unset($data['meta_tag']);
                }

                $event->update($data);

                // Create the schedules...
                $event->eventSchedules()->delete();
                if ($eventSchedules != null) {
                    if (count($eventSchedules) > 0) {
                        $this->scheduleCreate($eventSchedules, $eventId = $event->id);
                    }
                }

                DB::commit();

                return $this->responseReturn('update', $event);
            } catch (Exception $ex) {
                DB::rollback();

                return response()->json(['exception' => $ex->errorInfo ?? $ex->getMessage()], 422);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Events  $events
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, DeleteAction $delete)
    {
        $events = Events::find($id);

        @$delete->arrayImages($events->image);

        $events->eventSchedules()->delete();
        $res = $events->delete();

        return $this->responseReturn('delete', $res);
    }

    /**
     * Validate form field.
     *
     * @return \Illuminate\Http\Response
     */
    public function validateCheck($request, $id = null)
    {
        return true;

        return $request->validate([
            //ex: 'name' => 'required|email|nullable|date|string|min:0|max:191',
        ], [
            //ex: 'name' => "This name is required" (custom message)
        ]);
    }

    // getEventsCategory
    public function getEventCategory()
    {
        $eventCategory = Category::where('module_name', 'events')->where('status', 'active')->get();

        return $eventCategory;
    }
}
