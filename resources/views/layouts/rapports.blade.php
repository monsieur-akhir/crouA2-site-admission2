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
        <div class="card">
          <div class="card-body">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <h4> NOMBRE DE DEMANDES PAR UNIVERSITE</h4>
              <div class="table-responsive pt-3">
              <table  class="table table-bordered">
                <thead>
                  <tr>
                    @foreach (array_keys($demandeParUniversite) as $dPU)
                      <th>{{DB::table('universites')->where('id',$dPU)->first()->libelle}}</th>
                    @endforeach
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    @foreach ($demandeParUniversite as $dPU)
                      <td>{{$dPU}}</td>
                    @endforeach
                  </tr>
                </tbody>
              </table>
              </div>
              <br>
              <h4>NOMBRE DE DEMANDES PAR UFR (UNIVERSITE NANGUI ABROGOUA)</h4>
              <div class="table-responsive pt-3">
              <table  class="table table-bordered">
                <thead>
                  <tr>
                    @foreach (array_keys($demandeNanguiParDepartement) as $dNPD)
                      <th>{{DB::table('departements')->where('id',$dNPD)->first()->libelle}}</th>
                    @endforeach
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    @foreach ($demandeNanguiParDepartement as $dNPD)
                      <td>{{$dNPD}}</td>
                    @endforeach
                  </tr>
                </tbody>
              </table>
              </div>
              <br>
              <h4> NOMBRE DE DEMANDES PAR UNIVERSITE (MASCULIN)</h4>
              <div class="table-responsive pt-3">
              <table  class="table table-bordered">
                <thead>
                  <tr>
                    @foreach (array_keys($demandeParUniversiteMasculin) as $dNPD)
                      <th>{{DB::table('universites')->where('id',$dNPD)->first()->libelle}}</th>
                    @endforeach
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    @foreach ($demandeParUniversiteMasculin as $dNPD)
                      <td>{{$dNPD}}</td>
                    @endforeach
                  </tr>
                </tbody>
              </table>
              </div>
              <br>
              <h4> NOMBRE DE DEMANDES PAR UNIVERSITE (FEMININ)</h4>
              <div class="table-responsive pt-3">
              <table  class="table table-bordered">
                <thead>
                  <tr>
                    @foreach (array_keys($demandeParUniversiteFeminin) as $dNPD)
                      <th>{{DB::table('universites')->where('id',$dNPD)->first()->libelle}}</th>
                    @endforeach
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    @foreach ($demandeParUniversiteFeminin as $dNPD)
                      <td>{{$dNPD}}</td>
                    @endforeach
                  </tr>
                </tbody>
              </table>
              </div>
              <br>
              <h4>NOMBRE DE DEMANDES PAR NIVEAU ACTUEL</h4>
              <div class="table-responsive pt-3">
              <table  class="table table-bordered">
                <thead>
                  <tr>
                    @foreach (array_keys($demandeParNiveau) as $dNPD)
                      <th>{{$dNPD}}</th>
                    @endforeach
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    @foreach ($demandeParNiveau as $dNPD)
                      <td>{{$dNPD}}</td>
                    @endforeach
                  </tr>
                </tbody>
              </table>
              </div>
            </div>
          </div></div>
          </div>
          
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.  Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
          </div>
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Distributed by <a href="https://www.themewagon.com/" target="_blank">Themewagon</a></span> 
          </div>
        </footer> 
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
  </div>
@endsection