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
class DemandeController extends Controller
{
    public function demandeView()
    {
        $niveaux = DB::table('niveaus')->get();
        $departements = DB::table('departements')->get();
        $universites = DB::table('universites')->get();
        $pays = $this->pays();
        return view('layouts.demande',[
            "niveaux"=>$niveaux,
            "departements"=>$departements,
            "universites"=>$universites,
            "pays"=>$pays,
        ]);
    }
    public function reattributonView()
    {
        $niveaux = DB::table('niveaus')->get();
        $departements = DB::table('departements')->get();
        $universites = DB::table('universites')->get();
        $pays = $this->pays();
        $cites = Cite::all();
        return view('layouts.reattribution',[
            "niveaux"=>$niveaux,
            "departements"=>$departements,
            "universites"=>$universites,
            "pays"=>$pays,
            "cites"=>$cites,
        ]);
    }
    
    
    public function PDF_Admission(Request $request)
    {
        $demande = ReAdmission::where('matricule_crou',$request->matricule_crou)->first();
        $pdf = PDF::loadView('dossiers.fiche-readmission',[
            "data"=>$demande
        ]);
        return $pdf->stream();
    }
    public function PDF(Request $request)
    {
        $demande = Demande::where('matricule_crou',$request->matricule_crou)->first();
        if($demande->cite_id){
            $pdf = PDF::loadView('dossiers.fiche-readmission',[
                "data"=>$demande
            ]);
        }else{
            $pdf = PDF::loadView('dossiers.fiche',[
                "data"=>$demande
            ]);
        }
        return $pdf->stream();
        // return $pdf->download('ma_fiche.pdf');
    }
    
