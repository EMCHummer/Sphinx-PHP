<?php
  //
  //
  // Test Work for Samsung
  // 19.02.2022
  // Made by Leon Sokirkin - emchummer.ru
  //
  //

  header('Content-Type: text/html;charset=UTF-8');
  require_once(__DIR__.'/config.php');
  require_once('/var/www/sphinx/api/sphinxapi.php');
  session_start();

  if(file_exists(__DIR__."/controllers/Main.php")) {
    require_once __DIR__."/controllers/Main.php";
  }
  if(file_exists(__DIR__."/models/DB.php")) {
    require_once __DIR__."/models/DB.php";
  }

  $DB = new DB();
  $Main = new Main($_POST);
  $Main->invoke();

?>
