<?php

namespace App\Models\Admin\Site\TieredSpender;

use Classes\Sys\LogSys;
use Illuminate\Database\Capsule\Manager as DB;

class Rewards
{
    public function __construct()
    {
        $this->db = new \Classes\DB\MSSQL;
    }

    public function getRewards()
    {
        $rewards = DB::table(table('tieredRewards'))
            ->select()
            ->orderBy('Tier', 'ASC')
            ->get();
        return $rewards;
    }

    public function getRewardById($id)
    {
        $reward = DB::table(table('tieredRewards'))
            ->select()
            ->where('RowID', $id)
            ->limit(1)
            ->get();
        return $reward;
    }

    public function getRewardValueById($id, $value)
    {
        $reward = DB::table(table('tieredRewards'))
            ->where('RowID', $id)
            ->value($value);
        return $reward;
    }

    public function doesRewardIdExist()
    {
        $res = DB::table(table('tieredRewards'))
            ->select('RowID')
            ->orderBy('RowID', 'DESC')
            ->limit(1)
            ->get();
        return $res;
    }

    public function updateRewardById($id, $RewardName, $RewardDesc, $RewardImage, $RewardItemID, $RewardQuantity, $Tier)
    {
        try {
            $update = DB::table(table('tieredRewards'))
            ->where('RowID', $id)
            ->update(['RewardName' => $RewardName, 'RewardDesc' => $RewardDesc, 'RewardImage' => $RewardImage, 'RewardItemID' => $RewardItemID, 'RewardQuantity' => $RewardQuantity, 'Tier' => $Tier]);
            echo 'Updated Reward option '.$id .': RewardName => '.$RewardName.' RewardDesc => '.$RewardDesc.' RewardImage => '.$RewardImage.' RewardItemID => '.$RewardItemID.' RewardQuantity => '.$RewardQuantity.' Tier => '.$Tier;
        } catch (\Illuminate\Database\QueryException $e) {
            echo 'Reward option update failed.';
        } catch (\Exception $e) {
            echo 'Reward option update failed';
        }
    }

    public function deleteRewardById($id)
    {
        $reward = DB::table(table('tieredRewards'))
            ->where('RowID', $id)
            ->delete();
        if ($reward) {
            return true;
        } else {
            return false;
        }
    }

    public function checkIfItemExists($itemId)
    {
        // check if item id exists in db
        $item = DB::table(table('shItems'))
            ->select('ItemName')
            ->where('ItemID', $itemId)
            ->get();

        //return $item;

        if (!$item->isEmpty()) {
            return true;
        } else {
            return false;
        }
    }

    public function loadImages()
    {
        $folder = 'resources/themes/core/images/shop_icons/';
        $filetype = '*.*';
        $files = glob($folder.$filetype);
        $total = count($files);
        $per_page = 50;
        $last_page = (int)($total / $per_page);
        if (isset($_GET["page"])  && ($_GET["page"] <=$last_page) && ($_GET["page"] > 0)) {
            $page = $_GET["page"];
            $offset = ($per_page + 1)*($page - 1);
        } else {
            //echo "Page out of range showing results for page one";
            $page=1;
            $offset=0;
        }
        $max = $offset + $per_page;
        if ($max>$total) {
            $max = $total;
        }

        //echo "Processsing page : $page offset: $offset max: $max total: $total last_page: $last_page";
        $this->show_pagination($page, $last_page);
        for ($i = $offset; $i< $max; $i++) {
            $file = $files[$i];
            $path_parts = pathinfo($file);
            $filename = $path_parts['basename'];
            echo '
                <a class="fancybox" rel="group" href="?img='.$filename.'">
                    <img class="galleryPhoto" src="/'.$file.'" alt="'.$filename.'">
                </a>
            ';
        }
        $this->show_pagination($page, $last_page);
    }

    public function show_pagination($current_page, $last_page)
    {
        echo '<div>';
        if ($current_page > 1) {
            echo ' <a href="?page='.($current_page-1).'"> &lt;&lt;Previous </a> ';
        }
        if ($current_page < $last_page) {
            echo ' <a href="?page='.($current_page+1).'"> Next&gt;&gt; </a> ';
        }
        echo '</div>';
    }

    public function createReward($RewardName, $RewardDesc, $RewardImage, $RewardItemID, $RewardQuantity, $Tier)
    {
        $stmt = DB::table(table('tieredRewards'))
            ->insert([
                'RewardName' => $RewardName,
                'RewardDesc' => $RewardDesc,
                'RewardImage' => $RewardImage,
                'RewardItemID' => $RewardItemID,
                'RewardQuantity' => $RewardQuantity,
                'Tier' => $Tier,
            ]);
        if ($stmt) {
            echo 'Reward: '.$RewardName.' for: '.$Tier.' created successfully.';
        } else {
            echo 'Reward could not be created.';
        }
    }
}
