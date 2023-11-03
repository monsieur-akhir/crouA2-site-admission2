<?php $__env->startPush('scripts'); ?>
<script>
  /* Start Setup page */
  var demande = <?php echo json_encode($demande, 15, 512) ?>;
  console.log(demande);
  if(demande.handicap_etudiant == 'Oui'){
    $('#precision_handicap').show()
  }else{
    $('#precision_handicap').hide()
  }
  if(demande.is_bachelier == 'Oui'){
    $('#div_bachelier').show()
  }else{
    $('#div_bachelier').hide()
  }
 
  if(demande.ufr_etudiant == 1){
     /*  $('#select_filiere').select2({
        placeholder: "Selectionner l'element",
        ajax: {
          url: 'api/filieres?dep='+$('#sel_departement_etudiant').val() + '&niv=' + $('#niveau_actuel_etudiant').val(),
          processResults: function (data) {
            return {
              results: data.list,
            };
          },
        },
      }); */
      $('#input_filiere').attr('name', null);
      $('#select_filiere').attr('name', 'filiere');
      // $("#select_filiere").val(2).trigger('change')
      // $('#select_filiere').val(demande.filiere).trigger('change');
      $('.isNangui').hide();
      $('.noNangui').show();
  }else{
    if (demande.ufr_etudiant == 9) {
        $("#dep_lib").empty();
        $('#input_departement_etudiant').attr("name","ecole_etudiant")
        $('#input_departement_etudiant').attr("placeholder","NOM DE VOTRE ECOLE")
        $('#input_departement_etudiant').attr("value",demande.ecole_etudiant)
        $('#dep_lib').text("NOM DE VOTRE ECOLE");
      }else{
        $("#dep_lib").empty();
        $('#dep_lib').text("DEPARTEMENT");
        $('#input_departement_etudiant').attr("placeholder","DEPARTEMENT")
        $('#input_departement_etudiant').attr('name', 'departement_etudiant');
        $('#input_departement_etudiant').val(demande.departement_etudiant)
      }
      $('.isNangui').show();
      $('.noNangui').hide();
      $('#sel_departement_etudiant').attr('name', null);
      $('#select_filiere').attr('name', null);
      $('#input_filiere').attr('name', 'filiere');
      $('#input_filiere').val(demande.filiere);
      
  }
      /* End Setup page */
  $('#handicap_etudiant').change(function() {
    demande.handicap_etudiant = this.value
    if(this.value == 'Oui'){
      $('#precision_handicap').show()
    }else{
      $('#precision_handicap').hide()
    }
  })
  $('input[name=is_bachelier]').change(function() {
    demande.is_bachelier = this.value
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
      demande.ufr_etudiant = $('#ufr_etudiant').val()
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
</script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
  <div class="">
    <form action="/update-demande" method="post" enctype="multipart/form-data">
      <div class="row justify-content-md-center">
        <?php echo csrf_field(); ?>
        <div class="col-md-6">
          <div class="card">
            <?php if(count($errors->all()) != 0): ?>
            <div class="col-md-12 alert alert-danger" role="alert">
              <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($message); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
            </div>
            <?php endif; ?>
            <div class="card-body">
              <h4 class="card-title">FORMULAIRE D'ADMISSION EN RESIDENCE UNIVERSITAIRE <br> Session 2021 - 2022</h4>
              <hr />
              <p class="card-description">Informations Personnels</p>
              <div class="mr-2" style="float: ">
                <img src="<?php echo e(url($demande->image)); ?>" alt="" style="width:130px;height:200px; margin-top:10px" srcset="">
              </div>
              <hr />
                <div class="row">
                  <div class="form-group col-md-6">
                    <label>VOTRE PHOTO IDENTITE <span style="color: red;">*</span></label>
                    <input type="file" accept="image/png, image/gif, image/jpeg" name="image" id="image">
                  </div>
                  <div class="form-group col-md-6">
                    <label>SEXE <span style="color: red;">*</span></label>
                    <select class="form-control select2" name="genre" id="genre">
                      <option <?php echo e($demande->genre == "Masculin"?"selected":null); ?> value="Masculin">Masculin</option>
                      <option <?php echo e($demande->genre == "Feminin"?"selected":null); ?> value="Feminin">Feminin</option>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label>N° CARTE D'ETUDIANT <span style="color: red;">*</span></label>
                    <input
                      style="text-transform: uppercase"
                      type="text"
                      class="form-control"
                      name="num_carte"
                      value="<?php echo e($demande->num_carte); ?>"
                      placeholder="N° CARTE D'ETUDIANT"
                    />
                    <input type="text" hidden value="<?php echo e($demande->matricule_crou); ?>" name="matricule_crou">
                  </div>
                  <div class="form-group col-md-6">
                    <label>NOM <span style="color: red;">*</span></label>
                    <input value="<?php echo e($demande->nom_etudiant); ?>" style="text-transform: uppercase" type="text" class="form-control" name="nom_etudiant" placeholder="NOM" />
                  </div>

                  <div class="form-group col-md-6">
                    <label>PRÉNOMS <span style="color: red;">*</span></label>
                    <input
                      style="text-transform: uppercase"
                      type="text"
                      class="form-control"
                      name="prenoms_etudiant"
                      placeholder="PRÉNOMS"
                      value="<?php echo e($demande->prenoms_etudiant); ?>"
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
                      value="<?php echo e(Carbon\Carbon::parse($demande->date_naissance_etudiant)->format('Y-m-d')); ?>"
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
                      value="<?php echo e($demande->lieu_naissance_etudiant); ?>"
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
                      value="<?php echo e($demande->contact_etudiant); ?>"
                    />
                  </div>
                  <div class="form-group col-md-6">
                    <label>EMAIL <span style="color: red;">*</span></label>
                    <input value="<?php echo e($demande->email_etudiant); ?>" style="text-transform: lowercase" type="email" class="form-control" name="email_etudiant" placeholder="EMAIL" />
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label>NATIONALITE <span style="color: red;">*</span></label>
                    <select name="nationnalite" class="form-control select2">
                      <?php $__currentLoopData = $pays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pay): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option <?php echo e($demande->nationnalite == $pay['title']?"selected":null); ?> value="<?php echo e($pay['title']); ?>"><?php echo e($pay['title']); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label>HANDICAP <span style="color: red;">*</span></label>
                    <select name="handicap_etudiant" id="handicap_etudiant" class="form-control">
                      <option <?php echo e($demande->handicap_etudiant == "Non"?"selected":null); ?> value="Non">NON</option>
                      <option  <?php echo e($demande->handicap_etudiant == "Oui"?"selected":null); ?> value="Oui">OUI</option>
                    </select>
                  </div>
                </div>
                <?php if($demande->handicap_etudiant == 'Oui'): ?>
                <div class="row" id="precision_handicap">
                  <div class="form-group col-md-6">
                    <label>PRECISER VOTRE HANDICAP <span style="color: red;">*</span></label>
                    <select name="precision_handicap" id="handicap_etudiant" class="form-control select2">
                      <option value=""></option>
                      <option <?php echo e($demande->precision_handicap == "HANDICAP AUDITIF"?"selected":null); ?> value="HANDICAP AUDITIF">HANDICAP AUDITIF</option>
                      <option <?php echo e($demande->precision_handicap == "HANDICAP MENTAL"?"selected":null); ?> value="HANDICAP MENTAL">HANDICAP MENTAL</option>
                      <option <?php echo e($demande->precision_handicap == "HANDICAP MOTEUR"?"selected":null); ?> value="HANDICAP MOTEUR">HANDICAP MOTEUR</option>
                      <option <?php echo e($demande->precision_handicap == "HANDICAP PSYCHIQUE"?"selected":null); ?> value="HANDICAP PSYCHIQUE">HANDICAP PSYCHIQUE</option>
                      <option <?php echo e($demande->precision_handicap == "HANDICAP VISUEL"?"selected":null); ?> value="HANDICAP VISUEL">HANDICAP VISUEL</option>
                      <option <?php echo e($demande->precision_handicap == "POLYHANDICAP"?"selected":null); ?> value="POLYHANDICAP">POLYHANDICAP</option>
                      <option <?php echo e($demande->precision_handicap == "PLURIHANDICAP"?"selected":null); ?> value="PLURIHANDICAP">PLURIHANDICAP</option>
                    </select>
                  </div>
                </div>
                <?php endif; ?>
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
                      value="<?php echo e($demande->nom_tuteur); ?>"
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
                      value="<?php echo e($demande->contact_tuteur); ?>"
                    />
                  </div>
                </div>
                <hr />
                <p class="card-description">Cursus universtaire</p>
                <hr />
                <div class="row">
                  <div class="form-group col-md-12">
                    <label>NOUVEAU BACHELIER</label><br>
                    <div style="display: inline-flex;">
                      <div class="form-check form-check-inline">
                        <input <?php echo e($demande->is_bachelier == "Oui"?"checked":null); ?>  class="form-check-input" type="radio" name="is_bachelier" id="bachelier" value="Oui">
                        <label>Oui</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input <?php echo e($demande->is_bachelier == "Non"?"checked":null); ?> class="form-check-input" type="radio" name="is_bachelier" id="bachelier" value="Non">
                        <label>Non</label>
                      </div>
                    </div>
                  </div>
                  </div>
                  <div class="row" id="div_bachelier" >
                    <div class="form-group col-md-4">
                      <label>POINT BAC <span style="color: red;">*</span></label>
                      <input
                        style="text-transform: uppercase"
                        type="number"
                        class="form-control"
                        name="point_bac"
                        placeholder="NOMBRE DE POINT BAC"
                        value="<?php echo e($demande->point_bac); ?>"
                      />
                    </div>
                    <div class="form-group col-md-4">
                      <label>SERIE DU BAC <span style="color: red;">*</span></label>
                      <select class="form-control select2" name="serie_bac" id="serie_bac">
                        <option value=""></option>
                        <option <?php echo e($demande->serie_bac == "A"?"selected":null); ?> value="A">A</option>
                        <option <?php echo e($demande->serie_bac == "C"?"selected":null); ?> value="C">C</option>
                        <option <?php echo e($demande->serie_bac == "D"?"selected":null); ?> value="D">D</option>
                        <option <?php echo e($demande->serie_bac == "E"?"selected":null); ?> value="E">E</option>
                        <option <?php echo e($demande->serie_bac == "F"?"selected":null); ?> value="F">F</option>
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label>MENTION <span style="color: red;">*</span></label>
                      <select class="form-control select2" name="mention_bac" id="mention_bac">
                        <option value=""></option>
                        <option <?php echo e($demande->mention_bac == "Passable"?"selected":null); ?> value="Passable">Passable</option>
                        <option <?php echo e($demande->mention_bac == "Assez Bien"?"selected":null); ?> value="Assez Bien">Assez Bien</option>
                        <option <?php echo e($demande->mention_bac == "Bien"?"selected":null); ?> value="Bien">Bien</option>
                        <option <?php echo e($demande->mention_bac == "Très Bien"?"selected":null); ?> value="Très Bien">Très Bien</option>
                        <option <?php echo e($demande->mention_bac == "Excellent"?"selected":null); ?> value="Excellent">Excellent</option>
                      </select>
                    </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label>UNIVERSITE/STRUCTURE/ECOLE <span style="color: red;">*</span></label>
                    <select class="form-control select2" name="ufr_etudiant" id="ufr_etudiant">
                      
                      <?php $__currentLoopData = $universites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $universite): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option <?php echo e($demande->ufr_etudiant == $universite->id?"selected":null); ?> value="<?php echo e($universite->id); ?>"><?php echo e(strtoupper($universite->libelle)); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label ><span id="dep_lib">DEPARTEMENT/UFR</span> <span style="color: red;">*</span></label>
                    <span class="noNangui">
                      <select name="departement_etudiant" class="form-control select2" id="sel_departement_etudiant">
                        <option value=""></option>
                        <?php $__currentLoopData = $departements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $departement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option <?php echo e($demande->departement_etudiant == $departement->id?"selected":null); ?> value="<?php echo e($departement->id); ?>"><?php echo e($departement->libelle); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                    </span>
                    <input
                      style="text-transform: uppercase"
                      name=""
                      type="text"
                      class="form-control isNangui"
                      id="input_departement_etudiant"
                      placeholder="DEPARTEMENT"
                    />
                  </div>
                  <div class="form-group col-md-6">
                    <label>NIVEAU ACTUEL <span style="color: red;">*</span></label>
                    <select class="form-control select2" name="niveau_actuel_etudiant" id="niveau_actuel_etudiant">
                      <option value=""></option>
                      <?php $__currentLoopData = $niveaux; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $niveau): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option <?php echo e($demande->niveau_actuel_etudiant == $niveau->libelle?"selected":null); ?> value="<?php echo e($niveau->libelle); ?>"><?php echo e($niveau->libelle); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label class="col-md-12">FILIERE<span style="color: red;">*</span></label>
                    <span class="noNangui">
                      <?php
                        $filiere = DB::table('filieres')->where('id',$demande->filiere)->first();
                      ?>
                      <select class="form-control col-md-12 select2" name="filiere" id="select_filiere">
                        <?php if($filiere): ?>
                          <option value="<?php echo e($demande->filiere); ?>"><?php echo e($filiere->libelle); ?></option>
                        <?php endif; ?>
                      </select>
                    </span>
                    <input
                      style="text-transform: uppercase"
                      name="filiere"
                      type="text"
                      class="form-control isNangui"
                      id="input_filiere"
                      placeholder="FILIERE"
                    />
                  </div>
                  <div class="form-group col-md-6">
                    <label>NIVEAU PRECEDENT <span style="color: red;">*</span></label>
                    <select class="form-control select2" name="niveau_precedent_etudiant" id="">
                      <option value=""></option>
                      <option <?php echo e($demande->niveau_precedent_etudiant =="Terminale"?"selected":null); ?> value="Terminale">Terminale</option>
                      <?php $__currentLoopData = $niveaux; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $niveau): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option <?php echo e($demande->niveau_precedent_etudiant == $niveau->libelle?"selected":null); ?> value="<?php echo e($niveau->libelle); ?>"><?php echo e($niveau->libelle); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label>DECISION DE FIN D'ANNEE <span style="color: red;">*</span></label>
                    <select class="form-control " name="decision_final_etudiant" id="">
                      <option <?php echo e($demande->decision_final_etudiant == $niveau->id?"selected":null); ?> value="Admis">Admis</option>
                      <option <?php echo e($demande->decision_final_etudiant == $niveau->id?"Ajourné":null); ?> value="Ajourné">Ajourné</option>
                      <option <?php echo e($demande->decision_final_etudiant == $niveau->id?"Autorisé":null); ?> value="Autorisé">Autorisé</option>
                    </select>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary mr-2">MODIFIER MA DEMANDE</button>
                <a href="<?php echo e(url('/')); ?>" class="btn btn-light">ANNULER</a>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/croua2.ci/public_html/resources/views/layouts/update-demande.blade.php ENDPATH**/ ?>