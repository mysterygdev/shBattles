<?php

namespace DB\Queries\CMS\User;

use Illuminate\Database\Capsule\Manager as DB;

class DonateDB
{
   public static function getOptions()
   {
      $stmt    =  DB::table(table('donateOptions'))
                     ->select()
                     ->orderBy('Reward', 'ASC')
                     ->get();
      return $stmt;
   }

   public static function getUserPoints($user)
   {
      $stmt    =  DB::table(table('shUserData'))
                     ->where('UserUID', $user)
                     ->limit(1)
                     ->value('Point');
      return $stmt;
   }

   public static function getReward($id)
   {
      $stmt    =  DB::table(table('donateOptions'))
                     ->where('RowID', $id)
                     ->limit(1)
                     ->value('Reward');
      return $stmt;
   }

   public static function getBonus($id)
   {
      $stmt    =  DB::table(table('donateOptions'))
                     ->where('RowID', $id)
                     ->value('Bonus');
      return $stmt;
   }

   public static function getPrice($id)
   {
      $stmt    =  DB::table(table('donateOptions'))
                     ->select('Price')
                     ->where('RowID', $id)
                     ->limit(1)
                     ->value('Price');
      return $stmt;
   }
}
