<!-- jQuery -->
<script src="{{DIRS['YP_THEME_PATH']}}/vendor/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Hexagon Progress -->
<script src="{{DIRS['YP_THEME_PATH']}}/vendor/bower_components/HexagonProgress/jquery.hexagonprogress.min.js"></script>
<!-- Bootstrap -->
<script src="{{DIRS['YP_THEME_PATH']}}/vendor/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Jarallax -->
<script src="{{DIRS['YP_THEME_PATH']}}/vendor/bower_components/jarallax/dist/jarallax.min.js"></script>
<!-- Smooth Scroll -->
<script src="{{DIRS['YP_THEME_PATH']}}/vendor/bower_components/smoothscroll-for-websites/SmoothScroll.js"></script>
<!-- Owl Carousel -->
<script src="{{DIRS['YP_THEME_PATH']}}/vendor/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>
<!-- Countdown -->
<script src="{{DIRS['YP_THEME_PATH']}}/vendor/bower_components/jquery.countdown/dist/jquery.countdown.min.js"></script>
<!-- Youplay -->
<script src="{{DIRS['YP_THEME_PATH']}}/js/youplay.min.js"></script>
<!-- Core JS -->
<script src="{{DIRS['CORE_THEME_PATH']}}/js/Nv2.js"></script>
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
@if ($__env->yieldContent('index')==='rankings')
    <script src="{{DIRS['CORE_THEME_PATH']}}/js/pagination/load_data.js" type=module></script>
    <script src="{{DIRS['CORE_THEME_PATH']}}/js/pagination/rankings/load_rankings_data.js" type=module></script>
    <script src="{{DIRS['CORE_THEME_PATH']}}/js/pagination/rankings/load_next_rankings_data.js" type=module></script>
@endif