    public function traiterDemande(Request $request)
    {
        
        if($request->statut == -1){
            /* if (is_null($request->lit)) {
                $lit = Lit::where('id',$request->lit)->first();
                $lit->statut = 0;
                $lit->save();

                $attribution = AttributionChambre::where('lit_id',$request->lit)
                ->where('matricule_crou',$request->matricule_crou)
                ->latest()->first();
                $attribution->statut = 0;
                $attribution->save();
            } */
        }
        if($request->statut == 3){
            /*$lit = Lit::where('id',$request->lit)->first();
            $lit->statut = 1;
            $lit->save();
             $new_attribution = new AttributionChambre;
            $new_attribution->demande_id = $request->demande;
            $new_attribution->lit_id = $request->lit;
            $new_attribution->matricule_crou = $request->matricule_crou;
            $new_attribution->save(); */
        }
        $demande = Demande::where("matricule_crou",$request->matricule_crou)->first();
        $demande->statut = $request->statut;
        $demande->save();
        // return redirect('traiter');
        return redirect('dashboard')->with(["message"=>"Dossier n° ".$demande->matricule_crou." traité avec succes"]);
    }
    public function all(Request $request)
    {
        $demandes =  DB::table('demandes')
            ->select('genre', 'num_carte', 'nom_etudiant', 'prenoms_etudiant', 'date_naissance_etudiant', 'lieu_naissance_etudiant', 'contact_etudiant', 'email_etudiant', 'nationnalite', 'handicap_etudiant', 'nom_tuteur', 'contact_tuteur', 'ufr_etudiant', 'departement_etudiant', 'niveau_actuel_etudiant', 'niveau_precedent_etudiant', 'decision_final_etudiant', 'matricule_crou', 'filiere', 'statut', 'is_bachelier', 'mention_bac', 'ecole_etudiant', 'age', 'serie_bac', 'point_bac', 'precision_handicap', 'cite_id', 'batiment_id', 'palier_id', 'chambre_id', 'lit_id', 'created_at', 'updated_at')
            ->get();
        return view('layouts.traiter',[
            'demandes' =>$demandes
        ]);
    }
    public function traiter(Request $request)
    {
        $demandes =  DB::table('demandes')
            ->select('genre', 'num_carte', 'nom_etudiant', 'prenoms_etudiant', 'date_naissance_etudiant', 'lieu_naissance_etudiant', 'contact_etudiant', 'email_etudiant', 'nationnalite', 'handicap_etudiant', 'nom_tuteur', 'contact_tuteur', 'ufr_etudiant', 'departement_etudiant', 'niveau_actuel_etudiant', 'niveau_precedent_etudiant', 'decision_final_etudiant', 'matricule_crou', 'filiere', 'statut', 'is_bachelier', 'mention_bac', 'ecole_etudiant', 'age', 'serie_bac', 'point_bac', 'precision_handicap', 'cite_id', 'batiment_id', 'palier_id', 'chambre_id', 'lit_id', 'created_at', 'updated_at')
            ->where('statut',0)
            ->get();
        return view('layouts.traiter',[
            'demandes' =>$demandes
        ]);
    }
    public function accepter(Request $request)
    {
        $demandes =  DB::table('demandes')
            ->select('genre', 'num_carte', 'nom_etudiant', 'prenoms_etudiant', 'date_naissance_etudiant', 'lieu_naissance_etudiant', 'contact_etudiant', 'email_etudiant', 'nationnalite', 'handicap_etudiant', 'nom_tuteur', 'contact_tuteur', 'ufr_etudiant', 'departement_etudiant', 'niveau_actuel_etudiant', 'niveau_precedent_etudiant', 'decision_final_etudiant', 'matricule_crou', 'filiere', 'statut', 'is_bachelier', 'mention_bac', 'ecole_etudiant', 'age', 'serie_bac', 'point_bac', 'precision_handicap', 'cite_id', 'batiment_id', 'palier_id', 'chambre_id', 'lit_id', 'created_at', 'updated_at')
            ->where('statut',1)
            ->get();
        return view('layouts.traiter',[
            'demandes' =>$demandes
        ]);
    }
    public function refuser(Request $request)
    {
        $demandes =  DB::table('demandes')
        ->select('genre', 'num_carte', 'nom_etudiant', 'prenoms_etudiant', 'date_naissance_etudiant', 'lieu_naissance_etudiant', 'contact_etudiant', 'email_etudiant', 'nationnalite', 'handicap_etudiant', 'nom_tuteur', 'contact_tuteur', 'ufr_etudiant', 'departement_etudiant', 'niveau_actuel_etudiant', 'niveau_precedent_etudiant', 'decision_final_etudiant', 'matricule_crou', 'filiere', 'statut', 'is_bachelier', 'mention_bac', 'ecole_etudiant', 'age', 'serie_bac', 'point_bac', 'precision_handicap', 'cite_id', 'batiment_id', 'palier_id', 'chambre_id', 'lit_id', 'created_at', 'updated_at')
        ->where('statut',-1)
        ->get();
        return view('layouts.traiter',[
            'demandes' =>$demandes
        ]);
    }
    public function dossierDeposer(Request $request)
    {
        $demandes =  DB::table('demandes')
        ->select('genre', 'num_carte', 'nom_etudiant', 'prenoms_etudiant', 'date_naissance_etudiant', 'lieu_naissance_etudiant', 'contact_etudiant', 'email_etudiant', 'nationnalite', 'handicap_etudiant', 'nom_tuteur', 'contact_tuteur', 'ufr_etudiant', 'departement_etudiant', 'niveau_actuel_etudiant', 'niveau_precedent_etudiant', 'decision_final_etudiant', 'matricule_crou', 'filiere', 'statut', 'is_bachelier', 'mention_bac', 'ecole_etudiant', 'age', 'serie_bac', 'point_bac', 'precision_handicap', 'cite_id', 'batiment_id', 'palier_id', 'chambre_id', 'lit_id', 'created_at', 'updated_at')
        ->where('statut',2)
        ->get();
        return view('layouts.traiter',[
            'demandes' =>$demandes
        ]);
    }
    public function terminer(Request $request)
    {
        $demandes =  DB::table('demandes')
        ->select('genre', 'num_carte', 'nom_etudiant', 'prenoms_etudiant', 'date_naissance_etudiant', 'lieu_naissance_etudiant', 'contact_etudiant', 'email_etudiant', 'nationnalite', 'handicap_etudiant', 'nom_tuteur', 'contact_tuteur', 'ufr_etudiant', 'departement_etudiant', 'niveau_actuel_etudiant', 'niveau_precedent_etudiant', 'decision_final_etudiant', 'matricule_crou', 'filiere', 'statut', 'is_bachelier', 'mention_bac', 'ecole_etudiant', 'age', 'serie_bac', 'point_bac', 'precision_handicap', 'cite_id', 'batiment_id', 'palier_id', 'chambre_id', 'lit_id', 'created_at', 'updated_at')
        ->where('statut',3)
        ->get();
        return view('layouts.traiter',[
            'demandes' =>$demandes
        ]);
    }
    public function saveDemande(DemandeRequest $request)
    {
        // $validated = $request->validated();
        $mat = "CROUA2-2023-0".rand(4365,9999999);

        $file = $request->file('image');
        $filename = date('YmdHi').$file->getClientOriginalName();
        $file->move('photos', $filename);
        // $data['image']= url('photos/'.$filename);
        $data['image']= 'photos/'.$filename;
        $demande = new Demande;
        $demande->matricule_crou = $mat;
        $demande->genre = $request->genre;
        $demande->image = $data['image'];
        $demande->num_carte = $request->num_carte;
        $demande->nom_etudiant = $request->nom_etudiant;
        $demande->prenoms_etudiant = $request->prenoms_etudiant;
        $demande->date_naissance_etudiant = $request->date_naissance_etudiant;
        $demande->age = Carbon::parse($demande->date_naissance_etudiant)->age;;
        $demande->lieu_naissance_etudiant = $request->lieu_naissance_etudiant;
        $demande->contact_etudiant = $request->contact_etudiant;
        $demande->email_etudiant = $request->email_etudiant;
        $demande->nom_tuteur = $request->nom_tuteur;
        $demande->contact_tuteur = $request->contact_tuteur;
        $demande->niveau_actuel_etudiant = $request->niveau_actuel_etudiant;
        $demande->niveau_precedent_etudiant = $request->niveau_precedent_etudiant;
        $demande->decision_final_etudiant = $request->decision_final_etudiant;
        $demande->nationnalite = $request->nationnalite;
        $demande->ufr_etudiant = $request->ufr_etudiant;
        $demande->filiere = $request->filiere;
        if($demande->ufr_etudiant == 1 || $demande->ufr_etudiant != 9){
            $demande->ecole_etudiant = null;
            $demande->departement_etudiant = $request->departement_etudiant;
        }else{
            $demande->ecole_etudiant = $request->ecole_etudiant;
            $demande->departement_etudiant = null;
        }
        $demande->is_bachelier = $request->is_bachelier;
        if($demande->is_bachelier == 'Oui'){
            $demande->point_bac = $request->point_bac;
            $demande->serie_bac = $request->serie_bac;
            $demande->mention_bac = $request->mention_bac;
        }else{
            $demande->point_bac = null;
            $demande->serie_bac = null;
            $demande->mention_bac = null;
        }
        $demande->handicap_etudiant = $request->handicap_etudiant;
        if($demande->handicap_etudiant =='Oui'){
            $demande->precision_handicap = $request->precision_handicap;
        }else{
            $demande->precision_handicap = null;
        }
        $demande->statut = 0;
        $demande->save();
        $pdf = PDF::loadView('dossiers.fiche',[
            "data"=>$demande
        ]);
       /*  Mail::send([], [], function ($message) use ($demande,$pdf) {
            $attachment1 = new Swift_Attachment($pdf->output(), "ma_fiche.pdf",'application/pdf');
            $attachment2 = Swift_Attachment::fromPath(public_path() . "/documents/FICHE_DENGAGEMENT.pdf");
            $message->to($demande->email_etudiant)
              ->subject("Demande de chambre")
              ->setBody('Bonjour votre demande a été prise en compte')
              ->attach($attachment1)
              ->attach($attachment2);
          }); */
        return view('layouts.success',[
            "demande"=>$demande
        ]);
    }
  
