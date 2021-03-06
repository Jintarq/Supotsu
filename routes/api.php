<?php

use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClicksController;
use App\Http\Controllers\FavoritesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/logout', [AuthController::class, "logout"]);
    Route::get("/user", function (Request $request) {
        return $request->user();
    });
});

Route::post("/login", [AuthController::class, "login"]);
Route::post("/register", [AuthController::class, "register"]);

// API Articles 
Route::get("/articles", [ArticlesController::class, "index"]);
Route::post("/articles", [ArticlesController::class, "add"]);
Route::get("/articles/mostclicked", [ArticlesController::class, "getMostClickedArticles"]);
Route::get("/articles/mostrecent", [ArticlesController::class, "getMostRecentArticles"]);
Route::get("/articles/category/{category}", [ArticlesController::class, "getByCategory"]);
Route::delete("/articles/{id}", [ArticlesController::class, "delete"]);
Route::get("/articles/{id}", [ArticlesController::class, "getById"]);
Route::put("/articles/{id}", [ArticlesController::class, "update"]);


// API Routing related to calculate how many times an article has been clicked on
Route::get("/clicks", [ClicksController::class, "index"]);
Route::post("/clicks", [ClicksController::class, "add"]);

Route::put("/clicks/{article_id}", [ClicksController::class, "increment"]);
Route::get("/clicks/{article_id}", [ClicksController::class, "getNumberClicksByArticleID"]);


// API Favorites
Route::get("/favorites", [FavoritesController::class, "index"]);
Route::post("/favorites", [FavoritesController::class, "add"]);
Route::get("/favorites/{user_id}", [FavoritesController::class, "getByUserId"]);
Route::get("/favorites/articles/{user_id}", [FavoritesController::class, "getFavoritesArticlesByUserId"]);
Route::delete("/favorites/user/{user_id}/article/{article_id}", [FavoritesController::class, "deleteFavoriteArticleByUserId"]);