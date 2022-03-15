<?php

namespace App\Models\Admin\WebMall;

use Illuminate\Database\Capsule\Manager as DB;
use Classes\Utils as Utils;

class ManageProducts
{
    public function __construct()
    {
        $this->data = new Utils\Data;
    }

    public function getProducts()
    {
        $products = DB::table(table('products'))
          ->select('ProductID', 'ProductCode', 'ProductName', 'ProductDesc', 'ProductCurrency', 'ProductCost', 'ProductImage', 'Category', 'Tag', 'ItemID', 'ItemCount', 'Main')
          ->where('Main', 1)
          ->orderBy('ProductID')
          ->get();
        return $products;
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

    public function getProductByCode($code)
    {
        $product = DB::table(table('products'))
          ->select('ProductID', 'ProductCode', 'ProductName', 'ProductDesc', 'ProductCurrency', 'ProductCost', 'ProductImage', 'Category', 'Tag', 'ItemID', 'ItemCount', 'Main')
          ->where('Main', 1)
          ->where('ProductCode', $code)
          ->get();
        return $product;
    }

    public function deleteProductById($id)
    {
        $product = DB::table(table('products'))
          ->where('ProductID', $id)
          ->delete();
    }

    public function deleteProductByCode($code)
    {
        $product = DB::table(table('products'))
          ->where('ProductCode', $code)
          ->delete();
    }
}
