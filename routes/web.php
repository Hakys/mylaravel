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
Route::get('about', function () { return view('front_end.about'); })->name('about');
Route::get('services', function () { return view('front_end.services'); })->name('services');
Route::get('contact', function () { return view('front_end.contact'); })->name('contact');

/**  Área Privada  **/
Route::get('home', 'HomeController@admin')->name('home');

/**  Cliente  **/
Route::resource('clientes','ClienteController');
Route::post('clientes/changeStatus', 'ClienteController@changeStatus')->name('changeStatus');

/**  Consulta */
Route::resource('consultas','ConsultaController');

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