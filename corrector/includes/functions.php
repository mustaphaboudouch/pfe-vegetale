<?php

	// DELETE VARIETE

    function deleteVariete(){
		global $db;
        $id_variete = $_POST['id_variete'];
        $statement = $db->prepare('DELETE FROM VARIETES WHERE ID_VARIETE = ?');
       	$statement->execute(array($id_variete));
	}

	// VALIDER VARIETE

	function validerVariete(){
		global $db;
		$id_variete = $_POST['id_variete'];
		$statement = $db->prepare('UPDATE VARIETES SET ETAT_VARIETE = 1 WHERE ID_VARIETE = ?');
		$statement->execute([$id_variete]);
	}

	// GET VARIETES

	function getVarietes() {

		global $db;

		$statement = $db->query('SELECT *
                                 FROM VARIETES INNER JOIN ESPECES INNER JOIN UTILISATEURS
                                 ON VARIETES.ID_ESPECE = ESPECES.ID_ESPECE
                                 AND VARIETES.ID_UTILISATEUR = UTILISATEURS.ID_UTILISATEUR
								 WHERE ETAT_VARIETE = 1
								 ORDER BY DATE_CREATION DESC');

		while ($row = $statement->fetch()) {
			echo '<tr>';
				echo '<td>' . $row['NOM_VARIETE'] . '</td>';
                echo '<td>' . $row['NOM_ESPECE'] . '</td>';
				echo '<td>' . $row['PRENOM'] . ' ' . $row['NOM'] . '</td>';
				echo '<td>' . $row['DATE_CREATION'] . '</td>';
				echo '<td class="my-table-actions">';
					// preview button
					echo '
						<form action="pages/preview-variete.php" method="post">
							<input type="text" name="id_variete_img" value="'. $row['ID_VARIETE'] . '" hidden>
							<button  class="btn btn-primary"><i class="fa fa-eye"></i> Preview</button>
						</form>';
					// supprimer button
                    echo '<div><button class="btn btn-danger" data-toggle="modal" data-target="#verify_variete"  data-nom_variete="'. $row['NOM_VARIETE'] .'" data-id_variete="' . $row['ID_VARIETE'] .'"><i class="fa fa-trash-alt"></i> Supprimer</button></div>';
				echo '</td>';
			echo '</tr>';
		}
	}

	// GET DEMANDES

	function getDemandes() {

		global $db;

		$statement = $db->query('SELECT *
                                 FROM VARIETES INNER JOIN ESPECES INNER JOIN UTILISATEURS
                                 ON VARIETES.ID_ESPECE = ESPECES.ID_ESPECE
                                 AND VARIETES.ID_UTILISATEUR = UTILISATEURS.ID_UTILISATEUR
								 WHERE ETAT_VARIETE = 0
								 ORDER BY DATE_CREATION DESC');

		while ($row = $statement->fetch()) {
			echo '<tr>';
				echo '<td>' . $row['NOM_VARIETE'] . '</td>';
                echo '<td>' . $row['NOM_ESPECE'] . '</td>';
				echo '<td>' . $row['PRENOM'] . ' ' . $row['NOM'] . '</td>';
				echo '<td>' . $row['DATE_CREATION'] . '</td>';
				echo '<td class="my-table-actions">';
					// preview button
					echo '
						<form action="pages/preview-variete.php" method="post">
							<input type="text" name="id_variete_img" value="'. $row['ID_VARIETE'] . '" hidden>
							<button  class="btn btn-primary"><i class="fa fa-eye"></i> Preview</button>
						</form>';
					// valider button
					echo '<div><button class="btn btn-success" data-toggle="modal" data-target="#verify_valider" " data-nom_variete="'. $row['NOM_VARIETE'] .'" data-id_variete="' . $row['ID_VARIETE'] .'"><i class="fa fa-check-double"></i> Valider</button></div>';
					// supprimer button
					echo '<div><button class="btn btn-danger" data-toggle="modal" data-target="#verify_variete"  data-nom_variete="'. $row['NOM_VARIETE'] .'" data-id_variete="' . $row['ID_VARIETE'] .'"><i class="fa fa-trash-alt"></i> Supprimer</button></div>';
				echo '</td>';
			echo '</tr>';
		}
	}

    // COUNT ESPECES

	function countEspece() {

		global $db;

		$statement = $db->query('SELECT COUNT(ID_ESPECE) AS COUNT FROM ESPECES');
		$count = $statement->fetch();
		echo $count['COUNT'];
	}

	// COUNT VARIETIES

	function countVariete() {

		global $db;

		$statement = $db->query('SELECT COUNT(ID_VARIETE) AS COUNT FROM VARIETES WHERE ETAT_VARIETE = 1');
		$count = $statement->fetch();
		echo $count['COUNT'];
	}

	// COUNT DEMANDES

	function countDemande() {

		global $db;

		$statement = $db->query('SELECT COUNT(ID_VARIETE) AS COUNT FROM VARIETES WHERE ETAT_VARIETE = 0');
		$count = $statement->fetch();
		echo $count['COUNT'];
	}

	// COUNT USERS

	function countUser($type) {

		global $db;

		$statement = $db->prepare('SELECT COUNT(ID_UTILISATEUR) AS COUNT FROM UTILISATEURS WHERE TYPE_COMPTE = ?');
		$statement->execute(array($type));
		$count = $statement->fetch();
		echo $count['COUNT'];
	}

	// SEARCH PAGE

	function allEspeces(){
		global $db;
		$statement = $db->query('SELECT * from ESPECES');
		while ($item = $statement->fetch()) {
			echo '<option value="' . $item['ID_ESPECE'] . '">' . $item['NOM_ESPECE'] . '</option>';
		}
	}
	



?>
