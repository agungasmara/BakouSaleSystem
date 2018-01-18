<?php $__env->startSection('content'); ?>

    <div id="root_frontend">
        <router-view class="view"></router-view>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>