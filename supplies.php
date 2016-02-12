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

  	<div class="logo"><a href="index.html">F4U</a> <span>| application de gestion des fournitures</span></div>

    <?php
      require($AppelInclude . "menu.inc.php");
    ?>

    </div>
  </div><!-- End of Header-->

<div id="wrap">


  <div class="main_content">

    <div class="section_two_three entry">

     <table>
       <thead>
         <tr>
           <th>Quantité</th>
           <th>Libellé</th>
         </tr>
       </thead>
       <tbody>
         <?php
          if($_SESSION['type']== 1){

          }
          elseif ($_SESSION['type']== 2) {
            suppliesTeacherList($bdd);
          }
         ?>
       </tbody>
     </table>

    </div>


    <div class="section_one_three sidebar">

        <h2 class="centered_title">Mes fournitures</h2>
        <div class="roundimg"><a href="#" title=""><img src="images/icon_services.png" alt="" title="" /></a></div>
        <p class="centered_text">
        </p>
        <a href="#oModal" class="more">Ajouter</a>

    </div>

    <div id="oModal" class="oModal">
      <div>
        <header>
          <a href="#fermer" title="Fermer la fenêtre" class="droite">X</a>
           <h2>Ajouter une fourniture</h2>
         </header>
         <form action="include/suppliesAdd.php" method="post">
           <section>
             <input name="libelle" class="form-control" type="text" placeholder=" Libellé"/></br>
             <input name="quantite" class="form-control" type="number" placeholder=" Quantité"/></br>
           <section>
           <footer class="cf">
            <input value="Ajouter" name="classe" class="form-control" type="submit"/>
            <a href="#fermer" class="btn droite" title="Fermer la fenêtre"><input value="Fermer" class="form-control" type="button"/></a>
           </footer>
          </form>
      </div>
    </div>

  </div>

   <div class="clear"></div>

</div>

<?php
    require($AppelInclude . "footer.inc.html");
?>
