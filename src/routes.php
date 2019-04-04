<?php
/**
 * Created by PhpStorm.
 * User: gregorysteenhagen
 * Date: 2019-02-17
 * Time: 07:17
 */


use Csteamengine\ProjectManager\Controllers\ProjectController;

/*
 * All route names are prefixed with 'admin.'.
 */
Route::resource('projects', ProjectController::class);
//Route::get('projects', [ProjectController::class, 'index'])->name('projects');


/*
 * Backend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Projects', 'prefix' => 'projects', 'as' => 'projects.', 'middleware' => 'admin'], function () {
    Route::post('{id}/addImages', [ProjectController::class, 'addImages'])->name('addImages');
    Route::post('{id}/updateImages', [ProjectController::class, 'updateImages'])->name('updateImages');
    Route::post('{id}/orderImages', [ProjectController::class, 'orderImages'])->name('orderImages');
    Route::post('{id}/deleteImages', [ProjectController::class, 'deleteImages'])->name('deleteImages');
    Route::delete('{id}', [ProjectController::class, 'destroy'])->name('destroy');
    Route::post('/reorder', [ProjectController::class, 'reorder'])->name('reorder');
//    Route::get('create/', [ProjectController::class, 'create'])->name('create');
//    Route::post('store/', [ProjectController::class, 'store'])->name('store');
//    Route::put('{id}/update', [ProjectController::class, 'update'])->name('update');
});
