<?php

namespace App\Models\Admin\WebMall;

use Illuminate\Database\Capsule\Manager as DB;
use Classes\Utils as Utils;

class EditProduct
{
    public function __construct()
    {
        $this->data = new Utils\Data;
    }

    public function getProductID()
    {
        return $_GET['id'];
    }

    public function getProductById($id)
    {
        $product = DB::table(table('products'))
          ->select('ProductID', 'ProductCode', 'ProductName', 'ProductDesc', 'ProductCurrency', 'ProductCost', 'ProductImage', 'Category', 'Tag', 'ItemID', 'ItemCount', 'Main')
          ->where('Main', 1)
          ->where('ProductID', $id)
          ->get();
        return $product;
    }

    public function getProductName($id)
    {
        $name = DB::table(table('products'))
          ->select('ProductName')
          ->where('Main', 1)
          ->where('ProductID', $id)
          ->limit(1)
          ->get();
        return $name[0]->ProductName;
    }

    public function getProductByCode($code)
    {
        $product = DB::table(table('products'))
          ->select('ProductID', 'ProductCode', 'ProductName', 'ProductDesc', 'ProductCurrency', 'ProductCost', 'ProductImage', 'Category', 'Tag', 'ItemID', 'ItemCount', 'Main')
          ->where('Main', 1)
          ->where('ProductCode', $code)
          ->get();
        return $product;
    }

    public function getProductItemIds($id)
    {
        $items = DB::table(table('products'))
            ->select('ItemID', 'ItemCount')
            ->where('ProductID', $id)
            ->get();
        return $items;
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

    public function getProdValueById($id, $value)
    {
        $prod = DB::table(table('products'))
            ->where('ProductID', $id)
            ->value($value);
        return $prod;
    }

    public function updateProductById($id)
    {
        $name = isset($_POST['ProductName']) ? $this->data->purify(trim($_POST['ProductName'])) : false;
        $desc = isset($_POST['ProductDesc']) ? $this->data->purify(trim($_POST['ProductDesc'])) : false;
        $currency = isset($_POST['ProductCurrency']) ? $this->data->purify(trim($_POST['ProductCurrency'])) : false;
        $cost = isset($_POST['ProductCost']) ? $this->data->purify(trim($_POST['ProductCost'])) : false;
        //$image = isset($_POST['image']) ? $this->data->purify(trim($_POST['ProductCost'])) : false;
        $category = isset($_POST['category']) ? $this->data->purify(trim($_POST['category'])) : false;
        $tag = isset($_POST['tag']) ? $this->data->purify(trim($_POST['tag'])) : false;
        $ItemID = isset($_POST['Prod']['ItemID']) ? ($_POST['Prod']['ItemID']) : false;
        $ItemCount = isset($_POST['Prod']['ItemCount']) ? ($_POST['Prod']['ItemCount']) : false;
        if (
          $this->getProdValueById($id, 'ProductName') != $name ||
          $this->getProdValueById($id, 'ProductDesc') != $desc ||
          $this->getProdValueById($id, 'ProductCurrency') != $currency ||
          $this->getProdValueById($id, 'ProductCost') != $cost ||
          $this->getProdValueById($id, 'Category') != $category ||
          $this->getProdValueById($id, 'Tag') != $tag
        ) {
          echo 'lets do it';
        } else {
          echo 'No changes found. No update made.';
        }
    }
}
