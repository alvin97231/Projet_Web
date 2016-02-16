<?php

/**
 * Permet a travers un objet msqli, la connexion a la base de données
 * @return mysqli $bdd
*/
function connexionDB()
{
	try
		{
			$bdd = new mysqli("localhost", "root", "", "f4U");
			return $bdd;
		}
	catch(Exception $e)
		{
        	die('Erreur : '.$e->getMessage());
		}
}

/**
 * Connecte un utilisateur avec ses parametre
 * @param $bdd objet myqli
 * @param $login string de $POST['login']
 * @param $mdp string de $POST['mdp']
 * @return session demarrée ou redirection si mauvaises valeurs
*/
function initSessionUtilisateur($bdd, $login, $mdp)
{
	$req = "SELECT login, mdp, id_Personne
			FROM personne
			WHERE login = '".$login."'
			AND mdp = '".$mdp."'
			";

	$requete = $bdd->prepare($req);
	$resultat = $requete->execute();
	$requete->bind_result($log, $md, $id);
	$row = $requete->fetch();

		if (!$row)
		{
			echo "<script> alert('Identifiant ou mot de passe incorrect');</script>";
			echo "<script> window.location='../index.php';</script>";
		}
		else
		{
	    session_start();
	    $_SESSION['login'] = $login;
	    $_SESSION['mdp'] = $mdp;
	    echo "<script> alert('Vous \352tes connect\351');</script>";
			echo "<script> window.location='../main.php';</script>";
	}
}

/**
 * Affecte a $idU la valeur de l'id de l'utilisateur qui s'est connecté
 * @param $bdd objet mysqli
 * @param $login string de $POST['login']
 * @param $mdp string de $POST['mdp']
*/
function affectTypeUtilisateur($bdd)
{
	session_start();
	$login = $_SESSION['login'];
	$mdp = $_SESSION['mdp'];

	$req1 = "SELECT id_Personne
			FROM personne
			WHERE login =  '".$login."'
			AND mdp = '".$mdp."'
			AND id_Personne IN (SELECT id_Personne
													FROM eleve)";

	$req2 = "SELECT id_Personne
			FROM personne
			WHERE login =  '".$login."'
			AND mdp = '".$mdp."'
			AND id_Personne IN (SELECT id_Personne
													FROM professeur)";

	$req3 = "SELECT id_Personne
		  FROM personne
		  WHERE login =  '".$login."'
		  AND mdp = '".$mdp."'
		  AND id_Personne IN (SELECT id_Personne
		  										FROM administrateur)";

	$stmt = $bdd->prepare($req1);
	$stmt->execute();
	$stmt->bind_result($id);
	$row = $stmt->fetch();
	$_SESSION['type'] = 0;

	if ( $row ){
		$_SESSION['type'] = 1;
		$_SESSION['id_Eleve']=$id;
	}
	else if (!$row) {
		$stmt = $bdd->prepare($req2);
		$stmt->execute();
		$stmt->bind_result($id);
		$row = $stmt->fetch();

		if ( $row ){
			$_SESSION['type'] = 2;
			$_SESSION['id_Prof']=$id;
		}
		else if (!$row) {
			$stmt = $bdd->prepare($req3);
			$stmt->execute();
			$stmt->bind_result($id);
			$row = $stmt->fetch();

			if ( $row ){
				$_SESSION['type'] = 3;
				$_SESSION['id_Admin']=$id;
			}
		}
	}
}

/**
 * Fournit la liste des enseignements dans un tableau
 * @param $bdd objet msqli
 * @return Array
*/
function studiesTeacherList($bdd)
{
	$id_Prof = $_SESSION['id_Prof'];

	$query1 = "SELECT Matiere FROM professeur WHERE id_Personne = ?";
	$query2 = "SELECT id_Classe FROM est_prof WHERE id_Personne = ?";
	$query3 = "SELECT Niveau FROM classe WHERE id_Classe = ?";

	$stmt = $bdd->prepare($query1);
	$stmt->bind_param("i",$val1);
	$val1 = $id_Prof;
	$stmt->execute();
	$result = $stmt -> get_result();
	$display="";
	$display.='<table><thead><tr><th>Discipline</th><th>Niveau</th></tr></thead><tbody>';

	while ($val = $result -> fetch_assoc())

		{
				$matiere = $val['Matiere'];

				$display.="<tr>";
				$display.="<td>$matiere</td>";
		}

		$stmt = $bdd->prepare($query2);
		$stmt->bind_param("s",$val1);
		$val1 = $id_Prof;
		$stmt->execute();
		$result = $stmt -> get_result();
		$row = $result -> fetch_array( MYSQLI_NUM);
		$id_Classe = $row[0];

		$stmt = $bdd->prepare($query3);
		$stmt->bind_param("i",$val1);
		$val1 = $id_Classe;
		$stmt->execute();
		$result = $stmt -> get_result();

		while ($val = $result -> fetch_assoc())

			{
					$matiere = $val['Niveau'];

					$display.="<td>$matiere</td>";
			}

			$display.='</tr></tbody></table>';
	echo $display;
	$stmt -> close();
	$result -> free();
	//$bdd -> close();
}

