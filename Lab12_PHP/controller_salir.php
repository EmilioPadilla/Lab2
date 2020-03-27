<?php
  session_start();

  session_unset();
  session_destroy();

  include("html/index.html");
?>
