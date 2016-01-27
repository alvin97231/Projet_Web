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

  	<div class="logo"><a href="main.php">F4U</a> <span>| application de gestion des fournitures</span></div>

    <?php
      require($AppelInclude . "menu.inc.php");
    ?>

    </div>
  </div><!-- End of Header-->

<div id="wrap">

  <div class="main_content">


     <div class="section_one_three">
       <h2 class="centered_title">Gestion des Utilisateurs</h2>
       <div class="panel"><a href="studies.php" title=""><img src="images/users.png" alt="" title="" /></a></div>
       <p class="centered_text">
       </p>
       <a href="studies.php" class="more">Aller!</a>
     </div>

     <div class="section_one_three">
       <h2 class="centered_title">Gestion des Listes</h2>
       <div class="panel"><a href="#" title=""><img src="images/list.png" alt="" title="" /></a></div>
       <p class="centered_text">
       </p>
       <a href="supplies.php" class="more">Aller!</a>
     </div>

     <div class="section_one_three">
       <h2 class="centered_title">Statistiques</h2>
       <div class="panel"><a href="#" title=""><img src="images/chart.png" alt="" title="" /></a></div>
       <p class="centered_text">
       </p>
       <a href="#" class="more">Aller!</a>
     </div>

  </div>

</div>

<?php
    require($AppelInclude . "footer.inc.html");
?>
