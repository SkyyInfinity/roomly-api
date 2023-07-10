<?php

use App\Admin\Controllers\HomeController;
use App\Admin\Controllers\RoomController;
use Illuminate\Routing\Router;
use Encore\Admin\Facades\Admin;
use Illuminate\Support\Facades\Route;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', [HomeController::class, 'index'])->name('home');
    $router->get('/rooms', [RoomController::class, 'gridRoom'])->name('rooms.list');
    $router->get('/rooms/create', [RoomController::class, 'addRoom'])->name('rooms.create');
    $router->get('/rooms/{id}', [RoomController::class, 'detailRoom'])->name('rooms.details');
    $router->get('/rooms/{id}/edit', [RoomController::class, 'editRoom'])->name('rooms.details');
});
