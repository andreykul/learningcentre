<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| First match will be mapped, therefore most common matching at the bottom.
|
*/

Route::controller('admin/availability/export', 'AdminAvailabilityExportController');
Route::controller('admin/availability/import', 'AdminAvailabilityImportController');
Route::controller('admin/availability', 'AdminAvailabilityController');
Route::controller('admin/schedule/day', 'AdminScheduleDayController');
Route::controller('admin/schedule', 'AdminScheduleController');
Route::controller('admin/tas', 'AdminTAsController');
Route::controller('admin/courses', 'AdminCoursesController');
Route::controller('admin', 'AdminHomeController');

Route::controller('ta/shifts', 'TaShiftsController');
Route::controller('ta/hours', 'TaHoursController');
Route::controller('ta/timesheet', 'TaTimesheetController');
Route::controller('ta/profile/courses', 'TaCoursesController');
Route::controller('ta/profile', 'TaProfileController');
Route::controller('ta/availability', 'TaAvailabilityController');
Route::controller('ta/setup', 'TaSetupController');
Route::controller('ta/public/profile', 'TaPublicProfileController');
Route::controller('ta', 'TaHomeController');

Route::controller('courses/help','CoursesHelpController');

Route::controller('/','AppController');

