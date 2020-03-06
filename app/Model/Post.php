<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
class Post extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'posts';


    protected $fillable = [
        'author_id',
        'title',
        'meta_title',
        'slug',
        'summary',
        'content',
        'published',
        'published_at'
    ];
}
