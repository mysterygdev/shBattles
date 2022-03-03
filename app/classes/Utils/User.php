<?php

namespace Classes\Utils;

use Classes\DB\MSSQL;
use Illuminate\Database\Capsule\Manager as DB;

class User
{
    // SQL
    private $sql;
    private $stmt;
    private $res;
    private $fet;
    // Account Info - Shared
    public $AdminLevel;
    public $Country;
    public $DisplayName;
    public $DOB;
    public $Faction;
    public $Email;
    public $JoinDate;
    public $LeaveDate;
    public $LoginStatus;
    public $Point;
    public $RegDate;
    public $Status;
    public $UseQueue;
    public $UserUID;
    public $UserID;
    public $UserIP;
    public $is_staff = [
        '16',
        '32',
        '48',
        '64',
        '80',
        '128'
    ];

    // Status
    private $memberLevel;
    const STATUS_ADM = 16,STATUS_GM = [32, 48],STATUS_GMA = [64, 80],STATUS_GS = 128;
    // Session
    public $LoginGuest;
    // Other
    public $MapID;

    public function __construct($session)
    {
        $this->session = $session;
        $this->run();
    }

    public function run()
    {
        //Session::flush();
        if (isset($_SESSION) && isset($_SESSION['User']['UserUID']) || isset($_COOKIE['stayLoggedIn'])) {
            $SessionCookieCheck = isset($_COOKIE['stayLoggedIn']) ? $_COOKIE['UserUID'] : $_SESSION['User']['UserUID'];
            $query = DB::table(table('shUserData') . ' as [UM]')
                    ->select(['[UM].UserUID', '[UM].UserID', '[UM].Pw', '[UM].Point', '[UM].Status', '[UM].JoinDate', '[UM].LeaveDate', '[WP].DisplayName', '[WP].PIN', '[WP].Email', '[WP].ActivationKey', '[WP].UserIP', '[WP].LoginStatus'])
                    ->join(table('webPresence') . ' as  [WP]', '[UM].UserID', '=', '[WP].UserID')
                    ->where('[UM].UserUID', $SessionCookieCheck)
                    ->limit(1)
                    ->get();

            foreach ($query as $fet) {
                // Shaiya Data
                $this->JoinDate = $fet->JoinDate;
                $this->LeaveDate = $fet->LeaveDate;
                $this->Point = $fet->Point;
                $this->LoginStatus = $fet->LoginStatus;

                // Web Presence
                $this->DisplayName = $fet->DisplayName;
                $this->Email = $fet->Email;
                $this->Status = $fet->Status;
                $this->UserID = $fet->UserID;
                $this->UserIP = $fet->UserIP;
                $this->UserUID = $fet->UserUID;
            }

            // Cleanup
            $this->sql = null;
            $this->fet = null;
            $this->res = null;
        }

        $this->isLoggedIn();
        //self::initPasswordHash();
    }

    public function getData($data)
    {
        if ($this->$data) {
            return $this->$data;
        } else {
            die('<b>Class (' . get_class($this) . '):</br><br>The requested var, <b>' . $data . '</b>, couldn\'t be found.');
        }
    }

    public function isStaff()
    {
        if (isset($this->Status)) {
            switch ($this->Status) {
                case '16':
                    $this->memberLevel = 'ADM';
                    return true;
                break;
                case '32':
                    $this->memberLevel = 'GM';
                    return true;
                break;
                case '48':
                    $this->memberLevel = 'GM';
                    return true;
                break;
                case '64':
                    $this->memberLevel = 'GMA';
                    return true;
                break;
                case '80':
                    $this->memberLevel = 'GMA';
                    return true;
                break;
                case '128':
                    $this->memberLevel = 'GS';
                    return true;
                break;
            }
        }

        return false;
    }

    public function isADM(): bool
    {
        if ($this->Status == self::STATUS_ADM) {
            return true;
        }
        return false;
    }

    public function isGM(): bool
    {
        if (in_array($this->Status, self::STATUS_GM)) {
            return true;
        }
        return false;
    }

    public function isGMA(): bool
    {
        if (in_array($this->Status, self::STATUS_GMA)) {
            return true;
        }
        return false;
    }

    public function isGS(): bool
    {
        if ($this->Status == self::STATUS_GS) {
            return true;
        }
        return false;
    }

    public function isLoggedIn(): bool
    {
        if (!empty($this->UserUID) && !empty($this->UserID) && is_numeric($this->UserUID)) {
            $this->LoginStatus = true;
            return true;
        } else {
            $this->LoginStatus = false;
            return false;
        }
    }

    public function auth()
    {
        die('Fix me');
        if (!$this->isLoggedIn()) {
            header('location: /ap');
            die();
        }
    }

