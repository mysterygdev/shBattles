<?php

define('AJAX_CALL', true);
// Autoloader
require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/bootstrap.php';
$bootstrap = new  App\Bootstrap();
$bootstrap->isAjax();
use Illuminate\Database\Capsule\Manager as DB;

$data = new \Classes\Utils\Data;

$UserID = $_SESSION['User']['UserID'];
$UserUID = $_SESSION['User']['UserUID'];
$Tier = isset($_POST['tier']) ? $data->purify(trim($_POST['tier'])) : false;
// Error Checking
$errors = [];

if (empty($Tier)) {
    $errors[] .= 'Tier can not be empty!';
}

if (count($errors) == 0) {
    if (!empty($UserUID)) {
        $res = DB::table(table('tieredSpender'))
            ->select()
            ->where('UserUID', $_SESSION['User']['UserUID'])
            ->where('Tier', $Tier)
            ->where('Redeemed', 1)
            ->get();
        $rowCount = count($res);

        echo '<div class="text-white">';
        echo '<form class="send_reward" method="POST">';
        if ($rowCount > 0) {
            echo '<p>You have already redeemed the rewards for this tier.</p>';
        } else {
            $success = null;

            $res = DB::table(table('tieredRewards'))
                ->select()
                ->where('Tier', $Tier)
                ->get();
            $rowCount = count($res);
            foreach ($res as $data) {
                $itemId = $data->RewardItemID;
                $count = $data->RewardQuantity;
                $slot = 0;

                $sql = ('
                        Declare @Empty smallint
                        Declare @Slot smallint
                        Set @Slot = 0
                        Set @Empty = 0
                        WHILE (@Slot <= 239)
                          BEGIN
                          SET @empty = (SELECT COUNT(Slot) FROM PS_GameData.dbo.UserStoredPointItems WHERE UserUID = ? AND Slot = @Slot)
                          IF (@empty <= 0) BREAK
                          ELSE
                          SET @Slot = @Slot+1
                          END
                          Select @Slot as Slot
                  ');

                $stmtSlot = DB::select(DB::raw($sql), [$_SESSION['User']['UserUID']]);
                foreach ($stmtSlot as $fet) {
                    if ($fet->Slot < 240) {
                        $slot = $fet->Slot;
                        $stmt = DB::table(table('shUserBank'))
                            ->insert([
                                'UserUID' => $_SESSION['User']['UserUID'],
                                'Slot' => $slot,
                                'ItemID' => $itemId,
                                'ItemCount' => $count
                            ]);
                        if ($stmt) {
                            $success = true;
                            echo '<button class="badge badge-success text-center w_100_p fs_20"><i class="fa fa-info-circle"></i> Reward has been sent successfully.</button>';
                        } else {
                            echo '<button class="badge badge-danger text-center w_100_p fs_20"><i class="fa fa-info-circle"></i> Reward could not be sent.</button>';
                        }
                    } else {
                        echo 'User: ' . $_SESSION['User']['UserID'] . ' has too many Items in his/her gift box and can not hold any more.';
                    }
                }
            }
            if ($success) {
                $stmt = DB::table(table('tieredSpender'))
                ->insert([
                    'UserUID' => $_SESSION['User']['UserUID'],
                    'Tier' => $Tier,
                    'Redeemed' => 1
                ]);
            }
        }
        echo '</form>';
        echo '</div>';
    }
}

if (count($errors)) {
    echo '<ul>';
    foreach ($errors_body as $error) {
        echo '<li>' . $error . '</li>';
    }
    echo '</ul>';
}
