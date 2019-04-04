<?php
/**
 * Created by PhpStorm.
 * User: gregorysteenhagen
 * Date: 2019-03-17
 * Time: 11:40
 */
?>

<tr>

    {{--Order--}}
    <td>{{$loop->index+1}}</td>

    {{--ID--}}
    <td>{{$project->id}}</td>

    {{--Title--}}
    <td>{{$project->title}}</td>

    {{--Short Description--}}
    <td>{{$project->short_description}}</td>

    {{--Start Date--}}
    <td>{{$project->date_started}}</td>

    {{--End Date--}}
    <td>{{$project->date_completed}}</td>

    {{--Status--}}
    <td>
        @if($project->is_active)
            <i class="icon-check icons font-2xl mt-4  d-inline text-success"></i>
        @else
            <i class="icon-close icons font-2xl mt-4  d-inline text-danger"></i>
        @endif
    </td>

    {{--Action--}}
    <td>
        <div class="row">
            <div class="col-12 d-inline">
                {!! $project->action_buttons !!}
            </div>
        </div>
    </td>
</tr>
