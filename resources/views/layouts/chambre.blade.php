@extends('index')
@push('scripts')
<script>
  $('#add_chambre_form').submit(function(event) {
    event.preventDefault();
    // alert('bam');
    let libelle = $("#libelle").val();
    let palier_id = $("#palier_id").val();
    let code_nbre_lit_id = $("#code_nbre_lit_id").val();
    let _token = $("input[name=_token]").val();
    //alert(telephone);
    if (libelle == '' || libelle === undefined) {
      $('#response').append("<div  class='alert alert-danger text-center'>Veuillez saisir le libellé<button type='button' class='close text-danger' data-dismiss='alert' aria-hidden='true'>×</button></div></div>")
    } else if (palier_id == '' || palier_id === undefined) {
      $('#response').append("<div  class='alert alert-danger text-center'>Veuillez sélectionner la chambre<button type='button' class='close text-danger' data-dismiss='alert' aria-hidden='true'>×</button></div></div>")
    } else if (code_nbre_lit_id == '' || code_nbre_lit_id === undefined) {
      $('#response').append("<div  class='alert alert-danger text-center'>Veuillez sélectionner le de lit<button type='button' class='close text-danger' data-dismiss='alert' aria-hidden='true'>×</button></div></div>")
    } else {

      $.ajax({
        type: "POST",
        url: "{{ route('add-chambre') }}",
        data: {
          palier_id: palier_id,
          libelle: libelle,
          code_nbre_lit_id: code_nbre_lit_id,
          _token: _token
        },
        success: function(response) {
          console.log(response);
          if (response.error) {
            // for (var count = 0; count < response.error.length; count++) {
            $('#response').append("<div class='alert alert-danger text-center'>" + response.error + "<button type='button' class='close text-danger' data-dismiss='alert' aria-hidden='true'>×</button></div></div>")
            // }

          } else if (response.success) {
            //for (var count = 0; count < response.success.length; count++) {
            $('#response').append("<div class='alert alert-success text-center'>" + response.success + "<button type='button' class='close text-success' data-dismiss='alert' aria-hidden='true'>×</button></div></div>")
            //}
            // $(".message").html('');
            // $("#inscription_form")[0].reset();
            location.reload();
          }
        }
      });
    }
  });

  function updateChambre(id) {
    event.preventDefault();

    let libelle = $("#libelle" + id + "").val();
    let palier_id = $("#palier_id" + id + "").val();
    let code_nbre_lit_id = $("#code_nbre_lit_id" + id + "").val();
    let chambre_id = id;
    let _token = $("input[name=_token]").val();

    // alert(libelle + ' / ' + chambre_id + ' / ' + lit_id);
    if (libelle == '' || libelle === undefined) {
      $('.response').append("<div  class='alert alert-danger text-center'>Veuillez saisir le libellé<button type='button' class='close text-danger' data-dismiss='alert' aria-hidden='true'>×</button></div></div>")
    } else if (palier_id == '' || palier_id === undefined) {
      $('.response').append("<div  class='alert alert-danger text-center'>Veuillez sélectionner le palier<button type='button' class='close text-danger' data-dismiss='alert' aria-hidden='true'>×</button></div></div>")
    } else if (code_nbre_lit_id == '' || code_nbre_lit_id === undefined) {
      $('.response').append("<div  class='alert alert-danger text-center'>Veuillez sélectionner le nombre de lit<button type='button' class='close text-danger' data-dismiss='alert' aria-hidden='true'>×</button></div></div>")
    } else {

      $.ajax({
        type: "POST",
        url: "{{ route('update-chambre') }}",
        data: {
          id: chambre_id,
          libelle: libelle,
          code_nbre_lit_id: code_nbre_lit_id,
          palier_id: palier_id,
          _token: _token
        },
        success: function(response) {
          console.log(response);
          if (response.error) {
            // for (var count = 0; count < response.error.length; count++) {
            $('.response').append("<div class='alert alert-danger text-center'>" + response.error + "<button type='button' class='close text-danger' data-dismiss='alert' aria-hidden='true'>×</button></div></div>")
            // }

          } else if (response.success) {
            //for (var count = 0; count < response.success.length; count++) {
            $('.response').append("<div class='alert alert-success text-center'>" + response.success + "<button type='button' class='close text-success' data-dismiss='alert' aria-hidden='true'>×</button></div></div>")

            location.reload();
          }
        }
      });
    }

  }
