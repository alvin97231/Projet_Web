<?php

  if(isset($_SESSION['login'])) {
  ?>
    <li><a href="include/deconnexion.php"><input value="Deconnexion" class="form-control" type="submit"/></a></li>
  <?php
  }

  else {
  ?>
    <div class="menu">
      <form method="post" action="include/connexion.php">
        <input name="login" class="form-control" type="text" placeholder=" Username..."/>
        <input name="mdp" class="form-control" type="password" placeholder=" Password..."/>
        <input value="Connexion" class="form-control" type="submit"/>
      </form>
    </div>
  <?php
  }
?>
