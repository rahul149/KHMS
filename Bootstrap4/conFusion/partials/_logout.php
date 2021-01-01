<?php
  session_start();

  
  session_unset();
  session_destroy();
  header("Location: /khms/Kitt-management-site/Bootstrap4/conFusion/mainpage.php");
?>