@extends('index')
@push('scripts')
<script>
  $('#add_bat_form').submit(function(event) {
    event.preventDefault();
    //alert('bam');
    let libelle = $("#libelle").val();
    let cite_id = $("#cite_id").val();
    let _token = $("input[name=_token]").val();
    //alert(telephone);
    if (libelle == '' || libelle === undefined) {
      $('#response').append("<div  class='alert alert-danger text-center'>Veuillez saisir le libellé<button type='button' class='close text-danger' data-dismiss='alert' aria-hidden='true'>×</button></div></div>")
    } else if (cite_id == '' || cite_id === undefined) {
      $('#response').append("<div  class='alert alert-danger text-center'>Veuillez sélectionner la cité<button type='button' class='close text-danger' data-dismiss='alert' aria-hidden='true'>×</button></div></div>")
    } else {

      $.ajax({
        type: "POST",
        url: "{{ route('add-batiment') }}",
        data: {
          cite_id: cite_id,
          libelle: libelle,
          _token: _token
        },
        success: function(response) {
            console.log(response);
            if (response.error) {

              $('#response').append("<div class='alert alert-danger text-center'>" + response.error + "<button type='button' class='close text-danger' data-dismiss='alert' aria-hidden='true'>×</button></div></div>")
              // }

            } else if (response.success) {
              $('#response').append("<div class='alert alert-success text-center'>" + response.success + "<button type='button' class='close text-success' data-dismiss='alert' aria-hidden='true'>×</button></div></div>")
              
              location.reload();
            }
          }
      });
    }
  });

  function updateBatiment(id) {
    event.preventDefault();

    let libelle = $("#libelle" + id + "").val();
    let cite_id = $("#cite_id" + id + "").val();
    let batiment_id = id;
    let _token = $("input[name=_token]").val();

    // alert(libelle + ' / ' + chambre_id + ' / ' + lit_id);
    if (libelle == '' || libelle === undefined) {
      $('.response').append("<div  class='alert alert-danger text-center'>Veuillez saisir le libellé<button type='button' class='close text-danger' data-dismiss='alert' aria-hidden='true'>×</button></div></div>")
    } else if (cite_id == '' || cite_id === undefined) {
      $('.response').append("<div  class='alert alert-danger text-center'>Veuillez sélectionner la cité<button type='button' class='close text-danger' data-dismiss='alert' aria-hidden='true'>×</button></div></div>")
    } else {

      $.ajax({
        type: "POST",
        url: "{{ route('update-batiment') }}",
        data: {
          id: batiment_id,
          libelle: libelle,
          cite_id: cite_id,
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
              <h4 class="card-title">Les bâtiments </h4>
              <div class="text-right">
                <button type="button" style="background-color: #3C2A45;color:white" data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-warning btn-icon-text">
                  <i class="btn-icon-prepend"></i>
                  Ajouter un bâtiment
                </button>
              </div>
              <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                  <div class="modal-header" style="background-color: white">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter un batiment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-content p-4">
                    <form id="add_bat_form" method="POST">
                      @csrf
                      <div id="response"></div>
                      <div class="row">
                        <div class="form-group col-md-12">
                          <label>Cité</label>
                          <select class="form-control select2" style="width: 100%" name="cite_id" id="cite_id" required>
                            @foreach($cites as $cite)
                            <option value="{{ $cite->id }}">
                              {{ $cite->libelle }} 
                            </option>
                            @endforeach
                          </select>
                        </div>
                        
                        <div class="form-group col-md-12">
                          <label>Libelle bâtiment</label>
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
                      <th>Bâtiment</th>
                      <th>Cité</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($batiments as $batiment)
                    <tr>
                      <td>{{ $batiment->libelle }}</td>
                      <td>{{ $batiment->cite->libelle }}</td>
                      <td>
                        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal{{ $batiment->id }}">
                          Modifier
                        </button>
                      </td>
                      <!-- Modal -->
                      <div id="myModal{{ $batiment->id }}" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">Modifier le bâtiment
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title"></h4>
                            </div>
                            <div class="modal-body">
                              <form>
                                @csrf
                                <div class="response"></div>
                                <div class="row">
                                  <div class="form-group col-md-12">
                                    <label>Cité</label>
                                    <select class="form-control" name="cite_id{{ $batiment->id }}" id="cite_id{{ $batiment->id }}" required>
                                      @foreach($cites as $cite)
                                      <option value="{{ $cite->id }}" @if($batiment->cite_id == $cite->id ) {{ 'selected=selected' }} @endif>
                                        {{ $cite->libelle }} 
                                      </option>
                                      @endforeach
                                    </select>
                                  </div>
                                  
                                  <div class="form-group col-md-12">
                                    <label>Libelle bâtiment</label>
                                    <input required type="text" value="{{ $batiment->libelle }}" class="form-control" name="libelle{{ $batiment->id }}" id="libelle{{ $batiment->id }}">
                                  </div>
                                </div>
                                <div class="modal-footer" style="background-color: white">

                                  <button onclick="updateBatiment('{{ $batiment->id }}')" class="btn btn-primary">Enregistrer</button>
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>

                              </form>

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