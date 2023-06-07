<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', \App\Http\Controllers\Country\IndexController::class)->name('country.index');


//-------------------------------------------------------------
//----------------------------ADMIN----------------------------
//-------------------------------------------------------------

Route::prefix('admin')->middleware('admin')->namespace('\App\Http\Controllers\Admin')->group(function () {
    Route::get('/', IndexController::class)->name('admin.index');

    Route::prefix('country')->namespace('Country')->group(function () {
        Route::get('/', IndexController::class)->name('admin.country.index');
        Route::get('/create', CreateController::class)->name('admin.country.create');
        Route::post('/', StoreController::class)->name('admin.country.store');
        Route::get('/{country}', ShowController::class)->name('admin.country.show');
        Route::get('/{country}/edit', EditController::class)->name('admin.country.edit');
        Route::patch('/{country}', UpdateController::class)->name('admin.country.update');
        Route::delete('/{country}', DeleteController::class)->name('admin.country.delete');
    });

    Route::prefix('genre')->namespace('Genre')->group(function () {
        Route::get('/', IndexController::class)->name('admin.genre.index');
        Route::get('/create', CreateController::class)->name('admin.genre.create');
        Route::post('/', StoreController::class)->name('admin.genre.store');
        Route::get('/{genre}', ShowController::class)->name('admin.genre.show');
        Route::get('/{genre}/edit', EditController::class)->name('admin.genre.edit');
        Route::patch('/{genre}', UpdateController::class)->name('admin.genre.update');
        Route::delete('/{genre}', DeleteController::class)->name('admin.genre.delete');
    });

});


//-------------------------------------------------------------
//-------------------------END ADMIN---------------------------
//-------------------------------------------------------------

/*
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
*/

require __DIR__ . '/auth.php';


//-------------------------------------------------------------
//-------------------После выбора страны-----------------------
//-------------------------------------------------------------

Route::prefix('{country}')
    ->group(function () {
        Route::get('/', \App\Http\Controllers\Index\IndexController::class)->name('index.index');


        //----------------PROFILE-------------------
        Route::middleware('auth')->group(function () {
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::post('/profile', [ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        });
        //----------------PROFILE END-------------------


        //----------------Contact-------------------
        Route::prefix('/contact')->group(function () {
            Route::get('/{book}/create', \App\Http\Controllers\Contact\CreateController::class)->name('book.contact.create');
            Route::get('/{contact}', \App\Http\Controllers\Contact\ShowController::class)->name('book.contact.show');
            Route::patch('/{contact}', \App\Http\Controllers\Contact\UpdateController::class)->name('book.contact.update');
            Route::post('/{book}', \App\Http\Controllers\Contact\StoreController::class)->name('book.contact.store');
            Route::get('/', \App\Http\Controllers\Contact\IndexController::class)->name('book.contact.index');

        });


        //----------------BOOK-------------------
        Route::prefix('book')->group(function () {


            Route::middleware(['auth', 'verified'])->group(function () {
                Route::get('/create', \App\Http\Controllers\Book\CreateController::class)->name('book.create');
                Route::post('/create', \App\Http\Controllers\Book\StoreController::class)->name('book.store');
                Route::get('/mybook', \App\Http\Controllers\Book\MyBookController::class)->name('book.my');

                Route::prefix('/{book}')->group(function () {
                    Route::middleware('can:update,book')->group(function () {
                        Route::get('/edit', \App\Http\Controllers\Book\EditController::class)->name('book.edit');
                        Route::post('/update', \App\Http\Controllers\Book\UpdateController::class)->name('book.update');
                        Route::delete('/delete', \App\Http\Controllers\Book\DeleteController::class)->name('book.delete');
                    });

                });


            });

            Route::get('/{book}', \App\Http\Controllers\Book\ShowController::class)->name('book.show');
            Route::get('/', \App\Http\Controllers\Book\IndexController::class)->name('book.index');


        });
        //----------------BOOK END-------------------

    });

//-------------------------------------------------------------
//-----------------END После выбора страны---------------------
//-------------------------------------------------------------
