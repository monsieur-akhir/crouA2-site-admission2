<?php

use App\Cite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('layouts.starter');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/traiter', 'DemandeController@traiter');
    Route::get('/dossier-terminer', 'DemandeController@terminer');
    Route::get('/dossier-deposer', 'DemandeController@dossierDeposer');
    Route::get('/refuser', 'DemandeController@refuser');
    Route::get('/accepter', 'DemandeController@accepter');
    Route::post('/traiter', 'DemandeController@traiterDemande');
    Route::get('/all-demande', 'DemandeController@all');
    Route::get('/details-demandes', 'DemandeController@detailsDemande');

    Route::get('/all-demande-readmission', 'ReAdmissionController@all');
    Route::get('/details-demandes-readmission', 'ReAdmissionController@detailsDemande');
    Route::any('/trouver-fiche-readmission', 'ReAdmissionController@trouverFiche');
    Route::post('/traiter-readmission', 'ReAdmissionController@traiterDemande');
    Route::get('/traiter-readmission', 'ReAdmissionController@traiter');
    Route::get('/refuser-readmission', 'ReAdmissionController@refuser');
    Route::get('/dossier-deposer-readmission', 'ReAdmissionController@dossierDeposer');
    Route::get('/dossier-terminer-readmission', 'ReAdmissionController@terminer');
    Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');
    Route::get('/dashboard-readmission', 'DashboardController@dashboardRead')->name('dashboard-read');
    Route::get('/liste-agent', 'UserController@listeAgent')->name('liste-agent');
    Route::get('/liste-agent', 'UserController@listeAgent')->name('liste-agent');
    Route::post('/valider-agent', 'UserController@validerAgent')->name('valider-agent');

});
Route::post('/reattribution-chambre', 'ReAdmissionController@readmissonDemande');
Route::post('/ma-fiche-admission', 'ReAdmissionController@PDF_Admission');
Route::get('/success', function () {
    return view('layouts.success');
});
Route::get('/reattribution-chambre', 'ReAdmissionController@reattributonView');
Route::post('/ma-fiche', 'DemandeController@PDF');
Route::get('/welcome', function () {
    return view('layouts.starter');
});

Route::get('/reattribution-chambre', 'ReAdmissionController@reattributonView');
Route::post('/ma-fiche-resultat', 'FicheResultatController@PDF');
Route::get('/consulter-resultat', function () {
    return view('layouts.consulter-resultat');
});

Route::get('/accueil', function () {
    return view('layouts.accueil');
});

Route::get('/demande', 'DemandeController@demandeView');
Route::any('/trouver-fiche', 'DemandeController@trouverFiche');
Route::any('/delete-fiche', 'DemandeController@deleteFiche');
Route::get('/login', function () {
    return view('layouts.login');
})->name('login');
Route::post('/demande', 'DemandeController@saveDemande');
Route::post('/update-demande', 'DemandeController@updateDemande');
Route::post('/update-demande-readmission', 'ReAdmissionController@updateDemande');


Route::post('/authenticate', 'LoginController@authenticate')->name('authenticate');
Route::post('/valider-otp', 'LoginController@validerOtp')->name('valider-otp');
Route::get('/otp', 'LoginController@otp')->name('otp');
Route::get('/logout', 'LoginController@logout')->name('logout');
Route::post('/creer-compte', 'LoginController@creerCompte')->name('creer-compte');
Route::post('/change-pass', 'LoginController@changerPass')->name('change-pass');
Route::post('/definir-pass', 'LoginController@definirPass')->name('definir-pass');
Route::post('/modifier-motpasse', 'LoginController@modifierMotPasse')->name('modifier-motpasse');

Route::get('/inscrisuccess', function () {
    return redirect('/login')
        ->with("inscri_success", "Compte crée avec succès, vous recevrez un email de confirmation après validation de l'admin");
})->name('inscrisuccess');

Route::get('/sinscrire', function () {
    return view('layouts.sinscrire');
})->name('sinscrire');

Route::get('/pass-oublie', function () {
    return view('layouts.pass-oublie');
})->name('pass-oublie');

Route::get('/trouver-id', function () {
    return view('layouts.trouver-id');
})->name('trouver-id-crou');

Route::get('/changerpassw', function () {
    if (session()->get('code') == 30)
        return view('layouts.changerpassw');
    else
        return redirect()->back()->withErrors(['Imossible de faire cette action']);

})->name('changerpassw');

Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');
Route::get('/liste-agent', 'UserController@listeAgent')->name('liste-agent');
Route::post('/valider-agent', 'UserController@validerAgent')->name('valider-agent');
Route::post('/creer-user', 'UserController@creerUser')->name('creer-user');
Route::post('/modifier-user', 'UserController@modifierUser')->name('modifier-user');
Route::get('/rapports', 'RapportController@index');
Route::get('/rapports_depose', 'RapportController@dossierDepose');
Route::get('/rapports-readmission', 'RapportController@indexReadmission');
Route::get('/rapports_depose-readmission', 'RapportController@dossierDeposeReadmission');

Route::get('/paliers', 'PalierController@index')->name('paliers');
Route::post('/add-palier', 'PalierController@store')->name('add-palier');
Route::post('/update-palier', 'PalierController@update')->name('update-palier');

Route::get('/lits', 'LitController@index')->name('lits');
Route::post('/add-lit', 'LitController@store')->name('add-lit');
Route::post('/update-lit', 'LitController@update')->name('update-lit');

Route::get('/chambres', 'ChambreController@index')->name('chambres');
Route::post('/add-chambre', 'ChambreController@store')->name('add-chambre');
Route::post('/update-chambre', 'ChambreController@update')->name('update-chambre');

Route::get('/cites', 'CiteController@index')->name('cites');
Route::post('/add-cite', 'CiteController@store')->name('add-cite');
Route::post('/update-cite', 'CiteController@update')->name('update-cite');

Route::get('/batiments', 'BatimentController@index')->name('batiments');
Route::post('/add-batiment', 'BatimentController@store')->name('add-batiment');
Route::post('/update-batiment', 'BatimentController@update')->name('update-batiment');

Route::post('/consultation', 'ResultatController@consultation')->name('consultation');
Route::get('/resultatconsultation/{datenaiss}/{identifiant}', 'ResultatController@reponseConsultation')->name('resultatconsultation');
Route::post('trouver-demande-traiter', 'DemandeController@trouverDemande')->name('trouverDemande');

Route::post('/idtrouver', 'ResultatController@idtrouver')->name('idtrouver');
Route::get('/id-trouver/{nom}/{prenom}/{lieu}/{email}/{contact}/{date}', 'ResultatController@reponseChercherid')->name('id-trouver');

Route::get('/consulter-resultat', function () {
    return view('layouts.consulter-resultat');
})->name('consulter-resultat');
Route::get('/xyz', function () {
    DB::table('demandes')->orderBy('created_at')->chunk(100, function ($demandes) {
        foreach ($demandes as $demande) {
            $image_ = $demande->image;  // your base64 encoded
            if (str_contains($demande->image, 'data:')) {
                $image = substr($image_, strpos($image_, ',') + 1);
                $img = str_replace('data:image/png;base64,', '', $image);
                $img = str_replace(' ', '+', $image);
                $data = base64_decode($img);
                $str = uniqid();
                $path = "/photos/" . $str . '.png';
                $file = $path;

                $success = file_put_contents($file, $data);

                DB::table('demandes')
                    ->where('num_carte', $demande->num_carte)
                    ->update(['image' => "/photos/" . $str . '.png']);
                error_log($success);
            }


        }
    });
});



