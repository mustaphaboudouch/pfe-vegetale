<?php

function selectedPathotype($id_pathotype){
    global $db;
    $statement = $db->query('SELECT * from PATHOTYPES');
    while ($item = $statement->fetch()) {
        echo '<option value="' . $item['ID_PATHOTYPE'] . '" ' . ($item['ID_PATHOTYPE'] == $id_pathotype ? "selected": "") . '> ' . $item['NOM_PATHOTYPE'] . '</option>';
    }
}

function selectedResistance($nom_resistance){
    $resist_list=["HR","IR","T"];
    foreach($resist_list as $rs ){
        if($nom_resistance === $rs){
            echo '<option value="'.$rs.'" selected >'.$rs.'</option>';
        }else{
            echo '<option value="'.$rs.'" >'.$rs.'</option>';
        } 
    }
}

function updateResistance(){
    global $db;
    $id_resistance = $_SESSION['id_resistance'];
    $id_pathotype = checkInput($_POST['pathotype']);
    $nom_resistance = checkInput($_POST['resistance']);
    $statement = $db->prepare('UPDATE RESISTANCES SET ID_PATHOTYPE = ?,NOM_RESISTANCE = ?
                            WHERE ID_RESISTANCE = ?');
    $statement->execute([$id_pathotype,$nom_resistance,$id_resistance]);
    header("location: preview-variete.php");
}

function resistanceInfo(){
    global $db;
    $id_resistance = $_SESSION['id_resistance'];
    $statement = $db->prepare('SELECT * FROM RESISTANCES WHERE ID_RESISTANCE = ?');
    $statement->execute([$id_resistance]);
    while ($item = $statement->fetch()) {
        return $item;
    }
}
// in add_resistance page
function addPathotype(){
    global $db,$message_error3; 
    $pathotype = checkInput($_POST['new_pathotype']);
    if (empty($pathotype)){
            $message_error3 = '<h6 style="color: #FF0000;">* le champ est vide<h6>';
    }else{
        $statement = $db->prepare('SELECT * FROM PATHOTYPES WHERE NOM_PATHOTYPE = ?');
        $statement->execute([$pathotype]);
        if ($statement->fetch()) {
            $message_error3 = '<h6 style="color: #FF0000;">* Pathotype existe déjà<h6>';
        }
        else {
                $statement1 = $db->prepare('INSERT INTO PATHOTYPES(NOM_PATHOTYPE) values(?)');
                $statement1->execute([$pathotype]);
        }
    }
}

?>