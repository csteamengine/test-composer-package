<?php
/**
 * Created by PhpStorm.
 * User: gregorysteenhagen
 * Date: 2019-03-10
 * Time: 16:09
 */
?>
{{ html()->modelForm($project, $method, $route)->class('form-horizontal')->open() }}
@csrf
<div class="row">
    <div class="col-md-6 mb-3">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="{{$project->title}}" required="">
        <div class="invalid-feedback">
            Valid title is required.
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <label for="medium">Medium</label>
        <input type="text" class="form-control" name="medium" id="medium" placeholder="Medium" value="{{$project->medium}}" required="">
        <div class="invalid-feedback">
            Valid medium is required.
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <label for="short_description">Short Description</label>
        <input type="text" class="form-control" id="title" name="short_description" placeholder="Short Description" value="{{$project->short_description}}" required="">
        <div class="invalid-feedback">
            Valid short description is required.
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 mb-3">
        <label for="description">Description</label>
        <textarea id="summernote" class="form-control" name="description" placeholder="Description">{!! nl2br($project->description) !!}</textarea>
        <div class="invalid-feedback">
            Valid description is required.
        </div>
    </div>
    <div class="col-6 mb-3">
        <label for="start_date">Date Started</label>
        <input type="number" maxlength="4" minlength="4" class="form-control" id="start_date" name="date_started" placeholder="" value="{{$project->date_started}}" required="">
        <div class="invalid-feedback">
            Valid date is required.
        </div>
    </div>
    <div class="col-6 mb-3">
        <label for="completed_date">Date Completed</label>
        <input type="number" maxlength="4" minlength="4" class="form-control" id="completed_date" name="date_completed" placeholder="" value="{{$project->date_completed}}" required="">
        <div class="invalid-feedback">
            Valid date is required.
        </div>
    </div>
    <div class="col-6 mb-3">
        <div class="form-check form-check-inline">
            <input class="form-check-input" name="is_active" type="radio" id="active" value="1" @if($project->is_active != 0) checked @endif>
            <label class="form-check-label" for="active">Active</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" name="is_active" type="radio" id="inactive" value="0" @if($project->is_active == 0) checked @endif>
            <label class="form-check-label" for="inactive">Inactive</label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <button class="btn btn-primary btn-lg btn-block" type="submit">Save</button>
    </div>
</div>
{{ html()->closeModelForm() }}