<?php

/**
 * @Nogor Solutions Ltd
 */

namespace App\Http\Controllers\Admin\Website\Gallery;

use App\Action\Util\DeleteAction;
use App\Http\Controllers\Base\BaseController;
use App\Http\Resources\Resource;
use App\Models\Website\Gallery\Album;
use App\Models\Website\Gallery\Photo;
use App\Models\Website\Gallery\Video;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlbumController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Album::query()->withCount(['photos', 'videos'])->oldest('sorting');
        $query->whereLike($request->field_name, $request->value);
        $query->whereAny('status', $request->status);
        $query->whereAny('type', $request->type);

        if ($request->allData) {
            $query->where('type', $request->type);

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
        $data = $request->all();
        $image = $request->image_base64;

        try {
            if (! empty($image)) {
                $data['image'] = cloudflare(file: $image, folder: 'album', resizeSize: '600x600,242x242,339x260', base64: true);
            }

            $res = Album::create($data);

            return $this->responseReturn('create', $res);
        } catch (Exception $ex) {
            return response()->json(['exception' => $ex->errorInfo ?? $ex->getMessage()], 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $album = Album::find($id);

        if ($request->format() == 'html') {
            return view('layouts.backend_app');
        }

        if ($request->view != null) {
            return Photo::where('album_id', $album->id)->get();
        }

        if ($album->type == Album::PHOTOS) {
            $album->load('photos');
        } else {
            $album->load('videos');
        }

        return $album;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit($album)
    {
        return view('layouts.backend_app');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Model\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Album $album, DeleteAction $delete)
    {
        $data = $request->all();
        $image = $request->image_base64;

        try {
            if (! empty($image) && is_base64($image)) {
                @$delete->arrayImages($album->image);
                $data['image'] = cloudflare(file: $image, folder: 'album', resizeSize: '600x600,242x242,339x260', base64: true);
            } else {
                $data['image'] = $album->image;
            }

            $album->update($data);

            return $this->responseReturn('update', $album);
        } catch (Exception $ex) {
            return response()->json(['exception' => $ex->errorInfo ?? $ex->getMessage()], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, DeleteAction $delete)
    {
        $album = Album::where('id', $id)->firstOrFail();
        @$delete->arrayImages($album->image);

        if ($album->type === 'Videos') {

            $videos = Video::where('album_id', $album->id)->get();

            foreach ($videos as $video) {
                @$delete->arrayImages($video->thumbnail);
            }

            $delete = Video::where('album_id', $album->id)->delete();
        } else {
            $photos = Photo::where('album_id', $album->id)->get();
            foreach ($photos as $key => $photo) {
                foreach ($photo->images as $key1 => $value) {
                    $old = $this->oldFile($value);
                    if (Storage::disk('public')->exists($old)) {
                        Storage::delete($old);
                    }
                }
            }
            Photo::where('album_id', $album->id)->delete();
        }

        $res = $album->delete();

        return $this->responseReturn('delete', $res);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function album($type)
    {
        return Album::oldest('sorting')
            ->where('type', $type)
            ->where('status', 'active')
            ->get(['name', 'id']);
    }

    /**
     * Validate form field.
     *
     * @return \Illuminate\Http\Response
     */
    public function validateCheck($request)
    {
        return $request->validate([
            'name' => 'required|max:200',
        ]);
    }
}
