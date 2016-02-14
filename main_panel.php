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

    <!--<div class="section_two_three entry">

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
          //studiesAdminList($bdd);
        ?>
       </tbody>
     </table>

   </div>-->

     <div class="section_two_three entry">

     <h2 class="centered_title">Utilisateurs</h2>

      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Login</th>
            <th colspan="2">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
           usersList($bdd);
         ?>
        </tbody>
      </table>

    </div>

    <div class="section_one_three sidebar">

        <h2 class="centered_title">Gestion des Utilisateurs</h2>
        <div class="panel"><img src="images/users.png" alt="" title="" /></div>
        <p class="centered_text">
        </p>
        <a href="#oModal" class="more">Ajouter</a>

    </div>

    <div id="oModal" class="oModal">
      <div>
        <header>
          <a href="#fermer" title="Fermer la fenêtre" class="droite">X</a>
           <h2>Ajouter un utilisateur</h2>
         </header>
         <form action="include/usersAdd.php" method="post">
           <section>
             <input name="nom" class="form-control" type="text" placeholder="Nom"/></br>
             <input name="prenom" class="form-control" type="text" placeholder="Prénom"/></br>
             <input name="email" class="form-control" type="email" placeholder="E-mail"/></br></br>
             <label class="form-control">Administrateur<input type="radio" name="role" value="administrateur"></label>
             <label class="form-control">Professeur<input type="radio" name="role" value="professeur"></label>
             <label class="form-control">Eleve<input type="radio" name="role" value="eleve" ></label>
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
