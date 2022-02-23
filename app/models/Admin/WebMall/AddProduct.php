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

        $query = glob(DIRS['ROOT'] . '/resources/themes/core/images/shop_icons/*.*');
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
        /* $url = $_SERVER['REQUEST_URI'];
        $folder = 'assets/Themes/Default/images/shop_icons/';
        $filetype = '*.*';
        $files = glob($folder . $filetype);
        $total = count($files);
        $per_page = 50; */
        $folder = 'resources/themes/core/images/shop_icons/';
        $filetype = '*.*';
        $files = glob($folder.$filetype);
        $total = count($files);
        $per_page = 50;
        $last_page = (int)($total / $per_page);
        if (isset($_GET["page"])  && ($_GET["page"] <=$last_page) && ($_GET["page"] > 0)) {
            $page = $_GET["page"];
            $offset = ($per_page + 1)*($page - 1);
        } else {
            //echo "Page out of range showing results for page one";
            $page=1;
            $offset=0;
        }
        $max = $offset + $per_page;
        if ($max>$total) {
            $max = $total;
        }

        //echo "Processsing page : $page offset: $offset max: $max total: $total last_page: $last_page";
        $this->show_pagination($page, $last_page);
        for ($i = $offset; $i< $max; $i++) {
            $file = $files[$i];
            $path_parts = pathinfo($file);
            $filename = $path_parts['filename'];
            echo '
                <a class="fancybox" rel="group" href="?img='.$filename.'">
                    <img class="galleryPhoto" src="/'.$file.'" alt="'.$filename.'">
                </a>
            ';
        }
        $this->show_pagination($page, $last_page);
    }

    public function show_pagination($current_page, $last_page)
    {
        echo '<div>';
        if ($current_page > 1) {
            echo ' <a href="?page='.($current_page-1).'"> &lt;&lt;Previous </a> ';
        }
        if ($current_page < $last_page) {
            echo ' <a href="?page='.($current_page+1).'"> Next&gt;&gt; </a> ';
        }
        echo '</div>';
    }
}
