<!-- Footer -->
<?php echo $__env->make('partials.cms.divider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="row pattern-dark">
    <footer class="container footer">
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <nav class="footer-nav">
                    <ul>
                        <!-- items -->
                    </ul>
                </nav>
            </div>
            <div class="col-xs-12 col-sm-6">
                <nav class="social-nav">
                    <a href="#"><span class="ion-social-facebook"></span></a>
                    <a href="#"><span class="ion-social-twitter"></span></a>
                    <a href="#"><span class="ion-social-youtube"></span></a>
                    <a href="#"><span class="ion-social-instagram"></span></a>
                </nav>
            </div>
        </div>
        <div class="row">
            <p class="copyright"><?php echo APP['footer']; ?> <strong><?php echo APP['author']; ?></strong></p>
            <img height="95%"; width="95%"; src="/resources/themes/originals/images/blog-separator-3.png">
        </div>
    </footer>
</div>
<!-- /Footer -->
<?php /**PATH C:\laragon\www\originals\resources\views/layouts/cms/footer.blade.php ENDPATH**/ ?>