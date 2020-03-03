<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Helper;
use Laratrust\Traits\LaratrustUserTrait;
use OwenIt\Auditing\Contracts\Auditable;

class User extends Authenticatable implements Auditable
{
    use LaratrustUserTrait;
    use Notifiable;
    use \OwenIt\Auditing\Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstName',
        'middleName',
        'lastName',
        'email',
        'password',
        'mobile',
        'email_verified_at',
        'register_at',
        'last_login',
        'intro',
        'profile',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'register_at' => 'datetime',
        'last_login' => 'datetime',
    ];
    public function getFullNameAttribute() {
        return ucfirst($this->firstName) . ' ' . ucfirst($this->lastName);
    }

    public function scopeWhereRoleIsOther()
    {
        return $this->whereHas('roles', function ($roleQuery){
            $roleQuery->where('name','!=','admin')
                ->where('name','!=','user');
        });
    }
}
