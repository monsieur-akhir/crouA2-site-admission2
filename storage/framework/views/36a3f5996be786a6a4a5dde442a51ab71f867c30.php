<?php $__env->startSection('content'); ?>
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php echo $__env->make('partials._navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      
     
      <?php echo $__env->make('partials._sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <a style="padding: 15px; margin-top:10px" href="traiter">Aller à la liste</a>
              <div class="card-body">
                <form action="/traiter" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="text" hidden name="demande" value="<?php echo e($demande->id); ?>">
                    <input type="text" hidden name="matricule_crou" value="<?php echo e($demande->matricule_crou); ?>">
                    <input type="text" hidden name="lit" value="<?php echo e($demande->chambre_attribue?$demande->chambre_attribue->lit->id:null); ?>">
                    <?php if($demande->statut == 0): ?>
                            <button type="submit" name="statut" value="-1" class="btn btn-danger">Refuser la demande</button>
                            <button type="submit" name="statut" value="2" class="btn btn-success">Dossiers deposés</button>
                    <?php elseif($demande->statut == -1): ?>
                      <button type="submit" name="statut" value="2" class="btn btn-success">Dossiers deposés</button>
                    
                    <?php elseif($demande->statut == 2): ?>
                        <button type="submit" name="statut" value="-1" class="btn btn-danger">Refuser la demande</button>
                        <button type="submit" name="statut" value="3"   name="statut"  class="btn btn-success">Attribuer une chambre</button>
                        
                    <?php else: ?>
                        <?php if($demande->chambre_attribue): ?>
                          <button type="submit" name="statut" value="-1" class="btn btn-success">Retirer la chambre</button>
                          <br>
                          <br>
                            
                            <br>
                            <hr style="border:2px solid black">
                        <?php endif; ?>
                    <?php endif; ?>
                    <div style="float:right">
                      <a href="trouver-fiche?matricule_crou=<?php echo e($demande->matricule_crou); ?>&date_naissance_etudiant=<?php echo e($demande->date_naissance_etudiant); ?>" name="statut" value="1" class="btn btn-primary">Modifier</a>
                      <!-- <a href="delete-fiche?matricule_crou=<?php echo e($demande->matricule_crou); ?>&date_naissance_etudiant=<?php echo e($demande->date_naissance_etudiant); ?>" name="statut" value="1" class="btn btn-warning">Supprimer</a> -->
                    </div>
                </form>
                    
                    <div class="row">
                      <?php if($demande->cite_id): ?>
                      <div class="col-md-12 mt-4">
                        <h3><b>SITUATION ANTERIEURE DU RESIDENT</b> </h3>
                        <p style="line-height: 16px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Cité : <span style="font-weight:bold"><?php echo e(strtoupper(DB::table('cites')->where('id',$demande->cite_id)->first()->libelle)); ?></span></p>
                        <p style="line-height: 16px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Batiment : <span style="font-weight:bold"><?php echo e(strtoupper(DB::table('batiments')->where('id',$demande->batiment_id)->first()->libelle)); ?></span></p>
                        <p style="line-height: 16px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Palier : <span style="font-weight:bold"><?php echo e(strtoupper(DB::table('paliers')->where('id',$demande->palier_id)->first()->libelle)); ?></span></p>
                        <p style="line-height: 16px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Chambre : <span style="font-weight:bold"><?php echo e(strtoupper(DB::table('chambres')->where('id',$demande->chambre_id)->first()->libelle)); ?></span></p>
                        <p style="line-height: 16px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Lit : <span style="font-weight:bold"><?php echo e(strtoupper(DB::table('lits')->where('id',$demande->lit_id)->first()->libelle)); ?></span></p>
                      </div>
                      <hr>
                      <?php endif; ?>
                    <p style="line-height: 35px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Matricule Crou : <span style="font-weight:bold"><?php echo e($demande->matricule_crou); ?></span></p>
                    <p style="line-height: 35px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Numéro de carte : <span style="font-weight:bold"><?php echo e($demande->num_carte); ?></span></p>
                    <p style="line-height: 35px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Nom & Prenoms : <span style="font-weight:bold"><?php echo e($demande->nom_etudiant.' '.$demande->prenoms_etudiant); ?></span></p>
                    <p style="line-height: 35px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Date de naissance : <span style="font-weight:bold"><?php echo e($demande->date_naissance_etudiant); ?></span></p>
                    <p style="line-height: 35px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Lieu de naissance : <span style="font-weight:bold"><?php echo e($demande->lieu_naissance_etudiant); ?></span></p>
                    <p style="line-height: 35px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Genre :<span style="font-weight:bold"><?php echo e($demande->genre); ?></span></p>
                    <p style="line-height: 35px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Contact : <span style="font-weight:bold"><?php echo e($demande->contact_etudiant); ?></span></p>
                    <p style="line-height: 35px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Email : <span style="font-weight:bold"><?php echo e($demande->email_etudiant); ?></span></p>
                    <p style="line-height: 35px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Handicap : <span style="font-weight:bold"><?php echo e($demande->handicap_etudiant); ?></span></p>
                    <p style="line-height: 35px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Nom du tuteur/parent : <span style="font-weight:bold"><?php echo e($demande->nom_tuteur); ?></span></p>
                    <p style="line-height: 35px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Contact du tuteur/parent : <span style="font-weight:bold"><?php echo e($demande->contact_tuteur); ?></span></p>
                    <p style="line-height: 35px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Université ou école : <span style="font-weight:bold"><?php echo e(strtoupper(DB::table('universites')->where('id',$demande->ufr_etudiant)->first()->libelle)); ?></span></p>
                    
                    <?php if($demande->ecole_etudiant != null): ?>
                        <p style="line-height: 35px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Ecole : <span style="font-weight:bold"><?php echo e($demande->ecole_etudiant); ?></span></p>
                    <?php else: ?>
                      <?php
                        $departement = DB::table('departements')->where('id',$demande->departement_etudiant)->first();
                      ?>
                      <?php if($departement): ?>
                        <p style="line-height: 35px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Departement : <span style="font-weight:bold"><?php echo e($departement->libelle); ?></span></p>
                      <?php else: ?>
                        <p style="line-height: 35px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Departement : <span style="font-weight:bold"><?php echo e($demande->departement_etudiant); ?></span></p>
                      <?php endif; ?>
                    <?php endif; ?>
                    <p style="line-height: 35px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Niveau actuel : <span style="font-weight:bold"><?php echo e($demande->niveau_actuel_etudiant); ?></span></p>
                    <p style="line-height: 35px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Niveau précedent : <span style="font-weight:bold"><?php echo e($demande->niveau_precedent_etudiant); ?></span></p>
                    <p style="line-height: 35px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Decision final : <span style="font-weight:bold"><?php echo e($demande->decision_final_etudiant); ?></span></p>
                    <p style="line-height: 35px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Nationnalité : <span style="font-weight:bold"><?php echo e($demande->nationnalite); ?></span></p>
                    <?php
                        $filiere = DB::table('filieres')->where('id',$demande->filiere)->first();
                    ?>
                    <?php if($filiere): ?>
                      <p style="line-height: 35px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Filière : <span style="font-weight:bold"><?php echo e($filiere->libelle); ?></span></p>
                    <?php else: ?>
                      <p style="line-height: 35px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Filière : <span style="font-weight:bold"><?php echo e($demande->filiere); ?></span></p>
                    <?php endif; ?>
                    <?php if($demande->is_bachelier == 'Oui'): ?>
                        <p style="line-height: 35px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Nombre de point au bac : <span style="font-weight:bold"><?php echo e($demande->point_bac); ?></span></p>
                        <p style="line-height: 35px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Série du bac : <span style="font-weight:bold"><?php echo e($demande->serie_bac); ?></span></p>
                        <p style="line-height: 35px;margin-bottom: 12px;font-size: 24px" class="col-md-6">Mention au bac : <span style="font-weight:bold"><?php echo e($demande->mention_bac); ?></span></p>
                    <?php endif; ?>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/croua2.ci/public_html/resources/views/layouts/details-demande.blade.php ENDPATH**/ ?>