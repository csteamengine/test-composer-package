<?php

namespace Csteamengine\ProjectManager\Models;

use Csteamengine\ProjectManager\Models\Traits\Attribute\ProjectAttribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{

    use SoftDeletes,
        ProjectAttribute;

    protected $fillable = [
        'title',
        'description',
        'short_description',
        'image_id',
        'date_started',
        'date_completed',
        'medium',
        'is_active',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'active' => 'boolean',
        'confirmed' => 'boolean',
    ];

    public function images(){
        return $this->belongsToMany('App\Models\Image', 'project_images')->withPivot('order')->withPivot(['id', 'variable_name'])->orderBy('order');
    }

    public function image(){
        return $this->belongsTo('App\Models\Image');
    }

    public function get_parsed_description($input_description = null){
        if(is_null($input_description)){
            $input_description = $this->description;
        }

        $processed_string = preg_replace_callback(
            '~\!%(.*?)%!~si',
            function($match)
            {
                $image_html = $this->parse_image_html($match[1]);
                return str_replace($match[0], $image_html, $match[0]);
            },
            $input_description);

        return nl2br($processed_string);
    }

    public function parse_image_html($image_match = ''){
        $project_id = explode('_', $image_match)[1];
        $image_id = explode('--', explode('_', $image_match)[2])[0];
        $image_width = $this->parse_image_width($image_match);
        $project_image = ProjectImage::where('image_id', $image_id)->where('project_id', $project_id)->first();
        $image_html = '<img src="/storage/undefined.png" height="100" alt="Image could not be found">';

        if(!is_null($project_image)){
            $image = $project_image->image()->get()->first();

            $image_html = '<img src="'.$image->image_url.'" class="img-fluid" width="'.$image_width.'%" alt="Image could not be found">';
        }

        return $image_html;
    }

    public function parse_image_width($image_match){
        $heights = array();
        $test = preg_match('/--[0-9]*/', $image_match, $heights);
        $image_width = 250;

        if($test){
            $image_width = str_replace('-', '', $heights[0]);
        }
        return $image_width;
    }
}
