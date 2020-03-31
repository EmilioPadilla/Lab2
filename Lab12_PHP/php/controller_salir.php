<?php
  session_start();

  session_unset();
  session_destroy();

  header("location:controller_session.php");
?>
