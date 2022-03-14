<?php

namespace App\Models\Admin\WebMall;

use Illuminate\Database\Capsule\Manager as DB;
use Classes\Utils as Utils;

class AddProduct
{
    public $errors = [];
    public $error = 0;
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
        $this->prod = isset($_POST["Prod"]) ? $_POST["Prod"] : false;
        $this->ItemID = isset($_POST['Prod']['ItemID']) ? ($_POST['Prod']['ItemID']) : false;
        $this->ItemCount = isset($_POST['Prod']['ItemCount']) ? ($_POST['Prod']['ItemCount']) : false;
        var_dump($_POST);
    }
    public function recursive_convert_array_to_obj($arr, $indexed=false)
    {
        #			echo '<pre>';
        #			var_dump($arr);
        #			echo LB;
        #			echo '</pre>';
        if (is_array($arr)) {
            $new_arr	=	array();
            foreach ($arr as $k=>$v) {
                if ($indexed==true) {
                    if (is_integer($k)) {
                        $new_arr['Index'][$k] = $this->recursive_convert_array_to_obj($v);
                    } else {
                        $new_arr[$k] = $this->recursive_convert_array_to_obj($v);
                    }
                } else {
                    $new_arr[$k] = $this->recursive_convert_array_to_obj($v);
                }
            }

            return (object)$new_arr;
        }

        # else maintain the type of $arr
        return $arr;
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
            $this->addProduct();
        }

        return $code;
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
        $count = count($this->ItemID);

        for ($x = 0; $x < $count; $x++) {
            if ($x <= 0) {
                $Main=1;
            } else {
                $Main=0;
            }
            $stmt = DB::table(table('products'))
            ->insert([
                'ProductCode' => $this->code,
                'ProductName' => $this->name,
                'ProductDesc' => $this->desc,
                'ProductCurrency' => 'dp',
                'ProductCost' => $this->cost,
                'ProductImage' => $this->image,
                'Category' => $this->category,
                'Tag' => $this->tag,
                'ItemID' => $this->ItemID[$x],
                'ItemCount' => $this->ItemCount[$x],
                'Main' => $Main
            ]);
        }

        if ($stmt) {
            $this->error = 0;
        } else {
            $this->error = 1;
        }

        if ($this->error == 0) {
            return true;
        } else {
            return false;
        }
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

    public function checkIfItemExists($itemId)
    {
        // check if item id exists in db
        $item = DB::table(table('shItems'))
            ->select('ItemName')
            ->where('ItemID', $itemId)
            ->get();

        //return $item;

        if (!$item->isEmpty()) {
            return true;
        } else {
            return false;
        }
    }

    public function checkErrors(): array
    {
        $this->checkIfImageIsSelected();
        if (empty($this->image)) {
            $this->errors[] .= 'You must select an image.';
        }
        if (empty($this->name)) {
            $this->errors[] .= 'You must enter a name for your product.';
        }
        if (strlen($this->desc) < 1) {
            $this->errors[] .= 'You must enter a description for your product.';
        }
        if (strlen($this->cost) < 1) {
            $this->errors[] .= 'You must enter a cost for your product.';
        } elseif (!is_numeric($this->cost)) {
            $this->errors[] .= 'Cost must be a number/integer.';
        }
        if (strlen($this->category) < 1) {
            $this->errors[] .= 'You must choose a category for your product.';
        }
        if ($this->category == 'n/a') {
            $this->errors[] .= 'You must choose a category for your product.';
        }
        if (strlen($this->tag) < 1) {
            $this->errors[] .= 'You must choose a tag for your product.';
        }
        if ($this->tag == 'n/a') {
            $this->errors[] .= 'You must choose a tag for your product.';
        }
        if ($this->tag == 'n/a') {
            $this->errors[] .= 'You must choose a tag for your product.';
        }
        if (empty($this->ItemID || count($this->ItemID) < 1)) {
            $this->errors[] .= 'You must add at least one item id.';
        }
        if (empty($this->ItemCount || count($this->ItemCount) < 1)) {
            $this->errors[] .= 'You must add at least one item count.';
        }
        $itemIdCount = count($this->ItemID);
        for ($x = 0; $x < $itemIdCount; $x++) {
            if (empty($this->ItemID[$x])) {
                $this->errors[] .= 'Item ID '.$x.' can not be empty.';
            } elseif (!is_numeric($this->ItemID[$x])) {
                $this->errors[] .= 'Item ID '.$x.' must be a number/integer.';
            } elseif (strlen($this->ItemID[$x]) < 4 || strlen($this->ItemID[$x]) > 6) {
                $this->errors[] .= 'Item ID '.$x.' can not be greater than 6 characters or less than 4 characters.';
            } elseif (($this->ItemID[$x]) > 255255) {
                $this->errors[] .= 'Item ID '.$x.' can not be greater than 255255.';
            } elseif (!$this->checkIfItemExists($this->ItemID[$x])) {
                $this->errors[] .= 'Item ID does not exist.';
            }
        }
        $itemCntCount = count($this->ItemCount);
        for ($x = 0; $x < $itemCntCount; $x++) {
            if (empty($this->ItemCount[$x])) {
                $this->errors[] .= 'Item Count '.$x.' can not be empty.';
            } elseif (!is_numeric($this->ItemCount[$x])) {
                $this->errors[] .= 'Item Count '.$x.' must be a number/integer.';
            } elseif (strlen($this->ItemCount[$x]) > 3) {
                $this->errors[] .= 'Item Count '.$x.' can not be greater than 3 characters.';
            } elseif (($this->ItemCount[$x]) > 255) {
                $this->errors[] .= 'Item Count '.$x.' can not be greater than 255.';
            }
        }
        /* foreach ($this->products as $product) {
        } */
        // add checks to make sure at least 1 input is added.
        return $this->errors;
    }
}
