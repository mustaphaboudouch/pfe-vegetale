<?php

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

function allNiveauExpressions(){
    global $db;
    $statement = $db->query('SELECT * from NIVEAU_EXPRESSIONS');
    while ($item = $statement->fetch()) {
        echo '<option value="' . $item['ID_NIVEAU_EXPRESSION'] . '">' . $item['NOM_NIVEAU_EXPRESSION'] . '</option>';
    }
}

function allCaracteres(){
    global $db;
    $statement = $db->query('SELECT * from CARACTERES');
    while ($item = $statement->fetch()) {
        echo '<option value="' . $item['ID_CARACTERE'] . '">' . $item['NOM_CARACTERE'] . '</option>';
    }
}

function allOrganes(){
    global $db;
    $statement = $db->query('SELECT * from ORGANES');
    while ($item = $statement->fetch()) {
        echo '<option value="' . $item['ID_ORGANE'] . '">' . $item['NOM_ORGANE'] . '</option>';
    }
}

function addNotation(){
    global $db;
    $id_variete = $_SESSION['id_variete'];
    $id_organe = checkInput($_POST['organe']);
    $id_caractere = checkInput($_POST['caractere']);
    $id_niveau = checkInput($_POST['niveau']);
    $notation = checkInput($_POST['notation']);
    if(empty($notation)) $notation = null;
    $statement3 = $db->prepare('INSERT INTO NOTATIONS(ID_VARIETE,ID_ORGANE,ID_CARACTERE,ID_NIVEAU_EXPRESSION,NOTATION)
                                values(?,?,?,?,?)');
    $statement3->execute([$id_variete,$id_organe,$id_caractere,$id_niveau,$notation]);
    header("location: preview-variete.php");
}

?>