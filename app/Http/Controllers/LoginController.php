<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;

use App\Mail\SendMail;
use App\Mail\LoginEmail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $custom_messages = [
            'email.required' => "Veuillez renseigner le numéro de téléphone",
            'email.max' => "Le téléphone est au maximum 100 caractères",
            'email.min' => "Le téléphone est au minimum 8 caractères",
            'password.required' => "Veuillez renseigner le mot de passe",
            'password.max' => "Le mot de passe est au maximum 16 caractères",
            'password.min' => "Le mot de passe est au minimum 8 caractères"
        ];

        $rules = [
            'email' => 'required|min:8|max:100',
            'password' => 'required|min:8|max:32'
        ];
        $validator = Validator::make($request->all(), $rules, $custom_messages);
        if ($validator->fails()) {
            return redirect('login')->withErrors($validator->errors()->first());
        } else {
            $email = $request->email;
            $password = $request->password;
            $user = User::where('email', $email)->first();
           // dd($user->password, $user->email, $email);

            if (!empty($user) && ($user->role == 'admin' || $user->role == 'agent')) {

                if (Hash::check($password, $user->password)) {
                    if ($user->statut == 2) {
                        session()->put(['email' => $email, 'code' => 30]);
                        return redirect('/changerpassw')->with('otp_success', 'Veuillez definir un nouveau mot de passe pour vos prochaine connexion.');
                    } elseif ($user->statut == 1) {

                        $otp = strtoupper(Str::random(5));
                        $validUser = User::where('email', $email)->update(['otp' => $otp]);
                        session()->put('email', $email);
                        $nom = $user->usr_nom;
                        session()->forget(['email']);
                        Auth::guard()->login($user);
                        return redirect('dashboard');
                        /* if ($validUser) {
                            $details =
                                [
                                    'title' => 'Mail du Code otp',
                                    'nom' => $nom,
                                    'otp' => $otp
                                ];
                                Mail::to($email)->queue(new LoginEmail($user));
                            return redirect('/otp')->with('otp_success', 'Un email vous a été envoyé. Veuillez renseinger le code reçu ici.'); 
                        } else {
                            return redirect('login')->withErrors("Une erreur c'est produite veuillez reéssayer");
                        }*/
                    } else {
                        return redirect('login')->withErrors('Email ou mot de passe incorrect');
                    }
                } else {
                    return redirect('login')->withErrors('Email ou mot de passe incorrect');
                }
            } else {
                return redirect('login')->withErrors('Email ou mot de passe incorrect');
            }
        }
    }


    public function otp()
    {
        $email = session()->get('email');
        if (!empty($email)) {
            return view('layouts.otp');
        } else {
            return Redirect::back()->withErrors(['Imossible de faire cette action']);
        }
    }


    public function creerCompte(Request $request)
    {
        $custom_messages = [
            'telephone.required' => "Veuillez renseigner le numéro de téléphone",
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
            'prenoms.min' => "Le prénom est au minimum 2 caractères",

            'password.regex' => "Le mot de passe doit contenir au moins une minuscule, une majuscule, un chiffre, un caractère spécial et doit être entre 8 carcatères et 16 caractères",
            'password.same' => "Les deux mot de passe sont différents",
            'password.max' => "Le mot de passe est au maximum 16 caractères",
            'password.min' => "Le mot de passe est au minimum 8 caractères",
            'confirmation_password.min' => "La confirmation du mot est de 8 caractères au moins"
        ];

        $rules = [
            'telephone' => 'required|unique:users|min:10|max:10',
            'email' => 'unique:users|email|max:50|min:8',
            'nom' => 'required|max:30|min:2',
            'prenoms' => 'required|max:30|min:2',
            'password' => 'regex:/[@$!%*#?&]/|regex:/[0-9]/|regex:/[A-Z]/|regex:/[a-z]/|max:16|min:8|required_with:confirmation_password|same:confirmation_password',
            'confirmation_password' => 'max:16|min:8'
        ];

        $validator = Validator::make($request->all(), $rules, $custom_messages);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()]);
        } else {
            $nom = $request->nom;
            $prenoms = $request->prenoms;
            $telephone = $request->telephone;
            $email = $request->email;
            $password = "@Desire1";
            // $password = $request->password;

            $user = new User();
            $user->telephone = $telephone;
            $user->role = 'agent';
            $user->email = $email;
            $user->nom = $nom;
            $user->prenoms = $prenoms;
            $user->password = Hash::make($password);

            if ($user->save()) {
                return response()->json(['success' => ["Compte crée avec succès, vous recevrez un email de confirmation après validation de l'admin"]]);
            } else {
                return response()->json(['error' => ['Une erreur c\'est produite veuillez reéssayer plus tard']]);
            }
        }
    }

    public function validerOtp(Request $request)
    {

        $custom_messages = [
            'otp.required' => "Veuillez saisir le code reçu par email",
            'otp.min' => "Code invalide",
            'otp.max' => "Code invalide",
        ];
        $rules = [
            'otp' => 'required|max:5|min:5'
        ];
        $validator = Validator::make($request->all(), $rules, $custom_messages);
        if ($validator->fails()) {
            return Redirect::back()->withErrors([$validator->errors()->first()]);
        } else {

            $email = session()->get('email');
            $otp   = $request->otp;

            if (!empty($email)) {

                $user = User::where('email', $email)->where('otp', $otp)->first();

                if (!empty($user)) {

                    $otpTime = new Carbon($user->updated_at);
                    $now = Carbon::now();
                    $optMinu = $otpTime->addMinute(10);

                    if ($now <= $optMinu) {
                        $validUser = User::where('email', $email)->update([
                            'otp' => NULL
                        ]);

                        session()->forget(['email']);
                        Auth::guard()->login($user);
                        return redirect('dashboard');
                    } else {
                        return Redirect::back()->withErrors(["Délai d'attente dépassé veuillez demander un autre code"]);
                    }
                } else {
                    return Redirect::back()->withErrors(['Code otp invalide']);
                }
            } else {
                return redirect('/')->withErrors(['Impossible de faire cette action, veuillez reéssayer plus tard']);
            }
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }

    public function changerPass(Request $request)
    {

        $custom_messages = [
            'email.required' => "Veuillez renseigner le numéro de téléphone",
            'email.max' => "Le téléphone est au maximum 100 caractères",
            'email.min' => "Le téléphone est au minimum 8 caractères",
            'email.email' => "Veuillez renseigner un de bon format"
        ];

        $rules = [
            'email' => 'required|min:8|max:100|email'
        ];
        $validator = Validator::make($request->all(), $rules, $custom_messages);
        if ($validator->fails()) {
            return redirect('pass-oublie')->withErrors($validator->errors()->first());
        } else {
            $email = $request->email;
            $user = User::where('email', $email)->first();

            if (!empty($user)) {
                $passwor = strtoupper(Str::random(8));
                $password = Hash::make($passwor);

                $users = User::where('email', $email)->update([
                    'password' => $password,
                    'statut' => 2
                ]);
                $nom = $user->nom;
                if ($users) {
                    Mail::send([], [], function ($message) use ($nom, $passwor, $email) {
                        $message->to($email)
                            ->subject("Code temporaire OTP")
                            ->setBody('<h2>Bonjour ' . $nom . ',</h2>
                          <p> Votre mot de passe a été reinitialisé, veuillez vous connecter pour le modifier <br>  email : <strong> ' . $email . '</strong> <br> Mot de passe : <strong> ' . $passwor . '</strong> <br> Veuillez vous rendre sur (cliquez) <a href="https://admission.croua2.ci/login"><strong> admission croua2 </strong></a> pour vous connecter.</p>', 'text/html');
                    });
                    return redirect('login')->with('inscri_success', 'Demande de modification effectuée avec succès, veuillez consulter votre boîte mail');
                } else {
                    return redirect('pass-oublie')->withErrors("Erreur du serveur veuillez essayer plus tard");
                }
            } else {
                return redirect('pass-oublie')->withErrors("Compte introuvable ou veuillez contacter l'administrateur");
            }
        }
    }

    public function modifierMotPasse(Request $request)
    {

        $custom_messages = [
            'password.regex' => "Le mot de passe doit contenir au moins une minuscule, une majuscule, un chiffre, un caractère spécial et doit être entre 8 carcatères et 16 caractères",
            'password.same' => "Les deux mot de passe sont différents",
            'password.max' => "Le mot de passe est au maximum 16 caractères",
            'password.min' => "Le mot de passe est au minimum 8 caractères",
            'confirmation_password.min' => "La confirmation du mot est de 8 caractères au moins"
        ];

        $rules = [
            'password' => 'regex:/[@$!%*#?&]/|regex:/[0-9]/|regex:/[A-Z]/|regex:/[a-z]/|max:16|min:8|required_with:confirmation_password|same:confirmation_password',
            'confirmation_password' => 'max:16|min:8'
        ];

        $validator = Validator::make($request->all(), $rules, $custom_messages);
        if ($validator->fails()) {
            return Redirect::back()->withErrors([$validator->errors()->first()]);
        }else{

            $email = session()->get('email');

            if (!empty($email)) {

                $user = User::where('email', $email)->first();

                if (!empty($user)) {

                        $validUser = User::where('email', $email)->update([
                            'statut' => 1,
                            'password' => $password = Hash::make($request->password)
                        ]);

                        session()->forget(['email','code']);
                        Auth::guard()->login($user);
                        return redirect('dashboard');
                    } else {
                        return Redirect::back()->withErrors(["Délai d'attente dépassé veuillez demander un autre code"]);
                    }
                
            } else {
                return redirect('/')->withErrors(['Impossible de faire cette action, veuillez reéssayer plus tard']);
            }

            
        }
    }




}
