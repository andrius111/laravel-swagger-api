<?php

  use Illuminate\Support\Facades\Route;
  use Illuminate\Http\JsonResponse;

  Route::get("posts",           "PostController@index");
  Route::get("posts/{post}",    "PostController@show");
  Route::post("posts",          "PostController@store");
  Route::put("posts/{post}",    "PostController@update");
  Route::delete("posts/{post}", "PostController@destroy");

  Route::fallback(function() {
    return response()->json(['error' => 'Método não encontrado.'], JsonResponse::HTTP_METHOD_NOT_ALLOWED);
  });
