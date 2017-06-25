<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>

    <div id="map"></div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('principal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>