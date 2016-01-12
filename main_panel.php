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

    <h2 class="centered_title">Enseignements</h2>

     <table>
       <thead>
         <tr>
           <th>ID</th>
           <th>Niveau</th>
         </tr>
       </thead>
       <tbody>
         <?php
          studiesAdminList($bdd);
        ?>
       </tbody>
     </table>

    </div>

     <div class="section_one_three">

     <h2 class="centered_title">Utilisateurs</h2>

      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Login</th>
          </tr>
        </thead>
        <tbody>
          <?php
           usersList($bdd);
         ?>
        </tbody>
      </table>

    </div>

    <div id="oModal" class="oModal">
      <div>
        <header>
          <a href="#fermer" title="Fermer la fenêtre" class="droite">X</a>
           <h2>Ajouter une fourniture</h2>
         </header>
         <form action="include/ajout.php" method="post">
           <section>
             <input name="level" class="form-control" type="text" placeholder="Niveau"/></br>
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
