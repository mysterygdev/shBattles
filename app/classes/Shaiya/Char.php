<?php

namespace Shaiya;

/**
 * @author Brandon Gonzalez
 * @copyright Copyright (c) 2020, Brandon Gonzalez
 */

use Illuminate\Database\Capsule\Manager as DB;

class Char
{
    // Get Methods
    public static function getCharId($id)
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

    public static function getCharUID($id)
    {
        //
    }

    public static function getCharUserID($id)
    {
        //
    }

    public static function getCharName($id)
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

    public static function getCharSlot($id)
    {
        //
    }

    public static function getCharClass($id)
    {
        //
    }

    public static function getCharFamily($id)
    {
        //
    }

    public static function getCharLevel($id)
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

    public static function getCharStatpoint($id)
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

    public static function getCharSkillPoint($id)
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

    public static function getCharMap($id)
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

    public static function getCharMoney($id)
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

    public static function getCharKills($id)
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

    public static function getCharDeaths($id)
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

    public static function getCharGuild($id)
    {
        //
    }

    // Update Methods

    public static function updateCharName($id)
    {
        //
    }

    public static function updateCharLevel($id)
    {
        //
    }

    public static function updateCharMap($id)
    {
        //
    }

    public static function updateCharMoney($id)
    {
        //
    }

    public static function updateCharKills($id)
    {
        //
    }

    public static function updateCharDeaths($id)
    {
        //
    }
}