/**
 * Fournit la liste des enseignements dans un tableau
 * @param $bdd objet msqli
 * @return Array
*/
function studiesAdminList($bdd)
{

	$query1 = "SELECT Matiere, id_Personne FROM professeur";
	$query2 = "SELECT id_Classe FROM est_prof WHERE id_Personne = ?";
	$query3 = "SELECT Niveau FROM classe WHERE id_Classe = ?";
	$query4 = "SELECT Nom , Prenom FROM personne WHERE id_Personne = ?";

	$stmt = $bdd->prepare($query1);
	$stmt->execute();
	$result = $stmt -> get_result();
	$row = $result -> fetch_all();
	$display="";
	$display.='<table><thead><tr><th>Discipline</th><th>Niveau</th><th colspan="2">Professeur</th></tr></thead><tbody>';

	foreach ($row as $value){

			if($value[0] !== NULL){
				$matiere = $value[0];
				$id_Personne = $value[1];

				$display.='<tr>';
				$display.="<td>$matiere</td>";

				$stmt = $bdd->prepare($query2);
				$stmt->bind_param("s",$val1);
				$val1 = $id_Personne;
				$stmt->execute();
				$result = $stmt -> get_result();
				$row = $result -> fetch_array( MYSQLI_NUM);
				$id_Classe = $row[0];

				$stmt = $bdd->prepare($query3);
				$stmt->bind_param("i",$val1);
				$val1 = $id_Classe;
				$stmt->execute();
				$result = $stmt -> get_result();
				$val = $result -> fetch_assoc();

				$niveau= $val['Niveau'];
				$display.="<td>$niveau</td>";

				$stmt = $bdd->prepare($query4);
				$stmt->bind_param("i",$val1);
				$val1 = $id_Personne;
				$stmt->execute();
				$result = $stmt -> get_result();
				$val = $result -> fetch_assoc();

				$nom= $val['Nom'];
				$prenom= $val['Prenom'];

				$display.="<td>$nom</td>";
				$display.="<td>$prenom</td>";
			}
		}

	$display.='</tr></tbody></table>';
	echo $display;

	$stmt->close();
	$result -> free();
	$bdd -> close();
}

/**
 * Fournit la liste des fournitures dans un tableau en fonction du prof
 * @param $bdd objet msqli
 * @return Array
*/
function suppliesTeacherList($bdd)
{
	$id_Prof = $_SESSION['id_Prof'];

	$display='';

	$query1= "SELECT id_Fourniture FROM choisir  WHERE id_Personne = ?";
	$query2= "SELECT Quantite FROM contenir  WHERE id_Fourniture = ?";
	$query3= "SELECT Libelle FROM fourniture  WHERE id_Fourniture = ?";

	$stmt = $bdd->prepare($query1);
	$stmt->bind_param("s",$val1);
	$val1 = $id_Prof;
	$stmt->execute();
	$result = $stmt -> get_result();
	$row = $result -> fetch_all();
	$display.='<table><thead><tr><th>Quantité</th><th>Libellé</th></tr></thead><tbody>';

	for($i = 0; $i < count($row); ++$i) {
		$id_Fourniture = $row[$i][0];

		$stmt = $bdd->prepare($query2);
		$stmt->bind_param("i",$val1);
		$val1 = $id_Fourniture;
		$stmt->execute();
		$result = $stmt -> get_result();

		while ($val = $result -> fetch_assoc())

			{
					$quantite = $val['Quantite'];

					$display.= "<tr>";

					$display.= "<td>$quantite</td>";
			}

			$stmt = $bdd->prepare($query3);
			$stmt->bind_param("i",$val1);
			$val1 = $id_Fourniture;
			$stmt->execute();
			$result = $stmt -> get_result();

			while ($val = $result -> fetch_assoc())

				{
						$libelle = $val['Libelle'];

						$display.= "<td>$libelle</td>";
				}
	}
	$display.= "</tr>\n";
	$display.= "</tbody></table>";
	echo $display;
	$stmt->close();
	$result -> free();
	//$bdd -> close();
}

