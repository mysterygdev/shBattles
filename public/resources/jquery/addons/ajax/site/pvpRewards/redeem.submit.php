<?php
define('AJAX_CALL', true);
// Autoloader
require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/bootstrap.php';
$bootstrap = new  App\Bootstrap();
$bootstrap->isAjax();
use Illuminate\Database\Capsule\Manager as DB;
use App\Models as Models;
use Classes\Utils as Utils;

$data = new \Classes\Utils\Data;
$session = new Utils\Session;
$user = new Utils\User($session);
$rewards = new Models\Game\Rewards($user, $session);

$PrizeID = isset($_POST['id']) ? $data->purify(trim($_POST['id'])) : false;
$UserUID = isset($_POST['UserUID']) ? $data->purify(trim($_POST['UserUID'])) : false;
$ProductCodeName = 'PvP Reward';
$ProductCode = $ProductCodeName;
$slot;
$maxSlot;

// Get Reward from DB
$Points = $rewards->getReward($PrizeID)[0]->Points;

$res = DB::table(table('shUserData'))
    ->select()
    ->where('UserUID', $_SESSION['User']['UserUID'])
    ->limit(1)
    ->get();
$oldPoints = $res[0]->Point;
$newPoints = $oldPoints + $Points;

$ins = DB::table(table('logPvpRewards'))
->insert([
    'UserUID' => $UserUID,
    'PrizeID' => $PrizeID,
    'OldPoints' => $oldPoints,
    'NewPoints' => $newPoints
]);
if ($ins) {
    $update = DB::table(table('shUserData'))
    ->where('UserUID', $_SESSION['User']['UserUID'])
    ->update([
        'Point' => $newPoints
    ]);
    echo '<button class="badge badge-success text-center w_100_p fs_20"><i class="fa fa-info-circle"></i> Prize has been sent successfully.</button>';
} else {
    echo '<button class="badge badge-danger text-center w_100_p fs_20"><i class="fa fa-info-circle"></i> Prize could not be sent.</button>';
}
