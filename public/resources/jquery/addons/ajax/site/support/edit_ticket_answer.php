<?php

define('AJAX_CALL', true);
// Autoloader
require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/bootstrap.php';
$bootstrap = new  App\Bootstrap();
$bootstrap->isAjax();
use Illuminate\Database\Capsule\Manager as DB;

$UserUID = $_REQUEST['UserUID'];
$ticketID = $_REQUEST['TicketID'];
$Category = $_REQUEST['Category'];
$Subject = $_REQUEST['Subject'];
$Message = $_REQUEST['Message'];

if ($_POST['UserUID'] && !empty($_POST['UserUID'])) {
    if (!empty($Message)) {
        try {
            DB::table(table('tickets'))
                ->insert([
                    'UserUID' => $UserUID,
                    'ticketID' => $ticketID,
                    'Type' => 0,
                    'Status' => 1,
                    'Category' => $Category,
                    'Subject' => $Subject,
                    'Message' => $Message,
                    'Main' => 0
                ]);
            echo '<button class="badge badge-success text-center w_100_p fs_20"><i class="fa fa-info-circle"></i> Support ticket has been successfully updated.</button>';
        } catch (\Exception $e) {
            echo '<button class="badge badge-danger text-center w_100_p fs_20"><i class="fa fa-info-circle"></i> Support ticket update failed.</button>';
        }
    } else {
        echo '<p class="text-center">Message can not be empty.</p>';
    }
}
