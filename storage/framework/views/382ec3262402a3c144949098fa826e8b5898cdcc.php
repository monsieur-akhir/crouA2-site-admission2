<div>
    <h2>Bonjour <?php echo e($user->nom); ?>,</h2>
    <p> Votre compte est 
    <strong><?php echo e($user->otp); ?></strong>.
     Veuillez vous rendre sur (cliquez) 
     <a href="<?php echo e(url('/login')); ?>">
    <strong> admission croua2 </strong></a>
     pour vous connecter.</p>
</div><?php /**PATH /home/admin/web/vps-8a0d3bf3.vps.ovh.net/public_html/resources/views/emails/otp.blade.php ENDPATH**/ ?>