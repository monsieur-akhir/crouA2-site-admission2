@extends('index')
@push('scripts')
<script>
$('.isNangui').hide()
$('#div_bachelier').hide()
$('#precision_handicap').hide()
$('#handicap_etudiant').change(function() {
  if(this.value == 'Oui'){
    $('#precision_handicap').show()
  }else{
    $('#precision_handicap').hide()
  }
})
$('input[name=is_bachelier]').change(function() {
  console.log(this.value);
  if(this.value == 'Oui'){
    $('#div_bachelier').show()
  }else{
    $('#div_bachelier').hide()
  }
})
$('#sel_departement_etudiant')
  .add('#niveau_actuel_etudiant')
  .on('change', () => {
    if ($('#ufr_etudiant').val() == 1) {
        $('#select_filiere').select2({
          placeholder: "Selectionner l'element",
          ajax: {
            url: 'api/filieres?dep='+$('#sel_departement_etudiant').val() + '&niv=' + $('#niveau_actuel_etudiant').val(),
            processResults: function (data) {
              return {
                results: data.list,
              };
            },
          },
      });
    }
  });
$('#ufr_etudiant').change(function (e) {
  if ($('#ufr_etudiant').val() != 1) {
    if ($('#ufr_etudiant').val() == 9) {
      $("#dep_lib").empty();
      $('#input_departement_etudiant').attr("name","ecole_etudiant")
      $('#input_departement_etudiant').attr("placeholder","NOM DE VOTRE ECOLE")
      $('#dep_lib').text("NOM DE VOTRE ECOLE");
    }else{
      $("#dep_lib").empty();
      $('#dep_lib').text("DEPARTEMENT");
      $('#input_departement_etudiant').attr("placeholder","DEPARTEMENT")
      $('#input_departement_etudiant').attr('name', 'departement_etudiant');
    }
    $('#sel_departement_etudiant').attr('name', null);
    $('#select_filiere').attr('name', null);
    $('#input_filiere').attr('name', 'filiere');
    $('.isNangui').show()
    $('.noNangui').hide()
  } else {
    $("#dep_lib").empty();
    $('#dep_lib').text("DEPARTEMENT");
    $('#input_departement_etudiant').attr("placeholder","DEPARTEMENT")
    $('#sel_departement_etudiant').attr('name', 'departement_etudiant');
    $('#input_departement_etudiant').attr('name', null);
    $('#input_filiere').attr('name', null);
    $('#select_filiere').attr('name', 'filiere');
    $('.isNangui').hide()
    $('.noNangui').show()
  }
});

  $('#cite').change(function (e) {
      console.log(e);
      $('#batiment').select2({
        placeholder: "Selectionner l'element",
        ajax: {
          url: 'api/list-batiment-by-cite?cite='+$('#cite').val(),
          processResults: function (data) {
            console.log(data);
            return {
              results: data.list,
            };
          },
        },
      });
    });
    $('#batiment').change(function (e) {
      $('#palier').select2({
        placeholder: "Selectionner l'element",
        ajax: {
          url: 'api/list-paliers-by-batiment?bat='+$('#batiment').val(),
          processResults: function (data) {
            return {
              results: data.list,
            };
          },
        },
      });
    });
    $('#palier').change(function (e) {
      $('#chambre').select2({
        placeholder: "Selectionner l'element",
        ajax: {
          url: 'api/list-chambre-by-palier?pal='+$('#palier').val(),
          processResults: function (data) {
            return {
              results: data.list,
            };
          },
        },
      });
    });
    $('#chambre').change(function (e) {
      $('#lit').select2({
        placeholder: "Selectionner l'element",
        ajax: {
          url: 'api/list-lit-by-chambre?ch='+$('#chambre').val(),
          processResults: function (data) {
            console.log(data);
            return {
              results: data.list,
            };
          },
        },
      });
    });
