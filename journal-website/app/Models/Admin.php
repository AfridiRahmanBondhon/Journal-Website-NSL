<?php

namespace App\Models;

use App\Models\System\Role;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class Admin extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $guarded = ['id'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'role_id')->select('id', 'name');
    }

    public function getProfileAttribute($value)
    {
        $defaultImage = url('/public/images/profile.jpg');

        if (! empty($value) && Storage::exists($value)) {
            return url('/public/storage/'.$value);
        }

        return $defaultImage;
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
