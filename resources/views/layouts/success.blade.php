@extends('index')
@section('content')
<div>        
    <div class="content-wrapper">
      <div class="row justify-content-md-center justify-content-md-center">
        <div class="col-md-6">
            <img src="assets/images/check.png" width="200px" class="mt-5 p-4" alt="">
            <span class="mt-5">
                <h2>Félicitations vous avez terminé votre demande</h2>
                <h4>
                  Votre numéro identifiant CROU A2 : <b>{{$demande->matricule_crou}}</b>  <br><br>
                  Votre date de naissance : <b>{{$demande->date_naissance_etudiant}}</b> <br><br>
                 
                  Merci de bien noter ces informations pour d'éventuelles modifications et la consultation des résultats. <br><br>
                  Un email vous a été envoyé , consultez votre boite email</h4><br>
                  Nous vous prions de vous rendre à la Direction du CROU Abidjan 2,sis à l’Université Nangui-Abrogoua -Villa N° 6, face à la Scolarité pour finaliser votre
                  inscription avec les pièces à joindre. <br>
            </span>
           
            <div class="row">
              <form action="ma-fiche" method="post">
                @csrf
                <input type="text" hidden name="matricule_crou" value="{{$demande->matricule_crou}}">
                <button  type="submit" class="btn btn-success btn-icon-text m-2">
                {{-- <i class="btn-icon-prepend"></i>                                                     --}}
                Télécharger ma fiche de demande
              </button>
              <a target="_blank" href="{{asset('documents/FICHE_DENGAGEMENT.pdf')}}" class="btn btn-warning btn-icon-text m-2">
                {{-- <i class="btn-icon-prepend"></i>                                                     --}}
                Télécharger ma fiche d'engagement
              </a>
            </form>
            @if ($demande->cite_id == null)
              <form action="/trouver-fiche" method="get">
                {{-- @csrf --}}
                <input required type="text" value="{{$demande->matricule_crou}}"  name="matricule_crou" hidden>
                <input required type="date" value="{{$demande->date_naissance_etudiant}}" name="date_naissance_etudiant" hidden>
                <button type="submit" class="btn btn-primary btn-icon-text m-2">
                  Modifier ma demande
                </button>
              </form>
            @endif
            </div>
      </div>
    </div>
  </div>
@endsection