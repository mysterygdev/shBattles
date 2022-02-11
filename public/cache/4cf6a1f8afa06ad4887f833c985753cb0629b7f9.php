<!-- jQuery v3.3.1 -->
<script src="/resources/themes/indiega/js/jquery-3.3.1.min.js"></script>
<!-- Bootstrap JS -->
<script src="/resources/themes/indiega/js/bootstrap.min.js"></script>
<!-- Slider JS -->
<script src="/resources/themes/indiega/plugins/slider/js/n2-j.min.js"></script>
<script src="/resources/themes/indiega/plugins/slider/js/nextend-gsap.min.js"></script>
<script src="/resources/themes/indiega/plugins/plugins/slider/js/nextend-frontend.min.js"></script>
<script src="/resources/themes/indiega/plugins/slider/js/smartslider-frontend.min.js"></script>
<script src="/resources/themes/indiega/plugins/slider/js/smartslider-simple-type-frontend.min.js"></script>
<script src="/resources/themes/indiega/plugins/slider/js/nextend-webfontloader.min.js"></script>

<script src="/resources/themes/core/js/functions.js" type=module></script>
<?php if($__env->yieldContent('index')==='home' || $__env->yieldContent('index')==='news'): ?>
    <script src="/resources/themes/core/js/pagination/load_data.js" type=module></script>
    <script src="/resources/themes/core/js/pagination/news/load_news_data.js" type=module></script>
    <script src="/resources/themes/core/js/pagination/news/load_next_news_data.js" type=module></script>
<?php endif; ?>
<?php if($__env->yieldContent('index')==='patchNotes'): ?>
    <script src="/resources/themes/core/js/pagination/load_data.js" type=module></script>
    <script src="/resources/themes/core/js/pagination/patchNotes/load_patch_data.js" type=module></script>
    <script src="/resources/themes/core/js/pagination/patchNotes/load_next_patch_data.js" type=module></script>
<?php endif; ?>
<?php if($__env->yieldContent('index')==='view_topic'): ?>
    <script src="/resources/themes/core/js/forum_functions.js" type=module></script>
    <script src="/resources/themes/core/js/forum/pagination/load_data.js" type=module></script>
    <script src="/resources/themes/core/js/forum/pagination/load_topics_data.js" type=module></script>
    <script src="/resources/themes/core/js/forum/pagination/load_next_topics_data.js" type=module></script>
<?php endif; ?>
<?php if($__env->yieldContent('index')==='rankings'): ?>
    <script src="/resources/themes/core/js/pagination/load_data.js" type=module></script>
    <script src="/resources/themes/core/js/pagination/rankings/load_rankings_data.js" type=module></script>
    <script src="/resources/themes/core/js/pagination/rankings/load_next_rankings_data.js" type=module></script>
    <script src="/resources/themes/core/js/rankings/pagination/load_search_rankings_data.js" type=module></script>
<?php endif; ?>
<script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
<script src="https://js.stripe.com/v3/"></script>
<?php /**PATH C:\laragon\www\ShaiyaCMS\resources\views/layouts/cms/javascript.blade.php ENDPATH**/ ?>