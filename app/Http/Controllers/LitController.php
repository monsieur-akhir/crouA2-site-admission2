<?php

namespace App\Http\Controllers;

use App\Lit;
use App\Chambre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LitController extends Controller
{
    //

    public function __construct()
    {
        // $this->middleware('auth');
    }
    public function index()
    {
        $lits = Lit::all();
        $chambres = Chambre::all();

        return view('layouts.lit', ['lits' => $lits, 'chambres' => $chambres]);
    }

    public function store(Request $request)
    {

        $custom_messages = [
            'chambre_id.required' => "Veuillez sélectionner une chambre",
            'libelle.required' => "Veuillez saisir le libellé"
        ];

        $rules = [
            'chambre_id' => 'required',
            'libelle' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules, $custom_messages);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()]);
        } else {

            $libelle = $request->libelle;
            $chambre_id = $request->chambre_id;

            $chambre = Chambre::where('id', $chambre_id)->first();
            $count = Lit::where('chambre_id', $chambre_id)->count();

            if ($chambre->nombre_lit >  $count) {

                $li = Lit::where('libelle', $libelle)
                    ->where('chambre_id', $chambre_id)->first();
                if (empty($li)) {

                    $lit = new Lit();
                    $lit->libelle = $libelle;
                    $lit->chambre_id = $chambre_id;

                    if ($lit->save()) {
                        return response()->json(['success' => ["Lit ajouté avec succès"]]);
                    } else {
                        return response()->json(['error' => ['Une erreur c\'est produite veuillez reéssayer plus tard']]);
                    }
                } else {
                    return response()->json(['error' => 'Ce Lit existe dans une chambre']);
                }
            } else {
                return response()->json(['error' => 'La capacité de lit dans cette chambre est atteint']);
            }
        }
    }


    public function update(Request $request)
    {

        $custom_messages = [
            'chambre_id.required' => "Veuillez sélectionner une chambre",
            'libelle.required' => "Veuillez saisir le libellé",
            'id.required' => "Impossible de faire cette action",
        ];

        $rules = [
            'chambre_id' => 'required',
            'libelle' => 'required',
            'id' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules, $custom_messages);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()]);
        } else {

            $libelle = $request->libelle;
            $chambre_id = $request->chambre_id;
            $id = $request->id;

            $li = Lit::where('libelle', $libelle)
                ->where('chambre_id', $chambre_id)->first();

            $chambre = Chambre::where('id', $chambre_id)->first();
            $count = Lit::where('chambre_id', $chambre_id)->count();

            if ($chambre->nombre_lit >  $count) {

                if (empty($li)) {

                    $valid = Lit::where('id', $id)->update([
                        'libelle' => $libelle,
                        'chambre_id' => $chambre_id
                    ]);
                    if ($valid) {
                        return response()->json(['success' => ["Lit modifié avec succès"]]);
                    } else {
                        return response()->json(['error' => ['Une erreur c\'est produite veuillez reéssayer plus tard']]);
                    }
                } else {
                    return response()->json(['error' => 'Ce lit existe dans une chambre']);
                }
            } else {
                return response()->json(['error' => 'La capacité de lit dans cette chambre est atteint']);
            }
        }
    }
    public function listByChambre(Request $request)
    {
        error_log($request->ch);
        $data = DB::table('lits')
            ->select('id', 'libelle as text')
            ->where('chambre_id', $request->ch)
            ->get();
            error_log(json_encode($data));
            return response()->json(['list' => $data]);
    }
}
