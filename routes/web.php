<?php

use App\Photo;
use App\Staff;

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

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/create', function(){
    $staff = Staff::find(2);
    $staff->photos()->create(['path_image'=>'example.jpg']);
});

Route::get('/read', function(){
    $staff = Staff::findOrFail(1);
    foreach ($staff->photos as $photo) {
        return $photo->path_image;
    }
});

Route::get('/update', function(){
    $staff = Staff::find(1);
    $photo = $staff->photos()->whereId(1)->first();
    $photo->path_image = "updated example.jpg";
    $photo->save();
});

Route::get('/delete', function(){
    $staff = Staff::findOrFail(1);
    $staff->photos()->whereId(1)->delete();
});

Route::get('/assign', function(){
    $staff = Staff::findOrFail(1);
    $photo = Photo::findOrFail(4);
    $staff->photos()->save($photo);

});

Route::get('unassign', function(){
    $staff = Staff::findOrFail(1);
    $photo = Photo::findOrFail(4);
    $staff->photos()->save($photo);
});

