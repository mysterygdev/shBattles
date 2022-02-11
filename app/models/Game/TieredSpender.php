<?php

namespace App\Models\Game;

use Illuminate\Database\Capsule\Manager as DB;
use Classes\Utils as Utils;

class TieredSpender
{
    public $total = 0;
    public $tier = null;

    public function __construct()
    {
        $this->data = new \Classes\Utils\Data;
        $this->session = new Utils\Session;
        $this->user = new Utils\User($this->session);
        $this->user->run();
        $this->getTotal();
    }

    public function getPointArr()
    {
        $arr = [
            'Point1' => 999,
            'Point2' => 1999,
            'Point3' => 2999,
            'Point4' => 3999,
            'Point5' => 4999,
            'Point6' => 5999,
            'Point7' => 6999,
            'Point8' => 7999,
            'Point9' => 8999,
            'Point10' => 9999
        ];

        return $arr;
    }

    public function getTieredArr()
    {
        /* $arr = [
            'Tier1' => 1000,
            'Tier2' => 2000,
            'Tier3' => 3000,
            'Tier4' => 4000,
            'Tier5' => 5000,
            'Tier6' => 6000,
            'Tier7' => 7000,
            'Tier8' => 8000,
            'Tier9' => 9000,
            'Tier10' => 10000
        ]; */

        $arr = [
            'Tier1' => 1,
            'Tier2' => 2,
            'Tier3' => 3,
            'Tier4' => 4,
            'Tier5' => 5,
            'Tier6' => 6,
            'Tier7' => 7,
            'Tier8' => 8,
            'Tier9' => 9,
            'Tier10' => 10
        ];

        return $arr;
    }

    public function getTier($point)
    {
        switch ($point) {
            case 'Point1':
                return 1;
            case 'Point2':
                return 2;
            case 'Point3':
                return 3;
            case 'Point4':
                return 4;
            case 'Point5':
                return 5;
            case 'Point6':
                return 6;
            case 'Point7':
                return 7;
            case 'Point8':
                return 8;
            case 'Point9':
                return 9;
            case 'Point10':
                return 10;
        }
    }

    public function getUsedPoints()
    {
        $res = DB::table(table('shPointLog'))
            ->select()
            ->where('UserUID', $_SESSION['User']['UserUID'])
            ->get();
        return $res;
    }

    public function getTotal()
    {
        // make sure is logged in
        if ($this->user->isLoggedIn()) {
            foreach ($this->getUsedPoints() as $key => $value) {
                $this->total += $value->UsePoint;
            }
            return $this->total;
        }
    }

    public function isUnlocked()
    {
        if ($this->total > $this->getPointArr()['Point1']) {
            $this->addUnlockedClass('Point1');
        }
        if ($this->total > $this->getPointArr()['Point2']) {
            $this->addUnlockedClass('Point2');
        }
        if ($this->total > $this->getPointArr()['Point3']) {
            $this->addUnlockedClass('Point3');
        }
        if ($this->total > $this->getPointArr()['Point4']) {
            $this->addUnlockedClass('Point4');
        }
        if ($this->total > $this->getPointArr()['Point5']) {
            $this->addUnlockedClass('Point5');
        }
        if ($this->total > $this->getPointArr()['Point6']) {
            $this->addUnlockedClass('Point6');
        }
        if ($this->total > $this->getPointArr()['Point7']) {
            $this->addUnlockedClass('Point7');
        }
        if ($this->total > $this->getPointArr()['Point8']) {
            $this->addUnlockedClass('Point8');
        }
        if ($this->total > $this->getPointArr()['Point9']) {
            $this->addUnlockedClass('Point9');
        }
        if ($this->total > $this->getPointArr()['Point10']) {
            $this->addUnlockedClass('Point10');
        }
    }

    public function addUnlockedClass($point)
    {
        echo '<script>
            $(document).ready(function(){
                $(\'.' . $point . '\').addClass(\'bg-orange\');
            });
        </script>';
    }

    public function isRedeemed()
    {
        $res = DB::table(table('tieredSpender'))
            ->select()
            ->where('UserUID', $_SESSION['User']['UserUID'])
            ->get();
        foreach ($res as $key => $value) {
            $TierQuery = $value->Tier;
            $RedeemedQuery = $value->Redeemed;
            if ($TierQuery == $this->getTieredArr()['Tier1'] && $RedeemedQuery == 1) {
                $this->addRedeemedClass('Point1');
            }
            if ($TierQuery == $this->getTieredArr()['Tier2'] && $RedeemedQuery == 1) {
                $this->addRedeemedClass('Point2');
            }
            if ($TierQuery == $this->getTieredArr()['Tier3'] && $RedeemedQuery == 1) {
                $this->addRedeemedClass('Point3');
            }
            if ($TierQuery == $this->getTieredArr()['Tier4'] && $RedeemedQuery == 1) {
                $this->addRedeemedClass('Point4');
            }
            if ($TierQuery == $this->getTieredArr()['Tier5'] && $RedeemedQuery == 1) {
                $this->addRedeemedClass('Point5');
            }
            if ($TierQuery == $this->getTieredArr()['Tier6'] && $RedeemedQuery == 1) {
                $this->addRedeemedClass('Point6');
            }
            if ($TierQuery == $this->getTieredArr()['Tier7'] && $RedeemedQuery == 1) {
                $this->addRedeemedClass('Point7');
            }
            if ($TierQuery == $this->getTieredArr()['Tier8'] && $RedeemedQuery == 1) {
                $this->addRedeemedClass('Point8');
            }
            if ($TierQuery == $this->getTieredArr()['Tier9'] && $RedeemedQuery == 1) {
                $this->addRedeemedClass('Point9');
            }
            if ($TierQuery == $this->getTieredArr()['Tier10'] && $RedeemedQuery == 1) {
                $this->addRedeemedClass('Point10');
            }
        }
    }

    public function addRedeemedClass($point)
    {
        echo '<script>
            $(document).ready(function(){
                $(\'.' . $point . '\').removeClass(\'bg-orange\');
                $(\'.' . $point . '\').addClass(\'bg-lime\');
            });
        </script>';
    }

    public function getTierRewards($tier)
    {
        $res = DB::table(table('tieredRewards'))
            ->select()
            ->where('Tier', $tier)
            ->get();
        return $res;
    }

    public function getRewardsProgress()
    {
        $value = $this->getNextTier($this->getPointArr(), $this->total);
        $this->addRewardsClass($value);
    }

    public function getNextTier($array, $number)
    {
        foreach ($array as $key => $value) {
            if ($value >= $number) {
                return $key;
            }
        }
        return null;
    }

    public function addRewardsClass($tier)
    {
        echo '<script>
            $(document).ready(function(){
                $(\'.' . $tier . '\').addClass(\'bg-dodgerblue\');
            });
        </script>';
    }

    public function hasUserRedeemedTier($tier)
    {
        $res = DB::table(table('tieredSpender'))
            ->select()
            ->where('UserUID', $_SESSION['User']['UserUID'])
            ->where('Tier', $tier)
            ->where('Redeemed', 1)
            ->get();
        $rowCount = count($res);
        return $rowCount;
    }
}
