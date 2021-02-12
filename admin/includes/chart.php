<?php
    // function chartCount($type, $month) {
        
    //     $db = DatabaseUser::connect();

    //     $statement = $db->prepare('SELECT COUNT(ID_UTILISATEUR) AS COUNT
    //                                FROM UTILISATEURS
    //                                WHERE TYPE_COMPTE = ? AND extract(month from DATE_INSCRIPTION) = ?');

    //     $statement->execute(array($type, $month));
    //     $item = $statement->fetch();
    //     echo $item['COUNT'];
    // }

    //output an array of user counts for each month according the user type
    function monthUserCount($type) {

        $db = DatabaseUser::connect();

        $statement = $db->prepare('SELECT COUNT(ID_UTILISATEUR) AS COUNT
                                    FROM UTILISATEURS
                                    WHERE TYPE_COMPTE = ? AND extract(month from DATE_INSCRIPTION) = ?');

        $statement->execute(array($type,1));
        $item = $statement->fetch();
        $monthCount = "[\"".$item['COUNT'] ."\"";                    
        for($i = 2;$i < 13;$i++){
            $statement->execute(array($type,$i));
            $item = $statement->fetch();
            $monthCount .= ",\"" . $item['COUNT'] ."\"";
        }
        $monthCount .= "]";
        echo $monthCount;
    }
?>