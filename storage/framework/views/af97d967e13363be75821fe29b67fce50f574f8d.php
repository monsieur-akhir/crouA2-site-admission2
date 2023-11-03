<?php $__env->startSection('content'); ?>
<div>        
    <div class="content-wrapper">
      <div class="row justify-content-md-center justify-content-md-center">
        <div class="col-md-12">
            <img style="display:block; margin-left: auto;margin-right: auto;" src="assets/images/logo.png" width="300px" class="mt-5" alt="">
      </div>
      <div class="col-md-12">
        <h2 style="text-align: center">BIENVENUE SUR LE PORTAIL DE DEMANDE D’ADMISSION  EN RESIDENCE UNIVERSITAIRE</h2>
      </div>
      <hr>
      <a href="<?php echo e(url('demande')); ?>" style="background-color: #DA712A;color:white" class="btn btn-success btn-icon-text mr-1">
        
        Je veux faire ma demande
        </a>
      <button type="button" style="background-color: #3C2A45;color:white" data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-warning btn-icon-text  mr-1">
        
        Je veux modifier ma demande
      </button>
      
      <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-header" style="background-color: white">
                <h5 class="modal-title" id="exampleModalLabel">Modifier ma demande</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
          <div class="modal-content p-4">
              <form action="/trouver-fiche" method="get">
                
                <div class="row">
                    <div class="form-group col-md-12">
                        <label>IDENTIFIANT</label>
                        <input required style="text-transform:uppercase" type="text" class="form-control" name="matricule_crou"  placeholder="IDENTIFIANT">
                </div>
                    <div class="form-group col-md-12">
                        <label >DATE DE NAISSANCE</label>
                        <input required style="text-transform:lowercase" type="date" class="form-control" name="date_naissance_etudiant"  placeholder="DATE DE NAISSANCE">
                </div>
                </div>
                <button type="submit" class="btn btn-success">Rechercher</button>
              </form>
            
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/croua2.ci/public_html/resources/views/layouts/starter.blade.php ENDPATH**/ ?>