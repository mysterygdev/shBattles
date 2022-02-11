<?php
define('AJAX_CALL', true);
// Autoloader
require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/bootstrap.php';
$bootstrap = new  App\Bootstrap();
$bootstrap->isAjax();
use Illuminate\Database\Capsule\Manager as DB;

$data = new \Classes\Utils\Data;

//TODO: can be improved, don't need to get all this from post
$Answer = isset($_POST['YourAnswer']) ? $data->purify(trim($_POST['YourAnswer'])) : false;
$UserUID = isset($_POST['UserUID']) ? $data->purify(trim($_POST['UserUID'])) : false;
$TicketID = isset($_POST['TicketID']) ? $data->purify(trim($_POST['TicketID'])) : false;
$Type = isset($_POST['Type']) ? $data->purify(trim($_POST['Type'])) : false;
$Category = isset($_POST['Category']) ? $data->purify(trim($_POST['Category'])) : false;
$Subject = isset($_POST['Subject']) ? $data->purify(trim($_POST['Subject'])) : false;
$Main = isset($_POST['Main']) ? $data->purify(trim($_POST['Main'])) : false;
$Status = isset($_POST['Status']) ? $data->purify(trim($_POST['Status'])) : false;
$RespUID = isset($_POST['RespUID']) ? $data->purify(trim($_POST['RespUID'])) : false;

try {
    $ticket = DB::table(table('tickets'))
    ->insert([
        'UserUID' => $UserUID,
        'RespUID' => $RespUID,
        'TicketID' => $TicketID,
        'Type' => 1,
        'Status' => $Status,
        'Category' => $Category,
        'Subject' => $Subject,
        'Message' => $Answer,
        'Main' => 0,
    ]);
    if ($ticket) {
        $update = DB::table(table('tickets'))
          ->where('TicketID', $TicketID)
          ->where('Main', 1)
          ->update([
              'Status' => $Status
          ]);
    // good
    } else {
        // bad
    }
} catch (\Exception $e) {
    // fail
}

/* echo '<div class="text-center">';
                echo 'UserUID: ' . $UserUID . '<br>';
                echo 'Responder ID: ' . $RespUID . '<br>';
                echo 'TicketID: ' . $TicketID . '<br>';
                echo 'Type: ' . $Type . '<br>';
                echo 'Category: ' . $Category . '<br>';
                echo 'Subject: ' . $Subject . '<br>';
                echo 'Sent Message: ' . $Answer . '<br>';
                echo 'Main: ' . $Main . '';
            echo '</div>'; */
?>
<div class="text-center">
  Ticket updated successfully.
</div>
