<?php

namespace DB\Queries\Shaiya;

use Illuminate\Database\Capsule\Manager as DB;

class BossRecordsDB
{
   public static function getRecords($value)
   {
      $stmt    =  DB::table(table('logBossDeath'))
                     ->select('MobName', 'CharName', 'ActionTime')
                     ->where('MobID', $value)
                     ->limit(1)
                     ->orderBy('ActionTime', 'DESC')
                     ->get();
      return $stmt;
   }
}
