@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('strings.backend.products.title'))

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <strong>New Project</strong>
                </div><!--card-header-->
                <div class="card-body">
                    @include('backend.projects.projectInfoForm', ['project' => $project, 'route' => route('admin.projects.store'), 'method'=>'POST'])
                </div><!--card-body-->
            </div><!--card-->
        </div><!--col-->

    </div><!--row-->
@endsection
