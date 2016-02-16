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
  </div>

<div id="wrap">


  <div class="main_content">

    <div class="section_two_three entry">
         <?php
         if($_SESSION['type']==3) {
           studiesAdminList($bdd);
         }
         else if($_SESSION['type']==2) {
           studiesTeacherList($bdd);
         }
         ?>
    </div>

    <div class="section_one_three sidebar">

        <h2 class="centered_title">Enseignements</h2>
        <div class="roundimg"><a href="#" title=""><img src="images/icon_clients.png" alt="" title="" /></a></div>
        <p class="centered_text">
        </p>
        <?php
        if($_SESSION['type']==2) {
          echo '<a href="#oModal" class="more">Modifier</a>';
        }
        ?>


    </div>

    <div id="oModal" class="oModal">
      <div>
        <header>
          <a href="#fermer" title="Fermer la fenêtre" class="droite">X</a>
           <h2>Ajouter un enseignement</h2>
         </header>
         <form action="include/studiesAdd.php" method="post">
           <section>
              <select name="matiere" class="form-control">
                <option value="francais">Français</option>
                <option value="mathematiques">Mathématiques</option>
                <option value="histoire">Histoire</option>
                <option value="geographie">Géographie</option>
                <option value="ecjs">ECJS</option>
                <option value="eps">EPS</option>
                <option value="anglais">Anglais</option>
                <option value="espagnol">Espagnol</option>
                <option value="physique">Physique</option>
                <option value="chimie">Chimie</option>
            </select>
            <select name="niveau" class="form-control">
              <option value="1">Seconde</option>
              <option value="2">Première</option>
              <option value="3">Terminale</option>
            </select></br>
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
