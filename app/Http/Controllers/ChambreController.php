<?php

namespace App\Http\Controllers;

use App\Lit;
use App\Palier;
use App\Chambre;
use App\CodeNbreLit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class ChambreController extends Controller
{

    
    public function __construct()
    {
        // $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paliers = Palier::all();
        $codeNbrLits = CodeNbreLit::all();
        $chambres = Chambre::with('lits')->get();
        // dd($chambres);
        return view('layouts.chambre', [
            'paliers'=> $paliers,
            'codeNbrLits'=> $codeNbrLits,
            'chambres'=> $chambres
         ]);
    }

    public function store(Request $request)
    {
       
        $custom_messages = [
            'palier_id.required' => "Veuillez sélectionner un palier",           
            'libelle.required' => "Veuillez saisir le libellé",
            'code_nbre_lit_id.required' => "Veuillez saisir le nombre de lit",
        ];

        $rules = [
            'palier_id' => 'required',
            'libelle' => 'required',
            'code_nbre_lit_id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules, $custom_messages);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()]);
        } else {

            $libelle = $request->libelle;
            $palier_id = $request->palier_id;
            $code_nbre_lit_id = $request->code_nbre_lit_id;

           

            $ch = Chambre::where('libelle', $libelle)
                              ->where('palier_id', $palier_id)->first();
        

            $CdNbreChbre = CodeNbreLit::where('id', $code_nbre_lit_id)->first();

           // return response()->json(['success' => [$CdNbreChbre->nbre."/".$code_nbre_lit_id]]);


            if(empty($ch)){

                $chambre = new Chambre();
                $chambre->libelle = $libelle;
                $chambre->palier_id = $palier_id;
                $chambre->code_nbre_lit_id = $code_nbre_lit_id;
                $chambre->nombre_lit = $CdNbreChbre->nbre;
                $chambre->nbre_restant_lit = $CdNbreChbre->nbre;

                if ($chambre->save()) {
                    return response()->json(['success' => ["Chambre ajoutée avec succès"]]);
                } else {
                    return response()->json(['error' => ['Une erreur c\'est produite veuillez reéssayer plus tard']]);
                }

            }else{
                return response()->json(['error' => 'Ce palier existe pour ce bâtiment de la cette cité']);
            }

        }
    }

    public function update(Request $request)
    {
       
        $custom_messages = [
            'palier_id.required' => "Veuillez sélectionner un palier",           
            'libelle.required' => "Veuillez saisir le libellé",
            'id.required' => "Impossible de faire catte action",
            'code_nbre_lit_id.required' => "Veuillez saisir le nombre de lit",
        ];

        $rules = [
            'palier_id' => 'required',
            'libelle' => 'required',
            'id' => 'required',
            'code_nbre_lit_id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules, $custom_messages);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()]);
        } else {

            $libelle = $request->libelle;
            $palier_id = $request->palier_id;
            $code_nbre_lit_id = $request->code_nbre_lit_id;
            $id = $request->id;

           

            $ch = Chambre::where('libelle', $libelle)
                           ->where('palier_id', $palier_id)->first();        

            $CdNbreChbre = CodeNbreLit::where('id', $code_nbre_lit_id)->first();
            $count = Lit::where('chambre_id', $id)->where('statut_occp_lit', 1)->count();
            if(empty($ch)){

                $valid = Chambre::where('id', $id)->update([
                'libelle' => $libelle,
                'palier_id' => $palier_id,
                'code_nbre_lit_id' => $code_nbre_lit_id,
                'nombre_lit' => $CdNbreChbre->nbre,
                'nbre_restant_lit' => ($CdNbreChbre->nbre-$count),
             ]);
               if ($valid) {
                   return response()->json(['success' => ["Lit modifié avec succès"]]);
               } else {
                   return response()->json(['error' => ['Une erreur c\'est produite veuillez reéssayer plus tard']]);
               }

            }else{
                return response()->json(['error' => 'Ce palier existe pour ce bâtiment de la cette cité']);
            }

        }
    }
    public function listByPalier(Request $request)
    {
        $data = DB::table('chambres')
            ->select('id', 'libelle as text')
            ->where('palier_id',$request->pal)
            ->get();
            return response()->json(['list' => $data]);
    }

   
}
