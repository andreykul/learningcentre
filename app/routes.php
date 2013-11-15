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

Route::controller('ta', 'TaController');

Route::controller('/','AppController');

