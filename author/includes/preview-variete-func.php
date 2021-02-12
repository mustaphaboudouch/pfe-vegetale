<?php

function updateEtat($etat){
    global $db;
    $id_variete = $_SESSION['id_variete'];
    $statement = $db->prepare('UPDATE VARIETES SET ETAT_VARIETE = ? WHERE ID_VARIETE = ?');
    $statement->execute([$etat,$id_variete]);
}

function updateImage(){
    global $db,$message_error1;
    $id_variete = checkInput($_SESSION['id_variete']);
    $image_variete = $_FILES['image']['name'];
    $image_temp =  $_FILES['image']["tmp_name"];
    if(@getimagesize($image_temp)){
        move_uploaded_file($image_temp,"../../images/$image_variete");
        $statement = $db->prepare("UPDATE VARIETES SET IMAGE_VARIETE = ? WHERE ID_VARIETE = ?");
        $statement->execute(array($image_variete,$id_variete));
    }else {
        $message_error1 = '<small style="color: #FF0000;text-align=center;">* Le fichier selectionné n\'est pas une image<small>';
    }
    
}

function deleteNotation(){
    global $db;
    $id_notation = checkInput($_POST['id_notation']);
    $statement = $db->prepare('DELETE FROM NOTATIONS WHERE ID_NOTATION = ?');
    $statement->execute(array($id_notation));
}

function deleteResistance(){
    global $db;
    $id_resistance = checkInput($_POST['id_resistance']);
    $statement = $db->prepare('DELETE FROM RESISTANCES WHERE ID_RESISTANCE = ?');
    $statement->execute(array($id_resistance));
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
                    echo '<td class="my-table-actions">
                    <form action="update-notation.php" method="post">
                        <input type="text" name="id_notation" value="'. $organe['ID_NOTATION'] . '" hidden>
                        <button type="submit" name="edit_notation" class="btn btn-primary"><i class="fa fa-edit"></i>Modifier</button>
                    </form>
                    <button href="#" data-toggle="modal" data-target="#verify_notation" data-id_notation='.$organe['ID_NOTATION'].' class="btn btn-danger"><i class="fa fa-trash-alt"></i> Supprimer</button></td>';
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
                echo '<td class="my-table-actions">
                <form action="update-resistance.php" method="post">
                    <input type="text" name="id_resistance" value="'. $item['ID_RESISTANCE'] . '" hidden>
                    <button type="submit" name="edit_resistance" class="btn btn-primary"><i class="fa fa-edit"></i>Modifier</button>
                </form>
                <button href="#" data-toggle="modal" data-target="#verify_resistance"  data-id_resistance='. $item['ID_RESISTANCE'] . ' " class="btn btn-danger"><i class="fa fa-trash-alt"></i> Supprimer</button></td>';
            } 
        echo '</tr>';	
    }
}
//in add_variete page
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

function hasResistance($id_variete){
    global $db;
    $exist = false;
    $statement = $db->prepare('SELECT * FROM RESISTANCES 
                                WHERE ID_VARIETE = ?');
    $statement->execute(array($id_variete));
    return $statement->fetch();
}
?>