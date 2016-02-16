<?php
include("fonction.inc");

session_start();
echo "<script> alert('Voulez-vous vraiment supprimer?');</script>";
if (empty($_GET['id']))
	{
		echo "<script> alert('Renseignez correctement tous les champs');</script>";
	}

elseif (!empty($_GET['id']))
	{

		$id = $_GET['id'];

		$bdd = connexionDB();
		$role = 'administrateur';
		$query1 = "SELECT id_Personne FROM $role WHERE id_Personne = ?";
		$query2 = "DELETE FROM $role WHERE id_Personne = ?";
		$query3 = "DELETE FROM personne WHERE id_Personne = ?";

		$stmt = $bdd->prepare($query1);
		$stmt->bind_param("i",$val1);
		$val1 = $id;
		$stmt->execute();
		$row = $stmt->fetch();

		$stmt2 = $bdd->prepare($query2);
		$stmt2->bind_param("i",$val1);
		$val1 = $id;

		$stmt3 = $bdd->prepare($query3);
		$stmt3->bind_param("i",$val1);
		$val1 = $id;

		if(!empty($row)){
			$stmt->close();
			$stmt2->execute();
			$stmt2->close();
			$stmt3->execute();
			$stmt3->close();
		}
		elseif (!$row) {
			$role = 'professeur';
			$stmt = $bdd->prepare($query1);
			$stmt->bind_param("i",$val1);
			$val1 = $id;
			$stmt->execute();
			$row = $stmt->fetch();


			if(!empty($row)){
				$stmt->close();
				$stmt2->execute();
				$stmt2->close();
				$stmt3->execute();
				$stmt3->close();
			}
			elseif (!$row) {
				$role = 'eleve';
				$query1 = "SELECT id_Personne FROM $role WHERE id_Personne = ?";
				$stmt = $bdd->prepare($query1);
				$stmt->bind_param("i",$val1);
				$val1 = $id;
				$stmt->execute();
				$row = $stmt->fetch();

				if(!empty($row)){
					$stmt->close();
					$stmt2->execute();
					$stmt2->close();
					$stmt3->execute();
					$stmt3->close();
				}
			}
		}
		echo "<script> window.location='../main_panel.php';</script>";
	}
?>
