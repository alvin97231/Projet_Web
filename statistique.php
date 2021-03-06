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

<script  language="Javascript" >
function makeGraph(container, labels)
{
    container = document.getElementById(container);
    labels = document.getElementById(labels)
    var dnl = container.getElementsByTagName("li");
    for(var i = 0; i < dnl.length; i++)
    {
        var item = dnl.item(i);
        var value = item.innerHTML;
        var color = item.style.background=color;
        var content = value.split(":");
        value = content[0];
        item.style.height=value + "px";
        item.style.top=(199 - value) + "px";
        item.style.left = (i * 50 + 20) + "px";
        item.style.height = value + "px";
        item.innerHTML = value;
        item.style.visibility="visible";
        color = content[2];
        if(color != false) item.style.background=color;
        labels.innerHTML = labels.innerHTML +
             "<span style='margin:8px;background:"+ color+"'>" +
             content[1] + "</span>";
    }
}

window.onload=function () { makeGraph("graph", "labels") }
</script>

<div id="graph">
  200<br /> <br /> <br /> 150 <br /> <br /> <br /> 100 <br /> <br /> <br /> 50
  <ul>
  <li>30:Mathematique</li>
  <li>40:Français</li>
  </ul>

</div>
<div id="labels">Matières</div>

</div>

 <div class="clear"></div>


</div>

<?php
  require($AppelInclude . "footer.inc.html");
?>
