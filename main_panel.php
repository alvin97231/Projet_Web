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

            <?php
              if($_GET['nom'] && $_GET['prenom'] && $_GET['mail']){
                echo'<form action="include/usersModify.php" method="post">';
                echo"<section>";
                  echo'<input name="nom" class="form-control" type="text" value="'.$_GET['nom'].'"/></br>';
                  echo'<input name="prenom" class="form-control" type="text" value="'.$_GET['prenom'].'"/></br>';
                  echo'<input name="email" class="form-control" type="email" value="'.$_GET['mail'].'"/></br></br>';
                  echo'<input name="id" type="hidden" value="'.$_GET['id'].'"/>';
                echo'<section>';
                echo'<footer class="cf">';
                echo'<input value="Modifier" name="classe" class="form-control" type="submit"/>';
                echo'<a href="#fermer" class="btn droite" title="Fermer la fenêtre"><input value="Fermer" class="form-control" type="button"/></a>';
              }
              else{
                echo "<section>";
                  echo'<input name="nom" class="form-control" type="text" placeholder="Nom"/></br>';
                  echo'<input name="prenom" class="form-control" type="text" placeholder="Prénom"/></br>';
                  echo'<input name="email" class="form-control" type="email" placeholder="E-mail"/></br></br>';
                  echo'<label class="form-control">Administrateur<input type="radio" name="role" value="administrateur"></label>';
                  echo'<label class="form-control">Professeur<input type="radio" name="role" value="professeur"></label>';
                  echo'<label class="form-control">Eleve<input type="radio" name="role" value="eleve" ></label>';
                echo'<section>';
                echo'<footer class="cf">';
                echo'<input value="Ajouter" name="classe" class="form-control" type="submit"/>';
                echo'<a href="#fermer" class="btn droite" title="Fermer la fenêtre"><input value="Fermer" class="form-control" type="button"/></a>';
              }
            ?>
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
