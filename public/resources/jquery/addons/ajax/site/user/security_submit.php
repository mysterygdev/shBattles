<?php
define('AJAX_CALL', true);
// Autoloader
require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/bootstrap.php';
$bootstrap = new  App\Bootstrap();
$bootstrap->isAjax();
use Illuminate\Database\Capsule\Manager as DB;

use Utils\Data;
use Utils\Session;

$data = new Data;
$editProduct = new Models\Admin\WebMall\EditProduct;

var_dump($_POST);
if (isset($_POST)) {
    if ($_POST['2fa'] == true) {
        try {
            $update = DB::table(table('webPresence'))
            ->where('UserID', Session::get('User', 'UserID'))
            ->update([
               '2FA' => $_POST['2fa'],
               '2FAType' => $_POST['2faType']
            ]);

            $key = $data->randBytes(3);
            $stmt = DB::table(table('verificationKey'))
               ->insert([
                  'Key' => $key
               ]);
            $res = DB::table(table('verificationKey'))
                  ->where('Key', $key)
                  ->limit(1)
                  ->value('Key');
            $dbKey = $res;
            echo 'key: '.$key.'<br>';
            echo 'dbkey: '.$dbKey.'<br>';
            echo '<form id="security_form" method="post">';
            echo '<input type="text" id="chkKey" name="chkKey"><br><br>';
            echo '<input type="hidden" id="key" name="key" value="'.$dbKey.'"';
            echo '<button id="submit" class="btn btn-sm btn-dark">Save Changes</button>';
            echo '<button id="submit" class="btn btn-sm btn-dark">Submit</button>';
            echo '</form>';
        } catch (\Illuminate\Database\QueryException $e) {
            echo 'fail';
        }
    }
    if (isset($_POST['chkKey'])) {
        if ($_POST['chkKey'] == $_POST['key']) {
            echo 'key matches';
        } else {
            echo 'key fail';
        }
    }
}
?>
<script>
    $(document).ready(function(){
      $("button#submit").click(function(e){
        e.preventDefault();
        ajaxPOST(
          "/resources/jquery/addons/ajax/site/user/security_submit.php",
          $('form#security_form').serialize(),
          (message) => {
            $("#response").html(message)
          },
          'error'
        );
      });
    });
  </script>
