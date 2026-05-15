<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PilihAksesController;

Route::get('/', function () { 
    return view('login'); 
    });
Route::get('/login', function () { 
    return view('login'); 
    });
Route::get('/pilihakses', function () { 
    return view('pilihakses'); 
    });
Route::get('/home', function () { 
    return view('home'); 
    });
Route::get('/pelaporan', function () { 
    return view('pelaporan'); 
    });
Route::get('/pendaftaran', function () { 
    return view('pendaftaran'); 
    });