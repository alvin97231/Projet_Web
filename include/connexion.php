<?php
include("fonction.inc");

	$login = $_POST['login'];
	$mdp = $_POST['mdp'];

	$bdd = connexionDB();
	initSessionUtilisateur($bdd, $login, $mdp);
?>
