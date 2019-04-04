<?php
/**
 * Created by PhpStorm.
 * User: gs57722
 * Date: 3/15/19
 * Time: 10:52 AM
 */
?>
<div class="row">
    <div class="col-10 m-auto">
        <div id="projectImageCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
            <div class="carousel-inner">
                @foreach($images as $image)
                    <div class="carousel-item @if($loop->first) active @endif h-100 m-auto" style="background-color: {{'#'.$image->image_color}}; background-size: 100% !important" data-width="{{$image->image_width}}" data-height="{{$image->image_height}}" data-image="{{$image->image_url}}">
                        {{--<img src="{{$image->image_url}}" alt="{{$image->title}}" class="d-block h-100 m-auto">--}}
                        {{--<div class="carousel-caption d-none d-md-block">--}}
                        {{--<h5>{{$image->title}}</h5>--}}
                        {{--<p>{{$image->short_description}}</p>--}}
                        {{--</div>--}}
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#projectImageCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#projectImageCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>