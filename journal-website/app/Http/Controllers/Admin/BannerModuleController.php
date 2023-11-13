<?php

/**
 * @Nogor Solutions Ltd
 */

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\BannerModule;
use Illuminate\Http\Request;
use App\Http\Resources\Resource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Base\BaseController;
use Storage;

class BannerModuleController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $query  = BannerModule::latest();
        $query->whereLike( $request->field_name, $request->value );

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Artisan::call('optimize:clear');

        //dd('hi');
        $conf = BannerModule::first();
        $data = $request->all();
        //$file1 = $request->image_base64;
        $file1 = $request->file('banner_img1');
        //dd($conf);
        //dd($file1);

        if (! empty($conf)) {
            //dd("hi");
            $this->validateCheck($request);

            // logo Big...
            if (! empty($file1)) {
                $data['banner_img1'] = $this->upload($file1, 'banner', $conf->banner_img1);
                //dd($data['banner_img1']);
            } else {
                $data['banner_img1'] = $this->oldFile($conf->banner_img1);
            }

            $conf->update($data);

            return $this->responseReturn('update', $conf);
        } else {
            //dd("hi");
            //dd($file1);
            $this->validateCheck($request);
            if (! empty($file1)) {
                $data['banner_img1'] = $this->upload($file1, 'banner');
                //dd($data['banner_img1']);
            }

            $banner = BannerModule::create($data);

            return $this->responseReturn('create', $banner);
        }

        // if ($this->validateCheck($request)) {
        //     try {
        //         $data = $request->all();
        //         // push the insert text
        //         $res = BannerModule::create($data); 
        //         return $this->responseReturn( "create", $res );
        //     } catch (Exception $ex) {
        //         return response()->json( ['exception' => $ex->errorInfo ?? $ex->getMessage()], 422 );
        //     }
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BannerModule  $bannerModule
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, BannerModule $bannerModule)
    {
        if ($request->format() == 'html') {
            return view('layouts.backend_app');
        }
        return $bannerModule;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BannerModule  $bannerModule
     * @return \Illuminate\Http\Response
     */
    public function edit(BannerModule $bannerModule)
    {
        return view('layouts.backend_app');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BannerModule  $bannerModule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BannerModule $bannerModule)
    {
        //return view('layouts.admin_app');
        if ($this->validateCheck($request, $bannerModule->id)) {
            try {
                $conf = BannerModule::first();
                $data = $request->all();
                //$file1 = $request->image_base64;
                $file1 = $request->file('banner_img1');

                // push the update text
                if (! empty($conf)) {
                    //dd("hi");
                    $this->validateCheck($request);
        
                    // logo Big...
                    if (! empty($file1)) {
                        $data['banner_img1'] = $this->upload($file1, 'banner', $conf->banner_img1);
                        //dd($data['banner_img1']);
                    } else {
                        $data['banner_img1'] = $this->oldFile($conf->banner_img1);
                    }
        
                    $conf->update($data);
        
                    return $this->responseReturn('update', $conf);
                }

                return $this->responseReturn( "update", $bannerModule );
            } catch (Exception $ex) {
                return response()->json( ['exception' => $ex->errorInfo ?? $ex->getMessage()], 422 );
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BannerModule  $bannerModule
     * @return \Illuminate\Http\Response
     */
    public function destroy(BannerModule $bannerModule)
    {
        $old1 = $this->oldFile($bannerModule->banner_img1);
        if (Storage::disk('public')->exists($old1)) {
            Storage::delete($old1);
        }
        $res = $bannerModule->delete();
        return $this->responseReturn( "delete", $res );
    }

    /**
     * Validate form field.
     *
     * @return \Illuminate\Http\Response
     */
    public function validateCheck($request, $id=null)
    {
        return true;
        return $request->validate([
            //ex: 'name' => 'required|email|nullable|date|string|min:0|max:191',
        ],[
            //ex: 'name' => "This name is required" (custom message)
        ]);
    }
}
