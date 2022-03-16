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
}
