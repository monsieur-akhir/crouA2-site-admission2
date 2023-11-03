<?php

namespace App\Http\Controllers;

use App\Cite;
use App\Lit;
use App\Batiment;
use App\Palier;
use App\Chambre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CiteController extends Controller
{
    
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cites = Cite::orderBy('id', 'DESC')->get();
        
        return view('layouts.cite', [
            'cites' => $cites
        ]);
    }

    public function store(Request $request)
    {
       
        $custom_messages = [        
            'libelle.required' => "Veuillez saisir le libellé"
        ];

        $rules = [
            'libelle' => 'required'
        ];
       
        $validator = Validator::make($request->all(), $rules, $custom_messages);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()]);
        } else {

            $libelle = $request->libelle;
            $cit = Cite::where('libelle', $libelle)->first();
            if(empty($cit)){

                $cite = new Cite();
                $cite->libelle = $libelle;

                if ($cite->save()) {
                    return response()->json(['success' => ["Cité ajoutée avec succès"]]);
                } else {
                    return response()->json(['error' => ['Une erreur c\'est produite veuillez reéssayer plus tard']]);
                }

            }else{
                return response()->json(['error' => 'Cette cité existe pour ce bâtiment de la cette cité']);
            }

        }
    }

    public function update(Request $request)
    {
       
        $custom_messages = [          
            'id.required' => "Impossible de faire cette action",           
            'libelle.required' => "Veuillez saisir le libellé"
        ];

        $rules = [
            'id' => 'required',
            'libelle' => 'required'
        ];
       
        $validator = Validator::make($request->all(), $rules, $custom_messages);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()]);
        } else {

            $libelle = $request->libelle;
            $id = $request->id;

            $ci = Cite::where('libelle', $libelle)->first();
            if(empty($ci)){

                $valid = Cite::where('id', $id)->update(['libelle' => $libelle]);

                if ($valid) {
                    return response()->json(['success' => ["Cité modifiée avec succès"]]);
                } else {
                    return response()->json(['error' => ['Une erreur c\'est produite veuillez reéssayer plus tard']]);
                }

            }else{
                return response()->json(['error' => 'Cette cité existe']);
            }

        }
    }
    public function chambreInfo(Request $request)
    {
        $table = "";
        if($request->bat){
            $table = "batiments";
        }
        $data = DB::table($table)
            ->select('id', 'libelle as text')
            ->where('departement_id',$request->dep)
            ->where('niveau', 'LIKE', '%'.strtoupper(explode(" ", $request->niv)[0]).'%')
            ->get();
            error_log(strtoupper(explode(" ", $request->niv)[0]));
            error_log($request->dep);
            error_log(json_encode($filieres));
            return response()->json(['list' => $filieres]);
        
    }
}
