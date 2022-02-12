<?php

namespace App\Models\Game;

use Illuminate\Database\Capsule\Manager as DB;

class Vote
{
    public $fet;
    public $referer = null;
    public $VoteStatus = 'Not Voted';

    public function __construct($user, $session)
    {
        $this->data = new \Classes\Utils\Data;
        $this->session = $session;
        $this->user = $user;
        $this->getVoteReferer();
    }

    public function getVoteReferer()
    {
        if (isset($_SERVER['HTTP_REFERER'])) {
            $this->referer = $_SERVER['HTTP_REFERER'];
        } else {
            $this->referer = null;
        }

        $date = date('Y-m-d G:i', time());
        $ip = $_SERVER['REMOTE_ADDR'];
        $Point = VOTE['Point'];

        if (isset($_POST['Vote'])) {
            $site = htmlentities($_POST['site']);
            switch ($site) {
                case 'nr1':
                    $link = VOTE['XtremeTop100'];
                    break;
                case 'nr2':
                    $link = VOTE['OxigenTop100'];
                    break;
                case 'nr3':
                    $link = VOTE['GamingTop100'];
                    break;
                case 'nr4':
                    $link = VOTE['TopOfGames'];
                    break;
            }
            $res = DB::table(table('shUserData'))
                ->select()
                ->where('UserID', $this->user->UserID)
                ->get();
            $rowCount = count($res);
            if ($rowCount > 0) {
                $res = DB::table(table('vote'))
                    ->select()
                    ->where('UserID', $this->user->UserID)
                    ->where('VoteSite', $site)
                    ->where('UserIP', $ip)
                    ->get();
                $rowCount = count($res);
                foreach ($res as $data) {
                    $voted_date = $data->Date;
                    $to_time = strtotime($voted_date);
                    $from_time = strtotime($date);
                }
                if ($rowCount > 0) {
                    if (round(abs($to_time - $from_time) / 60, 2) > VOTE['time_needed']) {
                        $del = DB::table(table('vote'))
                            ->where('UserID', $this->user->UserID)
                            ->where('VoteSite', $site)
                            ->delete();

                        $expire = 365 * 24 * 3600;
                        $data = sha1($this->user->UserID . $_SERVER['HTTP_USER_AGENT'] . $this->user->UserUID . $Point . $ip);

                        setcookie('Vote4DP', $data, time() + $expire, '/', null, null, true);
                        setcookie('VoteID', $this->user->UserID, time() + $expire, '/', null, null, true);
                        setcookie('VoteSite', $site, time() + $expire, '/', null, null, true);

                        $log = DB::table(table('vote'))
                            ->insert([
                                'UserUID' => $this->user->UserUID,
                                'UserID' => $this->user->UserID,
                                'UserIP' => $ip,
                                'Date' => $date,
                                'VoteSite' => $site,
                                'SetSession' => 1,
                                'VoteStatus' => 'Waiting For Vote',
                                'Cookie' => $data
                            ]);

                        header('location:' . $link);
                    } else {
                        echo '<SCRIPT LANGUAGE="JavaScript">alert("Please wait 12 hours before revoting.")</script>';
                    }
                } else {
                    $expire = 365 * 24 * 3600;
                    $data = sha1($this->user->UserID . $_SERVER['HTTP_USER_AGENT'] . $this->user->UserUID . $Point . $ip);

                    setcookie('Vote4DP', $data, time() + $expire, '/', null, null, true);
                    setcookie('VoteID', $this->user->UserID, time() + $expire, '/', null, null, true);
                    setcookie('VoteSite', $site, time() + $expire, '/', null, null, true);

                    $log = DB::table(table('vote'))
                            ->insert([
                                'UserUID' => $this->user->UserUID,
                                'UserID' => $this->user->UserID,
                                'UserIP' => $ip,
                                'Date' => $date,
                                'VoteSite' => $site,
                                'SetSession' => 1,
                                'VoteStatus' => 'Waiting For Vote',
                                'Cookie' => $data
                            ]);

                    $update = DB::table(table('vote'))
                            ->where('UserID', $this->user->UserID)
                            ->update(['VoteWait' => 1]);

                    $this->VoteStatus = 'Waiting For Vote';

                    header('location:' . $link);
                }
            } else {
                // user not found
            }
        }
        if (isset($_COOKIE['Vote4DP']) && isset($_COOKIE['VoteID'])) {
            $res = DB::table(table('vote'))
                ->select()
                ->where('UserID', $this->user->UserID)
                ->where('VoteSite', $_COOKIE['VoteSite'])
                ->where('UserIP', $ip)
                ->where('Cookie', $_COOKIE['Vote4DP'])
                ->get();
            $rowCount = count($res);
            if ($rowCount > 0) {
                foreach ($res as $data) {
                    // site 1
                    if ($data->VoteSite == 'nr1' && $this->referer == VOTE['referer1']) {
                        $update = DB::table(table('shUserData'))
                            ->where('UserID', $this->user->UserID)
                            ->update(['Point' => $this->getUserPoints() + $Point]);

                        echo '<script language="javascript">alert("Thank you for your vote!")</script>';

                        $expire = 365 * 24 * 3600;
                        setcookie('Vote4DP', 'finished', time() + $expire, '/', null, null, true);
                    } elseif ($data->VoteSite == 'nr2' && $this->referer == VOTE['referer2']) {
                        $update = DB::table(table('shUserData'))
                            ->where('UserID', $this->user->UserID)
                            ->update(['Point' => $this->getUserPoints() + $Point]);

                        echo '<script language="javascript">alert("Thank you for your vote!")</script>';

                        $expire = 365 * 24 * 3600;
                        setcookie('Vote4DP', 'finished', time() + $expire, '/', null, null, true);
                    } elseif ($data->VoteSite == 'nr3' && $this->referer == VOTE['referer3']) {
                        $update = DB::table(table('shUserData'))
                            ->where('UserID', $this->user->UserID)
                            ->update(['Point' => $this->getUserPoints() + $Point]);

                        echo '<script language="javascript">alert("Thank you for your vote!")</script>';

                        $expire = 365 * 24 * 3600;
                        setcookie('Vote4DP', 'finished', time() + $expire, '/', null, null, true);
                    } elseif ($data->VoteSite == 'nr4' && $this->referer == VOTE['referer4']) {
                        $update = DB::table(table('shUserData'))
                            ->where('UserID', $this->user->UserID)
                            ->update(['Point' => $this->getUserPoints() + $Point]);

                        echo '<script language="javascript">alert("Thank you for your vote!")</script>';

                        $expire = 365 * 24 * 3600;
                        setcookie('Vote4DP', 'finished', time() + $expire, '/', null, null, true);
                    }
                }
            }
        }
    }

    public function getUserPoints()
    {
        if (isset($_SESSION['User'])) {
            $res = DB::table(table('shUserData'))
            ->where('UserUID', $_SESSION['User']['UserUID'])
            ->value('Point');
            return $res;
        }
    }
}
