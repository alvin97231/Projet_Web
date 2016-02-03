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

    <div class="section_two_three entry">

     <table>
       <thead>
         <tr>
           <th>Discipline</th>
           <th>Niveau</th>
         </tr>
       </thead>
       <tbody>
         <?php
         ?>
       </tbody>
     </table>

    </div>

    <div class="section_one_three sidebar">

        <h2 class="centered_title">Mes enseignements</h2>
        <div class="roundimg"><a href="#" title=""><img src="images/icon_clients.png" alt="" title="" /></a></div>
        <p class="centered_text">
        </p>
        <a href="#oModal" class="more">Ajouter</a>

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
