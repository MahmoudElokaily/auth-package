<?php


use Illuminate\Support\Facades\Route;
Route::group(["prefix" => "api/auth" , "namespace" => "Elokaily\Auth\controllers\apis" , "middleware" => "api"], function (){
    Route::post('login' , 'AuthController@authenticate');
    Route::post('register' , 'AuthController@register');
    Route::post('send_sms' , 'AuthController@send_sms');
});
