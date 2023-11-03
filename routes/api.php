<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/departements', 'DemandeController@Departement');
Route::get('/filieres', 'DemandeController@Filieres');
Route::get('/list-batiment-by-cite', 'BatimentController@listByCite');
Route::get('/list-paliers-by-batiment', 'PalierController@listByBatiment');
Route::get('/list-chambre-by-palier', 'ChambreController@listByPalier');
Route::get('/list-lit-by-chambre', 'LitController@listByChambre');

