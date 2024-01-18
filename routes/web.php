<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// ->middleware('verified'); // é pra pedir verificação do email
Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth', 'complete']], function(){
    Route::group([
        'prefix' => 'admin',
        'as' => 'admin.',
    ], function() {
        Route::get('/admin', function () {
            return view('admin.index');
        })->name('index');
    });

// vai colocando todas as rotas
    Route::group([
        'as' => 'user.',
    ], function() {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    });

});

Route::resource('orientadorgeral', App\Http\Controllers\OrientadorGeralController::class);
Route::resource('academico', App\Http\Controllers\AcademicoController::class);
Route::resource('orientador', App\Http\Controllers\OrientadorController::class)->names([
    'create' => 'c'
]);
Route::get('orientador/create/{orientadorgeral_id}', 'App\Http\Controllers\OrientadorController@create')->name('orientador.create');

Route::get('/complete', function(){
    return view('complete.index');
})->name('complete');

// Route::get('/admin', function () {
//     return view('admin.index');
// })->middleware(['auth', 'is_admin', 'role:admin'])->name('index');

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');
