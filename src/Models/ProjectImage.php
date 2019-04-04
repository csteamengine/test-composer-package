<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectImage extends Model
{
    protected $fillable = [
        'project_id',
        'image_id',
        'description',
        'is_active',
        'order'
    ];

    public function image(){
        return $this->belongsTo('App\Models\Image');
    }
}
