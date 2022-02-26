<?php

namespace App\Models\Server;

use Illuminate\Database\Capsule\Manager as DB;

class ServerInfo
{
    public $pOnline;
    public $AoL;
    public $UoF;

    public function __construct()
    {
        $this->db = new \Classes\DB\MSSQL;
    }

    public function serverStatus()
    {
        $LoginConn = @fsockopen(SERVER['ip'], SERVER['ports'][0], $errno, $errstr, 0.01);
        $GameConn = @fsockopen(SERVER['ip'], SERVER['ports'][1], $errno, $errstr, 0.01);
        echo '<p class="lead">Login Server: ';
        if ($LoginConn) {
            echo '<span style="color:lime" class="b">Online</span>';
        } else {
            echo '<span style="color:red" class="b">Offline</span></p>';
        }
        @fclose($LoginConn);
        echo '<p class="lead">Game Server: ';
        if ($GameConn) {
            echo '<span style="color:lime">Online</span>';
        } else {
            echo '<span style="color:red"">Offline</span></p>';
        }
        @fclose($GameConn);
    }

    public function playersOnline()
    {
        $sql = ('
                    SELECT COUNT(*) AS \'Players\',
                    (SELECT COUNT(*) FROM PS_GameData.dbo.Chars WHERE LoginStatus=? AND Family IN (0,1)) AS \'AoL\',
                    (SELECT COUNT(*) FROM PS_GameData.dbo.Chars WHERE LoginStatus=? AND Family IN (2,3)) AS \'UoF\'
                    FROM PS_GameData.dbo.Chars WHERE LoginStatus=?
        ');

        $res = DB::select(DB::raw($sql), [1, 0, 1, 1, 1]);
        foreach ($res as $fet) {
            $this->pOnline = $fet->Players;
            $this->AoL = $fet->AoL;
            $this->UoF = $fet->UoF;
        }
    }
}
