<?php
define('AJAX_CALL', true);
// Autoloader
require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/bootstrap.php';
$bootstrap = new  App\Bootstrap();
$bootstrap->isAjax();
use Illuminate\Database\Capsule\Manager as DB;
use App\Models as Models;

$data = new \Classes\Utils\Data;
$rewards = new Models\Admin\Site\PvpRewards\Rewards;

$RewardID = isset($_POST['id']) ? $data->purify(trim($_POST['id'])) : false;

$reward = $rewards->getRewardById($RewardID);

if (count($reward) > 0) {
    foreach ($reward as $res) {
        $ID = $res->RewardID;
    }
    if ($ID == $RewardID) {
        // Delete Donation
        if ($rewards->deleteRewardById($ID)) {
            echo 'Reward deleted successfully';
        } else {
            echo 'Reward deletion failed.';
        }
        redirect_html('/admin/site/pvpRewards/manageRewards', 3);
    } else {
        echo 'Reward ID does not match.';
    }
} else {
    echo 'Reward does\'nt exist.';
}
