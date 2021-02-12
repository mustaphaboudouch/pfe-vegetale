<?php

    // function chartCount($id_user, $month) {

    //     $db = DatabaseUser::connect();

    //     $statement = $db->prepare('SELECT COUNT(ID_VARIETE) AS COUNT
    //                                FROM VARIETES
    //                                WHERE ID_UTILISATEUR = ? AND ETAT_VARIETE = 1 AND extract(month from DATE_CREATION) = ?');
    //     $statement->execute(array($id_user, $month));
    //     $item = $statement->fetch();
    //     echo $item['COUNT'];
    // }
    
    // count number of varietes of a user made in each month
    //@output: [21,...]
    function monthMyVarieteCount($id_user) {

        $db = DatabaseUser::connect();

        $statement = $db->prepare('SELECT COUNT(ID_VARIETE) AS COUNT
                                   FROM VARIETES
                                   WHERE ID_UTILISATEUR = ? AND ETAT_VARIETE = 1 AND extract(month from DATE_CREATION) = ?');

        $statement->execute(array($id_user,1));
        $item = $statement->fetch();
        $monthCount = "[\"".$item['COUNT'] ."\"";                    
        for($i = 2;$i < 13;$i++){
            $statement->execute(array($id_user,$i));
            $item = $statement->fetch();
            $monthCount .= ",\"" . $item['COUNT'] ."\"";
        }
        $monthCount .= "]";
        echo $monthCount;
    }
    // output especes that are available in database
    //@output: [Poivron,....]
    function especesArray(){
        $db = DatabaseUser::connect();
        $statement = $db->query('SELECT NOM_ESPECE from ESPECES ORDER BY ID_ESPECE ASC');
        $item = $statement->fetch();
        $especes = "[\"".$item['NOM_ESPECE'] ."\"";
        while ($item = $statement->fetch()) {
            $especes .= ",\"" . $item['NOM_ESPECE'] ."\"";
        }
        $especes .= "]";
        echo $especes;
    }
    // count number of varietes per espece for a given user
    //@output: [1,43,56,...]
    function countVarieteEspece($id_user) {
        $db = DatabaseUser::connect();

        $statement = $db->prepare('SELECT ID_ESPECE , COUNT(ID_VARIETE) AS COUNT 
                                   FROM VARIETES
                                   WHERE ETAT_VARIETE = 1 AND ID_UTILISATEUR = ? 
                                   GROUP BY ID_ESPECE
                                   ORDER BY ID_ESPECE ASC');
        $statement->execute([$id_user]);
        $item = $statement->fetch();
        $varieteCount = "[\"".$item['COUNT'] ."\"";
        while ($item = $statement->fetch()) {
            $varieteCount .= ",\"" . $item['COUNT'] ."\"";
        }
        $varieteCount .= "]";
        echo $varieteCount;
    }
?>