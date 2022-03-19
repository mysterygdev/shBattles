<?php

namespace App\Controllers\Admin;

use Framework\Core\CoreController as Controller;
use App\Models as Models;
use Classes\Sys\LogSys;
use Classes\Utils as Utils;

class PaymentCenter extends Controller
{
    public function __construct()
    {
        $this->data = new Utils\Data;
        $this->logSys = new LogSys;
        $this->session = new Utils\Session;
        $this->user = new Utils\User($this->session);
    }

    public function payments()
    {
        $payments = $this->model(Models\Admin\PaymentCenter\Payments::class);

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'payments' => $payments
        ];

        $this->view('pages/ap/paymentCenter/payments', $data);
    }
}