</script>
@endpush
@section('content')
<div class="content-wrapper">
  <div class="">
    <form action="/reattribution-chambre" method="post" enctype="multipart/form-data">
      <div class="row justify-content-md-center">
        @csrf
        <div class="col-md-6">
          <div class="card">
            @if (count($errors->all()) != 0)
            <div class="col-md-12 alert alert-danger" role="alert">
              <ul>
                @foreach ($errors->all() as $message)
                <li>{{ $message }}</li>
                @endforeach
              </ul>
            </div>
            @endif
            <div class="card-body">
              <h4 class="card-title">FORMULAIRE DE RÉADMISSION EN RÉSIDENCE UNIVERSITAIRE <br> Session 2023 - 2024</h4>
              <hr />
              <p class="card-description">Informations Personnels</p>
              <hr />
                <div class="row">
                  <div class="form-group col-md-6">
                    <label>VOTRE PHOTO ID <span style="color: red;">*</span></label>
                    <input type="file" required name="image" id="image">
                  </div>
                  <div class="form-group col-md-6">
                    <label>SEXE <span style="color: red;">*</span></label>
                    <select class="form-control select2" name="genre" id="genre">
                      <option value="Masculin">Masculin</option>
                      <option value="Feminin">Feminin</option>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label>N° CARTE D'ÉTUDIANT <span style="color: red;">*</span></label>
                    <input
                      style="text-transform: uppercase"
                      type="text"
                      class="form-control"
                      name="num_carte"
                      placeholder="N° CARTE D'ÉTUDIANT"
                    />
                  </div>
                  <div class="form-group col-md-6">
                    <label>NOM <span style="color: red;">*</span></label>
                    <input value="{{session('nom_etudiant')}}" style="text-transform: uppercase" type="text" class="form-control" name="nom_etudiant" placeholder="NOM" />
                  </div>

                  <div class="form-group col-md-6">
                    <label>PRÉNOMS <span style="color: red;">*</span></label>
                    <input
                      style="text-transform: uppercase"
                      type="text"
                      class="form-control"
                      name="prenoms_etudiant"
                      placeholder="PRÉNOMS"
                    />
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label>NÉ(E) LE <span style="color: red;">*</span></label>
                    <input
                      style="text-transform: uppercase"
                      type="date"
                      class="form-control"
                      name="date_naissance_etudiant"
                      placeholder="DATE DE NAISSANCE"
                    />
                  </div>
                  <div class="form-group col-md-6">
                    <label>LIEU DE NAISSANCE <span style="color: red;">*</span></label>
                    <input
                      style="text-transform: uppercase"
                      type="text"
                      class="form-control"
                      name="lieu_naissance_etudiant"
                      placeholder="LIEU DE NAISSANCE"
                    />
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label>CONTACT <span style="color: red;">*</span></label>
                    <input
                      style="text-transform: uppercase"
                      type="tel"
                      class="form-control"
                      name="contact_etudiant"
                      placeholder="CONTACT"
                    />
                  </div>
                  <div class="form-group col-md-6">
                    <label>EMAIL <span style="color: red;">*</span></label>
                    <input style="text-transform: lowercase" type="email" class="form-control" name="email_etudiant" placeholder="EMAIL" />
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label>NATIONALITÉ <span style="color: red;">*</span></label>
                    <select name="nationnalite" class="form-control select2">
                      @foreach ($pays as $pay)
                      <option {{"Ivoirienne" == $pay['title']?"selected":null}} value="{{ $pay['title'] }}">{{ $pay['title'] }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label>HANDICAPE <span style="color: red;">*</span></label>
                    <select name="handicap_etudiant" id="handicap_etudiant" class="form-control">
                      <option value="Non">Non</option>
                      <option value="Oui">Oui</option>
                    </select>
                  </div>
                </div>
                <div class="row" id="precision_handicap">
                  <div class="form-group col-md-6">
                    <label>PRECISER VOTRE HANDICAPE <span style="color: red;">*</span></label>
                    <select name="precision_handicap" id="handicap_etudiant" class="form-control select2">
                      <option value=""></option>
                      <option value="HANDICAP AUDITIF">HANDICAP AUDITIF</option>
                      <option value="HANDICAP MENTAL">HANDICAP MENTAL</option>
                      <option value="HANDICAP MOTEUR">HANDICAP MOTEUR</option>
                      <option value="HANDICAP PSYCHIQUE">HANDICAP PSYCHIQUE</option>
                      <option value="HANDICAP VISUEL">HANDICAP VISUEL</option>
                      <option value="POLYHANDICAP">POLYHANDICAP</option>
                      <option value="PLURIHANDICAP">PLURIHANDICAP</option>
                    </select>
                  </div>
                </div>
                <hr />
                <p class="card-description">Informations Tuteurs/Parents</p>
                <hr />
                <div class="row">
                  <div class="form-group col-md-6">
                    <label>NOM DU PARENT/TUTEUR <span style="color: red;">*</span></label>
                    <input
                      style="text-transform: uppercase"
                      type="text"
                      name="nom_tuteur"
                      class="form-control"
                      placeholder="NOM DU PARENT/TUTEUR"
                    />
                  </div>
                  <div class="form-group col-md-6">
                    <label>CONTACT DU PARENT/TUTEUR <span style="color: red;">*</span></label>
                    <input
                      style="text-transform: uppercase"
                      type="tel"
                      name="contact_tuteur"
                      class="form-control"
                      placeholder="CONTACT DU PARENT/TUTEUR"
                    />
                  </div>
                </div>
                <hr />
                <p class="card-description">Cursus Universitaire</p>
                <hr />
                <div class="row">
                  <div class="form-group col-md-6">
                    <label>UNIVERSITÉ/STRUCTURE/ÉCOLE <span style="color: red;">*</span></label>
                    <select class="form-control select2" name="ufr_etudiant" id="ufr_etudiant">
                      {{-- <option value=""></option> --}}
                      @foreach ($universites as $universite)
                      <option value="{{$universite->id}}">{{strtoupper($universite->libelle) }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label ><span id="dep_lib">DÉPARTEMENT/UFR</span> <span style="color: red;">*</span></label>
                    <span class="noNangui">
                      <select name="departement_etudiant" class="form-control select2" id="sel_departement_etudiant">
                        <option value=""></option>
                        @foreach ($departements as $departement)
                        <option value="{{$departement->id}}">{{$departement->libelle}}</option>
                        @endforeach
                      </select>
                    </span>
                    <input
                      style="text-transform: uppercase"
                      name=""
                      type="text"
                      class="form-control isNangui"
                      id="input_departement_etudiant"
                      placeholder="DÉPARTEMENT"
                    />
                  </div>
                  <div class="form-group col-md-6">
                    <label>NIVEAU ACTUEL <span style="color: red;">*</span></label>
                    <select class="form-control select2" name="niveau_actuel_etudiant" id="niveau_actuel_etudiant">
                      <option value=""></option>
                      @foreach ($niveaux as $niveau)
                      <option value="{{$niveau->libelle}}">{{$niveau->libelle}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label class="col-md-12">FILIÈRE<span style="color: red;">*</span></label>
                    <span class="noNangui">
                    <select class="form-control col-md-12" name="filiere" id="select_filiere">
                      <option value=""></option>
                    </select>
                    </span>
                    <input
                      style="text-transform: uppercase"
                      name=""
                      type="text"
                      class="form-control isNangui"
                      id="input_filiere"
                      placeholder="FILIÈRE"
                    />
                  </div>
                  <div class="form-group col-md-6">
                    <label>NIVEAU PRÉCÉDENT <span style="color: red;">*</span></label>
                    <select class="form-control select2" name="niveau_precedent_etudiant" id="">
                      <option value=""></option>
                      @foreach ($niveaux as $niveau)
                      <option value="{{$niveau->libelle}}">{{$niveau->libelle}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label>DÉCISION DE FIN D'ANNÉE <span style="color: red;">*</span></label>
                    <select class="form-control " name="decision_final_etudiant" id="">
                      <option value="Admis">Admis</option>
                      <option value="Ajourné">Ajourné</option>
                      <option value="Autorisé">Autorisé</option>
                    </select>
                  </div>
                </div>
                <hr />
                <p class="card-description">Situation Antérieur du Résident</p>
                <hr />
                <div class="row">
                  <div class="form-group col-md-6">
                    <label>Cité Universitaire <span style="color: red;">*</span></label>
                    <select required name="cite_id" class="form-control select2" id="cite">
                      <option ></option>
                      @foreach ($cites as $cite)
                      <option value="{{$cite->id}}">{{strtoupper($cite->libelle) }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Bâtiment  <span style="color: red;">*</span></label>
                    <select required name="batiment_id" class="form-control select2"  id="batiment">
                      @foreach ($batiments as $batiment)
                      <option value="{{$batiment->id}}">{{strtoupper($batiment->libelle) }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Palier  <span style="color: red;">*</span></label>
                    <select required name="palier_id" class="form-control select2"  id="palier">
                      @foreach ($paliers as $palier)
                      <option value="{{$palier->id}}">{{strtoupper($palier->libelle) }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Chambre  <span style="color: red;">*</span></label>
                    <select required name="chambre_id" class="form-control select2"  id="chambre">
                      @foreach ($chambres as $chambre)
                      <option value="{{$chambre->id}}">{{strtoupper($chambre->libelle) }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label> LIT <span style="color: red;">*</span></label>
                    <select required name="lit_id" class="form-control select2"  id="lit">
                      @foreach ($lits as $lit)
                      <option value="{{$lit->id}}">{{strtoupper($lit->libelle) }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary mr-2">VALIDER MA DEMANDE DE RÉADMISSION</button>
                <a href="{{ url()->previous() }}" class="btn btn-light">ANNULER</a>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
