<?php

namespace Shaiya;

/**
 * @author Brandon Gonzalez
 * @copyright Copyright (c) 2020, Brandon Gonzalez
 */

use Illuminate\Database\Capsule\Manager as DB;

class Guild
{
    // Get Methods

    public static function getCharIdByName($name)
    {
        $res = DB::table(table('shCharData'))
              ->where('CharName', $name)
              ->value('CharID');
        return $res;
    }

    public static function getGuildIdByCharId($id)
    {
        //$id = $this->getCharIdByName($name);
        $res = DB::table(table('shGuildChars'))
              ->select('GuildID')
              ->where('CharID', $id)
              ->limit(1)
              ->get();
        if (!$res->isEmpty()) {
          return $res[0]->GuildID;
        } else {
          return null;
        }
    }

    public static function getGuildNameByCharName($name)
    {
        $charId = self::getCharIdByName($name);
        $guildId = self::getGuildIdByCharId($charId);
        $res = DB::table(table('shGuilds'))
              ->select('GuildName')
              ->where('GuildID', $guildId)
              ->limit(1)
              ->get();
        if (!$res->isEmpty()) {
          return $res[0]->GuildName;
        } else {
          return '';
        }
    }

    // Character Methods
}
