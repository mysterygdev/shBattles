<?php

namespace Models\Admin\Site\PvpRewards;

use Illuminate\Database\Capsule\Manager as DB;

class Rewards
{
    public function getRewards()
    {
        $rewards = DB::table(table('pvpRewards'))
            ->select()
            ->orderBy('RowID', 'ASC')
            ->get();
        return $rewards;
    }

    public function getRewardById($id)
    {
        $reward = DB::table(table('pvpRewards'))
            ->select()
            ->where('RewardID', $id)
            ->limit(1)
            ->get();
        return $reward;
    }

    public function getRewardTypeById($id)
    {
        $reward = DB::table(table('pvpRewards'))
            ->where('RewardID', $id)
            ->value('RewardType');
        return $reward;
    }

    public function getK1ReqById($id)
    {
        $reward = DB::table(table('pvpRewards'))
            ->where('RewardID', $id)
            ->value('K1Req');
        return $reward;
    }

    public function getPointsById($id)
    {
        $reward = DB::table(table('pvpRewards'))
            ->where('RewardID', $id)
            ->value('Points');
        return $reward;
    }

    public function doesRewardIdExist()
    {
        $res = DB::table(table('pvpRewards'))
            ->select('RewardID')
            ->orderBy('RewardID', 'DESC')
            ->limit(1)
            ->get();
        return $res;
    }

    public function createReward($id, $RewardType, $K1Req, $Points)
    {
        $stmt = DB::table(table('pvpRewards'))
            ->insert([
                'RewardID' => $id,
                'RewardType' => $RewardType,
                'K1Req' => $K1Req,
                'Points' => $Points
            ]);
        if ($stmt) {
            echo 'Reward: '.$id.' created successfully.';
        } else {
            echo 'Reward could not be created.';
        }
    }

    public function updateRewardById($id, $RewardType, $K1Req, $Points)
    {
        try {
            $update = DB::table(table('pvpRewards'))
            ->where('RewardID', $id)
            ->update(['RewardType' => $RewardType, 'K1Req' => $K1Req, 'Points' => $Points]);
            echo 'Updated Reward option '.$id .': RewardType => '.$RewardType.' K1Req => '.$K1Req.' Points => '.$Points;
        } catch (\Illuminate\Database\QueryException $e) {
            echo 'Reward option update failed.';
        } catch (\Exception $e) {
            echo 'Reward option update failed';
        }
    }

    public function deleteRewardById($id)
    {
        $reward = DB::table(table('pvpRewards'))
            ->where('RewardID', $id)
            ->delete();
        if ($reward) {
            return true;
        } else {
            return false;
        }
    }
}
