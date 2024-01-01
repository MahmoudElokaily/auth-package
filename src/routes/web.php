<?php


use Illuminate\Support\Facades\Route;
Route::group(["prefix" => "auth" , "namespace" => "Elokaily\Auth\controllers" , "middleware" => "web"], function (){
    Route::get("/" , "AuthController@login")->name("login");
    Route::post("/authenticate" , "AuthController@authenticate")->name("authenticate");
    Route::get("/register" , "AuthController@register")->name("register");
    Route::post("/store" , "AuthController@store")->name("store");
    Route::get("/forget-password" , "AuthController@forgetPassword")->name("forget-password");
    Route::post("/send-mail" , "AuthController@sendMail")->name("send-mail");
    Route::get("/reset-password/{token}" , "AuthController@resetPassword")->name("reset-password");
    Route::post("/update-password" , "AuthController@updatePassword")->name("update-password");
    Route::group(["middleware" => "auth"] , function (){
        Route::get("logout" , "AuthController@logout")->name("logout");
    });
});
