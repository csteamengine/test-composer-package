<?php
/**
 * Created by PhpStorm.
 * User: gregorysteenhagen
 * Date: 2019-03-16
 * Time: 08:58
 */
?>

<div class="project-tile col-6 col-md-4 text-center">
    <div class="content project-tile-content" style="background-color: {{'#'.$project->images[0]->image_color}}" data-image="{{$project->images[0]->image_url}}">
        <a href="{{route('frontend.projects.show', $project)}}">
            <div class="project-tile-overlay">
                <span class="project-tile-title">{{$project->title}}</span>
            </div>
        </a>
    </div>
</div>