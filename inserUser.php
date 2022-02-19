<?php
  require_once __DIR__.'/./DB.php';
  $user=null;
  $error=null;
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new UserQuery();
    $code='';
    for($i=0;$i<10;$i++)
      $code.=rand(0, 9);
    $id=uniqid();
    if($db->InserUser($id, $_POST['name'],$_POST['phone'],$_POST['mail'], $code)){
      header("Location: http://localhost/form_user/user/".$id);
    }
    else {
      header("Location: http://localhost/form_user/404.php");
    } 
  }
?>