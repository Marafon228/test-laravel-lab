<?php

use App\Http\Controllers\UserController;
use App\Models\Link;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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
/*Route::get('/user',[UserController::class, 'index']);
Route::get('/user/{id}',[UserController::class, 'index']);*/

Route::prefix('/contact')->group(function () {
    Route::view('/','contact')->name('contact');
    Route::post('/', function (){
        $request = request()->validate([
            'fio' => 'required | min:2 | max:50',
            'email' => 'required | email ',
            'message' => 'required | max:255',
        ]);

        return $request;
    });

});
Route::view('/form','form')->name('form');

Route::post('/form', function () {
    $request = request()->validate([
        'link' => 'required | min:5 | max: 255'
    ]);
    $model = new Link();
    $model->link = $request['link'];
    $model->alias = uniqid();
    $model->count = 0;
    $model->save();
    session()->flash('success', 'Ваша сслыка: ' . url('/') . $model->alias);
    return redirect()->route('form');
});

Route::get('/r/{redirect}', function ($redirect) {
    $model = Link::where('alias = ?', [
        $redirect
    ])->get();
    $model->count += 1;
    $model->save();
    return $redirect($model->link);
});
