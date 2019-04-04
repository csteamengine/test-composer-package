<?php
/**
 * Created by PhpStorm.
 * User: gs57722
 * Date: 3/12/19
 * Time: 1:38 PM
 */
?>
<div class="row">
    <div class="row">
        <form method="POST" action="{{route('admin.projects.deleteImages', $project)}}" id="deleteImagesForm">
            @csrf
            <input type="hidden" name="imageIds" id="delete-images-input">
        </form>
        @include('backend.projects.newImage')
        <button type="submit" class="btn btn-primary" form="orderForm" style="margin: 20px">
            Update Order
        </button>
        <button type="submit" id="delete-images-submit" class="btn btn-danger" style="margin: 20px" form="deleteImagesForm" disabled>
            Delete Images
        </button>
    </div>
</div>
<div class="row">
    <ul id="sortable">
        @foreach($images as $image)
            <li id="{{$image->pivot->id}}" class="image-tile">
                @include('backend.projects.image', ['image' => $image])
            </li>
        @endforeach
    </ul>
</div>

<form action="{{route('admin.projects.orderImages', $project)}}" method="POST" id="orderForm">
    @csrf
    <input type="hidden" value="" id="order" name="order">
</form>