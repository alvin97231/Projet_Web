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
       <h2 class="centered_title">Mes enseignements</h2>
       <div class="roundimg"><a href="studies.php" title=""><img src="images/icon_clients.png" alt="" title="" /></a></div>
       <p class="centered_text">
       </p>
       <a href="studies.php" class="more">Aller!</a>
       </div>

     <div class="section_one_three">
       <h2 class="centered_title">Mes fournitures</h2>
       <div class="roundimg"><a href="#" title=""><img src="images/icon_services.png" alt="" title="" /></a></div>
       <p class="centered_text">
       </p>
       <a href="supplies.php" class="more">Aller!</a>
       </div>

     <div class="section_one_three">
       <h2 class="centered_title">Mes listes complétées</h2>
       <div class="roundimg"><a href="#" title=""><img src="images/icon_contact.png" alt="" title="" /></a></div>
       <p class="centered_text">
       </p>
       <a href="#" class="more">Aller!</a>
       </div>

  </div>

   <div class="clear"></div>


</div>

<?php
    require($AppelInclude . "footer.inc.html");
?>
