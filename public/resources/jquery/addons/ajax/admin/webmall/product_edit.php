<?php
define('AJAX_CALL', true);
// Autoloader
require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/bootstrap.php';
$bootstrap = new  App\Bootstrap();
$bootstrap->isAjax();
use Illuminate\Database\Capsule\Manager as DB;

$data = new \Utils\Data;
$editProduct = new Models\Admin\WebMall\EditProduct;
//var_dump($_POST);
list($id) = explode('~', $_POST['id']);
if (isset($_POST)) {
    // update
    //var_dump($id);
    $name = isset($_POST['ProductName']) ? $data->purify(trim($_POST['ProductName'])) : false;
    $desc = isset($_POST['ProductDesc']) ? $data->purify(trim($_POST['ProductDesc'])) : false;
    $currency = isset($_POST['ProductCurrency']) ? $data->purify(trim($_POST['ProductCurrency'])) : false;
    $cost = isset($_POST['ProductCost']) ? $data->purify(trim($_POST['ProductCost'])) : false;
    //$image = isset($_POST['image']) ? $data->purify(trim($_POST['ProductCost'])) : false;
    $category = isset($_POST['category']) ? $data->purify(trim($_POST['category'])) : false;
    $tag = isset($_POST['tag']) ? $data->purify(trim($_POST['tag'])) : false;
    $ItemID = isset($_POST['Prod']['ItemID']) ? ($_POST['Prod']['ItemID']) : false;
    $ItemCount = isset($_POST['Prod']['ItemCount']) ? ($_POST['Prod']['ItemCount']) : false;

    $count = count($ItemID);
    $countDb = count($editProduct->getProductItemIds($id));

    /* var_dump($_POST);
    echo 'count item: '.$count.'<br>count db: '.$countDb;
    die; */

    $x = 0;
    if ($count == $countDb) {
        foreach ($editProduct->getProductItemIds($id) as $res) {
            echo ' Index: '.$x.' ID:'.$res->RowID;
            if ($res->Main == true) {
                $update = DB::table(table('products'))
                           ->where('RowID', $res->RowID)
                           ->update([
                              'ProductName' => $name,
                              'ProductDesc' => $desc,
                              'ProductCurrency' => $currency,
                              'ProductCost' => $cost,
                              'Category' => $category,
                              'Tag' => $tag,
                              'ItemID' => $ItemID[$x],
                              'ItemCount' => $ItemCount[$x],
                           ]);
            } else {
                $update = DB::table(table('products'))
                        ->where('RowID', $res->RowID)
                        ->update([
                           'ItemID' => $ItemID[$x],
                           'ItemCount' => $ItemCount[$x],
                           ]);
            }
            $x++;
        }
    } else {
        $prodId = null;

        $checkProductId = $editProduct->doesProductIdExist();

        if ($checkProductId->isEmpty()) {
            $prodId = 1;
        } else {
            if (!$checkProductId) {
                $prodId = 1;
            } else {
                $prodId = $checkProductId[0]->ProductID + 1;
            }
        }
        for ($i = $countDb; $i < $count+1; $i++) {
            $stmt = DB::table(table('products'))
                  ->insert([
                     'ProductID' => $prodId,
                     'ProductCode' => 'hfMGvHluqb',
                     'ItemID' => $ItemID[$i],
                     'ItemCount' => $ItemCount[$i],
                     'Main' => 0
                  ]);
        }
    }

    if ($count > $countDb) {
        $prodId = null;

        $checkProductId = $editProduct->doesProductIdExist();

        if ($checkProductId->isEmpty()) {
            $prodId = 1;
        } else {
            if (!$checkProductId) {
                $prodId = 1;
            } else {
                $prodId = $checkProductId[0]->ProductID + 1;
            }
        }
        $i = $countDb;
        echo 'i: '.$i;
        $stmt = DB::table(table('products'))
                  ->insert([
                     'ProductID' => $prodId,
                     'ProductCode' => 'hfMGvHluqb',
                     'ItemID' => $ItemID[$i],
                     'ItemCount' => $ItemCount[$i],
                     'Main' => 0
                  ]);
        $i++;
    }
    foreach ($editProduct->getProductItemIds($id) as $res) {
        //echo ' RowID: '.$res->RowID.' ItemID: '.$res->ItemID.' ItemCount: '.$res->ItemCount;
        /* if ($res->Main == true) {
            for ($x = 0; $x < $count; $x++) {
                $update = DB::table(table('products'))
                  ->where('RowID', $res->RowID)
                  ->update([
                     'ProductName' => $name,
                     'ProductDesc' => $desc,
                     'ProductCurrency' => $currency,
                     'ProductCost' => $cost,
                     'Category' => $category,
                     'Tag' => $tag,
                     'ItemID' => $ItemID[0],
                     'ItemCount' => $ItemCount[0],
                  ]);
            }
        } else {
            for ($x = 0; $x < $count; $x++) {
                echo 'HELLO';
                echo 'RowID: '.$res->RowID;
            }
            echo 'lets get it';
        } */
    }
}