/**
 * Fournit la liste des fournitures dans un tableau en fonction du prof
 * @param $bdd objet msqli
 * @return Array
*/
function suppliesStudentList($bdd)
{
	$display='';

	$id_Eleve = $_SESSION['id_Eleve'];

	$query1= "SELECT id_Classe FROM eleve  WHERE id_Personne = ?";
	$query2= "SELECT id_Personne FROM est_prof  WHERE id_Classe = ?";
	$query3= "SELECT id_Fourniture FROM choisir  WHERE id_Personne = ?";
	$query4= "SELECT Quantite FROM contenir  WHERE id_Fourniture = ?";
	$query5= "SELECT Libelle FROM fourniture  WHERE id_Fourniture = ?";

	$stmt = $bdd->prepare($query1);
	$stmt->bind_param("s",$val1);
	$val1 = $id_Eleve;
	$stmt->execute();
	$stmt->bind_result($id);
	$row = $stmt -> fetch();
	$id_Classe = $id;
	$stmt->close();

	$stmt = $bdd->prepare($query2);
	$stmt->bind_param("s",$id_Classe);
	$stmt->execute();
	$result = $stmt -> get_result();
	$row = $result -> fetch_all();
	$display.='<table><thead><tr><th>Quantite</th><th>Libelle</th></tr></thead><tbody>';


	foreach ($row as $value) {
		foreach ($value as $key) {

			$stmt = $bdd->prepare($query3);
			$stmt->bind_param("s",$val1);
			$val1 = $key;
			$stmt->execute();
			$result = $stmt -> get_result();
			$row = $result -> fetch_all();

			for($i = 0; $i < count($row); ++$i) {
				$id_Fourniture = $row[$i][0];

				$stmt = $bdd->prepare($query4);
				$stmt->bind_param("i",$val1);
				$val1 = $id_Fourniture;
				$stmt->execute();
				$result = $stmt -> get_result();

				while ($val = $result -> fetch_assoc())

					{
							$quantite = $val['Quantite'];

							$display.="<tr>";

							$display.="<td>$quantite</td>";
					}

					$stmt = $bdd->prepare($query5);
					$stmt->bind_param("i",$val1);
					$val1 = $id_Fourniture;
					$stmt->execute();
					$result = $stmt -> get_result();

					while ($val = $result -> fetch_assoc())

						{
								$libelle = $val['Libelle'];

								$display.= "<td>$libelle</td>";
						}
			}
			$display.= "</tr>\n";
			$display.= "</tbody></table>";
			echo $display;
			$stmt->close();
			$result -> free();
		}
	}
}

/**
 * Fournit la liste des fournitures dans un tableau en fonction du prof
 * @param $bdd objet msqli
 * @return Array
*/
function suppliesAdminList($bdd)
{
	$display='';

	$query1= "SELECT id_Fourniture , id_Personne FROM choisir ";
	$query2= "SELECT Quantite FROM contenir  WHERE id_Fourniture = ?";
	$query3= "SELECT Libelle FROM fourniture  WHERE id_Fourniture = ?";
	$query4 = "SELECT Nom , Prenom FROM personne WHERE id_Personne = ?";

	$stmt = $bdd->prepare($query1);
	$stmt->execute();
	$stmt->bind_result($id_Fourniture, $id_Personne);
	$result = $stmt -> get_result();
	$row = $result -> fetch_all();
	//$stmt->close();

	$display.='<table><thead><tr><th>Quantité</th><th>Libellé</th><th colspan="2">Professeur</th></tr></thead><tbody>';

	foreach ($row as $value) {
		$stmt = $bdd->prepare($query2);
		$stmt->bind_param("i",$val1);
		$val1 = $value[0];
		$stmt->execute();
		$result = $stmt -> get_result();
		$val = $result -> fetch_assoc();

		$quantite = $val['Quantite'];
		$display.="<tr>";
		$display.="<td>$quantite</td>";

		$stmt = $bdd->prepare($query3);
		$stmt->bind_param("i",$val1);
		$val1 = $value[0];
		$stmt->execute();
		$result = $stmt -> get_result();
		$val = $result -> fetch_assoc();

		$libelle = $val['Libelle'];
		$display.="<td>$libelle</td>";

		$stmt = $bdd->prepare($query4);
		$stmt->bind_param("i",$val1);
		$val1 = $value[1];
		$stmt->execute();
		$result = $stmt -> get_result();
		$val = $result -> fetch_assoc();

		$nom= $val['Nom'];
		$prenom= $val['Prenom'];

		$display.="<td>$nom</td>";
		$display.="<td>$prenom</td>";
	}
	$display.= "</tr>\n";
	$display.= "</tbody></table>";
	echo $display;
	$stmt->close();
	$result -> free();
}

