<?php

namespace App\Models\Admin\PaymentCenter;

use Illuminate\Database\Capsule\Manager as DB;
use Classes\Utils as Utils;

class Donations
{
    public function __construct()
    {
        $this->data = new Utils\Data;
    }

    public function getDonations()
    {
        $donations = DB::table(table('donateOptions'))
            ->select()
            ->orderBy('RowID', 'ASC')
            ->get();
        return $donations;
    }

    public function createDonation($reward, $price, $bonus = null)
    {
        $stmt = DB::table(table('donateOptions'))
            ->insert([
                'Reward' => $reward,
                'Bonus' => $bonus,
                'Price' => $price
            ]);
        if ($stmt) {
            echo 'Donation of Reward '.$reward.' created successfully.';
        } else {
            echo 'Donation could not be created.';
        }
    }
}
