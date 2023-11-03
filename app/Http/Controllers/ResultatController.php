<?php

namespace App\Http\Controllers;

use App\Demande;
use App\ReAdmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResultatController extends Controller
{
    public function consultation(Request $request)
    {
        // dd($request->all());

        $custom_messages = [
            'matricule_crou.required' => "Veuillez renseigner votre identifiant",
            // 'matricule_crou.max' => "Votre identifiant est au maximum 10 caractères",
            // 'matricule_crou.min' => "Votre identifiant est au minimum 10 caractères",
            'date_naissance_etudiant.required' => "Veuillez renseigner votre date de naissance",
        ];
        $rules = [
            // 'matricule_crou' => 'required|min:10|max:10',
            'matricule_crou' => 'required',
            'date_naissance_etudiant' => 'required'
        ];


        $validator = Validator::make($request->all(), $rules, $custom_messages);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        if ($request->readmission == "Readmission") {
            $demande = ReAdmission::where('matricule_crou', $request->matricule_crou)
                ->where('date_naissance_etudiant', $request->date_naissance_etudiant)
                ->first();
        } else if ($request->admission == "Admission") {
            $demande = Demande::where('matricule_crou', $request->matricule_crou)
                ->where('date_naissance_etudiant', $request->date_naissance_etudiant)
                ->first();
        }

        return view('layouts.resultatconsultation', ['demande' => $demande]);
    }

    public function reponseConsultation(Request $request)
    {
        $demande = Demande::where('matricule_crou', $request->matricule_crou)
            ->where('date_naissance_etudiant', $request->date_naissance_etudiant)
            ->first();
        dd($demande);
        return view('layouts.resultatconsultation', ['demande' => $demande]);
    }

    public function reponseChercherid(Request $request)
    {
        $demande = Demande::where('nom_etudiant', $request->contact_etudiant)
            ->where('prenoms_etudiant', $request->email_etudiant)
            ->where('lieu_naissance_etudiant', $request->lieu_naissance_etudiant)
            ->where('email_etudiant', $request->email_etudiant)
            ->where('contact_etudiant', $request->contact_etudiant)
            ->where('date_naissance_etudiant', $request->date_naissance_etudiant)
            ->first();
        return view('layouts.id-trouver', ['demande' => $demande]);
    }


    public function idtrouver(Request $request)
    {
        $demande = Demande::where('nom_etudiant', $request->nom_etudiant)
            ->where('prenoms_etudiant', $request->prenoms_etudiant)
            ->where('lieu_naissance_etudiant', $request->lieu_naissance_etudiant)
            ->where('email_etudiant', $request->email_etudiant)
            ->where('contact_etudiant', $request->contact_etudiant)
            ->where('date_naissance_etudiant', $request->date_naissance_etudiant)
            ->first();
        return view('layouts.id-trouver', ['demande' => $demande]);

    }
}
