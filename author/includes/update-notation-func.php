<?php

function notationInfo(){
    global $db;
    $id_notation = checkInput($_SESSION['id_notation']);
    $statement = $db->prepare('SELECT * FROM NOTATIONS WHERE ID_NOTATION= ?');
    $statement->execute(array($id_notation));
    $item = $statement->fetch();
    return $item;
}

function selectedOrgane($id_organe){
    global $db;
    $statement = $db->query('SELECT * from ORGANES');
    while ($item = $statement->fetch()) {
        echo '<option value="' . $item['ID_ORGANE'] . '" ' . ($item['ID_ORGANE'] == $id_organe ? "selected": "") . '> ' . $item['NOM_ORGANE'] . '</option>';
    }
}

function selectedCaractere($id_caractere){
    global $db;
    $statement = $db->query('SELECT * from CARACTERES');
    while ($item = $statement->fetch()) {
        echo '<option value="' . $item['ID_CARACTERE'] . '" ' . ($item['ID_CARACTERE'] == $id_caractere ? "selected": "") . '> ' . $item['NOM_CARACTERE'] . '</option>';
    }
}

function selectedNiveauExpression($id_niveau){
    global $db;
    $statement = $db->query('SELECT * from NIVEAU_EXPRESSIONS');
    while ($item = $statement->fetch()) {
        echo '<option value="' . $item['ID_NIVEAU_EXPRESSION'] . '" ' . ($item['ID_NIVEAU_EXPRESSION'] == $id_niveau ? "selected": "") . '> ' . $item['NOM_NIVEAU_EXPRESSION'] . '</option>';
    }
}

function updateNotation(){
    global $db;
    $id_notation = checkInput($_SESSION['id_notation']);
    echo "id notation $id_notation";
    $id_organe = checkInput($_POST['organe']);
    $id_caractere = checkInput($_POST['caractere']);
    $id_niveau = checkInput($_POST['niveau']);
    $notation = checkInput($_POST['notation']);
    $statement = $db->prepare('UPDATE NOTATIONS SET ID_ORGANE = ?,ID_CARACTERE = ?,
                            ID_NIVEAU_EXPRESSION = ?,NOTATION = ? 
                            WHERE ID_NOTATION = ?');
    $statement->execute([$id_organe,$id_caractere,$id_niveau,$notation,$id_notation]);
    header("location: preview-variete.php");
}

function addOrgane(){
    global $db,$isExist,$message_error3;
    $organe = checkInput($_POST['new_organe']);
    if (empty($organe)){
            $message_error3 = '<h6 style="color: #FF0000;">* le champ est vide<h6>';
    }else{
        $statement = $db->prepare('SELECT * FROM ORGANES WHERE NOM_ORGANE = ?');
        $statement->execute([$organe]);
        if ($statement->fetch()) {
            $message_error3 = '<h6 style="color: #FF0000;">* Organe existe déjà<h6>';
        }
        else {
            $statement1 = $db->prepare('INSERT INTO ORGANES(NOM_ORGANE) values(?)');
            $statement1->execute([$organe]);
        }
    }
}
function addCaractere(){
    global $db,$message_error4;
    $caractere = checkInput($_POST['new_caractere']);
    if (empty($caractere)){
            $message_error4 = '<h6 style="color: #FF0000;">* le champ est vide<h6>';
    }else{
        $statement = $db->prepare('SELECT * FROM CARACTERES WHERE NOM_CARACTERE = ?');
        $statement->execute([$caractere]);
        if ($statement->fetch()) {
            $message_error4 = '<h6 style="color: #FF0000;">* Caractere existe déjà<h6>';
        }
        else {
            $statement = $db->prepare('INSERT INTO CARACTERES(NOM_CARACTERE,TYPE_CARACTERE) values(?,?)');
            $statement->execute([$caractere,0]);
        }
    }
}

function addNiveauExpression(){
    global $db,$message_error5;
    $niveau = checkInput($_POST['new_niveau']);
    if (empty($niveau)){
            $message_error5 = '<h6 style="color: #FF0000;">* le champ est vide<h6>';
    }else{
            $statement = $db->prepare('SELECT * FROM NIVEAU_EXPRESSIONS WHERE NOM_NIVEAU_EXPRESSION = ?');
            $statement->execute([$niveau]);
            if ($statement->fetch()) {
                $message_error5 = '<h6 style="color: #FF0000;">* Expression existe déjà<h6>';
            }
            else {
                $statement1 = $db->prepare('INSERT INTO NIVEAU_EXPRESSIONS(NOM_NIVEAU_EXPRESSION) values(?)');
                $statement1->execute([$niveau]);
            }
    }
}
?>