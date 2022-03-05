<!-- jQuery -->
<script src="/resources/jquery/core/v1.12.4/jquery-v1.12.4.js"></script>
<!-- Popper -->
<script src="/resources/jquery/addons/popperjs/v1.14.3/popper.min.js"></script>
<!-- Bootstrap -->
<script src="/resources/jquery/addons/bootstrap/v3.3.5/bootstrap.min.js"></script>
<!-- Originals -->
<script src="/resources/themes/originals/js/Originals.js"></script>
<!-- Core JS -->
<script src="/resources/themes/core/js/Nv2.js"></script>
<?php if($__env->yieldContent('index')==='rankings'): ?>
    <script src="/resources/themes/core/js/pagination/load_data.js" type=module></script>
    <script src="/resources/themes/core/js/pagination/rankings/load_rankings_data.js" type=module></script>
    <script src="/resources/themes/core/js/pagination/rankings/load_next_rankings_data.js" type=module></script>
    <script src="/resources/themes/core/js/rankings/pagination/load_search_rankings_data.js" type=module></script>
<?php endif; ?>
<?php /**PATH C:\laragon\www\originals\resources\views/layouts/cms/javascript.blade.php ENDPATH**/ ?>