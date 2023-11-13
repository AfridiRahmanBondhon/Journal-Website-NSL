<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Base\BaseController;
use App\Http\Resources\Resource;
use App\Models\Admin;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Admin::with('role')->where('id', '!=', 2)->latest();
        $query->whereLike($request->field_name, $request->value);
        $query->whereAny('status', $request->status);

        if (! empty($request->role_id)) {
            $query->whereAny('role_id', $request->role_id);
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
                $data = $request->all();
                $profile = $request->profile;

                if (! empty($profile)) {

                    if (! empty($profile)) {
                        $data['profile'] = $this->upload($profile, 'admin', null, $base64 = true);
                    }
                }

                $res = Admin::create($data);

                return $this->responseReturn('create', $res);
            } catch (Exception $ex) {
                return response()->json(['exception' => $ex->errorInfo ?? $ex->getMessage()], 422);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Admin $admin)
    {
        if ($request->format() == 'html') {
            return view('layouts.backend_app');
        }
        if (Auth::guard('admin')->user()->role_id == 1) {
            return Admin::with('role')->find($admin->id);
        }

        return Admin::with('role')->find(Auth::guard('admin')->user()->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        return view('layouts.backend_app');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        $data = $request->all();
        $profile = $request->profile;

        try {
            if (! empty($profile)) {
                $data['profile'] = $this->upload($profile, 'admin', $admin->profile, $base64 = true);
            } else {
                $data['profile'] = $this->oldFile($admin->profile);
            }

            $data = [
                'name' => $request->name,
                'role_id' => $request->role_id ?? $admin->role_id,
                'mobile' => $request->mobile,
                'profile' => $data['profile'],
                'status' => empty($data['status']) ? 'active' : $data['status'],
            ];

            $admin->update($data);

            return $this->responseReturn('update', $admin);
        } catch (Exception $ex) {
            return response()->json(['exception' => $ex->errorInfo ?? $ex->getMessage()], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $authenticatedId = auth('admin')->user()->id ?? '';

        $res = Admin::query()
            ->where('id', '=', $id)
            ->where('id', '!=', $authenticatedId)
            ->delete();

        return $this->responseReturn('delete', false);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function checkOldPassword(Request $request)
    {
        if (empty($request->for_delete)) {
            if (Auth::guard('admin')->user()->role_id == 1 && Auth::guard('admin')->user()->id != $request->id) {
                return response()->json(true);
            }
        }
        if (Auth::guard('admin')->validate(['password' => $request->old_password, 'id' => $request->id])) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    /**
     * Password change
     *
     * @return json
     */
    public function passwordChange(Request $request)
    {
        $request->validate([
            'new_password' => 'required|min:6|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'required|min:6',
            'old_password' => [
                'required', function ($attribute, $value, $fail) {
                    if (! Hash::check($value, Auth::user()->password)) {
                        $fail('Old Password didn\'t match');
                    }
                },
            ],
        ]);

        $user = Admin::where('id', $request->id)->first();

        $user->update([
            'password' => $request->new_password,
        ]);

        return response()->json(['message' => 'Password change successfully!!'], 200);
    }

    /**
     * Validate form field.
     *
     * @return \Illuminate\Http\Response
     */
    public function validateCheck($request)
    {
        return $request->validate([
            'name' => 'required|min:3|max:60',
            'email' => 'required|min:3|unique:admins|max:100',
            'password' => 'required|min:6|max:30',
            'role_id' => 'required',
        ]);
    }
}
