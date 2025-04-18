<?php

use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


Route::get('/upload', function () {
    return view('dashboard-upload'); 
})->middleware('auth');


Route::get('/login', function () {
    return view('login');
})->middleware('guest')->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect('/upload');
    }
    return back()->withErrors(['email' => 'Email atau password salah.']);
});


Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->middleware('auth')->name('logout');


Route::middleware('auth')->group(function () {
    Route::get('/upload/image', [FileController::class, 'showImageUploadForm'])->name('upload.image.form');
    Route::post('/upload/image', [FileController::class, 'upload'])->name('upload.image');

    Route::get('/upload/excel', [FileController::class, 'showExcelUploadForm'])->name('upload.excel.form');
    Route::post('/upload/excel', [FileController::class, 'uploadExcel'])->name('upload.excel');

    Route::get('/upload', fn() => view('dashboard-upload'))->middleware('auth')->name('upload.dashboard');


});

Route::get('/files', [FileController::class, 'index'])->name('file-list');



Route::get('/test-view', fn() => view('c'));

Route::delete('/files/{id}', [FileController::class, 'destroy'])->middleware('auth')->name('file.delete');
