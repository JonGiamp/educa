<?php

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

Route::get('/', 'PagesController@accueil')->name('accueil');
Route::get('/contact', 'PagesController@contact')->name('contact');
Route::get('/niveaux/{level}', 'PagesController@level')->name('niveaux');
Route::get('/jeux/{matieres}', 'PagesController@games')->name('jeux');
Route::get('/scores', 'PagesController@rank')->name('scores');
Route::get('/mentions', 'PagesController@mentions')->name('mentions');
Route::get('/options', 'PagesController@settings')->name('options');
Route::get('/niveaux/{level}/{game}', 'PagesController@jeu')->name('jeu');
Route::get('/error', 'PagesController@error')->name('error');
Route::get('/connexion', 'PagesController@connexion')->name('connexion');
Route::get('/inscription', 'PagesController@inscription')->name('inscription');

Route::get('/logout', function () {
  Auth::logout();
  return Redirect::to('/');
})->name('logout');

Auth::routes();
