<?php
if(!isset($_SESSION))
  {
      session_start();
      include("html/index.html");
  } else {
    include("html/index.html");
  }


 ?>
