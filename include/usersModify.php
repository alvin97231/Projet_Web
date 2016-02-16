<?php
include("fonction.inc");

session_start();

if (empty($_POST['id']) || empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['email']))
	{
		echo "<script> alert('Renseignez correctement tous les champs');</script>";
	}

elseif (!empty($_POST['id']) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']))
	{
    $_POST['id'] = htmlspecialchars($_POST['id']);
    $_POST['nom'] = htmlspecialchars($_POST['nom']);
		$_POST['prenom'] = htmlspecialchars($_POST['prenom']);
		$_POST['email'] = htmlspecialchars($_POST['email']);

    $id = $_POST['id'];
		$nom = $_POST['nom'];
		$prenom = $_POST['prenom'];
		$email = $_POST['email'];

		$bdd = connexionDB();

		$query1 = "UPDATE personne SET Nom=?, Prenom=?, login=? WHERE id_Personne=?";


		$stmt = $bdd->prepare($query1);
		$stmt->bind_param("sssi",$val1, $val2, $val3, $val4);
		$val1 = $nom;
		$val2 = $prenom;
		$val3 = $email;
		$val4 = $id;
		$stmt->execute();
		$stmt->close();

		echo "<script> window.location='../main_panel.php';</script>";
	}
?>
