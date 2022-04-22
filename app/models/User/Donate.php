<?php

namespace Models\User;

use Illuminate\Database\Capsule\Manager as DB;
use Donate\PayPal\Paypal as Paypal;
use DB\Queries\CMS\User\DonateDB;
use Utils;

class Donate
{
    public $rowCount;
    public $res;
    public $errors = [];

    public function __construct()
    {
        $this->data = new Utils\Data;
        $this->paypal = new Paypal;
    }

    public function getOptions()
    {
        return DonateDB::getOptions();
    }

    public function getUserPoints($user)
    {
        return DonateDB::getUserPoints($user);
    }

    public function getRewardID()
    {
        return isset($_POST['RewardID']) ? $this->data->purify(trim($_POST['RewardID'])) : false;
    }

    public function getReward($id)
    {
        return DonateDB::getReward($id);
    }

    public function getBonus($id)
    {
        return DonateDB::getBonus($id);
    }

    public function getTotalReward($id)
    {
        $totalReward = $this->getReward($id) + $this->getBonus($id);
        return $totalReward;
    }

    public function getPrice($id)
    {
        DonateDB::getPrice($id);
    }

    public function getKey()
    {
        return isset($_GET['Key']) ? $this->data->urlSafeB64Decode($_GET['Key']) : false;
    }

    public function getType()
    {
        return isset($_GET['type']) ? $_GET['type'] : false;
    }

    public function getMethod()
    {
        return isset($_GET['method']) ? $_GET['method'] : false;
    }

    public function getHeader()
    {
        if ($_POST['toFriend'] == 'on') {
            $_GET['type'] = 'toFriend';
        } else {
            $_GET['type'] = 'normal';
        }
        return header('location: ../../../../user/donateProcess?Key=' . $this->data->urlSafeB64Encode($this->getRewardID()) . '&type=' . $_GET['type'].'&method=' . $_POST['SubmitBtn']);
    }

    public function getCryptoCheckout()
    {
        return COINBASE['options'][$this->getKey()];
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

    public function updateUserPoints($user, $currency, $points)
    {
        if (strtoupper($currency) == 'DP') {
            $update = DB::table(table('shUserData'))
                ->where('UserUID', $user)
                ->update(['Point' => $points]);
            } elseif (strtoupper($currency) == 'VIP') {
                $update = DB::table(table('shUserData'))
                    ->where('UserUID', $user)
                    ->update(['VipPoint' => $points]);
            }

        if ($update) {
            return true;
        }
    }

    public function addPaymentLog($user, $paid, $reward, $rewardCurrency, $email, $type, $method, $status = null, $transId = null, $tValKey = null)
    {
        //
        $stmt = DB::table(table('logPayments'))
        ->insert([
            'UserID' => $user,
            'Paid' => $paid,
            'Reward' => $reward,
            'RewardCurrency' => $rewardCurrency,
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
