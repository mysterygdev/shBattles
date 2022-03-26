<?php

namespace Classes\Shaiya;

/**
 * @author Brandon Gonzalez
 * @copyright Copyright (c) 2020, Brandon Gonzalez
 */

use Illuminate\Database\Capsule\Manager as DB;

class Guild
{
    // Get Methods

    public function getCharIdByName($name)
    {
        $res = DB::table(table('shCharData'))
              ->where('CharName', $name)
              ->value('CharID');
        return $res;
    }

    public function getGuildIdByCharId($id)
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

    public function getGuildNameByCharName($name)
    {
        $charId = $this->getCharIdByName($name);
        $guildId = $this->getGuildIdByCharId($charId);
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
