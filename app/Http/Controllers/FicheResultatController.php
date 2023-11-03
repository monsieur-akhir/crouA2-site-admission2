<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\DemandeRequest;
use App\Http\Requests\DemandeUpdateRequest;
use App\Http\Requests\ReadmissionRequest;
use App\Demande;
use App\Lit;
use App\Cite;
use App\Batiment;
use App\Palier;
use App\Chambre;
use App\AttributionChambre;
use App\ReAdmission;
use PDF;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Swift_Attachment;
use Carbon\Carbon;
class FicheResultatController extends Controller
{
    public function demandeView()
    {
        $niveaux = DB::table('niveaus')->get();
        $departements = DB::table('departements')->get();
        $universites = DB::table('universites')->get();
        $pays = $this->pays();
        return view('layouts.demande', [
            "niveaux" => $niveaux,
            "departements" => $departements,
            "universites" => $universites,
            "pays" => $pays,
        ]);
    }

    public function reattributonView()
    {
        $niveaux = DB::table('niveaus')->get();
        $departements = DB::table('departements')->get();
        $universites = DB::table('universites')->get();
        $pays = $this->pays();
        $cites = Cite::all();
        return view('layouts.reattribution', [
            "niveaux" => $niveaux,
            "departements" => $departements,
            "universites" => $universites,
            "pays" => $pays,
            "cites" => $cites,
        ]);
    }


    public function PDF_Admission(Request $request)
    {
        $demande = ReAdmission::where('matricule_crou', $request->matricule_crou)->first();
        $pdf = PDF::loadView('dossiers.fiche-resultat', [
            "data" => $demande
        ]);
        return $pdf->stream();
    }

    public function PDF(Request $request)
    {
        $demande = Demande::where('matricule_crou', $request->matricule_crou)->first();

        $pdf = PDF::loadView('dossiers.fiche-resultat', [
            "data" => $demande
        ]);

        return $pdf->stream();
        // return $pdf->download('ma_fiche.pdf');
    }

}
