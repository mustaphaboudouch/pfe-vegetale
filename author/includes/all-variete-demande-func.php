<?php
    
    // GET MY VARIETES

    function getMyVarietes($id) {

		global $db;

		$statement = $db->prepare('SELECT *
                                   FROM VARIETES INNER JOIN ESPECES
                                   ON VARIETES.ID_ESPECE = ESPECES.ID_ESPECE
                                   WHERE ID_UTILISATEUR = ?
                                   ORDER BY DATE_CREATION DESC');
        $statement->execute(array($id));
        
		while ($row = $statement->fetch()) {
			echo '<tr>';
				echo '<td>' . $row['NOM_VARIETE'] . '</td>';
                echo '<td>' . $row['NOM_ESPECE'] . '</td>';
				echo '<td>' . $row['DATE_CREATION'] . '</td>';
                if($row['ETAT_VARIETE'] == 0) echo '<td>En attente</td>';
                else echo '<td>Approuvé</td>';
				echo '<td class="my-table-actions">';
                    echo '
                        <form action="pages/preview-variete.php" method="post">
                            <input type="text" name="id_variete_img" value="'. $row['ID_VARIETE'] . '" hidden>
                            <button  class="btn btn-success"><i class="fa fa-eye"></i> Preview</button>
                        </form>';
            
                    echo '<div class="btn-toolbar">';
                        echo '
                            <form action="pages/update-variete.php" method="post">
                                <input type="text" name="id_variete" value="'. $row['ID_VARIETE'] . '" hidden>
                                <button type="submit" name="edit_variete" class="btn btn-primary"><i class="fa fa-edit"></i> Modifier</button>
                            </form>';		
                        echo '<div><button class="btn btn-danger " data-toggle="modal" data-target="#verify_variete" " data-nom_variete="'. $row['NOM_VARIETE'] .'" data-id_variete="' . $row['ID_VARIETE'] .'"><i class="fa fa-trash-alt"></i> Supprimer</button></div>';
                    echo '</div>';
                echo '</td>';
			echo '</tr>';
		}
    }
    
    // ALL VARIETES

    function getAllVarietes($id){

		global $db;

		$statement = $db->prepare('SELECT * FROM VARIETES INNER JOIN ESPECES
                                   ON VARIETES.ID_ESPECE = ESPECES.ID_ESPECE
                                   WHERE ETAT_VARIETE = 1 AND ID_UTILISATEUR <> ?
                                   ORDER BY DATE_CREATION DESC');
                                   
        $statement->execute(array($id));
        
		while ($row = $statement->fetch()) {
			echo '<tr>';
				echo '<td>' . $row['NOM_VARIETE'] . '</td>';
                echo '<td>' . $row['NOM_ESPECE'] . '</td>';
				echo '<td>' . $row['DATE_CREATION'] . '</td>';
				echo '<td>';
                    echo '
                        <form action="pages/preview-all-variete.php" method="post">
                            <input type="text" name="id_variete_img" value="'. $row['ID_VARIETE'] . '" hidden>
                            <button  class="btn btn-success"><i class="fa fa-eye"></i> Preview</button>
                        </form>';
                echo '</td>';
			echo '</tr>';
		}
    }

    // DELETE VARIETE

    function deleteVariete(){
        global $db;
        $id_variete = $_POST['id_variete'];
        $statement = $db->prepare('DELETE FROM VARIETES WHERE VARIETES.ID_VARIETE = ?');
        $statement->execute(array($id_variete));
	}
    
    
    

?>
