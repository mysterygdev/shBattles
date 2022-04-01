<?php

namespace Models\Admin\PaymentCenter;

use Illuminate\Database\Capsule\Manager as DB;
use Utils;

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
            ->orderBy('PaymentDate', 'ASC')
            ->get();
        return $payments;
    }
}
