<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| First match will be mapped, therefore most common matching at the bottom.
|
*/

Route::controller('admin/availability/download', 'AdminAvailabilityDownloadController');
Route::controller('admin/availability', 'AdminAvailabilityController');
Route::controller('admin/tas', 'AdminTAsController');
Route::controller('admin', 'AdminHomeController');

Route::controller('ta/profile', 'TaProfileController');
Route::controller('ta/availability', 'TaAvailabilityController');
Route::controller('ta/setup', 'TaSetupController');
Route::controller('ta', 'TaHomeController');

Route::controller('/','AppController');