    public function deleteFiche(Request $request)
    {
        $demande = Demande::where('matricule_crou',$request->matricule_crou)
        ->where('date_naissance_etudiant',$request->date_naissance_etudiant)
        ->first();
        if ($demande) {
            $demande->delete();
            $demandes = Demande::all();
            return view('layouts.traiter',[
                'demandes' =>$demandes,
                'message' =>"Demande supprimé"
            ]);
        }
    }
    public function trouverFiche(Request $request)
    {
        $niveaux = DB::table('niveaus')->get();
        $universites = DB::table('universites')->get();
        $departements = DB::table('departements')->get();
        $demande = Demande::where('matricule_crou',$request->matricule_crou)
        ->where('date_naissance_etudiant',$request->date_naissance_etudiant)
        ->first();
        $pays = $this->pays();
        if ($demande) {
            return view('layouts.update-demande',[
                'demande' =>$demande,
                "niveaux"=>$niveaux,
                "departements"=>$departements,
                "universites"=>$universites,
                "pays"=>$pays
            ]);
        }else{
            return back();
        }
    }
    public function updateDemande(DemandeUpdateRequest $request)
    {
        $validated = $request->validated();
        $demande = Demande::where("matricule_crou",$request->matricule_crou)->first();
        $file = $request->file('image');
        if($file){
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move('photos', $filename);
            $data['image']= 'photos/'.$filename;
            $demande->image = $data['image'];
        }
        $demande->genre = $request->genre;
        $demande->num_carte = $request->num_carte;
        $demande->nom_etudiant = $request->nom_etudiant;
        $demande->prenoms_etudiant = $request->prenoms_etudiant;
        $demande->date_naissance_etudiant = $request->date_naissance_etudiant;
        $demande->age = Carbon::parse($demande->date_naissance_etudiant)->age;
        $demande->lieu_naissance_etudiant = $request->lieu_naissance_etudiant;
        $demande->contact_etudiant = $request->contact_etudiant;
        $demande->email_etudiant = $request->email_etudiant;
        $demande->nom_tuteur = $request->nom_tuteur;
        $demande->contact_tuteur = $request->contact_tuteur;
        $demande->ufr_etudiant = $request->ufr_etudiant;
        $demande->filiere = $request->filiere;;
        if($demande->ufr_etudiant == 1 || $demande->ufr_etudiant != 9){
            $demande->ecole_etudiant = null;
            $demande->departement_etudiant = $request->departement_etudiant;
        }else{
            $demande->ecole_etudiant = $request->ecole_etudiant;
            $demande->departement_etudiant = null;
        }
        $demande->niveau_actuel_etudiant = $request->niveau_actuel_etudiant;
        $demande->niveau_precedent_etudiant = $request->niveau_precedent_etudiant;
        $demande->decision_final_etudiant = $request->decision_final_etudiant;
        $demande->nationnalite = $request->nationnalite;
        $demande->is_bachelier = $request->is_bachelier;
        if($demande->is_bachelier == 'Oui'){
            $demande->point_bac = $request->point_bac;
            $demande->serie_bac = $request->serie_bac;
            $demande->mention_bac = $request->mention_bac;
        }else{
            $demande->point_bac = null;
            $demande->serie_bac = null;
            $demande->mention_bac = null;
        }
        $demande->handicap_etudiant = $request->handicap_etudiant;
        if($demande->handicap_etudiant =='Oui'){
            $demande->precision_handicap = $request->precision_handicap;
        }else{
            $demande->precision_handicap = null;
        }
        $demande->save();
        /* $pdf = PDF::loadView('dossiers.fiche',[
            "data"=>$demande
        ]);
         Mail::send([], [], function ($message) use ($demande,$pdf) {
            $attachment1 = new Swift_Attachment($pdf->output(), "ma_fiche.pdf",'application/pdf');
            $attachment2 = Swift_Attachment::fromPath(public_path() . "/documents/FICHE_DENGAGEMENT.pdf");
            $message->to($demande->email_etudiant)
              ->subject("Modification de demande chambre")
              ->setBody('Bonjour votre modification de demande a été prise en compte')
              ->attach($attachment1)
              ->attach($attachment2);
          }); */
        return view('layouts.success',[
            "demande"=>$demande
        ]);
    }
    public function Departement(Request $request)
    {
        $list = array([
            'id' => null,
            'text'=>null
        ]);
        if($request->univ){
            $departements = DB::table('departements')
            ->select('id', 'libelle as text')
            ->where('universite_id',$request->univ)
            ->get();
            return response()->json(['list' => $departements]);
        }else{
            return response()->json([
                'list' => $list
            ]);
        }
    }
    public function Filieres(Request $request)
    {
        $list = array([
            'id' => null,
            'text'=>null
        ]);
        if($request->dep && $request->niv){
            $filieres = DB::table('filieres')
            ->select('id', 'libelle as text')
            ->where('departement_id',$request->dep)
            ->where('niveau', 'LIKE', '%'.strtoupper(explode(" ", $request->niv)[0]).'%')
            ->get();
            error_log(strtoupper(explode(" ", $request->niv)[0]));
            error_log($request->dep);
            error_log(json_encode($filieres));
            return response()->json(['list' => $filieres]);
        }else{
            return response()->json([
                'list' => $list
            ]);
        }
    }
    public function detailsDemande(Request $request)
    {
        $lits = Lit::where('statut',0)->get();
        $demande = Demande::where("matricule_crou",$request->mat)
        ->with(['chambre_attribue'])
        ->first();
        // dd($demande);
        return view('layouts.details-demande',[
            'demande' =>$demande,
            'lits' =>$lits,
        ]);
    }
    public function trouverDemande(Request $request)
    {
        $demandes =  DB::table('demandes')
            ->select('genre', 'num_carte', 'nom_etudiant', 'prenoms_etudiant', 'date_naissance_etudiant', 'lieu_naissance_etudiant', 'contact_etudiant', 'email_etudiant', 'nationnalite', 'handicap_etudiant', 'nom_tuteur', 'contact_tuteur', 'ufr_etudiant', 'departement_etudiant', 'niveau_actuel_etudiant', 'niveau_precedent_etudiant', 'decision_final_etudiant', 'matricule_crou', 'filiere', 'statut', 'is_bachelier', 'mention_bac', 'ecole_etudiant', 'age', 'serie_bac', 'point_bac', 'precision_handicap', 'cite_id', 'batiment_id', 'palier_id', 'chambre_id', 'lit_id', 'created_at', 'updated_at')
            ->where("matricule_crou",$request->matricule_crou)
            ->get();
        return view('layouts.traiter',[
            'demandes' =>$demandes
        ]);
    }
    public function pays()
    {
        return array( 
            array('id' => 1, 'title' => 'Afghane'),
            array('id' => 2, 'title' => 'Albanaise'),
            array('id' => 3, 'title' => 'Algerienne'),
            array('id' => 4, 'title' => 'Allemande'),
            array('id' => 5, 'title' => 'Americaine'),
            array('id' => 6, 'title' => 'Andorrane'),
            array('id' => 7, 'title' => 'Angolaise'),
            array('id' => 8, 'title' => 'Antiguaise et barbudienne'),
            array('id' => 9, 'title' => 'Argentine'),
            array('id' => 10, 'title' => 'Armenienne'),
            array('id' => 11, 'title' => 'Australienne'),
            array('id' => 12, 'title' => 'Autrichienne'),
            array('id' => 13, 'title' => 'Azerbaïdjanaise'),
            array('id' => 14, 'title' => 'Bahamienne'),
            array('id' => 15, 'title' => 'Bahreinienne'),
            array('id' => 16, 'title' => 'Bangladaise'),
            array('id' => 17, 'title' => 'Barbadienne'),
            array('id' => 18, 'title' => 'Belge'),
            array('id' => 19, 'title' => 'Belizienne'),
            array('id' => 20, 'title' => 'Beninoise'),
            array('id' => 21, 'title' => 'Bhoutanaise'),
            array('id' => 22, 'title' => 'Bielorusse'),
            array('id' => 23, 'title' => 'Birmane'),
            array('id' => 24, 'title' => 'Bissau-Guinéenne'),
            array('id' => 25, 'title' => 'Bolivienne'),
            array('id' => 26, 'title' => 'Bosnienne'),
            array('id' => 27, 'title' => 'Botswanaise'),
            array('id' => 28, 'title' => 'Bresilienne'),
            array('id' => 29, 'title' => 'Britannique'),
            array('id' => 30, 'title' => 'Bruneienne'),
            array('id' => 31, 'title' => 'Bulgare'),
            array('id' => 32, 'title' => 'Burkinabe'),
            array('id' => 33, 'title' => 'Burundaise'),
            array('id' => 35, 'title' => 'Cambodgienne'),
            array('id' => 36, 'title' => 'Camerounaise'),
            array('id' => 37, 'title' => 'Canadienne'),
            array('id' => 38, 'title' => 'Cap-verdienne'),
            array('id' => 39, 'title' => 'Centrafricaine'),
            array('id' => 40, 'title' => 'Chilienne'),
            array('id' => 41, 'title' => 'Chinoise'),
            array('id' => 42, 'title' => 'Chypriote'),
            array('id' => 43, 'title' => 'Colombienne'),
            array('id' => 44, 'title' => 'Comorienne'),
            array('id' => 45, 'title' => 'Congolaise'),
            array('id' => 46, 'title' => 'Costaricaine'),
            array('id' => 47, 'title' => 'Croate'),
            array('id' => 48, 'title' => 'Cubaine'),
            array('id' => 49, 'title' => 'Danoise'),
            array('id' => 50, 'title' => 'Djiboutienne'),
            array('id' => 51, 'title' => 'Dominicaine'),
            array('id' => 52, 'title' => 'Dominiquaise'),
            array('id' => 53, 'title' => 'Egyptienne'),
            array('id' => 54, 'title' => 'Emirienne'),
            array('id' => 55, 'title' => 'Equato-guineenne'),
            array('id' => 56, 'title' => 'Equatorienne'),
            array('id' => 57, 'title' => 'Erythreenne'),
            array('id' => 58, 'title' => 'Espagnole'),
            array('id' => 59, 'title' => 'Est-timoraise'),
            array('id' => 60, 'title' => 'Estonienne'),
            array('id' => 61, 'title' => 'Ethiopienne'),
            array('id' => 62, 'title' => 'Fidjienne'),
            array('id' => 63, 'title' => 'Finlandaise'),
            array('id' => 64, 'title' => 'Française'),
            array('id' => 65, 'title' => 'Gabonaise'),
            array('id' => 66, 'title' => 'Gambienne'),
            array('id' => 67, 'title' => 'Georgienne'),
            array('id' => 68, 'title' => 'Ghaneenne'),
            array('id' => 69, 'title' => 'Grenadienne'),
            array('id' => 70, 'title' => 'Guatemalteque'),
            array('id' => 71, 'title' => 'Guineenne'),
            array('id' => 72, 'title' => 'Guyanienne'),
            array('id' => 73, 'title' => 'Haïtienne'),
            array('id' => 74, 'title' => 'Hellenique'),
            array('id' => 75, 'title' => 'Hondurienne'),
            array('id' => 76, 'title' => 'Hongroise'),
            array('id' => 77, 'title' => 'Indienne'),
            array('id' => 78, 'title' => 'Indonesienne'),
            array('id' => 79, 'title' => 'Irakienne'),
            array('id' => 80, 'title' => 'Irlandaise'),
            array('id' => 81, 'title' => 'Islandaise'),
            array('id' => 82, 'title' => 'Israélienne'),
            array('id' => 83, 'title' => 'Italienne'),
            array('id' => 84, 'title' => 'Ivoirienne'),
            array('id' => 85, 'title' => 'Jamaïcaine'),
            array('id' => 86, 'title' => 'Japonaise'),
            array('id' => 87, 'title' => 'Jordanienne'),
            array('id' => 88, 'title' => 'Kazakhstanaise'),
            array('id' => 89, 'title' => 'Kenyane'),
            array('id' => 90, 'title' => 'Kirghize'),
            array('id' => 91, 'title' => 'Kiribatienne'),
            array('id' => 92, 'title' => 'Kittitienne-et-nevicienne'),
            array('id' => 93, 'title' => 'Kossovienne'),
            array('id' => 94, 'title' => 'Koweitienne'),
            array('id' => 95, 'title' => 'Laotienne'),
            array('id' => 96, 'title' => 'Lesothane'),
            array('id' => 97, 'title' => 'Lettone'),
            array('id' => 98, 'title' => 'Libanaise'),
            array('id' => 99, 'title' => 'Liberienne'),
            array('id' => 100, 'title' => 'Libyenne'),
            array('id' => 101, 'title' => 'Liechtensteinoise'),
            array('id' => 102, 'title' => 'Lituanienne'),
            array('id' => 103, 'title' => 'Luxembourgeoise'),
            array('id' => 104, 'title' => 'Macedonienne'),
            array('id' => 105, 'title' => 'Malaisienne'),
            array('id' => 106, 'title' => 'Malawienne'),
            array('id' => 107, 'title' => 'Maldivienne'),
            array('id' => 108, 'title' => 'Malgache'),
            array('id' => 109, 'title' => 'Malienne'),
            array('id' => 110, 'title' => 'Maltaise'),
            array('id' => 111, 'title' => 'Marocaine'),
            array('id' => 112, 'title' => 'Marshallaise'),
            array('id' => 113, 'title' => 'Mauricienne'),
            array('id' => 114, 'title' => 'Mauritanienne'),
            array('id' => 115, 'title' => 'Mexicaine'),
            array('id' => 116, 'title' => 'Micronesienne'),
            array('id' => 117, 'title' => 'Moldave'),
            array('id' => 118, 'title' => 'Monegasque'),
            array('id' => 119, 'title' => 'Mongole'),
            array('id' => 120, 'title' => 'Montenegrine'),
            array('id' => 121, 'title' => 'Mozambicaine'),
            array('id' => 122, 'title' => 'Namibienne'),
            array('id' => 123, 'title' => 'Nauruane'),
            array('id' => 124, 'title' => 'Neerlandaise'),
            array('id' => 125, 'title' => 'Neo-zelandaise'),
            array('id' => 126, 'title' => 'Nepalaise'),
            array('id' => 127, 'title' => 'Nicaraguayenne'),
            array('id' => 128, 'title' => 'Nigeriane'),
            array('id' => 129, 'title' => 'Nigerienne'),
            array('id' => 130, 'title' => 'Nord-coréenne'),
            array('id' => 131, 'title' => 'Norvegienne'),
            array('id' => 132, 'title' => 'Omanaise'),
            array('id' => 133, 'title' => 'Ougandaise'),
            array('id' => 134, 'title' => 'Ouzbeke'),
            array('id' => 135, 'title' => 'Pakistanaise'),
            array('id' => 136, 'title' => 'Palau'),
            array('id' => 137, 'title' => 'Palestinienne'),
            array('id' => 138, 'title' => 'Panameenne'),
            array('id' => 139, 'title' => 'Papouane-neoguineenne'),
            array('id' => 140, 'title' => 'Paraguayenne'),
            array('id' => 141, 'title' => 'Peruvienne'),
            array('id' => 142, 'title' => 'Philippine'),
            array('id' => 143, 'title' => 'Polonaise'),
            array('id' => 144, 'title' => 'Portoricaine'),
            array('id' => 145, 'title' => 'Portugaise'),
            array('id' => 146, 'title' => 'Qatarienne'),
            array('id' => 147, 'title' => 'Roumaine'),
            array('id' => 148, 'title' => 'Russe'),
            array('id' => 149, 'title' => 'Rwandaise'),
            array('id' => 150, 'title' => 'Saint-lucienne'),
            array('id' => 151, 'title' => 'Saint-marinaise'),
            array('id' => 152, 'title' => 'Saint-vincentaise-et-grenadine'),
            array('id' => 153, 'title' => 'Salomonaise'),
            array('id' => 154, 'title' => 'Salvadorienne'),
            array('id' => 155, 'title' => 'Samoane'),
            array('id' => 156, 'title' => 'Santomeenne'),
            array('id' => 157, 'title' => 'Saoudienne'),
            array('id' => 158, 'title' => 'Senegalaise'),
            array('id' => 159, 'title' => 'Serbe'),
            array('id' => 160, 'title' => 'Seychelloise'),
            array('id' => 161, 'title' => 'Sierra-leonaise'),
            array('id' => 162, 'title' => 'Singapourienne'),
            array('id' => 163, 'title' => 'Slovaque'),
            array('id' => 164, 'title' => 'Slovene'),
            array('id' => 165, 'title' => 'Somalienne'),
            array('id' => 166, 'title' => 'Soudanaise'),
            array('id' => 167, 'title' => 'Sri-lankaise'),
            array('id' => 168, 'title' => 'Sud-africaine'),
            array('id' => 169, 'title' => 'Sud-coréenne'),
            array('id' => 170, 'title' => 'Suedoise'),
            array('id' => 171, 'title' => 'Suisse'),
            array('id' => 172, 'title' => 'Surinamaise'),
            array('id' => 173, 'title' => 'Swazie'),
            array('id' => 174, 'title' => 'Syrienne'),
            array('id' => 175, 'title' => 'Tadjike'),
            array('id' => 195, 'title' => 'Taiwanaise'),
            array('id' => 176, 'title' => 'Tanzanienne'),
            array('id' => 177, 'title' => 'Tchadienne'),
            array('id' => 178, 'title' => 'Tcheque'),
            array('id' => 179, 'title' => 'Thaïlandaise'),
            array('id' => 180, 'title' => 'Togolaise'),
            array('id' => 181, 'title' => 'Tonguienne'),
            array('id' => 182, 'title' => 'Trinidadienne'),
            array('id' => 183, 'title' => 'Tunisienne'),
            array('id' => 184, 'title' => 'Turkmene'),
            array('id' => 185, 'title' => 'Turque'),
            array('id' => 186, 'title' => 'Tuvaluane'),
            array('id' => 187, 'title' => 'Ukrainienne'),
            array('id' => 188, 'title' => 'Uruguayenne'),
            array('id' => 189, 'title' => 'Vanuatuane'),
            array('id' => 190, 'title' => 'Venezuelienne'),
            array('id' => 191, 'title' => 'Vietnamienne'),
            array('id' => 192, 'title' => 'Yemenite'),
            array('id' => 193, 'title' => 'Zambienne'),
            array('id' => 194, 'title' => 'Zimbabweenne'),
        );
    }
}
