<?php

namespace App;

use Laratrust\Models\LaratrustRole;
use OwenIt\Auditing\Contracts\Auditable;
class Role extends LaratrustRole implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'roles';
    protected $fillable = [
        'name',
        'display_name',
        'description',
        'created_at',
        'updated_at'
    ];
    protected $casts = [
        'created_at' => 'dateTime',
        'updated_at' => 'dateTime'
    ];
}
