<?php

    require '../config/Database.php';

    $username = $password = $error = "";

    if (isset($_POST['submit'])) {

        $username = checkInput($_POST['username']);
        $password = checkInput($_POST['password']);

        if (!empty($username) && !empty($password)) {

            $db = DatabaseUser::connect();

            $statement = $db->query('SELECT * FROM UTILISATEURS');
            while ($item = $statement->fetch()) {
                if (($item['IDENTIFIANT'] == $username) && ($item['MOT_DE_PASSE'] == $password)) {

                    session_start();
                    $_SESSION['id'] = $item['ID_UTILISATEUR'];

                    if ($item['TYPE_COMPTE'] == 'utilisateur') {
                        $_SESSION['type'] = 4;
                        header("location: ../user/home.php");
                    }
                    else if ($item['TYPE_COMPTE'] == 'auteur') {
                        $_SESSION['type'] = 3;
                        header("location: ../author/dashboard.php");
                    }
                    else if ($item['TYPE_COMPTE'] == 'correcteur') {
                        $_SESSION['type'] = 2;
                        header("location: ../corrector/dashboard.php");
                    }
                    else if ($item['TYPE_COMPTE'] == 'admin') {
                        $_SESSION['type'] = 1;
                        header("location: ../admin/dashboard.php");
                    }
                }
                else {
                    $error = "Identifiant / Mot de passe est erroné.";
                }
            }
        }
    }

    function checkInput($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

?>
