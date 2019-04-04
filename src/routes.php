<?php

use Csteamengine\TestComposerPackage\Controllers\TestController;

Route::get('test', [TestController::class, 'index'])->name('test');