<?php
/**
 * Created by PhpStorm.
 * User: gregorysteenhagen
 * Date: 2019-03-12
 * Time: 21:06
 */

?>

<button class="btn btn-primary" id="newImageButton" data-toggle="modal" data-target="#newImageModal">
    Add Images
</button>

<!-- Modal -->
<div class="modal fade" id="newImageModal" tabindex="-1" role="dialog" aria-labelledby="newImageModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-control" action="{{route('admin.projects.addImages', $project)}}" enctype="multipart/form-data" id="newImageFile" method="POST">
                    @csrf
                    <input class="form-control-file" name="newImageFile[]" id="newImageFile" type="file" accept="image/png, image/jpeg" multiple required>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="newImageFile">Upload Images</button>
            </div>
        </div>
    </div>
</div>