<?php $__env->startPush('scripts'); ?>
<script>
  $('#add_palier_form').submit(function(event) {
     event.preventDefault();
     // alert('bam');
     let libelle = $("#libelle").val();
     let batiment_id = $("#batiment_id").val();
     let _token = $("input[name=_token]").val();
     //alert(telephone);
     if (libelle == '' || libelle === undefined) {
       $('#response').append("<div  class='alert alert-danger text-center'>Veuillez saisir le libellé<button type='button' class='close text-danger' data-dismiss='alert' aria-hidden='true'>×</button></div></div>")
     } else if (batiment_id == '' || batiment_id === undefined) {
       $('#response').append("<div  class='alert alert-danger text-center'>Veuillez sélectionner le bâtiment<button type='button' class='close text-danger' data-dismiss='alert' aria-hidden='true'>×</button></div></div>")
     }else {

       $.ajax({
         type: "POST",
         url: "<?php echo e(route('add-palier')); ?>",
         data: {
           batiment_id: batiment_id,
           libelle: libelle,
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
             //$(".message").html('');
             //$("#inscription_form")[0].reset();
             location.reload();
           }
         }
       });
     }
   });

   function updatePalier(id){
   event.preventDefault();

   let libelle = $("#libelle"+id+"").val();
   let batiment_id = $("#batiment_id"+id+"").val();
   let palier_id = id;
   let _token = $("input[name=_token]").val();

  // alert(libelle + ' / ' + chambre_id + ' / ' + lit_id);
   if (libelle == '' || libelle === undefined) {
     $('.response').append("<div  class='alert alert-danger text-center'>Veuillez saisir le libellé<button type='button' class='close text-danger' data-dismiss='alert' aria-hidden='true'>×</button></div></div>")
   } else if (batiment_id == '' || batiment_id === undefined) {
     $('.response').append("<div  class='alert alert-danger text-center'>Veuillez sélectionner la chambre<button type='button' class='close text-danger' data-dismiss='alert' aria-hidden='true'>×</button></div></div>")
   } else {

     $.ajax({
       type: "POST",
       url: "<?php echo e(route('update-palier')); ?>",
       data: {
         batiment_id: batiment_id,
         libelle: libelle,
         id: palier_id,
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
<?php $__env->stopPush(); ?>
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
              <h4 class="card-title">Les paliers </h4>
              <div class="text-right">
                <button type="button" style="background-color: #3C2A45;color:white" data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-warning btn-icon-text">
                  <i class="btn-icon-prepend"></i>
                  Ajouter un palier
                </button>
              </div>
              <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                  <div class="modal-header" style="background-color: white">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter un palier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-content p-4">
                    <form id="add_palier_form" method="POST">
                      <?php echo csrf_field(); ?>
                      <div id="response"></div>
                      <div class="row">
                        <div class="form-group col-md-12">
                          <label>Bâtiment</label><br>
                          <select class="form-control select2" style="width: 100%" name="batiment_id" id="batiment_id" required>
                            <?php $__currentLoopData = $batiments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $batiment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($batiment->id); ?>"> <?php echo e($batiment->libelle); ?> - <?php echo e($batiment->cite->libelle); ?> </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
                        </div>
                        <div class="form-group col-md-12">
                          <label>Libelle palier</label>
                          <input required style="text-transform:lowercase" type="text" class="form-control" name="libelle" id="libelle">
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
                      <th>Palier</th>
                      <th>Bâtiment</th>
                      <th>Cité</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $__currentLoopData = $paliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $palier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td><?php echo e($palier->libelle); ?></td>
                      <td><?php echo e($palier->batiment->libelle); ?></td>
                      <td><?php echo e($palier->batiment->cite->libelle); ?></td>
                      <td>
                        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal<?php echo e($palier->id); ?>">
                          Modifier
                        </button>
                      </td>
                      <!-- Modal -->
                      <div id="myModal<?php echo e($palier->id); ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">Modifier le palier
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title"></h4>
                            </div>
                            <div class="modal-body">
                              <form>
                                <?php echo csrf_field(); ?>
                                <div class="response"></div>
                                <div class="row">
                                  <div class="form-group col-md-12">
                                    <label>Bâtiment</label><br>
                                    <select class="form-control select2" style="width: 100%" name="batiment_id<?php echo e($palier->id); ?>" id="batiment_id<?php echo e($palier->id); ?>" required>
                                      <?php $__currentLoopData = $batiments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $batiment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <option value="<?php echo e($batiment->id); ?>" <?php if($palier->batiment_id == $batiment->id ): ?> <?php echo e('selected=selected'); ?> <?php endif; ?>>
                                      <?php echo e($batiment->libelle); ?> - <?php echo e($batiment->cite->libelle); ?>

                                      </option>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>

                                  </div>
                                  <div class="form-group col-md-12">
                                    <label>Libelle palier</label>
                                    <input required type="text" value="<?php echo e($palier->libelle); ?>" class="form-control" name="libelle<?php echo e($palier->id); ?>" id="libelle<?php echo e($palier->id); ?>">
                                  </div>
                                </div>
                                <div class="modal-footer" style="background-color: white">

                                  <button onclick="updatePalier('<?php echo e($palier->id); ?>')" class="btn btn-primary">Enregistrer</button>
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>

                              </form>

                            </div>

                          </div>

                        </div>
                      </div>
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
<?php echo $__env->make('index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/croua2.ci/public_html/resources/views/layouts/palier.blade.php ENDPATH**/ ?>