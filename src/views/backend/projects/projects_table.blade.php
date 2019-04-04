<?php
/**
 * Created by PhpStorm.
 * User: gregorysteenhagen
 * Date: 2019-03-17
 * Time: 11:38
 */

?>



<table id="projectTable" class="table table-striped table-bordered" style="width:100%">
    <thead>
    <tr>
        <th>Order</th>
        <th>ID</th>
        <th>Title</th>
        <th>Short Description</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($projects as $project)
        @include('backend.projects.projects_table_row', ['project' => $project])
    @endforeach
    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="deleteProjectModal" tabindex="-1" role="dialog" aria-labelledby="deleteProjectLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteProjectLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="deleteProjectForm" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                </form>
                Are you sure you want to delete this project?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger" form="deleteProjectForm">Delete Project</button>
            </div>
        </div>
    </div>
</div>

<input type="hidden" name="order-route" id="orderRoute" value="{{route('admin.projects.reorder')}}">
<input type="hidden" name="csrf-value" id="csrfValue" value="{{csrf_token()}}">