<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});






//======================================================================================================
Route::group([
    'middleware' => 'auth',
], function () {

    Route::group([
        'as' => 'users.',
        'prefix' => 'users'
    ], function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::post('/validateFirstStep', [UserController::class, 'validateFirstStep']);
    });

    Route::group([
        'as' => 'clients.',
        'prefix' => 'clients'
    ], function () {
        Route::get('/', [ClientController::class, 'index'])->name('index');
        Route::get('/create', [ClientController::class, 'create'])->name('create');
        Route::post('/store', [ClientController::class, 'store'])->name('store');
        Route::get('/{client}/edit', [ClientController::class, 'edit'])->name('edit');
        Route::put('/{client}/update', [ClientController::class, 'update'])->name('update');
        Route::delete('/{client}/destroy', [ClientController::class, 'destroy'])->name('destroy');
    });
});

//======================================================================================================















Route::get('/role', function () {
    $role = Role::create([
        'name' => 'client'
    ]);
});
Route::get('/permission', function () {
    //        $permission = Permission::create([
//            'name' => 'projects-index'
//        ]);
//        $permission = Permission::create([
//            'name' => 'projects-show'
//        ]);
//        $permission = Permission::create([
//            'name' => 'projects-store'
//        ]);
//        $permission = Permission::create([
//            'name' => 'projects-update'
//        ]);
//        $permission = Permission::create([
//            'name' => 'projects-destroy'
//        ]);



//        $permission = Permission::create([
//            'name' => 'clients-index'
//        ]);
//        $permission = Permission::create([
//            'name' => 'clients-store'
//        ]);
//        $permission = Permission::create([
//            'name' => 'clients-update'
//        ]);
//        $permission = Permission::create([
//            'name' => 'clients-destroy'
//        ]);
});

require __DIR__.'/auth.php';
