<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Routes cho quản lý Users
    Route::prefix('users')->group(function () { // Group users routes for better organization
        Route::get('/', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('/create', [UserController::class, 'create'])->name('admin.users.create');
        Route::post('/', [UserController::class, 'store'])->name('admin.users.store');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('admin.users.update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    });

    // Routes cho quản lý Roles
    Route::prefix('roles')->group(function () { // Group roles routes
        Route::get('/', [RoleController::class, 'index'])->name('admin.roles.index');
        Route::get('/create', [RoleController::class, 'create'])->name('admin.roles.create');
        Route::post('/', [RoleController::class, 'store'])->name('admin.roles.store');
        Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('admin.roles.edit');
        Route::put('/{role}', [RoleController::class, 'update'])->name('admin.roles.update');
        Route::delete('/{role}', [RoleController::class, 'destroy'])->name('admin.roles.destroy');
    });

    // Permission Routes
    Route::prefix('permissions')->group(function () {
        Route::get('/', [PermissionController::class, 'index'])->name('admin.permissions.index');
        Route::get('/create', [PermissionController::class, 'create'])->name('admin.permissions.create');
        Route::post('/', [PermissionController::class, 'store'])->name('admin.permissions.store');
        Route::get('/{permission}/edit', [PermissionController::class, 'edit'])->name('admin.permissions.edit');
        Route::put('/{permission}', [PermissionController::class, 'update'])->name('admin.permissions.update');
        Route::delete('/{permission}', [PermissionController::class, 'destroy'])->name('admin.permissions.destroy');
    });

    // Category Routes
    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('admin.categories.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('admin.categories.create');
        Route::post('/', [CategoryController::class, 'store'])->name('admin.categories.store');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::put('/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
    });

    // Property Routes
    Route::prefix('properties')->group(function () {
        Route::get('/', [PropertyController::class, 'index'])->name('admin.properties.index');
        Route::get('/create', [PropertyController::class, 'create'])->name('admin.properties.create');
        Route::post('/', [PropertyController::class, 'store'])->name('admin.properties.store');
        Route::get('/{property}/edit', [PropertyController::class, 'edit'])->name('admin.properties.edit');
        Route::put('/{property}', [PropertyController::class, 'update'])->name('admin.properties.update');
        Route::delete('/{property}', [PropertyController::class, 'destroy'])->name('admin.properties.destroy');
    });
});
