<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Disciplines
    Route::apiResource('disciplines', 'DisciplinesApiController');

    // Institutions
    Route::post('institutions/media', 'InstitutionsApiController@storeMedia')->name('institutions.storeMedia');
    Route::apiResource('institutions', 'InstitutionsApiController');

    // Courses
    Route::post('courses/media', 'CoursesApiController@storeMedia')->name('courses.storeMedia');
    Route::apiResource('courses', 'CoursesApiController');

    // Enrollments
    Route::apiResource('enrollments', 'EnrollmentsApiController');
});
