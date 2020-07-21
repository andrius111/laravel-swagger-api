<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\JsonResponse;

Route::get("blogs", "BlogController@index");
Route::get("blogs/{cd_blog}", "BlogController@show");
Route::post("blogs", "BlogController@store");
Route::put("blogs/{cd_blog}", "BlogController@update");
Route::delete("blogs/{cd_blog}", "BlogController@destroy");

Route::fallback(function(){
    return response()->json(['error' => 'Método não encontrado.'], JsonResponse::HTTP_METHOD_NOT_ALLOWED);
});
