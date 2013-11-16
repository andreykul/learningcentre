<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| First match will be mapped, therefore most common matching at the bottom.
|
*/

Route::controller('admin', 'AdminController');
Route::controller('admin', 'AdminAvailabilityController');

Route::controller('ta', 'TaController');
Route::controller('ta', 'TaProfileController');
Route::controller('ta', 'TaAvailabilityController');

Route::controller('/','AppController');

