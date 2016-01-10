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
           <th>Matiere</th>
         </tr>
       </thead>
       <tbody>
         <tr><td class="user-name">2</td><td class="user-email">Cahier grand carreaux</td><td class="user-phone">(398)-332-5385</td></tr>
         <tr><td class="user-name">3</td><td class="user-email">Pochettes</td><td class="user-phone">(293)-873-2247</td></tr>
         <tr><td class="user-name">6</td><td class="user-email">Pochettes</td><td class="user-phone">(957)-213-3499</td></tr>
         <tr><td class="user-name">1</td><td class="user-email">Cahier petit carreaux</td><td class="user-phone">(897)-762-9782</td></tr>
         <tr><td class="user-name">4</td><td class="user-email">douglas.hayes92@example.com</td><td class="user-phone">(231)-391-6269</td></tr>
         <tr><td class="user-name">4</td><td class="user-email">cameron.brown32@example.com</td><td class="user-phone">(204)-488-5204</td></tr>
         <tr><td class="user-name">1</td><td class="user-email">nevaeh.diaz99@example.com</td><td class="user-phone">(436)-578-2946</td></tr>
         <tr><td class="user-name">5</td><td class="user-email">Pochettes</td><td class="user-phone">(724)-705-3555</td></tr>
         <tr><td class="user-name">1</td><td class="user-email">Cahier grand carreaux</td><td class="user-phone">(774)-205-7754</td></tr>
         <tr><td class="user-name">1</td><td class="user-email">Cahier grand carreaux</td><td class="user-phone">(723)-243-7706</td></tr>
         <tr><td class="user-name">2</td><td class="user-email">Cahier petit carreaux</td><td class="user-phone">(398)-332-5385</td></tr>
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
         <section>
           <input name="uname" class="form-control" type="text" placeholder=" Libellé"/></br>
           <input name="uname" class="form-control" type="text" placeholder=" Matière"/></br>
           <input name="password" class="form-control" type="text" placeholder=" Quantité"/></br>
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
