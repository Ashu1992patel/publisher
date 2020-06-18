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

Route::resource('companiess', 'CompanyController');
Route::get('/', function () {
    return view('backend.login');
    return view('welcome');
});

Auth::routes();

Route::get('job/format/', 'CommonController@jobformat');

Route::middleware(['auth'])->group(function () {
    Route::resource('social-group', 'SocialPostController');
    Route::get('getIndustryCategoryFunction', 'MonsterController@getIndustryCategoryFunction'); //  Monster
    Route::get('getCategoryRole', 'MonsterController@getCategoryRole'); //  Monster
    Route::get('getMonsterEducationStream', 'MonsterController@getMonsterEducationStream'); //  Monster
    Route::get('getShineCity', 'ShineController@getShineCity'); //  Shine
    Route::get('getShineEducationStream', 'ShineController@getShineEducationStream'); //  Shine
    Route::resource('position', 'JobPositionController');
    Route::get('position/{id}', 'JobPositionController@show');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('redirect/{service}', 'HomeController@redirect')->name('redirect');
    Route::get('callback/{service}', 'HomeController@callback')->name('callback');

    // clickindiaresponse tracking views
    Route::get('clickindiaresponse', 'HomeController@clickindiaresponse')->name('clickindiaresponse');
});

Route::get('jsonjob', 'HomeController@jsonjob')->name('jsonjob');
