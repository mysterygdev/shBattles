<?php

namespace App\Models\Admin\PaymentCenter;

use Illuminate\Database\Capsule\Manager as DB;
use Classes\Utils as Utils;

class Payments
{
    public function __construct()
    {
        $this->data = new Utils\Data;
    }

    public function getPayments()
    {
        $payments = DB::table(table('logPayments'))
          ->select()
          ->orderBy('PaymentDate', 'DESC')
          ->get();
        return $payments;
    }

    // search for specific payment, datatables??
}
