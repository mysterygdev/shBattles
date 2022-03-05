<!-- jQueryUI -->
<script src="/resources/jquery/ui/v1.12.1/js/jquery-v1.12.1.ui.js"></script>
<!-- Data Tables -->
<script src="/resources/jquery/addons/datatables/datatables.js"></script>
<!-- Tiny MCE -->
<script src="/resources/jquery/addons/tinymce/v4.9.0/js/tinymce.min.js"></script>
<script src="/resources/jquery/addons/tinymce/v4.9.0/js/init.tinymce.js"></script>
<!-- Tabs -->
<script src="/resources/jquery/addons/tabs/tabs.js"></script>
<!-- WZ ToolTip -->
<script src="/resources/themes/originals/js/wz_tooltip.js"></script>
<?php if($__env->yieldContent('index')==='rankings'): ?>
    <script src="/resources/themes/core/js/pagination/load_data.js" type=module></script>
    <script src="/resources/themes/core/js/pagination/rankings/load_rankings_data.js" type=module></script>
    <script src="/resources/themes/core/js/pagination/rankings/load_next_rankings_data.js" type=module></script>
    <script src="/resources/themes/core/js/rankings/pagination/load_search_rankings_data.js" type=module></script>
<?php endif; ?>
<?php /**PATH C:\laragon\www\originals\resources\views/layouts/cms/scripts.blade.php ENDPATH**/ ?>