<?php
  define('AJAX_CALL', true);
  // Autoloader
  require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/bootstrap.php';
  $bootstrap = new  App\Bootstrap();
  $bootstrap->isAjax();
  use Illuminate\Database\Capsule\Manager as DB;
  use App\Models as Models;

  $data = new \Classes\Utils\Data;
  $donations = new Models\Admin\PaymentCenter\Donations;

  $RowID = isset($_POST['id']) ? $data->purify(trim($_POST['id'])) : false;

  $donation = $donations->getDonationById($RowID);

  if (count($donation) > 0) {
      foreach ($donation as $res) {
          $ID = $res->RowID;
      }
      if ($ID == $RowID) {
          // Delete Donation
          if ($donations->deleteDonationById($ID)) {
              echo 'Donation deleted successfully';
          } else {
              echo 'Donation deletion failed.';
          }
          redirect_html('/admin/paymentCenter/manageDonations', 3);
      } else {
          echo 'Donation ID does not match.';
      }
  } else {
      echo 'Donation does\'nt exist.';
  }
