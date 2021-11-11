<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register'=>false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/organization/details-person/{organizationId}', [App\Http\Controllers\OrganizationController::class, 'detailPerson'])->name('detailPerson');
Route::resources([
    'organization' => \App\Http\Controllers\OrganizationController::class,
    'user' => \App\Http\Controllers\UserController::class,
]);
Route::get('organization/{organization}/create', [\App\Http\Controllers\OrganizationController::class, 'personCreate']);
Route::get('organization/{organization}/person/{id}/edit', [\App\Http\Controllers\OrganizationController::class, 'personEdit']);
Route::post('organization/{organization}/person', [\App\Http\Controllers\OrganizationController::class, 'personStore']);
Route::put('organization/{organization}/person/{person}', [\App\Http\Controllers\OrganizationController::class, 'personUpdate']);
Route::delete('organization/{organization}/person/{person}', [\App\Http\Controllers\OrganizationController::class, 'personDestroy']);

