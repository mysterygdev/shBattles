<?php

namespace App\Controllers\Admin;

use Framework\Core\CoreController as Controller;
use App\Models;
use Classes\Sys\LogSys;
use Classes\Utils;

class Webmall extends Controller
{
    public function __construct()
    {
        $this->data = new Utils\Data;
        $this->logSys = new LogSys;
        $this->session = new Utils\Session;
        $this->user = new Utils\User($this->session);
    }

    /* Post Methods */

    public function index()
    {
        $dataClass = new Utils\Data;

        $panels = new Utils\Panels;

        $data = [
            'user' => $this->user,
            'panels' => $panels,
            'data' => $dataClass,
        ];

        $this->view('pages/ap/index', $data);
    }

    public function addProduct()
    {
        $addProduct = $this->model(Models\Admin\WebMall\AddProduct::class);

        $data = [
            'user' => $this->user,
            'addProduct' => $addProduct,
            'logSys' => $this->logSys
        ];

        $this->view('pages/ap/webmall/addProduct', $data);
    }

    public function editProduct()
    {
        $editProduct = $this->model(Models\Admin\WebMall\EditProduct::class);

        $data = [
            'user' => $this->user,
            'editProduct' => $editProduct,
            'logSys' => $this->logSys
        ];

        $this->view('pages/ap/webmall/editProduct', $data);
    }

    public function manageProducts()
    {
        $manageProducts = $this->model(Models\Admin\WebMall\ManageProducts::class);

        $data = [
            'user' => $this->user,
            'manageProducts' => $manageProducts,
            'logSys' => $this->logSys
        ];

        $this->view('pages/ap/webmall/manageProducts', $data);
    }

    /* Post Methods */
}
