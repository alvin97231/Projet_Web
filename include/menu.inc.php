<?php

  switch ($_SESSION['type']) {

    case 1:
        echo "<div class=\"menu\">";
          echo "<ul>";
            echo "<li><a href=\"main.php\">Accueil</a></li>";
            echo "<li><a href=\"supplies.php\">Fournitures</a></li>";
            echo "<li><a href=\"lists.php\">Listes</a></li>";
            require($AppelInclude . "loginForm.inc.php");
            echo "</ul>";
         echo "</div>";
        break;

    case 2:
        echo "<div class=\"menu\">";
          echo "<ul>";
            echo "<li><a href=\"main.php\">Accueil</a></li>";
            echo "<li><a href=\"supplies.php\">Fournitures</a></li>";
            echo "<li><a href=\"lists.php\">Listes</a></li>";
            echo "<li><a href=\"studies.php\">Enseignements</a></li>";
            require($AppelInclude . "loginForm.inc.php");
            echo "</ul>";
         echo "</div>";
        break;

    case 3:
        echo "<div class=\"menu\">";
          echo "<ul>";
            echo "<li><a href=\"main_panel.php\">Accueil</a></li>";
            echo "<li><a href=\"supplies.php\">Fournitures</a></li>";
            echo "<li><a href=\"lists.php\">Listes</a></li>";
            echo "<li><a href=\"studies.php\">Matieres</a></li>";
            echo "<li><a href=\"panel.php\">Administration</a></li>";
            require($AppelInclude . "loginForm.inc.php");
            echo "</ul>";
         echo "</div>";
        break;
  }
?>
