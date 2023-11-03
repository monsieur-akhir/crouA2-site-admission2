<?php $__env->startSection('content'); ?>
<div>        
    <div class="content-wrapper">
      <div class="row justify-content-md-center justify-content-md-center">
        <div class="col-md-12">
          <img style="display:block; margin-left: auto;margin-right: auto;" src="assets/images/logo.png" width="300px" class="mt-5" alt="">
    </div>
        <?php if($demande): ?>
        <div class="col-md-6">
          <?php if($demande->statut == 3): ?>
            <img src="assets/images/check.png" width="200px" class="mt-5 p-4" alt="">
          <?php else: ?>
          <?php endif; ?>
          <span class="mt-5">
              <h2>Resultat d'attribution de chambre</h2>
              <h3>
                Votre numéro identifiant CROU A2 : <b><?php echo e($demande->matricule_crou); ?></b>  <br><br>
                Votre date de naissance : <b><?php echo e($demande->date_naissance_etudiant); ?></b> <br><br>

                 <br><br>
                <?php if($demande->statut == 3): ?>
                    <h2>Félicitations le CROUA2 vous a attribué une chambre</h2>
                <?php else: ?>
                  <h2>Désolé votre demande n'a pas été accéptée</h2>
                <?php endif; ?>
               </h3>
                <br>
                Nous vous prions de vous rendre à la Direction du CROU Abidjan 2,sis à l’Université Nangui-Abrogoua -Villa N° 6, face à la Scolarité pour finaliser votre
                plus d'informations. <br>
          </span>
         
         
    </div>
    <?php else: ?>
      <h2>Demande introuvable </h2><br><br>
      Nous vous prions de vous rendre à la Direction du CROU Abidjan 2,sis à l’Université Nangui-Abrogoua -Villa N° 6, face à la Scolarité pour 
      toutes reclamations. <br>
    <?php endif; ?>
      
    </div>
  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/vps-8a0d3bf3.vps.ovh.net/public_html/resources/views/layouts/resultatconsultation.blade.php ENDPATH**/ ?>