<?php

    // function chartCount($month) {

    //     $db = DatabaseUser::connect();

    //     $statement = $db->prepare('SELECT COUNT(ID_VARIETE) AS COUNT
    //                                FROM VARIETES
    //                                WHERE ETAT_VARIETE = 1 AND extract(month from DATE_CREATION) = ?');
    //     $statement->execute(array($month));
    //     $item = $statement->fetch();
    //     echo $item['COUNT'];
    // }
    
    // output variete count for each month
    function monthVarieteCount() {

        $db = DatabaseUser::connect();

        $statement = $db->prepare('SELECT COUNT(ID_VARIETE) AS COUNT
                                   FROM VARIETES
                                   WHERE ETAT_VARIETE = 1 AND extract(month from DATE_CREATION) = ?');

        $statement->execute(array(1));
        $item = $statement->fetch();
        $monthCount = "[\"".$item['COUNT'] ."\"";                    
        for($i = 2;$i < 13;$i++){
            $statement->execute(array($i));
            $item = $statement->fetch();
            $monthCount .= ",\"" . $item['COUNT'] ."\"";
        }
        $monthCount .= "]";
        echo $monthCount;
    }

    // output an array of especes 
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
    // output variete count for each espece
    function countVarieteEspece() {
        $db = DatabaseUser::connect();

        $statement = $db->query('SELECT ID_ESPECE , COUNT(ID_VARIETE) AS COUNT 
                                   FROM VARIETES
                                   WHERE ETAT_VARIETE = 1 
                                   GROUP BY ID_ESPECE
                                   ORDER BY ID_ESPECE ASC');

        $item = $statement->fetch();
        $varieteCount = "[\"".$item['COUNT'] ."\"";
        while ($item = $statement->fetch()) {
            $varieteCount .= ",\"" . $item['COUNT'] ."\"";
        }
        $varieteCount .= "]";
        echo $varieteCount;
    }
    // output user count for each espece
    function countUserEspece() {

        $db = DatabaseUser::connect();

        $statement = $db->query('SELECT ID_ESPECE , COUNT(ID_UTILISATEUR) AS COUNT 
                                   FROM VARIETES
                                   WHERE ETAT_VARIETE = 1 
                                   GROUP BY ID_ESPECE
                                   ORDER BY ID_ESPECE ASC');

        $item = $statement->fetch();
        $userCount = "[\"".$item['COUNT'] ."\"";
        while ($item = $statement->fetch()) {
            $userCount .= ",\"" . $item['COUNT'] ."\"";
        }
        $userCount .= "]";
        echo $userCount;
    }

    function countUserEspecei() {

        $db = DatabaseUser::connect();

        $statement = $db->query('SELECT NOM_ESPECE, VARIETES.ID_ESPECE , COUNT(VARIETES.ID_UTILISATEUR) AS COUNT 
                                   FROM VARIETES INNER JOIN UTILISATEURS INNER JOIN ESPECES
                                   on VARIETES.ID_UTILISATEUR = UTILISATEURS.ID_UTILISATEUR AND
                                    VARIETES.ID_ESPECE = ESPECES.ID_ESPECE
                                   WHERE ETAT_VARIETE = 1 
                                   GROUP BY ID_ESPECE
                                   ORDER BY ID_ESPECE ASC');

        $item = $statement->fetch();
        $count = 13;
        $userCount = "[{ label: \"".$item['NOM_ESPECE'] ."\",backgroundColor: \"rgba(255, 99, 13, 0.7)\",data: [\"".$item['COUNT']."\"]}";
        while ($item = $statement->fetch()) {
            $userCount .= ",{ label: \"".$item['NOM_ESPECE'] ."\",backgroundColor: \"rgba(255, ".$count.", ".($count+=70).", 0.7)\",data: [\"".$item['COUNT']."\"]}";
        }
        $userCount .= "]";
        echo $userCount;
    }

?>

                    