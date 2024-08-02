<?php


use App\Http\Controllers\AkunController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Auth\AuthController as AuthController;
use App\Http\Controllers\TahfidzController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\PdfController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Approved;
use App\Http\Middleware\Guru;
use App\Http\Middleware\Operator;


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


Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'login');
    Route::post('/login', 'authentication');
    Route::get('/register', 'register');
    Route::post('/register', 'storeRegister');
    Route::get('/forgot_password', 'forgotPassword');
    Route::post('/forgot_password', 'submitForgetPasswordForm')->middleware('guest')->name('password.email');
    Route::post('/admin/reset/approved', 'resetApproved');
    Route::post('/admin/reset/unapproved', 'resetUnapproved');
    Route::get('/logout', 'logout');
});


Route::middleware([Approved::class])->group(function () {

    Route::controller(BerandaController::class)->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('/', 'index');
            Route::post('/approved', 'approved')->middleware([Admin::class]);
            Route::post('/unapproved', 'unapproved')->middleware([Admin::class]);
        });
        Route::prefix('operator')->group(function () {
            Route::get('/', 'index');
        });
        Route::prefix('guru')->group(function () {
            Route::get('/', 'index');
        });
    });


    Route::controller(AkunController::class)->group(function () {
        Route::prefix('admin')->group(function () {
            Route::post('/account/add', 'addAccount')->middleware([Admin::class]);
            Route::post('/account/delete/{id}', 'deleteAccount')->middleware([Admin::class]);
            Route::get('/profile', 'profile')->middleware([Admin::class]);
            Route::post('/profile/update/{id}', 'updateAccount')->middleware([Admin::class]);
            Route::put('/account/change-password/{id}', [AkunController::class, 'ubahSandi'])->name('ubahSandi');



            Route::prefix('guru')->group(function () {
                Route::post('/guru/update-status/{id}', [AkunController::class, 'updateStatus'])->name('updateStatus');
                Route::get('/', 'guru')->middleware([Admin::class]);
                Route::get('/edit/{id}', 'editAccountGuru')->middleware([Admin::class]);
                Route::post('/update/{id}', 'updateAccount')->middleware([Admin::class]);
            });
            Route::prefix('operator')->group(function () {
                Route::get('/', 'operator')->middleware([Admin::class]);
                Route::get('/edit/{id}', 'editAccountOperator')->middleware([Admin::class]);
                Route::post('/update/{id}', 'updateAccount')->middleware([Admin::class]);
            });
        });


        Route::prefix('operator')->group(function () {
            Route::get('/profile', 'profile')->middleware([Operator::class]);
            Route::post('/profile/update/{id}', 'updateAccount')->middleware([Operator::class]);
            Route::put('/account/change-password/{id}', [AkunController::class, 'ubahSandi'])->name('ubahSandi');
        });

        Route::prefix('guru')->group(function () {
            Route::get('/profile', 'profile')->middleware([Guru::class]);
            Route::post('/profile/update/{id}', 'updateAccount')->middleware([Guru::class]);
            Route::put('/account/change-password/{id}', [AkunController::class, 'ubahSandi'])->name('ubahSandi');
        });
    });


    Route::controller(TahfidzController::class)->group(function () {
        Route::prefix('admin')->group(function () {
            Route::prefix('tahfidz')->group(function () {
                Route::get('/{status?}', 'index')->middleware([Admin::class]);
                Route::post('/add', 'store')->middleware([Admin::class]);
                Route::get('/show/{id}', 'show')->middleware([Admin::class]);
                Route::get('/edit/{id}', 'edit')->middleware([Admin::class]);
                Route::post('/update/{id}', 'update')->middleware([Admin::class]);
                Route::post('/delete', 'destroy')->middleware([Admin::class]);
                // Route::controller(NilaiController::class)->group(function () {
                //     Route::prefix('nilai')->group(function () {
                //         Route::get('/edit/{id_tahfidz}/{id_nilai}', 'edit')->middleware([Admin::class]);
                //         Route::post('/update/{id}', 'update')->middleware([Admin::class]);
                //     });
                // });

                Route::controller(NilaiController::class)->group(function () {
                    Route::prefix('nilai')->group(function () {
                        Route::get('/{id}', 'index')->middleware([Admin::class]);
                        Route::post('/add', 'store')->middleware([Admin::class]);
                        Route::get('/edit/{id_tahfidz}/{id_nilai}', 'edit')->middleware([Admin::class]);
                        Route::post('/update/{id}', 'update')->middleware([Admin::class]);
                        Route::post('/delete/{id}', 'destroy')->middleware([Admin::class]);
                    });
                });
            });
        });
        Route::prefix('operator')->group(function () {
            Route::prefix('tahfidz')->group(function () {
                Route::get('/{status?}', 'index')->middleware([Operator::class]);
                Route::post('/add', 'store')->middleware([Operator::class]);
                Route::get('/show/{id}', 'show')->middleware([Operator::class]);
                Route::get('/edit/{id}', 'edit')->middleware([Operator::class]);
                Route::post('/update/{id}', 'update')->middleware([Operator::class]);
                Route::post('/delete', 'destroy')->middleware([Operator::class]);
                Route::controller(NilaiController::class)->group(function () {
                    Route::prefix('nilai')->group(function () {
                        Route::get('/{id}', 'index')->middleware([Operator::class]);
                        Route::post('/add', 'store')->middleware([Operator::class]);
                        Route::get('/edit/{id_tahfidz}/{id_nilai}', 'edit')->middleware([Operator::class]);
                        Route::post('/update/{id}', 'update')->middleware([Operator::class]);
                        Route::post('/delete/{id}', 'destroy')->middleware([Operator::class]);
                    });
                });
            });
        });
        Route::prefix('guru')->group(function () {
            Route::prefix('tahfidz')->group(function () {
                Route::get('/{status?}', 'index')->middleware([Guru::class]);
                Route::get('/show/{id}', 'show')->middleware([Guru::class]);
                Route::controller(NilaiController::class)->group(function () {
                    Route::prefix('nilai')->group(function () {
                        Route::get('/{id}', 'index')->middleware([Guru::class]);
                        Route::post('/add', 'store')->middleware([Guru::class]);
                        Route::get('/edit/{id_tahfidz}/{id_nilai}', 'edit')->middleware([Guru::class]);
                        Route::post('/update/{id}', 'update')->middleware([Guru::class]);
                    });
                });
            });
        });
    });


    Route::controller(PdfController::class)->group(function () {
        Route::prefix('pdf')->group(function () {
            // Route::get('/tahfidz', 'Tahfizd');
            Route::post('/tahfidz', 'TahfizhBySearch')->name('tahfizhBySearch');
            Route::post('/tahfidz-by-nilai', 'TahfizhByNilai')->name('tahfizhByNilai');
            Route::get('/tahfidz/{id}', 'TahfizdById');
            Route::get('/operator', 'Operator');
            Route::get('/guru', 'Guru');
        });
    });
});


Route::post('/rejected', [BerandaController::class, 'rejected']);
Route::get('/waiting-approval', function () {
    return view('v_approved.waiting-approval');
});
Route::get('/rejected', function () {
    return view('v_approved.rejected');
});
