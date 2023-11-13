<?php

/**
 * @Nogor Solutions Ltd
 */

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use App\Http\Resources\Resource;
use App\Models\Website\FrontMenu;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FrontMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = FrontMenu::with('content', 'parent')->latest();
        $query->whereAny('type', $request->type);
        // $query->whereAny('position', $request->position);
        $query->whereAny('status', $request->status);

        if ($request->field_name == 'content') {
            $query->whereHas('content', function ($query) use ($request) {
                $query->where('title', $request->value);
            });
        } elseif ($request->field_name == 'parent') {
            $query->whereHas('parent', function ($query) use ($request) {
                $query->where('title', $request->value);
            });
        } else {
            $query->whereLike($request->field_name, $request->value);
        }

        $datas = $query->paginate($request->pagination);

        return new Resource($datas);
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
        Cache::forget('front_menu_cache');
        $this->validateCheck($request);

        try {
            $res = FrontMenu::create($request->all());

            return $this->responseReturn('create', $res);
        } catch (Exception $ex) {
            return response()->json(['exception' => $ex->errorInfo ?? $ex->getMessage()], 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if ($request->format() == 'html') {
            return view('layouts.backend_app');
        }

        $menu = FrontMenu::with('content')->where('id', $id)->first();

        return $menu;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('layouts.backend_app');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Model\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Cache::forget('front_menu_cache');
        $this->validateCheck($request);

        $data = $request->except('content', 'updated_at', 'created_at');
        $frontMenu = FrontMenu::where('id', $id)->first();

        $frontMenu->update($data);

        return $this->responseReturn('update', $frontMenu);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(FrontMenu $frontMenu)
    {
        Cache::forget('front_menu_cache');
        $res = $frontMenu->delete();

        return $this->responseReturn('delete', $res);
    }

    /**
     * get parent menus.
     */
    public function getParentMenu()
    {
        return FrontMenu::getMenuList();
    }

    /**
     * Validate form field.
     *
     * @return \Illuminate\Http\Response
     */
    public function validateCheck($request, $id = null)
    {
        return $request->validate([
            'sorting' => 'required',
            'status' => 'required',
            'position' => 'required',
            'title' => 'required|string|min:0|max:191',
        ]);
    }
}
