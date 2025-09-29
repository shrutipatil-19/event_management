<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'loginUser'])->name('loginUser');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/add-user', [UserController::class, 'createUser'])->name('addUser');
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register', [UserController::class, 'storeUser'])->name('storeUser');

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::get('/add-categories', [CategoriesController::class, 'create'])->name('createCat');
    Route::get('/list-categories', [CategoriesController::class, 'index'])->name('listCat');
    Route::post('/create-categories', [CategoriesController::class, 'store'])->name('storeCat');
    Route::get('/edit-categories/{id}', [CategoriesController::class, 'edit'])->name('editCat');
    Route::put('/edit-categories/{id}', [CategoriesController::class, 'update'])->name('updateCat');
     Route::delete('/delete-categories/{id}', [CategoriesController::class, 'delete'])->name('deleteCat');
});
