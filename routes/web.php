<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get("register", function () {
    return view("register");
});

Route::post("submitReg", "App\Http\Controllers\loginRegister@forRegister");
Route::post("submitLog", "App\Http\Controllers\loginRegister@forlogin");

Route::group(["middleware" => ["auth"]], function () {
    Route::get("index", "App\Http\Controllers\loginRegister@index");
    Route::get("profile/{id}", "App\Http\Controllers\loginRegister@profile");
    Route::post("profileUpdate/{id}", "App\Http\Controllers\loginRegister@profileUpdate")->name("submitUpdate");
    Route::get("changePass/{id}", "App\Http\Controllers\loginRegister@changePass")->name("changePass");
    Route::post("updatePass/{id}", "App\Http\Controllers\loginRegister@updatePass")->name("submitUpPass");
});

Route::post("logout", "\App\Http\Controllers\loginRegister@logout");