<?php

namespace Classes\Shaiya;

/**
 * @author Brandon Gonzalez
 * @copyright Copyright (c) 2020, Brandon Gonzalez
 */

use Illuminate\Database\Capsule\Manager as DB;

class Player
{
    // Get Methods

    // Character Methods
    public function getCharId($id)
    {
        // update: get char id by char name
        if (is_numeric($id)) {
            $res = DB::table(table('shCharData'))
              ->where('UserUID', $id)
              ->value('CharID');
        }
        $res = DB::table(table('shCharData'))
              ->where('UserID', $id)
              ->value('CharID');
        return $res;
    }

    public function getCharUID($id)
    {
        //
    }

    public function getCharUserID($id)
    {
        //
    }

    public function getCharName($id)
    {
        if (is_numeric($id)) {
            $res = DB::table(table('shCharData'))
              ->where('CharID', $id)
              ->value('CharName');
        } else {
            echo 'Identifier must be numeric for character id.';
        }
        return $res;
    }

    public function getCharSlot($id)
    {
        //
    }

    public function getCharClass($id)
    {
        //
    }

    public function getCharFamily($id)
    {
        //
    }

    public function getCharLevel($id)
    {
        if (is_numeric($id)) {
            $res = DB::table(table('shCharData'))
              ->where('CharID', $id)
              ->value('Level');
        } else {
            echo 'Identifier must be numeric for character id.';
        }
        return $res;
    }

    public function getCharStatpoint($id)
    {
        if (is_numeric($id)) {
            $res = DB::table(table('shCharData'))
              ->where('CharID', $id)
              ->value('StatPoint');
        } else {
            echo 'Identifier must be numeric for character id.';
        }
        return $res;
    }

    public function getCharSkillPoint($id)
    {
        if (is_numeric($id)) {
            $res = DB::table(table('shCharData'))
              ->where('CharID', $id)
              ->value('SkillPoint');
        } else {
            echo 'Identifier must be numeric for character id.';
        }
        return $res;
    }

    public function getCharMap($id)
    {
        if (is_numeric($id)) {
            $res = DB::table(table('shCharData'))
              ->where('CharID', $id)
              ->value('Map');
        } else {
            echo 'Identifier must be numeric for character id.';
        }
        return $res;
    }

    public function getCharMoney($id)
    {
        if (is_numeric($id)) {
            $res = DB::table(table('shCharData'))
              ->where('CharID', $id)
              ->value('Money');
        } else {
            echo 'Identifier must be numeric for character id.';
        }
        return $res;
    }

    public function getCharKills($id)
    {
        if (is_numeric($id)) {
            $res = DB::table(table('shCharData'))
              ->where('CharID', $id)
              ->value('K1');
        } else {
            echo 'Identifier must be numeric for character id.';
        }
        return $res;
    }

    public function getCharDeaths($id)
    {
        if (is_numeric($id)) {
            $res = DB::table(table('shCharData'))
              ->where('CharID', $id)
              ->value('K2');
        } else {
            echo 'Identifier must be numeric for character id.';
        }
        return $res;
    }

    public function getCharGuild($id)
    {
        //
    }

    // User Methods

    // Update Methods

    // Character Methods

    public function updateCharName($id)
    {
        //
    }

    public function updateCharLevel($id)
    {
        //
    }

    public function updateCharMap($id)
    {
        //
    }

    public function updateCharMoney($id)
    {
        //
    }

    public function updateCharKills($id)
    {
        //
    }

    public function updateCharDeaths($id)
    {
        //
    }

    // User Methods
}
