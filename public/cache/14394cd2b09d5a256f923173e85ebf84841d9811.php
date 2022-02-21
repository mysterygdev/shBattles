<!-- jQuery -->
<script src="/resources/themes/YouPlay/vendor/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Hexagon Progress -->
<script src="/resources/themes/YouPlay/vendor/bower_components/HexagonProgress/jquery.hexagonprogress.min.js"></script>
<!-- Bootstrap -->
<script src="/resources/themes/YouPlay/vendor/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Jarallax -->
<script src="/resources/themes/YouPlay/vendor/bower_components/jarallax/dist/jarallax.min.js"></script>
<!-- Smooth Scroll -->
<script src="/resources/themes/YouPlay/vendor/bower_components/smoothscroll-for-websites/SmoothScroll.js"></script>
<!-- Owl Carousel -->
<script src="/resources/themes/YouPlay/vendor/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>
<!-- Countdown -->
<script src="/resources/themes/YouPlay/vendor/bower_components/jquery.countdown/dist/jquery.countdown.min.js"></script>
<!-- Youplay -->
<script src="/resources/themes/YouPlay/js/youplay.min.js"></script>
<!-- Core JS -->
<script src="/resources/themes/core/js/Nv2.js"></script>
<!-- Init YouPlay -->
<script>
    if(typeof youplay !== 'undefined') {
        youplay.init({
            // enable parallax
            parallax:         true,

            // set small navbar on load
            navbarSmall:      false,

            // enable fade effect between pages
            fadeBetweenPages: true,

            // twitter and instagram php paths
            php: {
                twitter: './php/twitter/tweet.php',
                instagram: './php/instagram/instagram.php'
            }
        });
    }
</script>
<script type="text/javascript">
    $(".countdown").each(function() {
        $(this).countdown($(this).attr('data-end'), function(event) {
          $(this).text(
            event.strftime('%D days %H:%M:%S')
          );
        });
    })
</script>
<?php if($__env->yieldContent('index')==='rankings'): ?>
    <script src="/resources/themes/core/js/pagination/load_data.js" type=module></script>
    <script src="/resources/themes/core/js/pagination/rankings/load_rankings_data.js" type=module></script>
    <script src="/resources/themes/core/js/pagination/rankings/load_next_rankings_data.js" type=module></script>
    <script src="/resources/themes/core/js/rankings/pagination/load_search_rankings_data.js" type=module></script>
<?php endif; ?>
<?php /**PATH C:\laragon\www\shaiyabattles\resources\views/layouts/cms/scripts.blade.php ENDPATH**/ ?>