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

    <?php
      if($_SESSION['type']==3){

        $display='';

        $display.='<div class="section_one_three">';
        $display.='<h2 class="centered_title">Gestion des Utilisateurs</h2>';
        $display.='<div class="panel"><a href="main_panel.php" title=""><img src="images/users.png" alt="" title="" /></a></div>';
        $display.='<p class="centered_text">';
        $display.='</p>';
        $display.='<a href="main_panel.php" class="more">Aller!</a>';
        $display.='</div>';

        $display.='<div class="section_one_three">';
        $display.='<h2 class="centered_title">Gestion des Listes</h2>';
        $display.='<div class="panel"><a href="list.php" title=""><img src="images/list.png" alt="" title="" /></a></div>';
        $display.='<p class="centered_text">';
        $display.='</p>';
        $display.='<a href="list.php" class="more">Aller!</a>';
        $display.='</div>';

        $display.='<div class="section_one_three">';
        $display.='<h2 class="centered_title">Statistiques</h2>';
        $display.='<div class="panel"><a href="statistique.php" title=""><img src="images/chart.png" alt="" title="" /></a></div>';
        $display.='<p class="centered_text">';
        $display.='</p>';
        $display.='<a href="statistique.php" class="more">Aller!</a>';
        $display.='</div>';

        echo $display;
      }

      else if($_SESSION['type']==2){

        $display='';

        $display.='<div class="section_one_three">';
        $display.='<h2 class="centered_title">Enseignement</h2>';
        $display.='<div class="roundimg"><a href="studies.php" title=""><img src="images/icon_clients.png" alt="" title="" /></a></div>';
        $display.='<p class="centered_text">';
        $display.='</p>';
        $display.='<a href="studies.php" class="more">Aller!</a>';
        $display.='</div>';

        $display.='<div class="section_one_three">';
        $display.='<h2 class="centered_title">Mes fournitures</h2>';
        $display.='<div class="roundimg"><a href="#" title=""><img src="images/icon_services.png" alt="" title="" /></a></div>';
        $display.='<p class="centered_text">';
        $display.='</p>';
        $display.='<a href="supplies.php" class="more">Aller!</a>';
        $display.='</div>';

        echo $display;
      }

        else if ($_SESSION['type']==1){

          $display='';

          $display.='<div class="section_one_three">';
          $display.='<h2 class="centered_title">Mes fournitures</h2>';
          $display.='<div class="roundimg"><a href="#" title=""><img src="images/icon_services.png" alt="" title="" /></a></div>';
          $display.='<p class="centered_text">';
          $display.='</p>';
          $display.='<a href="supplies.php" class="more">Aller!</a>';
          $display.='</div>';

          $display.='<div class="section_one_three">';
          $display.='<h2 class="centered_title">Ma liste</h2>';
          $display.='<div class="roundimg"><a href="#" title=""><img src="images/icon_contact.png" alt="" title="" /></a></div>';
          $display.='<p class="centered_text">';
          $display.='</p>';
          $display.='<a href="#" class="more">Aller!</a>';
          $display.='</div>';

          echo $display;
        }
    ?>

  </div>

   <div class="clear"></div>


</div>

<?php
    require($AppelInclude . "footer.inc.html");
?>
