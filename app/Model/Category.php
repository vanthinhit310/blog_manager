<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Cviebrock\EloquentSluggable\Sluggable;
class Category extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use Sluggable;

    protected $table = 'categories';

    protected $fillable = [
        'title',
        'meta_title',
        'slug',
        'content',
        'created_at',
        'updated_at'
    ];

    /**
     * @inheritDoc
     */
    public function sluggable(): array
    {
        // TODO: Implement sluggable() method.
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
