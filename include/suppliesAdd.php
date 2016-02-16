<?php
include("fonction.inc");

session_start();
$login = $_SESSION['login'];
$mdp = $_SESSION['mdp'];

if (empty($_POST['libelle']) || empty($_POST['quantite']))
	{
		echo "<script> alert('Renseignez correctement tous les champs');</script>";
	}

elseif (!empty($_POST['libelle']) && !empty($_POST['quantite']))
	{
		$_POST['libelle'] = htmlspecialchars($_POST['libelle']);
		$_POST['quantite'] = htmlspecialchars($_POST['quantite']);

		$libelle = $_POST['libelle'];
		$quantite = $_POST['quantite'];


		$bdd = connexionDB();

		$query= "SELECT id_Personne FROM personne  WHERE login = '".$login."'";
		$req = $bdd->prepare($query);
		$req->execute();
		$result = mysqli_stmt_get_result($req);
		$row = mysqli_fetch_array($result, MYSQLI_NUM);
		$id_Prof = $row[0];

		$query1 = "INSERT INTO fourniture (id_Fourniture, Libelle ) VALUES(?,?)";
		$query2 = "INSERT INTO contenir (Quantite, id_Fourniture) VALUES(?,?)";
		$query3 = "INSERT INTO choisir (id_Personne, id_Fourniture) VALUES(?,?)";

		$stmt = $bdd->prepare($query1);
		$stmt->bind_param("ss",$val1, $val2);
		$val1 = '';
		$val2 = $libelle;
		$stmt->execute();
		$stmt->close();

		$id_Fourniture = mysqli_insert_id($bdd);

		$stmt = $bdd->prepare($query2);
		$stmt->bind_param("ss",$val1, $val2);
		$val1 = $quantite;
		$val2 = $id_Fourniture;
		$stmt->execute();
		$stmt->close();

		$stmt = $bdd->prepare($query3);
		$stmt->bind_param("ss",$val1, $val2);
		$val1 = $id_Prof;
		$val2 = $id_Fourniture;
		$stmt->execute();
		$stmt->close();

		echo "<script> window.location='../supplies.php';</script>";
	}
?>
