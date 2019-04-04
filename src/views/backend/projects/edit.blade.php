@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('strings.backend.products.title'))

@push('before-styles')
    {{--Jquery TOoltip Alternate Theme--}}
    <link href="https://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />
    <!-- include summernote css/js-->
    <link href="/js/summernote/dist/summernote-bs4.css" rel="stylesheet">

    <style>

        #sortable {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        #sortable li {
            position: relative;
            display: inline-block;
            /*text-align: center;*/
            float: left;
            margin-bottom: 20px;
            background: none;
            border: none;
        }

        #sortable li:hover {
            cursor: pointer;
        }

        #sortable li .project-image{
            height: 200px;
            background: #eee;
            padding: 10px;
            margin: 10px;
            overflow: hidden;
            overflow-y: scroll;
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            border-radius: 5px;
        }

        #newImageButton{
            margin: 20px;
        }

        .project-image-variable{
            position: absolute;
            left: 0;
            font-size: 12px;
            bottom: -15px;
            width: 100%;
            text-align: center;
        }
        .marked img{
            border: 1px solid red !important;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#information" data-toggle="tab" role="tab" aria-controls="info" aria-selected="true">
                                <strong>Information</strong>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#images" data-toggle="tab" role="tab" aria-controls="images" aria-selected="false"><strong>Images</strong></a>
                        </li>
                    </ul>

                </div><!--card-header-->
                <div class="card-body tab-content" id="projectContent">
                    <div class="tab-pane fade show active" id="information" role="tabpanel" aria-labelledby="info-tab">
                        @include('backend.projects.projectInfoForm', ['project' => $project, 'route' => route('admin.projects.update', ['id' =>$project->id]), 'method'=>'PATCH'])
                    </div>
                    <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="info-tab">
                        @include('backend.projects.projectImagesForm', ['project' => $project, 'images' => $images])
                    </div>
                </div><!--card-body-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
@endsection

@push('after-scripts')
    {!! script('https://code.jquery.com/ui/1.12.1/jquery-ui.js') !!}
    {!! script('/js/summernote/dist/summernote-bs4.js') !!}
    {!! script(mix('js/backend/project.js')) !!}
@endpush