/**
 * Fournit la liste utilisateurs dans un tableau
 * @param $bdd
 * @return Array
*/
function usersList($bdd)
{

	$req = "SELECT id_Personne, Nom, Prenom, login FROM personne";

	$requete = $bdd->prepare($req);
	$requete->execute();
	$result = $requete -> get_result();

	while ($val = $result -> fetch_assoc())

		{
				$id = $val['id_Personne'];
				$nom = $val['Nom'];
				$prenom = $val['Prenom'];
				$login = $val['login'];


				echo "<tr>";
				echo "<td>$id</td>";
				echo "<td>$nom</td>";
				echo "<td>$prenom</td>";
				echo "<td>$login</td>";
				echo '<td><a href="main_panel.php?id='. $id .'&nom='. $nom .'&prenom='. $prenom .'&mail='. $login .'#oModal">modifier</a></td>';
				echo '<td><a href="include/usersDel.php?id='. $id .'">supprimer</a></td>';
				echo "</tr>\n";
		}


		$result -> free();
		$bdd -> close();
}


/**
 * Fournit la liste des fournitures dans un tableau en fonction du prof
 * @param $bdd objet msqli
 * @return Array
*/
function StudentList($bdd)
{

	$id_Eleve = $_SESSION['id_Eleve'];

	$query1= "SELECT id_Classe FROM eleve  WHERE id_Personne = ?";
	$query2= "SELECT id_Personne FROM est_prof  WHERE id_Classe = ?";
	$query3= "SELECT id_Fourniture FROM choisir  WHERE id_Personne = ?";
	$query4= "SELECT Quantite FROM contenir  WHERE id_Fourniture = ?";
	$query5= "SELECT Libelle FROM fourniture  WHERE id_Fourniture = ?";
	$query6= "SELECT Matiere FROM professeur  WHERE id_Personne = ?";

	$stmt = $bdd->prepare($query1);
	$stmt->bind_param("s",$val1);
	$val1 = $id_Eleve;
	$stmt->execute();
	$stmt->bind_result($id);
	$row = $stmt -> fetch();
	$id_Classe = $id;
	$stmt->close();

	$stmt = $bdd->prepare($query2);
	$stmt->bind_param("s",$id_Classe);
	$stmt->execute();
	$result = $stmt -> get_result();
	$row = $result -> fetch_all();

	foreach ($row as $value) {

		foreach ($value as $key) {
			$display='';
			$stmt = $bdd->prepare($query6);
			$stmt->bind_param("s",$val1);
			$val1 = $key;
			$stmt->execute();
			$stmt->bind_result($matiere);
			$row = $stmt -> fetch();
			$stmt->close();

			$display.="<table><thead><tr><th colspan=\"2\">$matiere</th></tr><tr><th>Quantité</th><th>Libellé</th></tr></thead><tbody>";
			$stmt = $bdd->prepare($query3);
			$stmt->bind_param("s",$val1);
			$val1 = $key;
			$stmt->execute();
			$result = $stmt -> get_result();
			$row2 = $result -> fetch_all();

			foreach ($row2 as $value2) {

				$stmt = $bdd->prepare($query4);
				$stmt->bind_param("i",$val1);
				$val1 = $value2[0];
				$stmt->execute();
				$stmt->bind_result($quantite);
				$stmt -> fetch();
				$stmt->close();
				$display.='<tr draggable="true" ondragstart="drag(event, this)">';
				$display.="<td>$quantite</td>";

				$stmt = $bdd->prepare($query5);
				$stmt->bind_param("i",$val1);
				$val1 =  $value2[0];
				$stmt->execute();
				$stmt->bind_result($libelle);
				$stmt -> fetch();
				$stmt->close();
				$display.= "<td>$libelle</td>";
				$display.="</tr>\n";
			}
			$display.= "</tbody></table>";
			echo $display;
		}
	}
	$result -> free();
}

/**
 * Transforme une date au format français jj/mm/aaaa vers le format anglais aaaa-mm-jj
 * @param $date au format  jj/mm/aaaa
 * @return string la date au format anglais aaaa-mm-jj
*/
function convertirDateFrancaisVersAnglais($date){
	@list($jour,$mois,$annee) = explode('/',$date);
	return date("Y-m-d", mktime(0, 0, 0, $mois, $jour, $annee));
}

/**
 * Transforme une date au format format anglais aaaa-mm-jj vers le format
 * français jj/mm/aaaa
 * @param $date au format  aaaa-mm-jj
 * @return string la date au format format français jj/mm/aaaa
*/
function convertirDateAnglaisVersFrancais($date)
{
    @list($annee,$mois,$jour) = explode('-',$date);
	return date("d/m/Y", mktime(0, 0, 0, $mois, $jour, $annee));
}


function estUtilisateurConnecte()
{
    return isset($_SESSION['login']);
}

 function verifConnecte()
 {
 	if(! estUtilisateurConnecte())
 	{
 		header("location:./index.php");
 	}
 }
?>