</script>
@endpush
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
              <h4 class="card-title">Les chambres </h4>
              <div class="text-right">
                <button type="button" style="background-color: #3C2A45;color:white" data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-warning btn-icon-text">
                  <i class="btn-icon-prepend"></i>
                  Ajouter une chambre
                </button>
              </div>
              <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                  <div class="modal-header" style="background-color: white">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter une chambre</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-content p-4">
                    <form id="add_chambre_form" method="POST">
                      @csrf
                      <div id="response"></div>
                      <div class="row">
                        <div class="form-group col-md-12">
                          <label>Palier</label>
                          <select class="form-control select2" style="width: 100%" name="palier_id" id="palier_id" required>
                            @foreach($paliers as $palier)
                            <option value="{{ $palier->id }}">
                              {{ $palier->libelle }} -
                              {{ $palier->batiment->libelle }} -
                              {{ $palier->batiment->cite->libelle }}
                            </option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group col-md-12">
                          <label>Nombre de lit</label>
                          <select class="form-control select2" style="width: 100%" name="code_nbre_lit_id" id="code_nbre_lit_id" required>
                            @foreach($codeNbrLits as $codeNbrLit)
                            <option value="{{ $codeNbrLit->id }}">
                              {{ $codeNbrLit->code }}
                              ({{ $codeNbrLit->nbre }} Lits)
                            </option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group col-md-12">
                          <label>Libelle chambre</label>
                          <input required type="text" class="form-control" name="libelle" id="libelle">
                        </div>
                      </div>
                      <div class="modal-footer" style="background-color: white">

                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>

                    </form>

                  </div>
                </div>
              </div>
              @if(session()->get('_success'))
              <div class="alert alert-success mg-b-0" role="alert">
                <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                  <span aria-hidden="true">&times;</span>
                </button>
                <strong>{{ session()->get('_success') }}</strong>
              </div>
              @endif

              @if ($errors->any())
              <div class="alert alert-danger background-danger">
                <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                  <span aria-hidden="true">&times;</span>
                </button>
                @foreach ($errors->all() as $error)
                <strong>{{ $error }}</strong>
                @endforeach
              </div>
              @endif
              <div class="table-responsive pt-3">
                <table id="dataTable" class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Chambre</th>
                      <th>Nombre de lit</th>
                      <th>Nombre de disponible</th>
                      <th>Nombre de lit occupé</th>
                      <th>Palier</th>
                      <th>Bâtiment</th>
                      <th>Cité</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($chambres as $chambre)
                    <tr>
                      <td>{{ $chambre->libelle }}</td>
                      <td>{{ $chambre->codeNbreLit->code }}(<span class="text-danger">{{ $chambre->nombre_lit }} Lits</span> )</td>
                      <td>{{ $chambre->nbre_restant_lit }} </td>
                      <td>{{ (-$chambre->nbre_restant_lit+$chambre->nombre_lit)}} </td>
                      <td>{{ $chambre->palier->libelle }}</td>
                      <td>{{ $chambre->palier->batiment->libelle }}</td>
                      <td>{{ $chambre->palier->batiment->cite->libelle }}</td>
                      <td>
                        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal{{ $chambre->id }}">
                          Modifier
                        </button>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#litModal{{ $chambre->id }}">
                          Voir les lits
                        </button>
                      </td>
                      <!-- Modal -->
                      <div id="myModal{{ $chambre->id }}" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">Modifier le chambre
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title"></h4>
                            </div>
                            <div class="modal-body">
                              <form>
                                @csrf
                                <div class="response"></div>
                                <div class="row">
                                  <div class="form-group col-md-12">
                                    <label>Palier</label>
                                    <select class="form-control" name="palier_id{{ $chambre->id }}" id="palier_id{{ $chambre->id }}" required>
                                      @foreach($paliers as $palier)
                                      <option value="{{ $palier->id }}" @if($chambre->palier_id == $palier->id ) {{ 'selected=selected' }} @endif>
                                        {{ $palier->libelle }} -
                                        {{ $palier->batiment->libelle }} -
                                        {{ $palier->batiment->cite->libelle }}
                                      </option>
                                      @endforeach
                                    </select>
                                  </div>
                                  <div class="form-group col-md-12">
                                    <label>Nombre de lit</label>
                                    <select class="form-control" name="code_nbre_lit_id{{ $chambre->id }}" id="code_nbre_lit_id{{ $chambre->id }}" required>
                                      @foreach($codeNbrLits as $codeNbrLit)
                                      <option value="{{ $codeNbrLit->id }}" @if($codeNbrLit->id == $chambre->code_nbre_lit_id ) {{ 'selected=selected' }} @endif>
                                        {{ $codeNbrLit->code }}
                                        ({{ $codeNbrLit->nbre }} Lits)
                                      </option>
                                      @endforeach
                                    </select>
                                  </div>
                                  <div class="form-group col-md-12">
                                    <label>Libelle chambre</label>
                                    <input required type="text" value="{{ $chambre->libelle }}" class="form-control" name="libelle{{ $chambre->id }}" id="libelle{{ $chambre->id }}">
                                  </div>
                                </div>
                                <div class="modal-footer" style="background-color: white">

                                  <button onclick="updateChambre('{{ $chambre->id }}')" class="btn btn-primary">Enregistrer</button>
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>

                              </form>

                            </div>

                          </div>

                        </div>
                      </div>
                      <div id="litModal{{ $chambre->id }}" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">Chambre : {{ $chambre->libelle }}
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title"></h4>
                            </div>
                            <div class="modal-body">
                              @if($chambre->lits)
                              <div class="template-demo">
                                @foreach($chambre->lits as $litCh)
                                  <h6>{{ $litCh->libelle }}</h6>
                                @endforeach
                              </div>
                              @endif

                            </div>

                          </div>

                        </div>
                      </div>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
      <!-- partial:partials/_footer.html -->
      <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
          <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021. Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>
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