    public function authADM()
    {
        die('Fix me');
        if (!$this->isADM()) {
            header('location: /ap');
            die();
        }
    }

    public function authStaff()
    {
        die('Fix me');
        if (!$this->isStaff()) {
            header('location: /ap');
            die();
        }
    }

    public function accessCheck()
    {
        if ($this->isLoggedIn()) {
            if (!$this->isStaff()) {
                //Template::doACP_Head("","",false,"12","Access Denied!");
                return '<span style="color:red">Sorry, you don\'t have permission to access this website!</span>';
                //Template::doACP_Foot();
            }
        }
    }

    public function isAuthorized(): bool
    {
        if ($this->isLoggedIn()) {
            if ($this->isStaff()) {
                return true;
            }
        }
        return false;
    }

    public function getUserStatus(): string
    {
        return $this->Status;
    }

    public function getStatus(int $Status): string
    {
        switch ($Status) {
            case 0:
                return 'Player';
            case 16:
                return 'Administrator';
            case 32:
                return 'GameMaster';
            case 48:
                return 'GameMaster';
            case 64:
                return 'GameMaster Assistant';
            case 80:
                return 'GameMaster Assistant';
            case 128:
                return 'GameSage';
            case -1:
                return 'Banned';
            case -5:
                return 'Permanently Banned';
            default:
                return 'Player';
        }
    }

    public function getStatusColor(int $Status): string
    {
        switch ($Status) {
            case 0:
                return 'Player';
            case 16:
                return '<span class="fw_bold" style="color:#FF0000;">Administrator</span>';
            case 32:
                return 'GameMaster';
            case 48:
                return 'GameMaster';
            case 64:
                return 'GameMaster Assistant';
            case 80:
                return 'GameMaster Assistant';
            case 128:
                return 'GameSage';
            case -1:
                return 'Banned';
            case -5:
                return 'Permanently Banned';
            default:
                return 'Player';
        }
    }

    public function getLoginStatus($status)
    {
        switch ($status) {
            case 0:
                return 'Offline';
            case 1:
                return 'Online';
        }
    }

    public function getUserFaction($user)
    {
        $faction = DB::table(table('shUmg'))
                        ->where('UserUID', $user)
                        ->value('Country');
        return $faction;
    }

    public function getFaction(int $Faction): string
    {
        switch ($Faction) {
            case 0:
                return 'Alliance of Light';
            case 1:
                return 'Union of Fury';
        }
    }

    public function getFactionName(int $Faction): string
    {
        switch ($Faction) {
            case 0:
                return 'Alliance of Light';
            case 1:
                return 'Union of Fury';
        }
    }

    public function getClass(int $Faction, int $Class): string
    {
        if ($Faction == 0) {
            switch ($Class) {
                case 0:
                    return 'Fighter';
                case 1:
                    return 'Defender';
                case 2:
                    return 'Archer';
                case 3:
                    return 'Ranger';
                case 4:
                    return 'Mage';
                case 5:
                    return 'Priest';
            }
        } else {
            switch ($Class) {
                case 0:
                    return 'Warrior';
                case 1:
                    return 'Guardian';
                case 2:
                    return 'Hunter';
                case 3:
                    return 'Assassin';
                case 4:
                    return 'Pagan';
                case 5:
                    return 'Oracle';
            }
        }
    }

    public function getMap(int $id)
    {
        return MAPS[$id] ?? 'Unknown';
    }

    public function fetchUser(): array
    {
        return get_class_vars(get_called_class());
    }

