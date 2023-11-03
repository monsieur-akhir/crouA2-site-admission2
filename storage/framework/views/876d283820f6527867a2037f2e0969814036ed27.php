<?php $__env->startSection('content'); ?>
<div>        
    <div class="content-wrapper">
      <div class="row justify-content-md-center justify-content-md-center">
        <div class="col-md-6">
            <img src="assets/images/check.png" width="200px" class="mt-5 p-4" alt="">
            <span class="mt-5">
                <h2>Félicitations vous avez terminé votre demande</h2>
                <h4>
                  Votre numéro identifiant CROU A2 : <b><?php echo e($demande->matricule_crou); ?></b>  <br><br>
                  Votre date de naissance : <b><?php echo e($demande->date_naissance_etudiant); ?></b> <br><br>
                 
                  Merci de bien noter ces informations pour d'éventuelles modifications et la consultation des résultats. <br><br>
                  Un email vous a été envoyé , consultez votre boite email</h4><br>
                  Nous vous prions de vous rendre à la Direction du CROU Abidjan 2,sis à l’Université Nangui-Abrogoua -Villa N° 6, face à la Scolarité pour finaliser votre
                  inscription avec les pièces à joindre. <br>
            </span>
           
            <div class="row">
              <form action="ma-fiche-admission" method="post">
                <?php echo csrf_field(); ?>
                <input type="text" hidden name="matricule_crou" value="<?php echo e($demande->matricule_crou); ?>">
                <button  type="submit" class="btn btn-success btn-icon-text m-2">
                
                Télécharger ma fiche de demande
              </button>
              <a target="_blank" href="<?php echo e(asset('documents/FICHE_DENGAGEMENT.pdf')); ?>" class="btn btn-warning btn-icon-text m-2">
                
                Télécharger ma fiche d'engagement
              </a>
            </form>
            <?php if($demande->cite_id == null): ?>
              <form action="/trouver-fiche" method="get">
                
                <input required type="text" value="<?php echo e($demande->matricule_crou); ?>"  name="matricule_crou" hidden>
                <input required type="date" value="<?php echo e($demande->date_naissance_etudiant); ?>" name="date_naissance_etudiant" hidden>
                <button type="submit" class="btn btn-primary btn-icon-text m-2">
                  Modifier ma demande
                </button>
              </form>
            <?php endif; ?>
            </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/admission.croua2.ci/public_html/resources/views/layouts/success-readmission.blade.php ENDPATH**/ ?>