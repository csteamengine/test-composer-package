<?php
/**
 * Created by PhpStorm.
 * User: gregorysteenhagen
 * Date: 2019-03-16
 * Time: 20:36
 */

?>
<div class="row">
    <div class="col-12 text-center">
        <h3>Images</h3>
    </div>
</div>
<div class="project-image-container row mb-5 justify-content-center">
    @foreach($images as $image)
        <a class="project-image-tiles col-sm-4 col-md-3 col-lg-2 p-2" data-slide-to="{{$loop->index}}" data-target="#projectImageCarousel">
            {{--<img class="project-image-tiles" src="{{$image->image_url}}" alt="Project Image">--}}
            <div class="project-image-tiles-image" style="background-color: {{'#'.$image->image_color}}" data-image="{{$image->image_url}}"></div>
        </a>
    @endforeach
</div>