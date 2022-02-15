<?php

define('AJAX_CALL', true);
// Autoloader
require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/bootstrap.php';
$bootstrap = new  App\Bootstrap();
$bootstrap->isAjax();
use Illuminate\Database\Capsule\Manager as DB;

$data = new \Classes\Utils\Data;

//$UserUID = isset($_POST['id']) ? $data->purify(trim($_POST['id'])) : false;
$UserUID = $_SESSION['User']['UserUID'];
$Category = isset($_POST['Category']) ? $data->purify(trim($_POST['Category'])) : false;
$Subject = isset($_POST['Subject']) ? $data->purify(trim($_POST['Subject'])) : false;
$Message = isset($_POST['Message']) ? $data->purify(trim($_POST['Message'])) : false;
$TicketKey = $data->randMemberId();
// Error Checking
$errors = [];

if (empty($UserUID)) {
    $errors[] .= 'UserUID can not be empty.';
}
if (empty($Category) || $Category == 'Choose One') {
    $errors[] .= 'Category can not be empty.';
}
if (empty($Subject)) {
    $errors[] .= 'Subject can not be empty.';
}
if (empty($Message)) {
    $errors[] .= 'Message can not be empty.';
}
// If No Errors Continue
if (count($errors) == 0) {
    try {
        $res = DB::table(table('tickets'))
            ->select('TicketID')
            ->orderBy('TicketID', 'DESC')
            ->limit(1)
            ->get();
        $checkTicketID = $res[0]->TicketID;
        $TicketID = $checkTicketID + 1;

        try {
            DB::table(table('tickets'))
            ->insert([
                'UserUID' => $UserUID,
                'TicketID' => $TicketID,
                'Type' => 0,
                'Status' => 1,
                'Category' => $Category,
                'Subject' => $Subject,
                'Message' => $Message,
                'Main' => 1,
                'TicketKey' => $TicketKey
            ]);
            echo '<button class="badge badge-success text-center w_100_p fs_20"><i class="fa fa-info-circle"></i> Support ticket has been successfully created.</button>';
        } catch (\Exception $e) {
            echo '<button class="badge badge-danger text-center w_100_p fs_20"><i class="fa fa-info-circle"></i> Support ticket creation failed.</button>';
        }
    } catch (\Exception $e) {
        echo 'couldnt run query';
    }
    /* echo '<div class="text-center">';
    echo 'UserUID: ' . $UserUID . '<br>';
    echo 'TicketID: ' . $TicketID . '<br>';
    echo 'Category: ' . $Category . '<br>';
    echo 'Subject: ' . $Subject . '<br>';
    echo 'Sent Message: ' . $Message . '<br>';
    echo 'Ticket Key: ' . $TicketKey . '<br>';
    echo '</div>';
    echo 'no errors'; */
}
// Check Errors
if (count($errors)) {
    echo '<ul>';
    foreach ($errors as $error) {
        echo '<li>' . $error . '</li><br>';
    }
    echo '</ul>';
}
