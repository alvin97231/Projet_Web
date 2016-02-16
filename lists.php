<?php
    $AppelInclude = './include/';
    require($AppelInclude . "debut.inc.html");
    require($AppelInclude . "fonction.inc");

    $bdd = connexionDB();
    affectTypeUtilisateur($bdd);
    verifConnecte();
?>

  <div id="header">
  	<div class="header_content">

  	<div class="logo"><a href="index.php">F4U</a> <span>| application de gestion des fournitures</span></div>

    <?php
      require($AppelInclude . "menu.inc.php");
    ?>

    </div>
  </div><!-- End of Header-->

<div id="wrap">


  <div class="main_content">

    <div id="list">
      <?php
      if($_SESSION['type']==1) {
        echo '<div id="dropper" ondrop="drop(event)" ondragover="allowDrop(event)" class="dropper1">';
        echo '<h2>J\'ai</h2>';
        echo '</div>';
        echo '<div id="dropper" class="dropper2">';
        echo '<h2>Je n\'ai pas</h2>';
        echo '</div>';

        StudentList($bdd);
      }
      ?>
    </div>

  </div>

   <div class="clear"></div>

</div>


<?php
    require($AppelInclude . "footer.inc.html");
?>
