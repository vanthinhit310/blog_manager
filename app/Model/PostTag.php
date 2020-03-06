<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class PostTag extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'post_tags';

    protected $fillable = [
        'post_id',
        'tag_id'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class,'post_id');
    }

    public function tag()
    {
        return $this->belongsTo(Post::class,'tag_id');
    }

}
