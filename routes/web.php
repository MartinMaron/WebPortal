<?php

use App\Models\Realestate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DownloadFileController;
use App\Http\Controllers\Web\RealestateController;

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



Route::get('/labor', function () {
    return view('test');
})->name('labor');

Route::name('guest.')->group(function () {
    Route::get('/', function () {return view('guest.welcome');})->name('home');
    Route::get('/heizkostenabrechnung', function () { return view('guest.heizkostenabrechnung');})->name('heizkostenabrechnung');
    Route::get('/betriebskosten', function () { return view('guest.betriebskostenabrechnung');})->name('betriebskostenabrechnung');
    Route::get('/rauchmelderservice', function () { return view('guest.rauchmelderservice');})->name('rauchmelderservice');
    Route::get('/energieausweis', function () { return view('guest.energieausweis');})->name('energieausweis');
    Route::get('/heizkostenverteiler', function () { return view('guest.heizkostenverteiler');})->name('heizkostenverteiler');
    Route::get('/waermezaehler', function () { return view('guest.waermezaehler');})->name('waermezaehler');
    Route::get('/rauchmelder', function () { return view('guest.rauchmelder');})->name('rauchmelder');
    Route::get('/wasserzaehler', function () { return view('guest.wasserzaehler');})->name('wasserzaehler');
    Route::get('/kontakt', function () { return view('guest.kontakt');})->name('kontakt');
    Route::get('/messdienstwechsel', function () { return view('guest.messdienstwechsel');})->name('messdienstwechsel');
});


Route::get('/downloadpublicfile/{file_name}', [DownloadFileController::class, 'downloadFile'])->name('downloadpublicfile');
Route::get('/showpublicfile/{file_name}', [DownloadFileController::class, 'showFile'])->name('showpublicfile');


Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::name('user.')->group(function () {


        /* Startseite im user bereich */
        Route::get('/dashboard', function () {
            if (auth()->user()->isUser){
                return view('backend.realestate.list');
            }else{
                return view('backend.show-verbrauchsinfo');
            }
        })->name('dashboard');

        /* Controller Routing */
        Route::resource('/realestate', RealestateController::class);

        Route::get('/occupants/{id}', function ($id) {
            $realestate = Realestate::all()->find($id);
            return view('backend.realestate.show-occupants', compact('realestate'));
        })->name('occupants');

        Route::get('/costs/{id}', function ($id) {
            $realestate = Realestate::all()->find($id);
            return view('backend.realestate.show-costs', compact('realestate'));
        })->name('costs');

    });
});


