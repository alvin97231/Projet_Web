<?php
include("fonction.inc");

if (empty($_POST['classe']))
	{
		echo "<script> alert('Renseignez correctement tous les champs');</script>";
	}

elseif (!empty($_POST['classe']))
	{
		$_POST['level'] = htmlspecialchars($_POST['level']);
		$niveau = $_POST['level'];

		$bdd = connexionDB();

		$req = $bdd->prepare("INSERT INTO classe (id_Classe, Niveau) VALUES('', '$niveau')");
		$req->execute();
		echo "<script> window.location='../panel.php';</script>";
	}
?>
