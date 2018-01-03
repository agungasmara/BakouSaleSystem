
<!-- Le javascript
================================================== -->

<!-- Placed at the end of the document so the pages load faster -->
<script src="<?php echo e(url('assets/frontend/js/jquery/jquery-2.1.3.min.js')); ?>"></script>
<script src="<?php echo e(url('assets/frontend/bootstrap/js/bootstrap.min.js')); ?>"></script>
<!-- include footable plugin -->
<script src="<?php echo e(url('assets/frontend/js/footable.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(url('assets/frontend/js/footable.sortable.js')); ?>" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        $('.footable').footable();
    });
</script>
<script>
    // this script required for subscribe modal
    $(window).load(function () {
        // full load
        $('#modalAds').modal('show');
        $('#modalAds').removeClass('hide');
    });

</script>

<!-- include jqueryCycle plugin -->
<script src="<?php echo e(url('assets/frontend/js/jquery.cycle2.min.js')); ?>"></script>

<!-- include easing plugin -->
<script src="<?php echo e(url('assets/frontend/js/jquery.easing.1.3.js')); ?>"></script>

<!-- include  parallax plugin -->
<script type="text/javascript" src="<?php echo e(url('assets/frontend/js/jquery.parallax-1.1.js')); ?>"></script>

<!-- optionally include helper plugins -->
<script type="text/javascript" src="<?php echo e(url('assets/frontend/js/helper-plugins/jquery.mousewheel.min.js')); ?>"></script>

<!-- include mCustomScrollbar plugin //Custom Scrollbar  -->

<script type="text/javascript" src="<?php echo e(url('assets/frontend/js/jquery.mCustomScrollbar.js')); ?>"></script>

<!-- include icheck plugin // customized checkboxes and radio buttons   -->
<script type="text/javascript" src="<?php echo e(url('assets/frontend/plugins/icheck-1.x/icheck.min.js')); ?>"></script>

<!-- include grid.js // for equal Div height  -->
<script src="<?php echo e(url('assets/frontend/plugins/jquery-match-height-master/dist/jquery.matchHeight-min.js')); ?>"></script>
<script src="<?php echo e(url('assets/frontend/js/grids.js')); ?>"></script>

<!-- include carousel slider plugin  -->
<script src="<?php echo e(url('assets/frontend/js/owl.carousel.min.js')); ?>"></script>

<!-- include smoothproducts // product zoom plugin  -->
<script type="text/javascript" src="<?php echo e(url('assets/frontend/plugins/smoothproducts-master/js/smoothproducts.min.js')); ?>"></script>

<script type="text/javascript">
    /* wait for images to load */
    $(window).load(function () {
        $('.sp-wrap').smoothproducts();
    });
</script>

<!-- jQuery select2 // custom select   -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

<!-- include touchspin.js // touch friendly input spinner component   -->
<script src="<?php echo e(url('assets/frontend/js/bootstrap.touchspin.js')); ?>"></script>

<!-- include custom script for only homepage  -->
<script src="<?php echo e(url('assets/frontend/js/home.js')); ?>"></script>

<script src="<?php echo e(url('assets/frontend/js/grids.js')); ?>"></script>
<script src="<?php echo e(url('assets/frontend/js/enquire.min.js')); ?>"></script>
<!-- include custom script for site  -->
<script src="<?php echo e(url('assets/frontend/js/script.js')); ?>"></script>
<script>

</script>