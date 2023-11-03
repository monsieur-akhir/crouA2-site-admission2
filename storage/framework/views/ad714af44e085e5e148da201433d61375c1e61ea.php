<?php $__env->startPush('scripts'); ?>
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
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
  <div class="">
    <form action="/reattribution-chambre" method="post" enctype="multipart/form-data">
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
                    <input value="<?php echo e(session('nom_etudiant')); ?>" style="text-transform: uppercase" type="text" class="form-control" name="nom_etudiant" placeholder="NOM" />
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
                      <?php $__currentLoopData = $pays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pay): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option <?php echo e("Ivoirienne" == $pay['title']?"selected":null); ?> value="<?php echo e($pay['title']); ?>"><?php echo e($pay['title']); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                      
                      <?php $__currentLoopData = $universites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $universite): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($universite->id); ?>"><?php echo e(strtoupper($universite->libelle)); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label ><span id="dep_lib">DÉPARTEMENT/UFR</span> <span style="color: red;">*</span></label>
                    <span class="noNangui">
                      <select name="departement_etudiant" class="form-control select2" id="sel_departement_etudiant">
                        <option value=""></option>
                        <?php $__currentLoopData = $departements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $departement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($departement->id); ?>"><?php echo e($departement->libelle); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                      <?php $__currentLoopData = $niveaux; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $niveau): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($niveau->libelle); ?>"><?php echo e($niveau->libelle); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                      <?php $__currentLoopData = $niveaux; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $niveau): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($niveau->libelle); ?>"><?php echo e($niveau->libelle); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                      <?php $__currentLoopData = $cites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cite): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($cite->id); ?>"><?php echo e(strtoupper($cite->libelle)); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Bâtiment  <span style="color: red;">*</span></label>
                    <select required name="batiment_id" class="form-control select2"  id="batiment">
                      <?php $__currentLoopData = $batiments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $batiment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($batiment->id); ?>"><?php echo e(strtoupper($batiment->libelle)); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Palier  <span style="color: red;">*</span></label>
                    <select required name="palier_id" class="form-control select2"  id="palier">
                      <?php $__currentLoopData = $paliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $palier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($palier->id); ?>"><?php echo e(strtoupper($palier->libelle)); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Chambre  <span style="color: red;">*</span></label>
                    <select required name="chambre_id" class="form-control select2"  id="chambre">
                      <?php $__currentLoopData = $chambres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chambre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($chambre->id); ?>"><?php echo e(strtoupper($chambre->libelle)); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label> LIT <span style="color: red;">*</span></label>
                    <select required name="lit_id" class="form-control select2"  id="lit">
                      <?php $__currentLoopData = $lits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($lit->id); ?>"><?php echo e(strtoupper($lit->libelle)); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary mr-2">VALIDER MA DEMANDE DE RÉADMISSION</button>
                <a href="<?php echo e(url()->previous()); ?>" class="btn btn-light">ANNULER</a>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/admission.croua2.ci/public_html/resources/views/layouts/reattribution.blade.php ENDPATH**/ ?>