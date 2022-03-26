<?php
require_once '../app/bootstrap.php';
$bootstrap = new  App\Bootstrap();
#var_dump(db);
$bootstrap->dispatch();
