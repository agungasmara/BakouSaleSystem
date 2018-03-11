<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="{{url('assets/frontend/js/jquery/jquery-2.1.3.min.js')}}"></script>
<script src="{{url('assets/frontend/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- include footable plugin -->
<script src="{{url('assets/frontend/js/footable.js')}}" type="text/javascript"></script>
<script src="{{url('assets/frontend/js/footable.sortable.js')}}" type="text/javascript"></script>

<!-- include jqueryCycle plugin -->
<script src="{{url('assets/frontend/js/jquery.cycle2.min.js')}}"></script>

<!-- include easing plugin -->
<script src="{{url('assets/frontend/js/jquery.easing.1.3.js')}}"></script>

<!-- include  parallax plugin -->
<script type="text/javascript" src="{{url('assets/frontend/js/jquery.parallax-1.1.js')}}"></script>

<!-- optionally include helper plugins -->
<script type="text/javascript" src="{{url('assets/frontend/js/helper-plugins/jquery.mousewheel.min.js')}}"></script>

<!-- include mCustomScrollbar plugin //Custom Scrollbar  -->

<script type="text/javascript" src="{{url('assets/frontend/js/jquery.mCustomScrollbar.js')}}"></script>

<!-- include icheck plugin // customized checkboxes and radio buttons   -->
<script type="text/javascript" src="{{url('assets/frontend/plugins/icheck-1.x/icheck.min.js')}}"></script>

<!-- include grid.js // for equal Div height  -->
<script src="{{url('assets/frontend/plugins/jquery-match-height-master/dist/jquery.matchHeight-min.js')}}"></script>
<script src="{{url('assets/frontend/js/grids.js')}}"></script>

<!-- include carousel slider plugin  -->
<script src="{{url('assets/frontend/js/owl.carousel.min.js')}}"></script>

<!-- include smoothproducts // product zoom plugin  -->
<script type="text/javascript" src="{{url('assets/frontend/plugins/smoothproducts-master/js/smoothproducts.min.js')}}"></script>
<!-- jQuery select2 // custom `   -->
<script src="{{url('assets/frontend/js/select2.min.js')}}"></script>

<!-- include touchspin.js // touch friendly input spinner component   -->
<script src="{{url('assets/frontend/js/bootstrap.touchspin.js')}}"></script>

<!-- include custom script for only homepage  -->
<script src="{{url('assets/frontend/js/home.js')}}"></script>

<script src="{{url('assets/frontend/js/grids.js')}}"></script>
<script src="{{url('assets/frontend/js/enquire.min.js')}}"></script>
<!-- include pace script for automatic web page progress bar  -->
<script>
    paceOptions = {
        elements: true
    };
</script>
<script src="{{url('assets/frontend/js/pace.min.js')}}"></script>

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
<script type="text/javascript">
    /* wait for images to load */
    $(window).load(function () {
        $('.sp-wrap').smoothproducts();
    });
</script>

<!-- Rating -->
<script type="text/javascript" src="{{url('assets/frontend/plugins/rating/bootstrap-rating.min.js')}}"></script>
<script>
    $(function () {

        $('.rating-tooltip-manual').rating({
            extendSymbol: function () {
                var title;
                $(this).tooltip({
                    container: 'body',
                    placement: 'bottom',
                    trigger: 'manual',
                    title: function () {
                        return title;
                    }
                });
                $(this).on('rating.rateenter', function (e, rate) {
                    title = rate;
                    $(this).tooltip('show');
                })
                .on('rating.rateleave', function () {
                    $(this).tooltip('hide');
                });
            }
        });

    });
</script>

<!-- include custom script for site  -->
<script src="{{url('assets/frontend/js/script.js')}}"></script>