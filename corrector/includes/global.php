<?php

	// database connection
	$db = DatabaseUser::connect();
	// starting a session
	session_start();

	
	// global variables
	$isExist = false;
    $message_error1 = $message_error2 = $message_error3 = $message_error4 = $message_error5 = "";
	$nom = $prenom = $identifiant = $motdepasse = $type = $message_error = "";

	function checkInput($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	function checkConnection() {
        
        if (isset($_SESSION['id'])) {
            if($_SESSION['type'] == 2) {
                $id = $_SESSION['id'];
            }
            else {
                header("location: /pfe/access/login.php");
            }
        } else {
            header("location: /pfe/access/login.php");
        }
        return $id;
    }
    
    // GET NOM ET PRENOM

	function getNom($id) {

		global $db;

		$statement = $db->prepare('SELECT PRENOM,NOM FROM UTILISATEURS WHERE ID_UTILISATEUR = ?');
		$statement->execute(array($id));
		$account = $statement->fetch();
		echo $account['PRENOM'] .' '.$account['NOM'];
	}
	
	
	
?>