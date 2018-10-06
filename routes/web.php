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

/**  Auth  **/
Auth::routes();

/**  Index Page **/
Route::get('/', function () { return view('index'); });
Route::get('/about', function () { return view('about'); });
Route::get('/services', function () { return view('services'); });
Route::get('/contact', function () { return view('contact'); });

/**  Área Privada  **/
Route::get('home/', 'HomeController@admin')->name('home');

/**  Cliente  **/
Route::resource('clientes/','ClienteController');
Route::get('clientes/create', array('as' => 'create', 'uses' => 'ClienteController@create'));
Route::delete('clientes/{id}', array('as' => 'destroy', 'uses' => 'ClienteController@destroy'));
Route::put('clientes/{id}', array('as' => 'update', 'uses' => 'ClienteController@update'));
Route::post('clientes/changeStatus', array('as' => 'changeStatus', 'uses' => 'ClienteController@changeStatus'));

/** Others 
Route::get('/laravel', function () { return view('otros.welcome'); });
Route::get('user/profile', 'UserController@showProfile')->name('profile');
Route::resource('users/', 'UserController');

Route::match(['get', 'post'], 'input/', 'ArticulosController@recibir');

Route::match(['get', 'post'], 'editar/{id}', 'ArticulosController@recibirPost');
Route::get('articulos/{id}','ArticulosController@ver');
Route::get('articulos', 'ArticulosController@vertodos');

Route::get('algo/', function () {
    return view('otros.algo');
});

Route::get('algo/{ano}/{mes}/', function ($ano,$mes) {
    return view('otros.algo',[
        'ano'=>$ano,
        'mes'=>$mes,
        ]);
})->where([
    'ano'=>'[0-9]+',
    'mes'=>'[a-zA-Z]+',
]);

Route::get('csv/', function(){
    return response("1,2,3,4\n5,6,7,8", 200)
    ->header('Content-Type', 'text/csv');
});

Route::get('out/', function(){
    return response("", 301)
    ->header('location', 'http://desarrolloweb.com');
});
Route::get('out2/', function(){
    return redirect('users/');
});

Route::get('error/', function(){
    return response()
    ->view('welcome')
    ->header('status', 404)
    ->header('Refresh', '5; url=/');
    });
**/