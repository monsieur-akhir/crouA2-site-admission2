<?php

namespace App\Http\Controllers;

use App\Palier;
use App\Batiment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PalierController extends Controller
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
        $batiments = Batiment::all();

        return view('layouts.palier', ['paliers'=> $paliers, 'batiments'=> $batiments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $custom_messages = [
            'batiment_id.required' => "Veuillez sélectionner un bâtiment",           
            'libelle.required' => "Veuillez saisir le libellé"
        ];

        $rules = [
            'batiment_id' => 'required',
            'libelle' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules, $custom_messages);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()]);
        } else {

            $libelle = $request->libelle;
            $batiment_id = $request->batiment_id;
            $palie = Palier::where('libelle', $libelle)
                              ->where('batiment_id', $batiment_id)->first();
            if(empty($palie)){

                $palier = new Palier();
                $palier->libelle = $libelle;
                $palier->batiment_id = $batiment_id;

                if ($palier->save()) {
                    return response()->json(['success' => ["Palier ajouté avec succès"]]);
                } else {
                    return response()->json(['error' => ['Une erreur c\'est produite veuillez reéssayer plus tard']]);
                }

            }else{
                return response()->json(['error' => 'Ce palier existe pour ce bâtiment de la cette cité']);
            }

        }
    }
  
    public function update(Request $request){

        $custom_messages = [
            'batiment_id.required' => "Veuillez sélectionner un bâtiment",           
            'libelle.required' => "Veuillez saisir le libellé",
            'id.required' => "Impossible de faire cette action",
        ];

        $rules = [
            'batiment_id' => 'required',
            'libelle' => 'required',
            'id' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules, $custom_messages);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()]);
        } else {

            $libelle = $request->libelle;
            $batiment_id = $request->batiment_id;
            $id = $request->id;

            $pa = Palier::where('libelle', $libelle)
                              ->where('batiment_id', $batiment_id)->first();
            if(empty($pa)){

                $valid = Palier::where('id', $id)->update(['libelle' => $libelle,
                 'batiment_id' => $batiment_id ]);
                if ($valid) {
                    return response()->json(['success' => ["Palier modifié avec succès"]]);
                } else {
                    return response()->json(['error' => ['Une erreur c\'est produite veuillez reéssayer plus tard']]);
                }

            }else{
                return response()->json(['error' => 'Ce palier existe pour ce bâtiment de la cette cité']);
            }

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Palier  $palier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Palier $palier)
    {
        //
    }
    public function listByBatiment(Request $request)
    {
        $data = DB::table('paliers')
            ->select('id', 'libelle as text')
            ->where('batiment_id',$request->bat)
            ->get();
            return response()->json(['list' => $data]);
    }
}
