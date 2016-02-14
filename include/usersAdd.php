<?php
include("fonction.inc");

session_start();

if (empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['email']) || empty($_POST['role']))
	{
		echo "<script> alert('Renseignez correctement tous les champs');</script>";
	}

elseif (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['role']))
	{
		$_POST['nom'] = htmlspecialchars($_POST['nom']);
		$_POST['prenom'] = htmlspecialchars($_POST['prenom']);
		$_POST['email'] = htmlspecialchars($_POST['email']);
		$_POST['role'] = htmlspecialchars($_POST['role']);

		$nom = $_POST['nom'];
		$prenom = $_POST['prenom'];
		$email = $_POST['email'];
		$role = $_POST['role'];

		$bdd = connexionDB();

		$query1 = "INSERT INTO personne (id_Personne, Nom, Prenom, login, mdp ) VALUES(?,?,?,?,?)";
		$query2 = "INSERT INTO $role (id_Personne) VALUES(?)";

		$stmt = $bdd->prepare($query1);
		$stmt->bind_param("sssss",$val1, $val2, $val3, $val4, $val5);
		$val1 = '';
		$val2 = $nom;
		$val3 = $prenom;
		$val4 = $email;
		$val5 = $nom.$prenom;
		$stmt->execute();
		$stmt->close();

		$stmt = $bdd->prepare($query2);
		$stmt->bind_param("i",$val1);
		$val1 = mysqli_insert_id($bdd);;
		$stmt->execute();
		$stmt->close();

		echo "<script> window.location='../main_panel.php';</script>";
	}
?>
