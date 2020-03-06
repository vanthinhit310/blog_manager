<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
class PostMeta extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'post_metas';

    protected $fillable = [
        'post_id',
        'key',
        'content'
    ];


    public function post()
    {
        return $this->belongsTo(Post::class,'post_id');
    }
}
