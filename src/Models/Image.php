<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'title',
        'description',
        'short_description',
        'image_url',
        'image_type',
        'image_thumbnail',
        'image_color',
        'image_width',
        'image_height',
        'category_id',
        'is_active',
    ];
}
