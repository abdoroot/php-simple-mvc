<?php
require_once "system/routes.php";
require_once "system/rendering.php";
require_once "app/controllers/controllers.php"; //Base Controller
require_once "app/controllers/ProductController.php";

use System\Route;
use App\Controller\ProductController;
Route::Get("/index",[ProductController::class,"index"]);