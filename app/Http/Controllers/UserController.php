<?php

namespace App\Http\Controllers;

use App\User;
use App\Mail\SendMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function listeAgent()
    {

        $agents = User::whereNotIn('statut', ['-1'])
            ->orderBy('id', 'DESC')
            ->get();
        return view('layouts.liste-agent', ['agents' => $agents]);
    }

    public function validerAgent(Request $request)
    {

        //dd($request);

        $custom_messages = [
            'id.required' => "Impossible de faire cette action 1",
            'email.required' => "Impossible de faire cette action 2",
            'statut.required' => "Impossible de faire cette action  3",
            'nom.required' => "Impossible de faire cette action 4",
        ];
        $rules = [
            'id' => 'required',
            'statut' => 'required',
            'email' => 'required',
            'nom' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules, $custom_messages);
        if ($validator->fails()) {
            return Redirect::back()->withErrors([$validator->errors()->first()]);
        } else {

            $email = $request->email;
            $id = $request->id;
            $statut = $request->statut;
            $nom = $request->nom;

            $validUser = User::where('id', $id)->where('email', $email)->update([
                    'statut' => $statut
                ]);

            if ($validUser) {
                $details =
                    [
                        'title' => 'Compte activé',
                        'nom' => $nom,
                        'msg' => 'Votre compte ' . $email . ' a été activé.Veuillez vous rendre sur https://admission.croua2.ci/login pour vous connecter.'
                    ];
                if ($statut == '1') {

                    // $msg = 'activé';
                    $otp = 'activé';
                    /* Mail::send([], [], function ($message) use ($nom, $otp, $email) {
                        $message->to($email)
                            ->subject("Code temporaire OTP")
                            ->setBody('<h2>Bonjour ' . $nom . ',</h2>
                          <p> Votre compte est <strong> ' . $otp . '</strong>. Veuillez vous rendre sur (cliquez) <a href="https://admission.croua2.ci/login"><strong> admission croua2 </strong></a> pour vous connecter.</p>', 'text/html');
                    }); */
                } else if ($statut == 0) {
                    $otp = 'désactivé';
                }
                return redirect('/liste-agent')->with('_success', 'Compte ' . $otp . ' avec succès');
            }
        }
    }

    public function creerUser(Request $request)
    {
        $custom_messages = [
            'telephone.nullable' => "Veuillez renseigner le numéro de téléphone",
            'telephone.unique' => "Ce numéro de téléphone existe déjà",
            'telephone.max' => "Le téléphone est au maximum 10 caractères",
            'telephone.min' => "Le téléphone est au minimum 10 caractères",

            'email.max' => "L'email est au maximum 100 caractères",
            'email.min' => "L'email est au minimum 8 caractères",
            'email.unique' => "Cet utilisateur existe déjà",

            'nom.required' => "Veuillez renseigner le nom",
            'nom.max' => "Le nom est au maximum 50 caractères",
            'nom.min' => "Le nom est au minimum 2 caractères",

            'prenoms.required' => "Veuillez renseigner le prénom",
            'prenoms.max' => "Le prénom est au maximum 50 caractères",
            'prenoms.min' => "Le prénom est au minimum 2 caractères"
        ];

        $rules = [
            'telephone' => 'nullable|unique:users|min:10|max:10',
            'email' => 'unique:users|email|max:50|min:8',
            'nom' => 'required|max:30|min:2',
            'prenoms' => 'required|max:30|min:2'
        ];

        $validator = Validator::make($request->all(), $rules, $custom_messages);
        if ($validator->fails()) {
            return Redirect::back()->withErrors([$validator->errors()->first()]);
        } else {

            $nom = $request->nom;
            $prenoms = $request->prenoms;
            $telephone = $request->telephone;
            $email = $request->email;
            $role = $request->role;
            $password = strtoupper(Str::random(8));

            $user = new User();
            $user->telephone = $telephone;
            $user->role = $role;
            $user->email = $email;
            $user->nom = $nom;
            $user->prenoms = $prenoms;
            $user->statut = 2;
            $user->password = Hash::make($password);

            if ($user->save()) {
               /*  Mail::send([], [], function ($message) use ($nom, $password, $email) {
                    $message->to($email)
                        ->subject("Compte crée")
                        ->setBody('<h2>Bonjour ' . $nom . ',</h2>
                      <p> Votre compte a été crée, veuillez vous connecter avec les accès <br>  email : <strong> ' . $email . '</strong> <br> Mot de passe : <strong> ' . $password . '</strong> <br> Veuillez vous rendre sur (cliquez) <a href="https://admission.croua2.ci/login"><strong> admission croua2 </strong></a> pour vous connecter.</p>', 'text/html');
                }); */
                return redirect('/liste-agent')->with('_success', 'Utilisateur crée avec succès');
            } else {
                return Redirect::back()->withErrors("Une erreur c'est produite veuillez reéssayer plus tard");
            }
        }
    }


    public function modifierUser(Request $request)
    {

        $custom_messages = [
            'id.required' => "Impossible de faire cette action",
            'old_email.required' => "Impossible de faire cette action",
            'telephone.nullable' => "Veuillez renseigner le numéro de téléphone",
            //'telephone.unique' => "Ce numéro de téléphone existe déjà",
            'telephone.max' => "Le téléphone est au maximum 10 caractères",
            'telephone.min' => "Le téléphone est au minimum 10 caractères",

            'email.max' => "L'email est au maximum 100 caractères",
            'email.min' => "L'email est au minimum 8 caractères",
            // 'email.unique' => "Cet utilisateur existe déjà",

            'nom.required' => "Veuillez renseigner le nom",
            'nom.max' => "Le nom est au maximum 50 caractères",
            'nom.min' => "Le nom est au minimum 2 caractères",

            'prenoms.required' => "Veuillez renseigner le prénom",
            'prenoms.max' => "Le prénom est au maximum 50 caractères",
            'prenoms.min' => "Le prénom est au minimum 2 caractères"
        ];

        $rules = [
            'telephone' => 'nullable|min:10|max:10',
            'email' => 'email|max:50|min:8',
            'nom' => 'required|max:30|min:2',
            'id' => 'required',
            'old_email' => 'required',
            'prenoms' => 'required|max:30|min:2'
        ];

        $validator = Validator::make($request->all(), $rules, $custom_messages);
        if ($validator->fails()) {
            return Redirect::back()->withErrors([$validator->errors()->first()]);
        } else {
            //dd($request->old_email,Auth::user()->email);
            if ($request->old_email != Auth::user()->email) {

                $nom = $request->nom;
                $prenoms = $request->prenoms;
                $telephone = $request->telephone;
                $email = $request->email;
                $old_email = $request->old_email;
                $role = $request->role;
                $id = $request->id;
                
                $u = User::where('email', $email)->first();

                if((!empty($u) && $email == $old_email) || empty($u) ){
    
                    $user = User::where('id', $id)->update([
                        'telephone'=> $telephone,
                        'role'=> $role,
                        'email'=> $email,
                        'nom'=> $nom,
                        'prenoms'=> $prenoms
                    ]);
                    if ($user) {
                        /* Mail::send([], [], function ($message) use ($nom, $telephone, $email) {
                            $message->to($email)
                                ->subject("Compte modifié")
                                ->setBody('<h2>Bonjour ' . $nom . ',</h2>
                              <p> Votre compte a été modifié, veuillez vous connecter avec,  email : <strong> ' . $email . '</strong> et votre mot de passe habituel <br> Veuillez vous rendre sur (cliquez) <a href="https://admission.croua2.ci/login"><strong> admission croua2 </strong></a> pour vous connecter.</p>', 'text/html');
                        }); */
                        return redirect('/liste-agent')->with('_success', 'Utilisateur modifié avec succès');
                    } else {
                        return Redirect::back()->withErrors("Une erreur c'est produite veuillez reéssayer plus tard");
                    }
                }else{
                    return Redirect::back()->withErrors("Un compte existe avec ce email ".$email."");
                } 



            } else {
                return Redirect::back()->withErrors("Impossible de modifié le compte admin connecté pour l'action que vous venez de faire");
            }
        }
    }
}
