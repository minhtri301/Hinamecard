<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class PageSub extends Model
{
    use HasFactory,Sluggable;

    protected $table = 'page_sub';

    protected $fillable = ['slug', 'name_page', 'content', 'image', 'banner',
    'title_h1', 'meta_title', 'meta_description', 'meta_keyword','meta_schema'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name_page'
            ]
        ];
    }
}
