<?php

namespace App\Http\Controllers;

use App\Cite;
use App\Batiment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BatimentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $batiments = Batiment::orderBy('id', 'DESC')->get();
        $cites = Cite::orderBy('id', 'DESC')->get();
        return view('layouts.batiment', [
            'batiments' => $batiments,
            'cites' => $cites
        ]);
    }

    public function store(Request $request)
    {
       
        $custom_messages = [
            'cite_id.required' => "Veuillez sélectionner une cité",           
            'libelle.required' => "Veuillez saisir le libellé"
        ];

        $rules = [
            'cite_id' => 'required',
            'libelle' => 'required'
        ];
       
        $validator = Validator::make($request->all(), $rules, $custom_messages);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()]);
        } else {

            $libelle = $request->libelle;
            $cite_id = $request->cite_id;
            $bat = Batiment::where('libelle', $libelle)
                              ->where('cite_id', $cite_id)->first();
            if(empty($bat)){

                $batiment = new Batiment();
                $batiment->libelle = $libelle;
                $batiment->cite_id = $cite_id;

                if ($batiment->save()) {
                    return response()->json(['success' => ["Bâtiment ajouté avec succès"]]);
                } else {
                    return response()->json(['error' => ['Une erreur c\'est produite veuillez reéssayer plus tard']]);
                }

            }else{
                return response()->json(['error' => 'Ce bâtiment existe pour ce bâtiment de la cette cité']);
            }

        }
    }

    public function update(Request $request)
    {
       
        $custom_messages = [
            'cite_id.required' => "Veuillez sélectionner une cité",           
            'id.required' => "Impossible de faire cette action",           
            'libelle.required' => "Veuillez saisir le libellé"
        ];

        $rules = [
            'cite_id' => 'required',
            'id' => 'required',
            'libelle' => 'required'
        ];
       
        $validator = Validator::make($request->all(), $rules, $custom_messages);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()]);
        } else {

            $libelle = $request->libelle;
            $cite_id = $request->cite_id;
            $id = $request->id;

            $bat = Batiment::where('libelle', $libelle)
                              ->where('cite_id', $cite_id)->first();
            if(empty($bat)){

                $valid = Batiment::where('id', $id)->update(['libelle' => $libelle,
                 'cite_id' => $cite_id ]);

                if ($valid) {
                    return response()->json(['success' => ["bâtiment modifié avec succès"]]);
                } else {
                    return response()->json(['error' => ['Une erreur c\'est produite veuillez reéssayer plus tard']]);
                }

            }else{
                return response()->json(['error' => 'Ce bâtiment existe pour la cette cité']);
            }

        }
    }
    public function listByCite(Request $request)
    {
        $data = DB::table('batiments')
            ->select('id', 'libelle as text')
            ->where('cite_id',$request->cite)
            ->get();
            error_log(json_encode($data));
            return response()->json(['list' => $data]);
    }
}
