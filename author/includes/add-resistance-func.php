<?php

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

function allPathotypes(){
    global $db;
    $statement = $db->query('SELECT * from PATHOTYPES');
    while ($item = $statement->fetch()) {
        echo '<option value="' . $item['ID_PATHOTYPE'] . '">' . $item['NOM_PATHOTYPE'] . '</option>';
    }
}

function allResistances(){
    $resist_list=["HR","IR","T"];
    foreach($resist_list as $rs ){
            echo '<option value="'.$rs.'" >'.$rs.'</option>';
    }
}

function addResistance(){
    global $db;
    $id_variete = checkInput($_SESSION['id_variete']);
    $id_pathotype = checkInput($_POST['pathotype']);
    $resistance = checkInput($_POST['resistance']);
    $statement = $db->prepare('INSERT INTO RESISTANCES(ID_VARIETE,ID_PATHOTYPE,NOM_RESISTANCE)
                                values(?,?,?)');
    $statement->execute([$id_variete,$id_pathotype,$resistance]);
    header("location: preview-variete.php");
}

?>