    public function checkUserFlags()
    {
        $sql = ('
					SELECT TOP 1 * FROM ShaiyaCMS.dbo.FORUM_USER_PERMS WHERE [User] = :user
			');
        MSSQL::query($sql);
        MSSQL::bind(':user', $_SESSION['User']['UserID']);
        $res = MSSQL::single();
        $this->userFlags = $res->Perms;
        $this->userFlags = explode('~', $res->Perms);
        ;
    }

    public function initPasswordHash(int $type, string $user = null)
    {
        // 1 = all
        // 2 = specific user
        if ($type == 1) {
        } elseif ($type == 2) {
            $query = DB::table(table('webPresence') . ' as [W]')
            ->select(['[W].UserUID', '[W].UserID', '[U].PwPlain', '[W].Pw'])
            ->join(table('shUserData') . ' as  [U]', '[W].UserID', '=', '[U].UserID')
            ->where('[U].UserID', $user)
            ->limit(1)
            ->get();

            $default_hash = password_hash($query[0]->PwPlain, PASSWORD_DEFAULT);
            $update = DB::table(table('webPresence'))
                    ->where('UserID', $query[0]->UserID)
                    ->update(['Pw' => $default_hash]);
        }
        /* $sql = ('
                    SELECT [WP].[UserUID],[WP].[UserID],[U].[PwPlain],[WP].[Pw] FROM ShaiyaCMS.dbo.WEB_PRESENCE AS [WP]
                    INNER JOIN PS_UserData.dbo.Users_Master AS [U] ON [WP].[UserID] = [U].[UserID]
            ');
        foreach (MSSQL::connect()->query($sql) as $user) {
            $default_hash = password_hash($user['PwPlain'], PASSWORD_DEFAULT);
            MSSQL::connect()->exec("UPDATE ShaiyaCMS.dbo.WEB_PRESENCE SET Pw='{$default_hash}' WHERE UserUID='{$user['UserUID']}';");
        } */
    }

    public function updateLoginStatus($status)
    {
        $data = [
            'LoginStatus' => $status
        ];
        try {
            $loginStatus = DB::table(table('webPresence'))
                    ->where('UserID', $this->session->get('User', 'UserID'))
                    ->update($data);
        } catch (\Exception $e) {
            echo 'problem inserting.';
        }
    }

    public function getUserGameInfo($UserUID, $col = false)
    {
        $return = false;

        $query = DB::table(table('shUserData'))
            ->select()
            ->where('UserUID', $UserUID)
            ->get();

        $cnt = 0;

        foreach ($query as $res) {
            //echo 'data found';
            foreach ($res as $key => $value) {
                if ($col) {
                    if ($key == $col) {
                        $return = $res->$col;
                        break;
                    } else {
                        $return = 'Datatype Invalid';
                    }
                } else {
                    $return[$key] = $value;
                }
            }
            $cnt++;
        }

        return $return;
    }

    public function getCharFromUser($type, $userUID)
    {
        if ($type == 'id') {
            // get char id
        } elseif ($type == 'name') {
            // get char name
        }
    }

    public function getCharIdFromUser($userUID)
    {
        $query = DB::table(table('shCharData'))
            ->select('CharID')
            ->where('UserUID', $userUID)
            ->where('Del', 0)
            ->limit(1)
            ->get();
        return $query[0]->CharID;
    }

    public function getCharNameFromUser($userUID)
    {
        $query = DB::table(table('shCharData'))
            ->select('CharName')
            ->where('UserUID', $userUID)
            ->where('Del', 0)
            ->limit(1)
            ->get();
        return $query[0]->CharName;
    }

    public function getUserIdFromCharId($charID)
    {
        $query = DB::table(table('shCharData'))
            ->select('UserID')
            ->where('CharID', $charID)
            ->limit(1)
            ->get();
        return $query[0]->UserID;
    }

    public function isCharInGuild($charID)
    {
        $query = DB::table(table('shGuildChars'))
            ->select('GuildID')
            ->where('CharID', $charID)
            ->limit(1)
            ->get();
        if (count($query) > 0) {
            return $query[0]->GuildID;
        } else {
            return false;
        }
    }

    public function getGuildFromChar($charID)
    {
        $query = DB::table(table('shGuildChars'))
            ->select('GuildID')
            ->where('CharID', $charID)
            ->limit(1)
            ->get();
        return $query[0]->GuildID;
    }

    public function updateCharGold($char, $gold)
    {
        // Update char gold, $user,$char
    }

    public function updateCharName($char, $oldName, $newName)
    {
        //
    }

    public function updateCharLevel($char, $level)
    {
        //
    }

    public function updateCharMap($char, $map, $x, $y, $z)
    {
        $update = DB::table(table('shCharData'))
        ->where('CharID', $char)
        ->update(['Map' => $map, 'PosX' => $x, 'PosY' => $y, 'PosZ' => $z]);

        // Check if update was successful
        if ($update) {
            return true;
        } else {
            return false;
        }
    }

    public function updateCharKills($char, $newKills)
    {
        //
    }

    public function updateCharDeaths($char, $newDeaths)
    {
        //
    }

    // MISC
    public function classInfo($level = false)
    {
        switch ($level) {
            case 1:
                $this->props($level);
                break;
            case 2:
                $this->methods($level);
                break;
        }
    }

    public function props()
    {
        echo '<div class="col-md-12">';
        echo '<b>Properties for class (' . get_class($this) . '):</b><br>';
        echo '<pre>';
        print_r(get_object_vars($this));
        echo '</pre>';
        echo '</div>';
        exit;
    }

    public function methods()
    {
        $class_methods = get_class_methods($this);
        echo '<div class="col-md-12">';
        echo '<b>Class (' . get_class($this) . ') Methods:</b> <br>';
        echo '<pre>';
        foreach ($class_methods as $method_name) {
            echo $method_name . '<br>';
        }
        echo '</pre>';
        echo '</div>';
        exit;
    }
}
