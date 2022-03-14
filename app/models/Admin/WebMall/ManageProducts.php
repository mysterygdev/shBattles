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
}
