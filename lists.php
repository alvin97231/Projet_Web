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
           <th>Name</th>
           <th>Email</th>
           <th>Phone</th>
           <th>Mobile</th>
         </tr>
       </thead>
       <tbody>
         <tr><td class="user-name">gary coleman</td><td class="user-email">gary.coleman21@example.com</td><td class="user-phone">(398)-332-5385</td><td class="user-mobile">(888)-677-3719</td></tr>
         <tr><td class="user-name">rose parker</td><td class="user-email">rose.parker16@example.com</td><td class="user-phone">(293)-873-2247</td><td class="user-mobile">(216)-889-4933</td></tr>
         <tr><td class="user-name">chloe nelson</td><td class="user-email">chloe.nelson18@example.com</td><td class="user-phone">(957)-213-3499</td><td class="user-mobile">(207)-516-4474</td></tr>
         <tr><td class="user-name">eric bell</td><td class="user-email">eric.bell16@example.com</td><td class="user-phone">(897)-762-9782</td><td class="user-mobile">(565)-627-3002</td></tr>
         <tr><td class="user-name">douglas hayes</td><td class="user-email">douglas.hayes92@example.com</td><td class="user-phone">(231)-391-6269</td><td class="user-mobile">(790)-838-2130</td></tr>
         <tr><td class="user-name">cameron brown</td><td class="user-email">cameron.brown32@example.com</td><td class="user-phone">(204)-488-5204</td><td class="user-mobile">(508)-463-6811</td></tr>
         <tr><td class="user-name">nevaeh diaz</td><td class="user-email">nevaeh.diaz99@example.com</td><td class="user-phone">(436)-578-2946</td><td class="user-mobile">(906)-412-3302</td></tr>
         <tr><td class="user-name">kathy miller</td><td class="user-email">kathy.miller62@example.com</td><td class="user-phone">(724)-705-3555</td><td class="user-mobile">(764)-841-2531</td></tr>
         <tr><td class="user-name">susan king</td><td class="user-email">susan.king88@example.com</td><td class="user-phone">(774)-205-7754</td><td class="user-mobile">(639)-267-9728</td></tr>
         <tr><td class="user-name">jeffery ramirez</td><td class="user-email">jeffery.ramirez83@example.com</td><td class="user-phone">(723)-243-7706</td><td class="user-mobile">(172)-597-3422</td></tr>
         <tr><td class="user-name">gary coleman</td><td class="user-email">gary.coleman21@example.com</td><td class="user-phone">(398)-332-5385</td><td class="user-mobile">(888)-677-3719</td></tr>
       </tbody>
     </table>

     <h4>Blockquote</h4>
     <blockquote>
     Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
     </blockquote>

    </div>

  </div>

   <div class="clear"></div>

</div>


<?php
    require($AppelInclude . "footer.inc.html");
?>
