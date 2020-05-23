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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::middleware(['auth'])->group(function () {
  Route::resource('/challenges', 'ChallengeController');
  Route::get('/challenges/send/{id}/{challenge_id}', 'ChallengeController@sendChallenge');
  Route::get('/challenges/accept/{challenge_id}', 'ChallengeController@acceptChallenge');

  // Friendships
  Route::get('/friends/add', 'FriendsController@index');
  Route::get('/friends/add/{id}', 'FriendsController@sendFriendRequest');
  Route::get('/friends/accept/{id}', 'FriendsController@acceptFriendRequest');
});
