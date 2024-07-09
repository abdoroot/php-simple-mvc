<?php

use Core\Application;
use Core\Route;
use App\Controller\ProductController;

Route::Get("/index", [ProductController::class, "index"]);
