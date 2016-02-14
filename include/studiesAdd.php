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

		$query= "SELECT id_Personne FROM personne  WHERE login = '".$login."'";
		$req = $bdd->prepare($query);
		$req->execute();
		$result = $req->get_result();
		$row = $result->fetch_array(MYSQLI_NUM);
		$id_Prof = $row[0];

    $query1 = "UPDATE professeur SET Matiere = '".$matiere."' WHERE id_Personne= $id_Prof" ;
		$req1 = $bdd->prepare($query1);
		$req1->execute();

		$query2 = "INSERT INTO est_prof VALUES(?,?)";
		$req2 = $bdd->prepare($query2);
		$req2->bind_param("ii",$val1, $val2);
		$val1 = $niveau;
		$val2 = $id_Prof;
		$req2->execute();

		echo "<script> window.location='../studies.php';</script>";
	}
?>
