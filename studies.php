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
           <th>Identifiant</th>
           <th>Discipline</th>
           <th>Niveau</th>
         </tr>
       </thead>
       <tbody>
         <tr onclick="document.location='#oModal'"><td class="user-name">1</td><td class="user-email">Français</td><td class="user-phone">Terminale</td></a></tr>
         <tr><td class="user-name">2</td><td class="user-email">Philosophie</td><td class="user-phone">Premiere</td></tr>
         <tr><td class="user-name">3</td><td class="user-email">Philosophie</td><td class="user-phone">Seconde</td></tr>
         <tr><td class="user-name">4</td><td class="user-email">Philosophie</td><td class="user-phone">Terminale</td></tr>
         <tr><td class="user-name">5</td><td class="user-email">Histoire</td><td class="user-phone">Seconde</td></tr>
         <tr><td class="user-name">6</td><td class="user-email">Histoire</td><td class="user-phone">Terminale</td></tr>
         <tr><td class="user-name">7</td><td class="user-email">Histoire</td><td class="user-phone">Premiere</td></tr>
         <tr><td class="user-name">8</td><td class="user-email">Géographie</td><td class="user-phone">Terminale</td></tr>
         <tr><td class="user-name">9</td><td class="user-email">Géographie</td><td class="user-phone">Seconde</td></tr>
         <tr><td class="user-name">10</td><td class="user-email">Géographie</td><td class="user-phone">Premiere</td></tr>
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
           <h2>Ajouter une fourniture</h2>
         </header>
         <section>
           <input name="uname" class="form-control" type="text" placeholder=" Matière"/></br>
           <input name="uname" class="form-control" type="text" placeholder=" Niveau "/></br>
         <section>
         <footer class="cf">
          <a href="#fermer" class="btn droite" title="Ajouter la fourniture"><input value="Ajouter" class="form-control" type="button"/></a>
          <a href="#fermer" class="btn droite" title="Fermer la fenêtre"><input value="Fermer" class="form-control" type="button"/></a>
         </footer>
      </div>
    </div>

  </div>

   <div class="clear"></div>

</div>

<?php
    require($AppelInclude . "footer.inc.html");
?>
