<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::post('chat', function (Request $request) {
    $apiKey = 'AIzaSyCtTWP6c8stbRg38Ql2ePCpG5TEO-xq5xs';

    $response = Http::post("https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key={$apiKey}", [
        'contents' => [
            [
                'parts' => [
                    ['text' => $request->input('content')]
                ]
            ]
        ]
    ]);
    return $response;
});
