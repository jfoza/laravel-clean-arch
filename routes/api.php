<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

Route::get('/', function () {
    return response()->json(
        ['Status' => 'Ok'],
        Response::HTTP_OK
    );
});

Route::prefix('/products')->group(app_path('Features/Product/Presentation/Routes/product.php'));

