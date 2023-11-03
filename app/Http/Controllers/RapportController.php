<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Demande;
use App\ReAdmission;

class RapportController extends Controller
{
    public function index(Request $request)
    {
        // $all = Demande::where()->count();
        $demandeParUniversite = Demande::selectRaw('ufr_etudiant, count(*) as total')
        ->groupBy('ufr_etudiant')
        ->pluck('total','ufr_etudiant')->all();
        $demandeNanguiParDepartement = Demande::where('ufr_etudiant',1)
        ->selectRaw('departement_etudiant, count(*) as total')
        ->groupBy('departement_etudiant')
        ->pluck('total','departement_etudiant')->all();
        $demandeParUniversiteMasculin = Demande::where('genre','Masculin')
        ->selectRaw('ufr_etudiant, count(*) as total')
        ->groupBy('ufr_etudiant')
        ->pluck('total','ufr_etudiant')->all();
        $demandeParUniversiteFeminin = Demande::where('genre','Feminin')
        ->selectRaw('ufr_etudiant, count(*) as total')
        ->groupBy('ufr_etudiant')
        ->pluck('total','ufr_etudiant')->all();
        $demandeParNiveau = Demande::selectRaw('niveau_actuel_etudiant, count(*) as total')
        ->groupBy('niveau_actuel_etudiant')
        ->pluck('total','niveau_actuel_etudiant')->all();
        // dd($demandeParNiveau);
        return view('layouts.rapports',[
            'demandeParUniversite' =>$demandeParUniversite,
            'demandeNanguiParDepartement' =>$demandeNanguiParDepartement,
            'demandeParUniversiteMasculin' =>$demandeParUniversiteMasculin,
            'demandeParUniversiteFeminin' =>$demandeParUniversiteFeminin,
            'demandeParNiveau' =>$demandeParNiveau
        ]);
    }
    public function dossierDepose(Request $request)
    {
        // $all = Demande::where()->count();
        $demandeParUniversite = Demande::selectRaw('ufr_etudiant, count(*) as total')
        ->where('statut',2)
        ->groupBy('ufr_etudiant')
        ->pluck('total','ufr_etudiant')->all();
        $demandeNanguiParDepartement = Demande::where('ufr_etudiant',1)
        ->where('statut',2)
        ->selectRaw('departement_etudiant, count(*) as total')
        ->groupBy('departement_etudiant')
        ->pluck('total','departement_etudiant')->all();
        $demandeParUniversiteMasculin = Demande::where('genre','Masculin')
        ->where('statut',2)
        ->selectRaw('ufr_etudiant, count(*) as total')
        ->groupBy('ufr_etudiant')
        ->pluck('total','ufr_etudiant')->all();
        $demandeParUniversiteFeminin = Demande::where('genre','Feminin')
        ->where('statut',2)
        ->selectRaw('ufr_etudiant, count(*) as total')
        ->groupBy('ufr_etudiant')
        ->pluck('total','ufr_etudiant')->all();
        $demandeParNiveau = Demande::selectRaw('niveau_actuel_etudiant, count(*) as total')
        ->where('statut',2)
        ->groupBy('niveau_actuel_etudiant')
        ->pluck('total','niveau_actuel_etudiant')->all();
        // dd($demandeParNiveau);
        return view('layouts.rapports_depose',[
            'demandeParUniversite' =>$demandeParUniversite,
            'demandeNanguiParDepartement' =>$demandeNanguiParDepartement,
            'demandeParUniversiteMasculin' =>$demandeParUniversiteMasculin,
            'demandeParUniversiteFeminin' =>$demandeParUniversiteFeminin,
            'demandeParNiveau' =>$demandeParNiveau
        ]);
    }
    public function indexReadmission(Request $request)
    {
        // $all = Demande::where()->count();
        $demandeParUniversite = ReAdmission::selectRaw('ufr_etudiant, count(*) as total')
        ->groupBy('ufr_etudiant')
        ->pluck('total','ufr_etudiant')->all();
        $demandeNanguiParDepartement = ReAdmission::where('ufr_etudiant',1)
        ->selectRaw('departement_etudiant, count(*) as total')
        ->groupBy('departement_etudiant')
        ->pluck('total','departement_etudiant')->all();
        $demandeParUniversiteMasculin = ReAdmission::where('genre','Masculin')
        ->selectRaw('ufr_etudiant, count(*) as total')
        ->groupBy('ufr_etudiant')
        ->pluck('total','ufr_etudiant')->all();
        $demandeParUniversiteFeminin = ReAdmission::where('genre','Feminin')
        ->selectRaw('ufr_etudiant, count(*) as total')
        ->groupBy('ufr_etudiant')
        ->pluck('total','ufr_etudiant')->all();
        $demandeParNiveau = ReAdmission::selectRaw('niveau_actuel_etudiant, count(*) as total')
        ->groupBy('niveau_actuel_etudiant')
        ->pluck('total','niveau_actuel_etudiant')->all();
        // dd($demandeParNiveau);
        return view('layouts.rapports',[
            'demandeParUniversite' =>$demandeParUniversite,
            'demandeNanguiParDepartement' =>$demandeNanguiParDepartement,
            'demandeParUniversiteMasculin' =>$demandeParUniversiteMasculin,
            'demandeParUniversiteFeminin' =>$demandeParUniversiteFeminin,
            'demandeParNiveau' =>$demandeParNiveau
        ]);
    }
    public function dossierDeposeReadmission(Request $request)
    {
        // $all = Demande::where()->count();
        $demandeParUniversite = ReAdmission::selectRaw('ufr_etudiant, count(*) as total')
        ->where('statut',2)
        ->groupBy('ufr_etudiant')
        ->pluck('total','ufr_etudiant')->all();
        $demandeNanguiParDepartement = ReAdmission::where('ufr_etudiant',1)
        ->where('statut',2)
        ->selectRaw('departement_etudiant, count(*) as total')
        ->groupBy('departement_etudiant')
        ->pluck('total','departement_etudiant')->all();
        $demandeParUniversiteMasculin = ReAdmission::where('genre','Masculin')
        ->where('statut',2)
        ->selectRaw('ufr_etudiant, count(*) as total')
        ->groupBy('ufr_etudiant')
        ->pluck('total','ufr_etudiant')->all();
        $demandeParUniversiteFeminin = ReAdmission::where('genre','Feminin')
        ->where('statut',2)
        ->selectRaw('ufr_etudiant, count(*) as total')
        ->groupBy('ufr_etudiant')
        ->pluck('total','ufr_etudiant')->all();
        $demandeParNiveau = ReAdmission::selectRaw('niveau_actuel_etudiant, count(*) as total')
        ->where('statut',2)
        ->groupBy('niveau_actuel_etudiant')
        ->pluck('total','niveau_actuel_etudiant')->all();
        // dd($demandeParNiveau);
        return view('layouts.rapports_depose',[
            'demandeParUniversite' =>$demandeParUniversite,
            'demandeNanguiParDepartement' =>$demandeNanguiParDepartement,
            'demandeParUniversiteMasculin' =>$demandeParUniversiteMasculin,
            'demandeParUniversiteFeminin' =>$demandeParUniversiteFeminin,
            'demandeParNiveau' =>$demandeParNiveau
        ]);
    }

    
}
