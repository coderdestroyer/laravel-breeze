<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/dashboard', [MahasiswaController::class, 'index'])->middleware(['auth']);

Route::get('/dashboard', [MahasiswaController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::post('/mahasiswa', [MahasiswaController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('mahasiswa.store');;

Route::put('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'update']) 
    ->middleware(['auth', 'verified'])
    ->name('mahasiswa.update');

Route::delete('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'destroy'])
    ->middleware(['auth', 'verified'])
    ->name('mahasiswa.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
