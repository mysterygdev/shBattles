<?php
  define('AJAX_CALL', true);
  // Autoloader
  require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/bootstrap.php';
  $bootstrap = new  App\Bootstrap();
  $bootstrap->isAjax();
  use Illuminate\Database\Capsule\Manager as DB;

  $data = new \Classes\Utils\Data;

  $PrizeID = isset($_POST['id']) ? $data->purify(trim($_POST['id'])) : false;
  $UserUID = isset($_POST['UserUID']) ? $data->purify(trim($_POST['UserUID'])) : false;
  $ProductCodeName = 'PvP Reward';
  $ProductCode = $ProductCodeName;
  $slot;
  $maxSlot;

switch ($PrizeID) {
    case '1':
        $ItemID = null;
        $Points = 1;
        $Count = null;
        break;
    case '2':
        $ItemID = null;
        $Points = 5;
        $Count = null;
        break;
    case '3':
        $ItemID = null;
        $Points = 10;
        $Count = null;
        break;
    case '4':
        $ItemID = null;
        $Points = 15;
        $Count = null;
        break;
    case '5':
        $ItemID = null;
        $Points = 20;
        $Count = null;
        break;
    case '6':
        $ItemID = null;
        $Points = 25;
        $Count = null;
        break;
    case '7':
        $ItemID = null;
        $Points = 30;
        $Count = null;
        break;
    case '8':
        $ItemID = null;
        $Points = 35;
        $Count = null;
        break;
    case '9':
        $ItemID = null;
        $Points = 40;
        $Count = null;
        break;
    case '10':
        $ItemID = null;
        $Points = 45;
        $Count = null;
        break;
    case '11':
        $ItemID = null;
        $Points = 50;
        $Count = null;
        break;
    case '12':
        $ItemID = null;
        $Points = 55;
        $Count = null;
        break;
    case '13':
        $ItemID = null;
        $Points = 60;
        $Count = null;
        break;
    case '14':
        $ItemID = null;
        $Points = 65;
        $Count = null;
        break;
    case '15':
        $ItemID = null;
        $Points = 70;
        $Count = null;
        break;
    case '16':
        $ItemID = null;
        $Points = 75;
        $Count = null;
        break;
    case '17':
        $ItemID = null;
        $Points = 80;
        $Count = null;
        break;
    case '18':
        $ItemID = null;
        $Points = 85;
        $Count = null;
        break;
    case '19':
        $ItemID = null;
        $Points = 90;
        $Count = null;
        break;
    case '20':
        $ItemID = null;
        $Points = 95;
        $Count = null;
        break;
    case '21':
        $ItemID = null;
        $Points = 100;
        $Count = null;
        break;
    case '22':
        $ItemID = null;
        $Points = 105;
        $Count = null;
        break;
    case '23':
        $ItemID = null;
        $Points = 110;
        $Count = null;
        break;
    case '24':
        $ItemID = null;
        $Points = 115;
        $Count = null;
        break;
    case '25':
        $ItemID = null;
        $Points = 120;
        $Count = null;
        break;
    case '26':
        $ItemID = null;
        $Points = 125;
        $Count = null;
        break;
    case '27':
        $ItemID = null;
        $Points = 130;
        $Count = null;
        break;
    case '28':
        $ItemID = null;
        $Points = 135;
        $Count = null;
        break;
    case '29':
        $ItemID = null;
        $Points = 140;
        $Count = null;
        break;
    case '30':
        $ItemID = null;
        $Points = 145;
        $Count = null;
        break;
    case '31':
        $ItemID = null;
        $Points = 150;
        $Count = null;
        break;
}

$res = DB::table(table('shUserData'))
    ->select()
    ->where('UserUID', $_SESSION['User']['UserUID'])
    ->limit(1)
    ->get();
  $oldPoints = $res[0]->Point;
  $newPoints = $oldPoints + $Points;

$ins = DB::table(table('pvpRewards'))
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
