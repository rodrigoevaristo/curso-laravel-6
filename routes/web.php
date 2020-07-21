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

Route::view('/view', 'welcome');

Route::get('/categorias/{flag}/posts', function ($prm1) {
    return "Produtos da categoria: {$prm1}";
});

Route::get('/produtos/{idProduto?}', function($idProduto = '') {
    return "Produtos com id: {$idProduto}";
});

Route::redirect('/redirect1', '/redirect2');

/*Route::get('redirect1', function() {
    return redirect('/redirect2');
});*/

Route::get('redirect2', function () {
    return 'Redirect 02';
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/nome-url', function () {
    return 'teste nome url';
})->name('url.name');

Route::get('redirect3', function () {
    return redirect()->route('url.name');
});

//route('url.name'); // Pode passar essa rota ao inves da url
/*
Route::middleware(['auth'])->group(function() {

    Route::prefix('admin')->group(function() {

        Route::get('/', function () {
            return 'Admin';
        });

        Route::get('/dashboard', function () {
            return 'Home Admin';
        });

        Route::get('financeiro', function () {
            return 'Admin Financeiro';
        });

        Route::get('/produtos', function () {
            return 'Admin Produtos';
        });

        Route::namespace('admin')->group(function() {
            //Route::get('/', 'TestController@teste')->name('admin.home');

            Route::name('admin.')->group(function(){
                Route::get('/', function () {
                    return redirect()->route('dashboard');
                })->name('admin.home');

                Route::get('/dashboard', 'TestController@teste')->name('dashboard');

                Route::get('/financeiro', 'TestController@teste')->name('financeiro');

                Route::get('/produtos', 'TestController@teste')->name('produtos');
            });

        });
    });
});
*/

    Route::group([
        'middleware' => ['auth'],
        'prefix' => 'admin', //Prefixo das rotas
        'namespace' => 'admin', //namespace dos controllers
        'name' => 'admin.' //nome das rotas
    ], function () {
        Route::get('/', function () {
            return redirect()->route('dashboard');
        })->name('admin.home');

        Route::get('/dashboard', 'TestController@teste')->name('dashboard');

        Route::get('/financeiro', 'TestController@teste')->name('financeiro');

        Route::get('/produtos', 'TestController@teste')->name('produtos');

    });

/*
Route::get('/admin/dashboard', function () {
    return 'Home Admin';
})->middleware('auth');
*/

Route::get('/login', function () {
    return 'Login';
})->name('login');


//Aula 16 a 18
/*
Route::get('products/{id}', 'ProductController@show')->name('products.show');
Route::get('products', 'ProductController@index')->name('products.index');
Route::get('products/create', 'ProductController@create')->name('products.create');
Route::get('products/{flag}/edit', 'ProductController@edit')->name('products.edit');
Route::post('products', 'ProductController@store')->name('products.store');
Route::put('products/{id}', 'ProductController@update')->name('products.update');
Route::delete('products/{id}', 'ProductController@destroy')->name('products.destroy');
*/

//Aula 19

Route::any('products/search', 'ProductController@search')->name('products.search');

Route::resource('products', 'ProductController');//->middleware('auth')
//Route::post('products', 'ProductController@store')->name('products.store');
