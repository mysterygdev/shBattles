<?php
  define('AJAX_CALL', true);
  // Autoloader
  require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/bootstrap.php';
  $bootstrap = new  App\Bootstrap();
  $bootstrap->isAjax();
  use Illuminate\Database\Capsule\Manager as DB;
  use App\Models as Models;

  $data = new \Classes\Utils\Data;
  $manageProducts = new Models\Admin\WebMall\ManageProducts;

  $ProductID = isset($_POST['id']) ? $data->purify(trim($_POST['id'])) : false;
  $ProductCode = isset($_POST['code']) ? $data->purify(trim($_POST['code'])) : false;

  $product = $manageProducts->getProductById($ProductID);

  if (count($product) > 0) {
      foreach ($product as $res) {
          $ID = $res->ProductID;
          $Code = $res->ProductCode;
      }
      if ($Code == $ProductCode) {
          // Delete Product
          $manageProducts->deleteProductByCode($Code);
          echo 'Product Deleted Successfully';
          redirect_html('/admin/webmall/manageProducts', 3);
      } else {
          echo 'Product Code does not match.';
      }
  } else {
      echo 'Product does\'nt exist.';
  }
