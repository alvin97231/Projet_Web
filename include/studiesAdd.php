<?php
include("fonction.inc");

session_start();
$login = $_SESSION['login'];
$mdp = $_SESSION['mdp'];

if (empty($_POST['matiere']) || empty($_POST['niveau']))
	{
		echo "<script> alert('Renseignez correctement tous les champs');</script>";
	}

elseif (!empty($_POST['matiere']) && !empty($_POST['niveau']))
	{
		$_POST['matiere'] = htmlspecialchars($_POST['matiere']);
		$_POST['niveau'] = htmlspecialchars($_POST['niveau']);

		$matiere = $_POST['matiere'];
		$niveau = $_POST['niveau'];

		$bdd = connexionDB();

		$req = $bdd->prepare("UPDATE professeur SET Matiere = $matiere WHERE id_Personne= (SELECT id_Personne
																																											  FROM personne
																																											  WHERE login = $login
																																											  AND mdp = $mdp)" );
		$req->execute();
		echo "<script> window.location='../panel.php';</script>";
	}
?>
