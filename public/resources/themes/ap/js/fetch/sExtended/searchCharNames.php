<?php
  define('AJAX_CALL', true);
  // Autoloader
  require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/bootstrap.php';
  $bootstrap = new  App\Bootstrap();
  $bootstrap->isAjax();
  use App\Models as Models;

  $notice = new Models\Admin\SExtended\SendPlayerNotice();

  $charName = $_POST['charName'];

  $data = $notice->searchData($charName);

  echo json_encode($data);
