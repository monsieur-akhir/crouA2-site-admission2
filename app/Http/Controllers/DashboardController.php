<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Demande;
use App\ReAdmission;

class DashboardController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function dashboard(){
        $termine = Demande::where('statut',3)->count();
        $valide = Demande::where('statut',2)->count();
        $annule = Demande::where('statut',-1)->count();
        $accepte = Demande::where('statut',1)->count();
        $initie = Demande::where('statut',0)->count();
        $all = Demande::count();
        return view('layouts.dashboard',[
            'termine'=>$termine,
            'valide'=>$valide,
            'annule'=>$annule,
            'accepte'=>$accepte,
            'initie'=>$initie,
            'all'=>$all,
        ]);
    }
    public function dashboardRead(){
        $termine = ReAdmission::where('statut',3)->count();
        $valide = ReAdmission::where('statut',2)->count();
        $annule = ReAdmission::where('statut',-1)->count();
        $accepte = ReAdmission::where('statut',1)->count();
        $initie = ReAdmission::where('statut',0)->count();
        $all = ReAdmission::count();
        return view('layouts.dashboard',[
            'termine'=>$termine,
            'valide'=>$valide,
            'annule'=>$annule,
            'accepte'=>$accepte,
            'initie'=>$initie,
            'all'=>$all,
        ]);
    }
    
}
