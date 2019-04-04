@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.general.projects'))
@section('meta_canonical', "https://kellydevittceramics.com/projects")
@push('before-styles')
    {{style(mix('/css/projects/project_tile.css'))}}
@endpush

@section('content')
    <div class="row justify-content-center">
        @if(sizeof($projects) == 0)
            <h4 class="mt-4">There are no projects to view yet.</h4>
        @endif
        @foreach($projects as $project)
            @include('frontend.projects.project_tile', ['project' => $project])
        @endforeach
    </div>
@endsection

@push('after-scripts')
    {{script(mix('js/frontend/projects.js'))}}
@endpush