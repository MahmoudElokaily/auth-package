<?php


use Illuminate\Support\Facades\Route;
Route::group(["prefix" => "auth" , "as" => "auth." , "namespace" => "Elokaily\Auth\controllers" , "middleware" => "web"], function (){
    Route::get("/" , "AuthController@login")->name("login");
    Route::post("/authenticate" , "AuthController@authenticate")->name("authenticate");
    Route::get("/register" , "AuthController@register")->name("register");
    Route::post("/store" , "AuthController@store")->name("store");
});
