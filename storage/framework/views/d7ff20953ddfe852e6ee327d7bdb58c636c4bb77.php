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
              <div class="card-body">
                <?php if(isset($message) ): ?>
                <div class="alert alert-success background-success">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="icofont icofont-close-line-circled text-white"></i>
                  </button>
                  <strong><?php echo e($message); ?></strong>
                </div>
                <?php endif; ?>
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
                      <?php $__currentLoopData = $demandes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $demande): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                  <td><?php echo e($demande->matricule_crou); ?></td>
                                  <td><?php echo e($demande->num_carte); ?></td>
                                  <td><?php echo e($demande->genre); ?></td>
                                  <td><?php echo e($demande->nom_etudiant); ?></td>
                                  <td><?php echo e($demande->prenoms_etudiant); ?></td>
                                  <td><?php echo e($demande->contact_etudiant); ?></td>
                                  <td><?php echo e($demande->date_naissance_etudiant); ?></td>
                                  <td><?php echo e($demande->nationnalite); ?></td>
                                  <td><?php echo e(strtoupper(DB::table('universites')->where('id',$demande->ufr_etudiant)->first()->libelle)); ?></td>
                                  <?php
                                      $departement = DB::table('departements')->where('id',$demande->departement_etudiant)->first();
                                  ?>
                                    <?php if($departement): ?>
                                    <td>
                                      <?php echo e(strtoupper($departement->libelle)); ?>

                                    </td>
                                  <?php else: ?>
                                    <td>
                                      <?php echo e(strtoupper($demande->ecole_etudiant)); ?>

                                    </td>
                                  <?php endif; ?>
                                  <?php
                                      $filiere = DB::table('filieres')->where('id',$demande->filiere)->first();
                                  ?>
                                  <?php if($filiere): ?>
                                    <td>
                                      <?php echo e(strtoupper($filiere->libelle)); ?>

                                    </td>
                                  <?php else: ?>
                                    <td>
                                      <?php echo e(strtoupper($demande->filiere)); ?>

                                    </td>
                                  <?php endif; ?>
                                  
                                  
                                  <td><?php echo e($demande->niveau_actuel_etudiant); ?></td>
                                  <td>
                                        <?php if($demande->statut == 0): ?>
                                          <label class="badge badge-warning p-2">
                                              A traiter
                                          </label>
                                        <?php elseif($demande->statut == -1): ?>
                                          <label class="badge badge-danger p-2">
                                            Refusé
                                          </label>
                                        <?php elseif($demande->statut == 1): ?>
                                          <label class="badge badge-success p-2">
                                            Accepté
                                          </label>
                                        <?php elseif($demande->statut == 2): ?>
                                          <label class="badge badge-success p-2">
                                            Dossiers déposés
                                          </label>
                                        <?php else: ?>
                                          <label class="badge badge-success p-2">
                                            Chambre attribuée
                                          </label>
                                        <?php endif; ?> 
                                  </td>
                                  <td>
                                        <a href="<?php echo e(url('details-demandes?mat='.$demande->matricule_crou)); ?>"  class="btn btn-success p-2">
                                         TRAITER 
                                        </a>
                                  </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                  </table>
                  
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
<?php echo $__env->make('index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/vps-8a0d3bf3.vps.ovh.net/public_html/resources/views/layouts/traiter.blade.php ENDPATH**/ ?>