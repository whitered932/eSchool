<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix' => config('admin.route.prefix'),
    'namespace' => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
    'as' => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'GradeController@index')->name('home');
    $router->resource('grades', GradeController::class);
    $router->resource('lessons', LessonController::class);
    $router->resource('teachers', TeacherController::class);
    $router->resource('students', StudentController::class);


});
