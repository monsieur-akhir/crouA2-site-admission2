@extends('index')
@section('content')
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('partials._navbar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      
     
      @include('partials._sidebar')
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <a style="padding: 15px; margin-top:10px" href="traiter">Aller à la liste</a>
              <div class="card-body">
                <form action="/traiter-readmission" method="POST">
                    @csrf
                    <input type="text" hidden name="demande" value="{{$demande->id}}">
                    <input type="text" hidden name="matricule_crou" value="{{$demande->matricule_crou}}">
                    {{-- <input type="text" hidden name="lit" value="{{$demande->chambre_attribue?$demande->chambre_attribue->lit->id:null}}"> --}}
                    @if ($demande->statut == 0)
                            <button type="submit" name="statut" value="-1" class="btn btn-danger">Refuser la demande</button>
                            <button type="submit" name="statut" value="2" class="btn btn-success">Dossiers deposés</button>
                    @elseif($demande->statut == -1)
                      <button type="submit" name="statut" value="2" class="btn btn-success">Dossiers deposés</button>
                    {{-- @elseif($demande->statut == 1)
                        <button type="submit" name="statut" value="-1" class="btn btn-danger">Refuser la demande</button> --}}
                    @elseif($demande->statut == 2)
                        <button type="submit" name="statut" value="-1" class="btn btn-danger">Refuser la demande</button>
                        <button type="submit" name="statut" value="3"  {{-- type="button" data-toggle="modal" data-target=".bd-example-modal-lg" --}} name="statut"  class="btn btn-success">Attribuer une chambre</button>
                        {{-- <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-md">
                            <div class="modal-header" style="background-color: white">
                              <h5 class="modal-title" id="exampleModalLabel">ATTRIBTION DE CHAMBRE</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-content p-4">
                                <div class="row">
                                  <div class="form-group col-md-12">
                                    <label>Attribtion de chambre</label>
                                    <select class="form-control select2" style="width: 100%" name="lit" id="lit" required>
                                        @foreach($lits as $lit)
                                        <option value="{{ $lit->id }}">{{ $lit->chambre->palier->batiment->cite->libelle.' / '.$lit->chambre->palier->batiment->libelle.' / '.$lit->chambre->palier->libelle.' / '.$lit->chambre->libelle.' / '.$lit->libelle }}  </option>
                                        @endforeach
                                      </select>
                                    </select>
                                  </div>
                                </div>
                                <div class="modal-footer" style="background-color: white">
                                  <button type="submit" name="statut" value="3" class="btn btn-primary">Enregistrer</button>
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                          </div>
                        </div> --}}
                    @else
                        @if ($demande->chambre_attribue)
                          <button type="submit" name="statut" value="-1" class="btn btn-danger">Retirer la chambre</button>
                          <br>
                          <br>
                            {{-- <div class="row">
                              <p style="line-height: 14px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Cité : <span style="font-weight:bold">{{$demande->chambre_attribue->lit->chambre->palier->batiment->cite->libelle}}</span></p>
                              <p style="line-height: 14px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Batiment : <span style="font-weight:bold">{{$demande->chambre_attribue->lit->chambre->palier->batiment->libelle}}</span></p>
                              <p style="line-height: 14px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Palier : <span style="font-weight:bold">{{$demande->chambre_attribue->lit->chambre->palier->libelle}}</span></p>
                              <p style="line-height: 14px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Chambre : <span style="font-weight:bold">{{$demande->chambre_attribue->lit->chambre->libelle}}</span></p>
                              <p style="line-height: 14px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Lit : <span style="font-weight:bold">{{$demande->chambre_attribue->lit->libelle}}</span></p>
                            </div> --}}
                            <br>
                            <hr style="border:2px solid black">
                        @endif
                    @endif
                    <div style="float:right">
                      <a href="trouver-fiche-readmission?matricule_crou={{$demande->matricule_crou}}&date_naissance_etudiant={{$demande->date_naissance_etudiant}}" name="statut" value="1" class="btn btn-primary">Modifier</a>
                      <!-- <a href="delete-fiche?matricule_crou={{$demande->matricule_crou}}&date_naissance_etudiant={{$demande->date_naissance_etudiant}}" name="statut" value="1" class="btn btn-warning">Supprimer</a> -->
                    </div>
                </form>
                    {{-- chambre_attribue --}}
                    <div class="row">
                      @if ($demande->cite_id)
                      <div class="col-md-12 mt-4">
                        <h3><b>SITUATION ANTERIEURE DU RESIDENT</b> </h3>
                        <p style="line-height: 16px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Cité : <span style="font-weight:bold">{{strtoupper(DB::table('cites')->where('id',$demande->cite_id)->first()->libelle)}}</span></p>
                        <p style="line-height: 16px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Batiment : <span style="font-weight:bold">{{strtoupper(DB::table('batiments')->where('id',$demande->batiment_id)->first()->libelle)}}</span></p>
                        <p style="line-height: 16px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Palier : <span style="font-weight:bold">{{strtoupper(DB::table('paliers')->where('id',$demande->palier_id)->first()->libelle)}}</span></p>
                        <p style="line-height: 16px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Chambre : <span style="font-weight:bold">{{strtoupper(DB::table('chambres')->where('id',$demande->chambre_id)->first()->libelle)}}</span></p>
                        <p style="line-height: 16px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Lit : <span style="font-weight:bold">{{strtoupper(DB::table('lits')->where('id',$demande->lit_id)->first()->libelle)}}</span></p>
                      </div>
                      <hr>
                      @endif
                    <p style="line-height: 35px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Matricule Crou : <span style="font-weight:bold">{{$demande->matricule_crou}}</span></p>
                    <p style="line-height: 35px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Numéro de carte : <span style="font-weight:bold">{{$demande->num_carte}}</span></p>
                    <p style="line-height: 35px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Nom & Prenoms : <span style="font-weight:bold">{{$demande->nom_etudiant.' '.$demande->prenoms_etudiant}}</span></p>
                    <p style="line-height: 35px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Date de naissance : <span style="font-weight:bold">{{$demande->date_naissance_etudiant}}</span></p>
                    <p style="line-height: 35px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Lieu de naissance : <span style="font-weight:bold">{{$demande->lieu_naissance_etudiant}}</span></p>
                    <p style="line-height: 35px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Genre :<span style="font-weight:bold">{{$demande->genre}}</span></p>
                    <p style="line-height: 35px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Contact : <span style="font-weight:bold">{{$demande->contact_etudiant}}</span></p>
                    <p style="line-height: 35px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Email : <span style="font-weight:bold">{{$demande->email_etudiant}}</span></p>
                    <p style="line-height: 35px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Handicap : <span style="font-weight:bold">{{$demande->handicap_etudiant}}</span></p>
                    <p style="line-height: 35px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Nom du tuteur/parent : <span style="font-weight:bold">{{$demande->nom_tuteur}}</span></p>
                    <p style="line-height: 35px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Contact du tuteur/parent : <span style="font-weight:bold">{{$demande->contact_tuteur}}</span></p>
                    <p style="line-height: 35px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Université ou école : <span style="font-weight:bold">{{strtoupper(DB::table('universites')->where('id',$demande->ufr_etudiant)->first()->libelle)}}</span></p>
                    
                    @if ($demande->ecole_etudiant != null)
                        <p style="line-height: 35px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Ecole : <span style="font-weight:bold">{{$demande->ecole_etudiant}}</span></p>
                    @else
                      @php
                        $departement = DB::table('departements')->where('id',$demande->departement_etudiant)->first();
                      @endphp
                      @if ($departement)
                        <p style="line-height: 35px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Departement : <span style="font-weight:bold">{{ $departement->libelle}}</span></p>
                      @else
                        <p style="line-height: 35px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Departement : <span style="font-weight:bold">{{ $demande->departement_etudiant}}</span></p>
                      @endif
                    @endif
                    <p style="line-height: 35px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Niveau actuel : <span style="font-weight:bold">{{$demande->niveau_actuel_etudiant}}</span></p>
                    <p style="line-height: 35px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Niveau précedent : <span style="font-weight:bold">{{$demande->niveau_precedent_etudiant}}</span></p>
                    <p style="line-height: 35px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Decision final : <span style="font-weight:bold">{{$demande->decision_final_etudiant}}</span></p>
                    <p style="line-height: 35px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Nationnalité : <span style="font-weight:bold">{{$demande->nationnalite}}</span></p>
                    @php
                        $filiere = DB::table('filieres')->where('id',$demande->filiere)->first();
                    @endphp
                    @if ($filiere)
                      <p style="line-height: 35px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Filière : <span style="font-weight:bold">{{ $filiere->libelle}}</span></p>
                    @else
                      <p style="line-height: 35px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Filière : <span style="font-weight:bold">{{ $demande->filiere}}</span></p>
                    @endif
                    @if ($demande->is_bachelier == 'Oui')
                        <p style="line-height: 35px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Nombre de point au bac : <span style="font-weight:bold">{{$demande->point_bac}}</span></p>
                        <p style="line-height: 35px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Série du bac : <span style="font-weight:bold">{{$demande->serie_bac}}</span></p>
                        <p style="line-height: 35px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Mention au bac : <span style="font-weight:bold">{{$demande->mention_bac}}</span></p>
                    @endif
                  </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
     
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
  </div>
@endsection