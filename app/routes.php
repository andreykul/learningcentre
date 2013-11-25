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


Route::controller('ta', 'TaController');
Route::controller('ta', 'TaProfileController');
Route::controller('ta', 'TaAvailabilityController');
Route::controller('ta', 'TaSetupController');

Route::controller('/','AppController');

