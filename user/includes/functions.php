<?php

    $db = DatabaseUser::connect();
	session_start();
    $isExist = false;
    $nom = $prenom = $identifiant = $motdepasse = $message_error = "";

    function checkInput($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
    }


    function checkConnection() {

        if (isset($_SESSION['id'])) {
            if($_SESSION['type'] == 4) {
                $id = $_SESSION['id'];
            }
            else {
                header("location: /pfe/access/login.php");
            }
        } else {
            header("location: /pfe/access/login.php");
        }
        return $id;
	}

	// GET NOM ET PRENOM

	function getNom($id) {

		global $db;

		$statement = $db->prepare('SELECT PRENOM,NOM FROM UTILISATEURS WHERE ID_UTILISATEUR = ?');
		$statement->execute(array($id));
		$account = $statement->fetch();
		echo $account['PRENOM'] .' '.$account['NOM'];
	}

    // compare page
    function compareVariete($id1,$id2){
        /*
            [id_variete1 => [nom => nom_variete ,
                             organes => [
                                        organe1 => [[nom_caractere => ,nom_niveau_expression => ,notation => ],
                                         [nom_caractere => ,nom_niveau_expression => ,notation => ],...],

                                        organe2 => [[nom_caractere => ,nom_niveau_expression => ,notation => ],
                                         [nom_caractere => ,nom_niveau_expression => ,notation => ],...],
                                        . . .
                                        . . .
                                        . . .
                                        . . .
                                        ]
                             ],
            id_variete2 => [nom => nom_variete,
                            organes => [
                                        organe1 => [[nom_caractere => ,nom_niveau_expression => ,notation => ],
                                         [nom_caractere => ,nom_niveau_expression => ,notation => ],...],

                                        organe2 => [[nom_caractere => ,nom_niveau_expression => ,notation => ],
                                         [nom_caractere => ,nom_niveau_expression => ,notation => ],...],
                                        . . .
                                        . . .
                                        . . .
                                        . . .
                                        ]
                            ],
            ]
        */
        global $db;
        $data = array();
        $varietes = [$id1,$id2];

        foreach($varietes as $id_variete){
            $statement0 = $db->prepare('SELECT * FROM VARIETES WHERE ID_VARIETE = ?');
            $statement0->execute(array($id_variete));
            $nom_variete = $statement0->fetch();

            $statement1 = $db->prepare('SELECT * FROM NOTATIONS INNER JOIN VARIETES INNER JOIN ORGANES INNER JOIN CARACTERES INNER JOIN NIVEAU_EXPRESSIONS
                               ON VARIETES.ID_VARIETE = NOTATIONS.ID_VARIETE AND ORGANES.ID_ORGANE = NOTATIONS.ID_ORGANE AND CARACTERES.ID_CARACTERE = NOTATIONS.ID_CARACTERE AND NIVEAU_EXPRESSIONS.ID_NIVEAU_EXPRESSION = NOTATIONS.ID_NIVEAU_EXPRESSION
                               WHERE NOTATIONS.ID_VARIETE = ?
                               GROUP BY NOTATIONS.ID_ORGANE');
            $statement1->execute([$id_variete]);
            while($row = $statement1->fetch()){
                 $organes = $row['NOM_ORGANE'];
                 $statement2 = $db->prepare('SELECT * FROM NOTATIONS INNER JOIN VARIETES INNER JOIN ORGANES INNER JOIN CARACTERES INNER JOIN NIVEAU_EXPRESSIONS
                               ON VARIETES.ID_VARIETE = NOTATIONS.ID_VARIETE AND ORGANES.ID_ORGANE = NOTATIONS.ID_ORGANE AND CARACTERES.ID_CARACTERE = NOTATIONS.ID_CARACTERE AND NIVEAU_EXPRESSIONS.ID_NIVEAU_EXPRESSION = NOTATIONS.ID_NIVEAU_EXPRESSION
                               WHERE NOTATIONS.ID_VARIETE = ? and NOTATIONS.ID_ORGANE = ?
                               ');
                $statement2->execute(array($id_variete,$row['ID_ORGANE']));
                while($row = $statement2->fetch()){
                    $data[$id_variete]['nom'] = $nom_variete["NOM_VARIETE"];
                    $data[$id_variete]['organes'][$organes][] =  ['nom_caractere' => $row['NOM_CARACTERE'],
                                   'nom_niveau_expression' => $row['NOM_NIVEAU_EXPRESSION'],
                                   'notation'=>$row['NOTATION']] ;
                }
            }
        }
        return $data;
    }

    function varieteOfEspece($id_espece){
        global $db;
        $statement = $db->prepare('SELECT * FROM VARIETES WHERE ID_ESPECE = ?');
        $statement->execute(array($id_espece));
        while ($item = $statement->fetch()) {
                echo '<option value="' . $item['ID_VARIETE'] . '">' . $item['NOM_VARIETE'] . '</option>';
        }
    }

    function selectedEspece($id_espece){
        global $db;
        $statement = $db->query('SELECT * from ESPECES');
        while ($item = $statement->fetch()) {
            echo '<option value="' . $item['ID_ESPECE'] . '" ' . ($item['ID_ESPECE'] == $id_espece ? "selected": "") . '> ' . $item['NOM_ESPECE'] . '</option>';
        }
    }

    // PROFILE PAGE

    function userInfo($id_utilisateur){
        global $db,$nom,$prenom ,$identifiant,$motdepasse,$type,$image_user;
        $statement = $db->prepare('SELECT * FROM UTILISATEURS WHERE ID_UTILISATEUR = ?');
        $statement->execute([$id_utilisateur]);
        while($item = $statement->fetch()) {
            $nom = $item['NOM'];
            $prenom = $item['PRENOM'];
            $type = $item['TYPE_COMPTE'];
            $identifiant = $item['IDENTIFIANT'];
            $motdepasse = $item['MOT_DE_PASSE'];
            $image_user = $item['IMAGE_UTILISATEUR'];
        }
    }

    function updateUser($id){
        global $db,$message_error,$isExist;
        $nom = checkInput($_POST['nom']);
        $prenom = checkInput($_POST['prenom']);
        $identifiant = checkInput($_POST['identifiant']);
        $motdepasse = checkInput($_POST['motdepasse']);

        if (empty($nom) || empty($prenom) || empty($identifiant) || empty($motdepasse)) {
            $message_error = '<h6 style="color: #FF0000;">* Il y a des champs vides<h6>';
        }
        else {
            $message_error = "";
            $statement2 = $db->prepare('SELECT * FROM UTILISATEURS WHERE ID_UTILISATEUR <> ?');
            $statement2->execute(array($id));
            while ($item = $statement2->fetch()) {
                if ($item['IDENTIFIANT'] == $identifiant) {
                    $isExist = true;
                    break;
                }
            }
            if ($isExist == true) {
                $message_error = '<h6 style="color: #FF0000;">* Identifiant existe déjà<h6>';
            }
            else {
                $statement3 = $db->prepare('UPDATE UTILISATEURS
                                            SET NOM = ?, PRENOM = ?, IDENTIFIANT = ?,
                                            MOT_DE_PASSE = ?
                                            WHERE ID_UTILISATEUR = ?');
                $statement3->execute(array($nom, $prenom, $identifiant, $motdepasse,$id));
            }
        }
    }

    function selectedUserType($type){
        $accountTypes = ["admin","correcteur","auteur","utilisateur"];
        for ($i = 0;$i< count($accountTypes);$i++) {
            if(trim($accountTypes[$i]) == trim($type)) echo '<option value="'.$accountTypes[$i].'" selected>'.$accountTypes[$i].'</option>';
            else echo '<option value="'.$accountTypes[$i].'">'.$accountTypes[$i].'</option>';
        }
    }

    // search page
    function allEspeces(){
        global $db;
        $statement = $db->query('SELECT * from ESPECES');
        while ($item = $statement->fetch()) {
            echo '<option value="' . $item['ID_ESPECE'] . '">' . $item['NOM_ESPECE'] . '</option>';
        }
    }

    function listOfVarietes(){
        global $db;
        $statement = $db->query('SELECT ID_VARIETE, NOM_VARIETE, IMAGE_VARIETE, NOM_ESPECE
										 FROM VARIETES INNER JOIN ESPECES
										 ON VARIETES.ID_ESPECE = ESPECES.ID_ESPECE
										 ORDER BY DATE_CREATION DESC');
        while ($item = $statement->fetch()) {

            echo '<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" >';
                echo '<div class="card">';
                    echo '<div class="image-variete">';
                        echo '<a href="pages/preview.php?id_variete='.$item['ID_VARIETE'].'"> <img src="../images/' . $item['IMAGE_VARIETE'] . '" class="card-img-top" style="border:0;"></a>';
                    echo '</div>';
                    echo '<div class="card-body">';
                        echo '<h5 class="card-title">' . $item['NOM_VARIETE'] . '</a></h5>';
                        echo '<h6 class="card-subtitle text-muted">' . $item['NOM_ESPECE'] . '</h6>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';

        }
    }

    function organesOfVariete($id_variete){
        global $db;

        $statement = $db->prepare('SELECT * FROM NOTATIONS
                                    INNER JOIN ORGANES
                                    ON ORGANES.ID_ORGANE = NOTATIONS.ID_ORGANE
                                    WHERE NOTATIONS.ID_VARIETE = ?
                                    GROUP BY ORGANES.ID_ORGANE');
        $statement->execute(array($id_variete));

        $arr = $statement->fetchAll();
        return $arr;
    }

    function organeInfo($id_variete){
        global $db;
        $statement = $db->prepare('SELECT * FROM ESPECES INNER JOIN VARIETES
                                    INNER JOIN ORGANES
                                    INNER JOIN CARACTERES
                                    INNER JOIN NIVEAU_EXPRESSIONS
                                    INNER JOIN NOTATIONS
                                    ON ESPECES.ID_ESPECE = VARIETES.ID_ESPECE
                                    AND VARIETES.ID_VARIETE = NOTATIONS.ID_VARIETE
                                    AND ORGANES.ID_ORGANE = NOTATIONS.ID_ORGANE
                                    AND CARACTERES.ID_CARACTERE = NOTATIONS.ID_CARACTERE
                                    AND NIVEAU_EXPRESSIONS.ID_NIVEAU_EXPRESSION = NOTATIONS.ID_NIVEAU_EXPRESSION
                                    WHERE NOTATIONS.ID_VARIETE = ?
                                    ORDER BY ORGANES.ID_ORGANE');
        $statement->execute(array($id_variete));
        $arr = $statement->fetchAll();
        return $arr;
    }

    function printOrganeInfo($organeID,$organesInfo,$id_user,$id_owner){
        foreach ($organesInfo as $organe) {
            if ($organeID == $organe['ID_ORGANE']) {
                echo '<tr>';
                    echo '<td>' . $organe['NOM_CARACTERE'] . '</td>';
                    echo '<td>' . $organe['NOM_NIVEAU_EXPRESSION'] . '</td>';
                    echo '<td>' . $organe['NOTATION'] . '</td>';
                    if($id_owner == $id_user){
                        echo '<td>
                        <form action="update-notation.php" method="post">
                            <input type="text" name="id_notation" value="'. $organe['ID_NOTATION'] . '" hidden>
                            <button type="submit" name="edit_notation" class="btn btn-primary">Edit</button>
                        </form>
                        </td>';
                        echo '<td><button href="#" data-toggle="modal" data-target="#verify_notation" data-id_notation='.$organe['ID_NOTATION'].' class="btn btn-danger">Supprimer</button></td>';
                    }

                echo '</tr>';
            }
        }
    }

    function printPathotypeInfo($id_variete,$id_user,$id_owner){
        global $db;
        $statement = $db->prepare('SELECT * FROM RESISTANCES
                                    INNER JOIN VARIETES
                                    INNER JOIN PATHOTYPES
                                    ON VARIETES.ID_VARIETE = RESISTANCES.ID_VARIETE
                                    AND PATHOTYPES.ID_PATHOTYPE = RESISTANCES.ID_PATHOTYPE
                                    WHERE VARIETES.ID_VARIETE = ?');
        $statement->execute(array($id_variete));

        while ($item = $statement->fetch()) {
            echo '<tr>';
                echo '<td>' . $item['NOM_PATHOTYPE'] . '</td>';
                echo '<td>' . $item['NOM_RESISTANCE'] . '</td>';
                if($id_owner == $id_user){
                    echo '<td>
                    <form action="update-resistance.php" method="post">
                        <input type="text" name="id_resistance" value="'. $item['ID_RESISTANCE'] . '" hidden>
                        <button type="submit" name="edit_resistance" class="btn btn-primary">Edit</button>
                    </form>
                    </td>';
                    echo '<td><button href="#" data-toggle="modal" data-target="#verify_resistance"  data-id_resistance='. $item['ID_RESISTANCE'] . ' " class="btn btn-danger">Supprimer</button></td>';
                }
            echo '</tr>';
        }
    }

    function hasResistance($id_variete){
        global $db;
        $exist = false;
        $statement = $db->prepare('SELECT * FROM RESISTANCES
                                    WHERE ID_VARIETE = ?');
        $statement->execute(array($id_variete));
        return $statement->fetch();
    }

    // GET VARIETE INFOS

    function varieteInfo(){
        global $db;
        $id_variete = checkInput($_SESSION['id_variete']);
        $statement = $db->prepare('SELECT * FROM VARIETES INNER JOIN ESPECES
                                ON ESPECES.ID_ESPECE = VARIETES.ID_ESPECE
                                WHERE VARIETES.ID_VARIETE = ?');
        $statement->execute(array($id_variete));
        $item = $statement->fetch();
        return $item;
    }

?>
