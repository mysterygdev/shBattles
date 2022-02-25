<?php

namespace App\Models\Admin\WebMall;

use Illuminate\Database\Capsule\Manager as DB;
use Classes\Utils as Utils;

class AddProduct
{
    private $errors = [];
    //TODO: MAKE SURE ITEMID/ITEMCOUNT IS NOT EMPTY.. ITS IN ARRAY.. FIGURE IT OUT
    public function __construct()
    {
        $this->data = new Utils\Data;
        $this->pagination = new Utils\Pagination;
        $this->code = $this->getRandomString();
        $this->image = null;
        $this->name = isset($_POST['ProductName']) ? $this->data->purify(trim($_POST['ProductName'])) : false;
        $this->desc = isset($_POST['ProductDesc']) ? $this->data->purify(trim($_POST['ProductDesc'])) : false;
        $this->cost = isset($_POST['ProductCost']) ? $this->data->purify(trim($_POST['ProductCost'])) : false;
        $this->category = isset($_POST['category']) ? $this->data->purify(trim($_POST['category'])) : false;
        $this->tag = isset($_POST['tag']) ? $this->data->purify(trim($_POST['tag'])) : false;
        $this->products = isset($_POST['Products']) ? ($_POST['Products']) : false;
        var_dump($_POST['Products'][0]['Items']);
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

    public function addProduct()
    {
        $code = $this->getRandomString();
        if ($this->doesProductCodeExists($code)) {
            echo 'code already exists';
            echo $code;
            $newCode = $this->getRandomString();
        } else {
            echo 'code doesnt exist';
        }
    }

    public function getRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_-';
        $string = '';

        for ($i = 0; $i < $length; $i++) {
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }

        return $string;
    }

    public function doesProductCodeExists($code)
    {
        $code = DB::table(table('products'))
            ->select('ProductCode')
            ->where('ProductCode', $code)
            ->get();
        if ($code->isEmpty()) {
            return 0;
        } else {
            return 1;
        }
    }

    public function insertProduct()
    {
        //
    }

    public function checkIfImageIsSelected()
    {
        if (isset($_GET['img'])) {
            if ($_GET['img']) {
                $img    =   $_GET['img'];
                $this->image = $img;
            }
        }
    }

    public function checkErrors(): array
    {
        $this->checkIfImageIsSelected();
        if (empty($this->image)) {
            $this->errors[] .= 'You must select an image.';
        } elseif (empty($this->name)) {
            $this->errors[] .= 'You must enter a name for your product.';
        } elseif (strlen($this->desc) < 1) {
            $this->errors[] .= 'You must enter a description for your product.';
        } elseif (strlen($this->cost) < 1) {
            $this->errors[] .= 'You must enter a cost for your product.';
        } elseif (strlen($this->category) < 1) {
            $this->errors[] .= 'You must choose a category for your product.';
        } elseif ($this->category == 'n/a') {
            $this->errors[] .= 'You must choose a category for your product.';
        } elseif (strlen($this->tag) < 1) {
            $this->errors[] .= 'You must choose a tag for your product.';
        } elseif ($this->tag == 'n/a') {
            $this->errors[] .= 'You must choose a tag for your product.';
        } elseif ($this->tag == 'n/a') {
            $this->errors[] .= 'You must choose a tag for your product.';
        } elseif (empty($this->products)) {
            $this->errors[] .= 'You must add at least one item id.';
        }
        foreach ($this->products as $product) {
        }
        // add checks to make sure at least 1 input is added.
        return $this->errors;
    }
}
