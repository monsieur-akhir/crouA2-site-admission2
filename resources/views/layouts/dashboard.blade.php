@extends('index')
@section('content')
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('partials._navbar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="ti-settings"></i></div>
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close ti-close"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark</div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles default"></div>
          </div>
        </div>
      </div>
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      @include('partials._sidebar')
      <!-- partial -->
      <div class="main-panel">
      <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Bienvenue</h3>
                  <h6 class="font-weight-normal mb-0">sur l'administration du portail de demande des chambres</h6>
                </div>
                
              </div>
            </div>
          </div>
          <div class="row">
            
            @if (session('message'))
            <div class="alert alert-success background-success">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <i class="icofont icofont-close-line-circled text-white"></i>
              </button>
              <strong>{{ session('message') }}</strong>
            </div>
            @endif
            <div class="col-md-12 grid-margin transparent">
              <button class="btn btn-primary mb-2" data-toggle="modal" data-target="#traiter-demande">Traiter un dossier</button>
              <div class="modal fade " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="traiter-demande">
                <div class="modal-dialog modal-md">
                    <div class="modal-header" style="background-color: white">
                        <h5 class="modal-title" id="exampleModalLabel">Modifier ma demande</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                  <div class="modal-content p-4">
                      <form action="/trouver-demande-traiter" method="POST">
                        @csrf
                          <div class="row">
                              <div class="form-group col-md-12">
                                  <label>IDENTIFANT CROU</label>
                                  <input required style="text-transform:uppercase" type="text" class="form-control" name="matricule_crou"  placeholder="IDENTIFANT CROU">
                          </div>
                        </div>
                        <button type="submit" class="btn btn-success">Rechercher</button>
                      </form>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3 mb-4 stretch-card transparent">
                  <div class="card card-tale">
                    <div class="card-body">
                      <p class="mb-4">Toutes les demandes</p>
                      <p class="fs-30 mb-2">{{$all}}</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 mb-4 stretch-card transparent">
                  <div class="card card-tale">
                    <div class="card-body">
                      <p class="mb-4">Demandes non-traitées</p>
                      <p class="fs-30 mb-2">{{$initie}}</p>
                      @if($all != 0)
                      <p>{{($initie / $all)*100}} %</p>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="col-md-3 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body">
                      <p class="mb-4">Dossiers déposés</p>
                      <p class="fs-30 mb-2">{{$valide}}</p>
                      @if($all != 0)
                      <p>{{($valide / $all)*100}} %</p>
                      @endif
                    </div>
                  </div>
                </div>
               {{--  <div class="col-md-3 mb-4 stretch-card transparent">
                  <div class="card card-light-blue">
                    <div class="card-body">
                      <p class="mb-4">Demandes refusées</p>
                      <p class="fs-30 mb-2">{{$annule}}</p>
                      <p>{{($annule / $all)*100}} %</p>
                    </div>
                  </div>
                </div> --}}
                <div class="col-md-3 mb-4 stretch-card transparent">
                  <div class="card card-light-danger">
                    <div class="card-body">
                      <p class="mb-4">Attribution de chambre</p>
                      <p class="fs-30 mb-2">{{$termine}}</p>
                      @if($all != 0)
                      <p>{{($termine / $all)*100}} %</p>
                      @endif
                    </div>
                  </div>
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