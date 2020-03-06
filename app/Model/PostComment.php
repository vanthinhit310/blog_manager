<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
class PostComment extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'post_comments';

    protected $fillable = [
        'post_id',
        'content',
        'published',
        'published_at'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class,'post_id');
    }
}
