<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
class Category extends Model implements Auditable
{
    //
    use \OwenIt\Auditing\Auditable;

    protected $table = 'categories';

    protected $fillable = [
        'title',
        'meta_title',
        'slug',
        'content',
        'created_at',
        'updated_at'
    ];
}
