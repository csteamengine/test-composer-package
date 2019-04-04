@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . $project->title))
@section('meta_description', $project->short_description)
@section('meta_canonical', "https://kellydevittceramics.com/gallery")
@push('before-styles')
    {{style(mix('/css/projects/project.css'))}}
@endpush

@section('content')
    <div class="row mb-5">
        <div class="col-md-6">
            @include('frontend.projects.image_carousel', ['project' => $project, 'images' => $images])
        </div>
        <div class="col-md-6 align-self-center text-center mt-3">
            <h3>{!! $project->title !!}</h3>
            <p>{!! $project->short_description !!}</p>
            <p><small>{!! $project->date_started !!} - {!! $project->date_completed !!}<br>{!! $project->medium !!}</small></p>
        </div>
    </div>

    @include('frontend.projects.project_description', ['project' => $project])
    @include('frontend.projects.image_list', ['images' => $project->images()->get()])
@endsection

@push('after-scripts')
    {{script(mix('js/frontend/project.js'))}}
@endpush