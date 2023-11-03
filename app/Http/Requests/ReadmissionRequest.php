<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReadmissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'num_carte.required'=> 'Le numéro de la carte est obligatoire',
            'nom_etudiant.required'=> 'Le nom est obligatoire',
            'prenoms_etudiant.required'=> 'Le prénom est obligatoire',
            'date_naissance_etudiant.required'=> 'La date de naissance est obligatoire',
            'lieu_naissance_etudiant.required'=> 'Le lieu de naissance est obligatoire',
            'contact_etudiant.required'=> 'Votre contact est obligatoire',
            'email_etudiant.required'=> 'Votre email est obligatoire',
            'handicap_etudiant.required'=> 'Votre etat de santé est obligatoire',
            'nom_tuteur.required'=> 'Le nom de votre tuteur/parent est obligatoire',
            'contact_tuteur.required'=> 'Le contact de votre tuteur/parent est obligatoire',
            'ufr_etudiant.required'=> 'Votre ecole est obligatoire',
            'departement_etudiant.required_unless'=> 'Votre departement est obligatoire',
            'ecole_etudiant.required_if'=> 'Votre ecole est obligatoire',
            'niveau_actuel_etudiant.required'=> 'Votre niveau est obligatoire',
            'niveau_precedent_etudiant.required'=> 'Votre niveau précedent est obligatoire',
            'decision_final_etudiant.required'=> 'Votre decision final academique est obligatoire',
            'nationnalite.required'=> 'Votre nationnalité est obligatoire',
            // 'serie_bac.required_if'=> 'La série du bac est obligatoire',
            'filiere.required'=> 'Votre filière est obligatoire',
            'precision_handicap.required_if'=> 'Votre handicape est obligatoire',
            'num_carte.unique'=> 'Votre handicape est obligatoire',
            'num_carte.unique'=> 'Votre numéro de carte existe déja',
            'contact_etudiant.unique'=> 'Votre numéro de téléphone existe déja',
            'email_etudiant.unique'=> 'Votre email existe déja',
        ];
    }
    public function rules()
    {
        return [
            'num_carte'=> 'required|unique:re_demande',
            'nom_etudiant'=> 'required',
            'prenoms_etudiant'=> 'required',
            'date_naissance_etudiant'=> 'required',
            'lieu_naissance_etudiant'=> 'required',
            'contact_etudiant'=> 'required|unique:re_demande',
            'email_etudiant'=> 'required|unique:re_demande',
            'handicap_etudiant'=> 'required',
            'nom_tuteur'=> 'required',
            'contact_tuteur'=> 'required',
            'ufr_etudiant'=> 'required',
            // 'is_bachelier'=> 'required',
            'filiere'=>'required', 
            'ecole_etudiant'=> 'required_if:ufr_etudiant,==,9',
            'departement_etudiant'=> 'required_unless:ufr_etudiant,9', 
            'niveau_actuel_etudiant'=> 'required',
            'niveau_precedent_etudiant'=> 'required',
            'decision_final_etudiant'=> 'required',
            'nationnalite'=> 'required',
            // 'point_bac'=> 'required_if:is_bachelier,==,Oui',
            // 'serie_bac'=> 'required_if:is_bachelier,==,Oui',
            'mention_bac'=> 'required_if:is_bachelier,==,Oui',
            'precision_handicap'=> 'required_if:handicap_etudiant,==,Oui',
        ];
    }
 
}
