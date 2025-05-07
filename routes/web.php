<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DropdownController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [DropdownController::class, 'index']);
Route::get('/get-courses/{id}', [DropdownController::class, 'getCourses']);
Route::get('/get-locations/{id}', [DropdownController::class, 'getLocations']);
Route::get('/get-students/{id}', [DropdownController::class, 'getStudents']);