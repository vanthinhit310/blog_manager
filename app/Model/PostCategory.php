<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
class PostCategory extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'post_categories';

    protected $fillable = [
        'post_id',
        'category_id'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class,'post_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
}
