<?php

namespace DB\Queries\Shaiya\Guilds;

use Illuminate\Database\Capsule\Manager as DB;

class GuildRankings
{
   public static function getGuilds()
   {
      $stmt   =  DB::table(table('shGuilds') . ' as [G]')
                        ->select()
                        ->join(table('shGuildDetails') . ' as  [GD]', '[GD].GuildID', '=', '[G].GuildID')
                        ->where('DEL', '0')
                        ->where('GuildPoint', '!=', '0')
                        ->limit(15)
                        ->orderBy('GuildPoint', 'DESC')
                        ->get();
      return $stmt;
   }
}
