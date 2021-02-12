<?php 

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

// COUNT MY VARIETIES

function countMyVariete($id) {

    global $db;

    $statement = $db->prepare('SELECT COUNT(ID_VARIETE) AS COUNT
                               FROM VARIETES
                               WHERE ETAT_VARIETE = 1 AND ID_UTILISATEUR = ?');
    $statement->execute(array($id));
    $count = $statement->fetch();
    echo $count['COUNT'];
}

// COUNT MY REQUESTS

function countMyDemande($id) {

    global $db;

    $statement = $db->prepare('SELECT COUNT(ID_VARIETE) AS COUNT
                               FROM VARIETES
                               WHERE ETAT_VARIETE = 0 AND ID_UTILISATEUR = ?');
    $statement->execute(array($id));
    $count = $statement->fetch();
    echo $count['COUNT'];
}

?>