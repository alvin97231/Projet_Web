<?php
    $AppelInclude = './include/';
    require($AppelInclude . "debut.inc.html");
    require($AppelInclude . "fonction.inc");

    $bdd = connexionDB();
?>

  <div id="header">
        <div class="header_content">

        <div class="logo"><a href="index.php">F4U</a> <span>| application de gestion des fournitures</span></div>

        <?php
            require($AppelInclude . "loginForm.inc.php");
        ?>

        </div>
  </div><!-- End of Header-->

<div id="wrap">

  <!--<div class="top_slogan">
    Design is not just what it looks like and feels like. Design is how it works.
  </div>-->

  <div class="slider">
		<div class="flexslider">
	    <ul class="slides">
	    	<li><a href="#"><img src="images/main.jpg" alt="" title="" border="0"/></a></li>
	    </ul>
	  </div>
   </div>

   <div class="clear"></div>


</div>

<?php
    require($AppelInclude . "footer.inc.html");
?>
