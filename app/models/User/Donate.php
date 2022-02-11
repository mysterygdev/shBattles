<?php

namespace App\Models\User;

use Illuminate\Database\Capsule\Manager as DB;
use Classes\Donate\PayPal\Paypal as Paypal;
use Classes\Utils as Utils;

class Donate
{
    public $rowCount;
    public $res;
    public $errors = [];

    public function __construct($session)
    {
        $this->data = new \Classes\Utils\Data;
        $this->session = $session;
        $this->paypal = new Paypal;
    }

    public function getOptions()
    {
        $res = DB::table(table('donateOptions'))
            ->select()
            ->orderBy('Reward', 'ASC')
            ->get();
        return $res;
    }

    public function getUserPoints($user)
    {
        $res = DB::table(table('shUserData'))
            ->select('Point')
            ->where('UserUID', $user)
            ->limit(1)
            ->get();
        return $res[0]->Point;
    }

    public function getRewardID()
    {
        return isset($_POST['RewardID']) ? $this->data->purify(trim($_POST['RewardID'])) : false;
    }

    public function getReward($id)
    {
        $res = DB::table(table('donateOptions'))
            ->select('Reward')
            ->where('RowID', $id)
            ->limit(1)
            ->get();
        return $res[0]->Reward;
    }

    public function getBonus($id)
    {
        $res = DB::table(table('donateOptions'))
            ->where('RowID', $id)
            ->value('Bonus');
        return $res;
    }

    public function getTotalReward($id)
    {
        $totalReward = $this->getReward($id) + $this->getBonus($id);
        return $totalReward;
    }

    public function getPrice($id)
    {
        // old way (messy)
        $res = DB::table(table('donateOptions'))
            ->select('Price')
            ->where('RowID', $id)
            ->limit(1)
            ->get();
        return $res[0]->Price;
        // new way (clean)
        /* $res = DB::table(table('donateOptions'))
            ->select('Price')
            ->where('RowID', $id)
            ->first();
        return $res->Price; */
        // other clean way
        /* $res = DB::table(table('donateOptions'))
            ->where('RowID', $id)
            ->value('Price');
        return $res; */
    }

    public function getKey()
    {
        return isset($_GET['Key']) ? $this->data->urlSafeB64Decode($_GET['Key']) : false;
    }

    public function getMethod()
    {
        return isset($_GET['method']) ? $_GET['method'] : false;
    }

    public function getHeader()
    {
        return header('location: ../../../../user/donateProcess?Key=' . $this->data->urlSafeB64Encode($this->getRewardID()) . '&method=' . $_POST['SubmitBtn']);
    }

    public function getDonateInfo($Key, $Method)
    {
        return $this->paypal->donateInfo($Key, $Method);
    }

    public function getLastPayment()
    {
        try {
            $res = DB::table(table('logPayments'))
                ->select()
                ->orderBy('PaymentDate', 'DESC')
                ->limit(1)
            ->get();
        } catch (\Exception $e) {
            return 'An error has occured.';
        }
        return $res;
    }

    public function updateUserPoints($user, $points)
    {
        $update = DB::table(table('shUserData'))
                ->where('UserUID', $user)
                ->update(['Point' => $points]);

        if ($update) {
            return true;
        }
    }

    public function addPaymentLog($user, $paid, $reward, $email, $type, $method, $status = null, $transId = null, $tValKey = null)
    {
        //
        $stmt = DB::table(table('logPayments'))
        ->insert([
            'UserID' => $user,
            'Paid' => $paid,
            'Reward' => $reward,
            'DonatorEmail' => $email,
            'PaymentStatus' => $status,
            'TransID' => $transId,
            'TransValidationKey' => $tValKey,
            'PaymentType' => $type,
            'PaymentMethod' => $method,
        ]);

        if ($stmt) {
            return true;
        }
    }
}
