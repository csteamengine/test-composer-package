@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('strings.backend.projects.index.title'))

@push('before-styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.5/css/rowReorder.dataTables.min.css">
    <style>
        tr{
            cursor: pointer;
        }
    </style>
@endpush

@section('content')
    <div class="row mb-2">
        <div class="col">
            <a href="{{route('admin.projects.create')}}" class="btn btn-primary">
                Add Project
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <strong>@lang('strings.backend.projects.index.title')</strong>
                </div><!--card-header-->
                <div class="card-body">
                    @include('backend.projects.projects_table', ['projects' => $projects])
                </div><!--card-body-->
            </div><!--card-->
        </div><!--col-->

    </div><!--row-->
@endsection

@push('after-scripts')
    {!! script('https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js') !!}
    {!! script('https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js') !!}
    {!! script('https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js') !!}
    {!! script('https://cdn.datatables.net/rowreorder/1.2.5/js/dataTables.rowReorder.min.js') !!}
    {!! script(mix('js/backend/projects.js')) !!}
@endpush