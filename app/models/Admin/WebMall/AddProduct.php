<?php

namespace App\Models\Admin\WebMall;

use Classes\Utils as Utils;

class AddProduct
{
    public function __construct()
    {
        $this->data = new Utils\Data;
        $this->pagination = new Utils\Pagination;
    }

    public function getPagination()
    {
        $records_per_page = 15;
        $page = '';

        if (isset($decoded['page'])) {
            $page = $decoded['page'];
        } else {
            $page = 1;
        }

        $prevPage = $page - 1;
        $nextPage = $page + 1;

        $start_from = ($page - 1) * $records_per_page;
        $RankNum = ($page - 1) * $records_per_page;

        $query = glob(DIRS['PUBROOT'] . '/resources/themes/core/images/shop_icons/*.*');
        //echo $query;

        //$dir = DIRS['PUBROOT'] . '/resources/themes/core/images/shop_icons';
        //echo 'current directory: ' . dirname(__FILE__);
        //echo 'current directory: ' . DOC_ROOT;
        echo '<br>';
        /* if (is_dir($dir)) {
            echo 'is dir';
        } else {
            echo 'is not dir';
        } */
        //echo (count(glob("$dir/*")) === 0) ? 'Empty' : 'Not empty';

        $this->pagination->sp($query, $records_per_page, $prevPage, $nextPage, $page);
    }

    public function loadImages()
    {
        $url = $_SERVER['REQUEST_URI'];
        $folder = 'assets/Themes/Default/images/shop_icons/';
        $filetype = '*.*';
        $files = glob($folder . $filetype);
        $total = count($files);
        $per_page = 50;
    }
}
