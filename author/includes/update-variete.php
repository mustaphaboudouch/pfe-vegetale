<?php

    function updateVariete(){
        global $db,$message_error2,$isExist;
        $id_variete = $_SESSION['id_variete'];
        $nom_variete = checkInput($_POST['variete']);
        $id_espece = checkInput($_POST['espece']);

        $statement = $db->prepare('SELECT * FROM VARIETES WHERE NOM_VARIETE <> ?');
        $statement->execute([$nom_variete]);
        while ($item = $statement->fetch()) {
            if ($item['NOM_VARIETE'] == $nom_variete) {
                $isExist = true;
                break;
            }
        }
        if ($isExist == true) {
                $message_error2 = '<h6 style="color: #FF0000;text-align=center;">* Espece existe déjà<h6>';
        }else{
            $statement1 = $db->prepare('UPDATE VARIETES SET ID_ESPECE = ?,NOM_VARIETE = ?
                                        WHERE ID_VARIETE = ?');
            $statement1->execute([$id_espece,$nom_variete,$id_variete]);

            $statement2 = $db->prepare('SELECT * FROM VARIETES WHERE NOM_VARIETE = ?');

            $statement2->execute([$nom_variete]);
            $variete = $statement2->fetch();
            header("location: ../varietes.php");
        }
    }

    function selectedEspece($id_espece){
        global $db;
        $statement = $db->query('SELECT * from ESPECES');
        while ($item = $statement->fetch()) {
            echo '<option value="' . $item['ID_ESPECE'] . '" ' . ($item['ID_ESPECE'] == $id_espece ? "selected": "") . '> ' . $item['NOM_ESPECE'] . '</option>';
        }
    }

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

    function addEspece(){
        global $db,$message_error1;
        $espece = checkInput($_POST['new_espece']);
        if (empty($espece)){
                $message_error1 = '<h6 style="color: #FF0000;">* le champ est vide<h6>';
        }else{
            $statement = $db->prepare('SELECT * FROM ESPECES WHERE NOM_ESPECE = ?');
            $statement->execute([$espece]);
            if ($statement->fetch()) {
                $message_error1 = '<h6 style="color: #FF0000;">* Espece existe déjà<h6>';
            }
            else {
                $statement1 = $db->prepare('INSERT INTO ESPECES(NOM_ESPECE) values(?)');
                $statement1->execute([$espece]);
            }
        }
    }

?>