<?php
/**
 * @Nogor Solutions Ltd
 */

namespace App\Http\Controllers\Admin\Website\Gallery;

use App\Action\Util\DeleteAction;
use App\Http\Controllers\Base\BaseController;
use App\Http\Resources\Resource;
use App\Models\Website\Gallery\Video;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class VideoController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Video::with('album')->whereHas('album', function ($query) use ($request) {
            $query->whereLike('name', $request->value);
        })->oldest('sorting');

        $query->whereAny('status', $request->status);

        if (! empty($request->album_id)) {
            $query->whereAny('album_id', $request->album_id);
        }

        if ($request->field_name !== 'album_name') {
            $query->whereLike($request->field_name, $request->value);
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
                Cache::forget('website_cache');
                $data = $request->except('thumbnail');
                $image = $request->image_base64;

                if (! empty($image)) {
                    $data['thumbnail'] = cloudflare(file: $image, folder: 'video', resizeSize: '600x600,200x200', base64: true);
                }

                $res = Video::create($data);

                return $this->responseReturn('create', $res);
            } catch (Exception $ex) {
                return response()->json(['exception' => $ex->errorInfo ?? $ex->getMessage()], 422);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if ($request->format() == 'html') {
            return view('layouts.backend_app');
        }

        return Video::with('album')->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        return view('layouts.backend_app');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Model\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video, DeleteAction $delete)
    {
        if ($this->validateCheck($request)) {
            Cache::forget('website_cache');

            try {
                $data = $request->except('thumbnail');

                $image = $request->image_base64;

                if (! empty($image) && is_base64($image)) {
                    @$delete->arrayImages($video->thumbnail);
                    $data['thumbnail'] = cloudflare(file: $image, folder: 'video', resizeSize: '600x600,200x200', base64: true);
                } else {
                    $data['thumbnail'] = $video->thumbnail;
                }

                $video->update($data);

                return $this->responseReturn('update', $video);
            } catch (Exception $ex) {
                return response()->json(['exception' => $ex->errorInfo ?? $ex->getMessage()], 422);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video, DeleteAction $delete)
    {
        Cache::forget('website_cache');
        @$delete->arrayImages($video->thumbnail);

        $res = $video->delete();

        return $this->responseReturn('delete', $res);
    }

    /**
     * Validate form field.
     *
     * @return \Illuminate\Http\Response
     */
    public function validateCheck($request)
    {
        return $request->validate([
            'sorting' => 'required',
            'status' => 'required',
            'original_image' => 'required',
            'title' => 'required',
            'album_id' => 'required',
        ]);
    }
}
