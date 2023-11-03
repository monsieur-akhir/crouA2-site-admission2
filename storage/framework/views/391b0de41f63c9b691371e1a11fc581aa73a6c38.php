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
              <h4 class="card-title">Les agents </h4>

              <div class="text-right">
                <button type="button" style="background-color: #3C2A45;color:white" data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-warning btn-icon-text">
                  <i class="btn-icon-prepend"></i>
                  Ajouter un utilisateur
                </button>
              </div>
              <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                  <div class="modal-header" style="background-color: white">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter un utilisateur</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-content p-4">
                    <form action="<?php echo e(route('creer-user')); ?>" method="POST">
                      <?php echo csrf_field(); ?>
                      <div id="response"></div>
                      <div class="row">
                        <div class="form-group col-md-12">
                          <label>Nom <span class="text-danger">*</span> </label>
                          <input required type="text" class="form-control" name="nom" id="nom">
                        </div>
                        <div class="form-group col-md-12">
                          <label>Prénoms<span class="text-danger">*</span> </label>
                          <input required type="text" class="form-control" name="prenoms" id="prenoms">
                        </div>
                        <div class="form-group col-md-12">
                          <label>Email<span class="text-danger">*</span> </label>
                          <input required type="email" class="form-control" name="email" id="email">
                        </div>
                        <div class="form-group col-md-12">
                          <label>Rôle<span class="text-danger">*</span> </label>
                          <select class="form-control" name="role" required>
                            <option value="admin">Administrateur</option>
                            <option value="agent">Agent</option>
                          </select>
                        </div>
                        <div class="form-group col-md-12">
                          <label>Téléphone</label>
                          <input type="text" maxlength="10" minlength="10" class="form-control" name="telephone" id="telephone">
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


              <?php if(session()->get('_success')): ?>
              <div class="alert alert-success mg-b-0" role="alert">
                <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                  <span aria-hidden="true">&times;</span>
                </button>
                <strong><?php echo e(session()->get('_success')); ?></strong>
              </div>
              <?php endif; ?>

              <?php if($errors->any()): ?>
              <div class="alert alert-danger background-danger">
                <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                  <span aria-hidden="true">&times;</span>
                </button>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <strong><?php echo e($error); ?></strong>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
              <?php endif; ?>
              <div class="table-responsive pt-3">
                <table id="dataTable" class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Nom</th>
                      <th>Prenoms</th>
                      <th>Email</th>
                      <th>Téléphone</th>
                      <th>Role</th>
                      <th>Statut</th>
                      <th></th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $__currentLoopData = $agents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td><?php echo e($agent->nom); ?></td>
                      <td><?php echo e($agent->prenoms); ?></td>
                      <td><?php echo e($agent->email); ?></td>
                      <td><?php echo e($agent->telephone); ?></td>
                      <td><?php echo e($agent->role); ?></td>
                      <td>
                        <?php if($agent->statut == 0): ?>
                        <label class="badge badge-warning p-2">
                          En attente d'activation
                        </label>
                        <?php elseif($agent->statut == -1): ?>
                        <label class="badge badge-danger p-2">
                          Désactivé
                        </label>
                        <?php elseif($agent->statut == 1): ?>
                        <label class="badge badge-success p-2">
                          Activé
                        </label>
                        <?php endif; ?>
                      </td>
                      <td>


                        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal<?php echo e($agent->id); ?>">
                          Modifier
                        </button>

                        <!-- Modal -->
                        <div id="myModal<?php echo e($agent->id); ?>" class="modal fade" role="dialog">
                          <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">Modifier un agent
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"></h4>
                              </div>
                              <div class="modal-body">
                                <form action="<?php echo e(route('modifier-user')); ?>" method="POST">
                                  <?php echo csrf_field(); ?>
                                  <div id="response"></div>
                                  <div class="row">
                                    <div class="form-group col-md-12">
                                      <label>Nom <span class="text-danger">*</span> </label>
                                      <input required type="text" value="<?php echo e($agent->nom); ?>" class="form-control" name="nom" id="nom">
                                      <input required type="hidden" value="<?php echo e($agent->id); ?>" class="form-control" name="id" id="id">
                                    </div>
                                    <div class="form-group col-md-12">
                                      <label>Prénoms<span class="text-danger">*</span> </label>
                                      <input required type="text" class="form-control" value="<?php echo e($agent->prenoms); ?>" name="prenoms" id="prenoms">
                                    </div>
                                    <div class="form-group col-md-12">
                                      <label>Email<span class="text-danger">*</span> </label>
                                      <input required type="email" value="<?php echo e($agent->email); ?>" class="form-control" name="email" id="email">
                                      <input required type="hidden" value="<?php echo e($agent->email); ?>" name="old_email" id="email">
                                    </div>
                                    <div class="form-group col-md-12">
                                      <label>Rôle<span class="text-danger">*</span> </label>
                                      <select class="form-control" name="role" required>
                                        <option <?php if($agent->role == "admin"): ?> selected='selected' <?php endif; ?> value="admin">Administrateur</option>
                                        <option <?php if($agent->role == "agent"): ?> selected='selected' <?php endif; ?> value="agent">Agent</option>
                                      </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                      <label>Téléphone</label>
                                      <input type="text" value="<?php echo e($agent->telephone); ?>" maxlength="10" minlength="10" class="form-control" name="telephone" id="telephone">
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
                        </div>
                      </td>
                      <td>
                        <form action="<?php echo e(route('valider-agent')); ?>" method="POST" novalidate>
                          <?php echo csrf_field(); ?>
                          <input hidden name="statut" <?php if($agent->statut == 0): ?>
                          value="1"
                          <?php elseif($agent->statut == 1): ?>
                          value="0"
                          <?php endif; ?>>
                          <input required type="hidden" value="<?php echo e($agent->nom); ?>" name="nom">
                          <input required type="hidden" value="<?php echo e($agent->id); ?>" name="id">
                          <input required type="hidden" value="<?php echo e($agent->email); ?>" name="email">

              </div>
              <button type="submit" <?php if($agent->statut == 0): ?>
                class="btn btn-success"
                <?php elseif($agent->statut == 1): ?>
                class="btn btn-danger"
                <?php endif; ?>
                >
                <?php if($agent->statut == 0): ?>
                <?php echo e('Activé agent'); ?>

                <?php elseif($agent->statut == 1): ?>
                <?php echo e('Désactivé agent'); ?>

                <?php endif; ?>
              </button>
              </form>

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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/admission.croua2.ci/public_html/resources/views/layouts/liste-agent.blade.php ENDPATH**/ ?>