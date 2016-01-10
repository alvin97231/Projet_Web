<?php
  $_SESSION["login"] = NULL;
  $_SESSION["mdp"] = NULL;
  $_SESSION["type"] = NULL;
  session_destroy();
  header("location: ../index.php");
?>
