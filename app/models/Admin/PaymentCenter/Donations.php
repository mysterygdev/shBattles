<?php

namespace Models\Admin\PaymentCenter;

use Illuminate\Database\Capsule\Manager as DB;
use Utils;

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

    public function getDonationById($id)
    {
        $donation = DB::table(table('donateOptions'))
            ->select()
            ->where('RowID', $id)
            ->limit(1)
            ->get();
        return $donation;
    }

    public function getRewardById($id)
    {
        $reward = DB::table(table('donateOptions'))
            ->where('RowID', $id)
            ->value('Reward');
        return $reward;
    }

    public function getBonusById($id)
    {
        $bonus = DB::table(table('donateOptions'))
            ->where('RowID', $id)
            ->value('Bonus');
        return $bonus;
    }

    public function getPriceById($id)
    {
        $price = DB::table(table('donateOptions'))
            ->where('RowID', $id)
            ->value('Price');
        return $price;
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

    public function updateDonationById($id, $Reward, $Bonus, $Price)
    {
        try {
            $update = DB::table(table('donateOptions'))
            ->where('RowID', $id)
            ->update(['Reward' => $Reward, 'Bonus' => $Bonus, 'Price' => $Price]);
            echo 'Updated donation option '.$id .': Reward => '.$Reward.' Bonus => '.$Bonus.' Price => '.$Price;
        } catch (\Illuminate\Database\QueryException $e) {
            echo 'Donation option update failed.';
        } catch (\Exception $e) {
            echo 'Donation option update failed';
        }
    }

    public function deleteDonationById($id)
    {
        $donation = DB::table(table('donateOptions'))
            ->where('RowID', $id)
            ->delete();
        if ($donation) {
            return true;
        } else {
            return false;
        }
    }
}
