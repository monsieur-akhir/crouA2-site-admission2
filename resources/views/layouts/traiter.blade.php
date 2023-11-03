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
              <div class="card-body">
                @if (isset($message) )
                <div class="alert alert-success background-success">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="icofont icofont-close-line-circled text-white"></i>
                  </button>
                  <strong>{{ $message }}</strong>
                </div>
                @endif
                <h4 class="card-title">Les demandes </h4>
                <div class="table-responsive pt-3">
                  <table id="dataTable" class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Identifiant</th>
                        <th>Numero carte étudiant</th>
                        <th>Sexe</th>
                        <th>Nom</th>
                        <th>Prénoms</th>
                        <th>Contact</th>
                        <th>Date de naissance</th>
                        <th>Nationnalité</th>
                        <th>UFR ou Ecole</th>
                        <th>Departement</th>
                        <th>Filière</th>
                        <th>Niveau actuel</th>
                        <th>Statut</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($demandes as $demande)
                                <tr>
                                  <td>{{$demande->matricule_crou}}</td>
                                  <td>{{$demande->num_carte}}</td>
                                  <td>{{$demande->genre}}</td>
                                  <td>{{$demande->nom_etudiant}}</td>
                                  <td>{{$demande->prenoms_etudiant}}</td>
                                  <td>{{$demande->contact_etudiant}}</td>
                                  <td>{{$demande->date_naissance_etudiant}}</td>
                                  <td>{{$demande->nationnalite}}</td>
                                  <td>{{strtoupper(DB::table('universites')->where('id',$demande->ufr_etudiant)->first()->libelle)}}</td>
                                  @php
                                      $departement = DB::table('departements')->where('id',$demande->departement_etudiant)->first();
                                  @endphp
                                    @if ($departement)
                                    <td>
                                      {{ strtoupper($departement->libelle)}}
                                    </td>
                                  @else
                                    <td>
                                      {{ strtoupper($demande->ecole_etudiant)}}
                                    </td>
                                  @endif
                                  @php
                                      $filiere = DB::table('filieres')->where('id',$demande->filiere)->first();
                                  @endphp
                                  @if ($filiere)
                                    <td>
                                      {{ strtoupper($filiere->libelle)}}
                                    </td>
                                  @else
                                    <td>
                                      {{ strtoupper($demande->filiere)}}
                                    </td>
                                  @endif
                                  
                                  
                                  <td>{{$demande->niveau_actuel_etudiant}}</td>
                                  <td>
                                        @if ($demande->statut == 0)
                                          <label class="badge badge-warning p-2">
                                              A traiter
                                          </label>
                                        @elseif($demande->statut == -1)
                                          <label class="badge badge-danger p-2">
                                            Refusé
                                          </label>
                                        @elseif($demande->statut == 1)
                                          <label class="badge badge-success p-2">
                                            Accepté
                                          </label>
                                        @elseif($demande->statut == 2)
                                          <label class="badge badge-success p-2">
                                            Dossiers déposés
                                          </label>
                                        @else
                                          <label class="badge badge-success p-2">
                                            Chambre attribuée
                                          </label>
                                        @endif 
                                  </td>
                                  <td>
                                        <a href="{{url('details-demandes?mat='.$demande->matricule_crou)}}"  class="btn btn-success p-2">
                                         TRAITER 
                                        </a>
                                  </td>
                                </tr>
                            @endforeach
                    </tbody>
                  </table>
                  {{-- {{ $demandes->links() }} --}}
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