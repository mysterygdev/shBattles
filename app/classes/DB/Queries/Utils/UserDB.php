<?php
   Namespace DB\Queries\Utils;

   Use Illuminate\Database\Capsule\Manager as Eloquent;

   Class UserDB{
      public static function __get_UserData($SessionCookieCheck){
         $query   =  Eloquent::table(table('shUserData') . ' as [UM]')
                     ->select([
                        '[UM].UserUID',
                        '[UM].UserID',
                        '[UM].Pw',
                        '[UM].Point',
                        '[UM].Status',
                        '[UM].JoinDate',
                        '[UM].LeaveDate',
                        '[WP].DisplayName',
                        '[WP].PIN',
                        '[WP].Email',
                        '[WP].ActivationKey',
                        '[WP].UserIP',
                        '[WP].LoginStatus'])
                        ->join(table('webPresence') . ' as  [WP]', '[UM].UserID', '=', '[WP].UserID')
                        ->where('[UM].UserUID', $SessionCookieCheck)
                        ->limit(1)
                        ->get();

         return $query;
      }
   }
?>
