<?php

	$db = DatabaseUser::connect();
	// starting a session
	session_start();
	// global variables

	$isExist = false;
	$prenom = $nom = $identifiant = $motdepasse = $error = "";

	function dying(){
		die("user not found");
	}

	function getNom($id) {

		global $db;

		$statement = $db->prepare('SELECT PRENOM,NOM FROM UTILISATEURS WHERE ID_UTILISATEUR = ?');
		$statement->execute(array($id));
		$account = $statement->fetch();
		echo $account['PRENOM'] .' '.$account['NOM'];
	}

	function checkConnection() {
        
        if (isset($_SESSION['id'])) {
            if($_SESSION['type'] == 1) {
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

	function checkInput($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	// GET USERS

	function getUser($id,$type) {

		global $db;
		$id_admin = $id;
		$statement = $db->prepare('SELECT * FROM UTILISATEURS WHERE TYPE_COMPTE = ? AND ID_UTILISATEUR <> ?');
		$statement->execute(array($type,$id_admin));

		while ($row = $statement->fetch()) {
			echo '<tr>';
				echo '<td>' . $row['PRENOM'] . '</td>';
				echo '<td>' . $row['NOM'] . '</td>';
				echo '<td>' . $row['DATE_INSCRIPTION'] . '</td>';
				echo '<td class="my-table-actions">';
					echo '<form action="pages/preview.php" method="post">
							<input type="text" name="id" value="'.$row['ID_UTILISATEUR'].'" hidden >
							<button name="preview" class="btn btn-success"><i class="fa fa-eye"></i> Preview</button> 
						</form>';
					echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#change_type" data-id_user="'. $row['ID_UTILISATEUR'] .'" data-usertype="'. $row['TYPE_COMPTE'] .'"><i class="fa fa-edit"></i> Modifier</button> ';
					echo '<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#verify_user" data-id_user="'. $row['ID_UTILISATEUR'] .'" data-nom="'. $row['PRENOM'] .' '. $row['NOM'] .'"><i class="fa fa-trash-alt"></i> Supprimer</button>';
				echo '</td>';
			echo '</tr>';
		}
	}

	// COUNT USERS

	function countUser($type) {

		global $db;

		$statement = $db->prepare('SELECT COUNT(ID_UTILISATEUR) AS COUNT FROM UTILISATEURS WHERE TYPE_COMPTE = ?');
		$statement->execute(array($type));
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

	// LIST TYPE OF USERS

	function selectedUserType($type){
		$accountTypes = ["admin","correcteur","auteur","utilisateur"];
		for ($i = 0;$i< count($accountTypes);$i++) {
			if(trim($accountTypes[$i]) == trim($type)) echo '<option value="'.$accountTypes[$i].'" selected>'.$accountTypes[$i].'</option>';
			else echo '<option value="'.$accountTypes[$i].'">'.$accountTypes[$i].'</option>';
		}
	}

	// CHANGE TYPE OF A USER

	function changeUserType(){
		global $db;
		$type = $_POST['user_type'];
		$id_user = $_POST['id_user'];
		$stmt = $db->prepare('UPDATE UTILISATEURS SET TYPE_COMPTE = ? WHERE ID_UTILISATEUR = ?');
		$stmt->execute([$type,$id_user]);
	}

	// DELETE A USER

	function deleteUser(){
		global $db;
		$id_user = $_POST['id_user'];
		$stmt = $db->prepare('DELETE FROM UTILISATEURS WHERE ID_UTILISATEUR = ?');
		$stmt->execute([$id_user]);
	}
	
	// GET USER ACCOUNT INFOS

	function getAccount($user){
		global $db;
		$id = $user;
		$statement = $db->prepare('SELECT * FROM UTILISATEURS WHERE ID_UTILISATEUR = ?');
		$statement->execute(array($id));
		$account = $statement->fetch();
		return $account;
	}

	// UPDATE ADMIN ACCOUNT

	function updateAccount($id_user){
		global $db,$prenom,$nom,$identifiant,$motdepasse,$error;
		$id = $id_user;
		$prenom = checkInput($_POST['prenom']);
		$nom = checkInput($_POST['nom']);
		$identifiant = checkInput($_POST['identifiant']);
		$motdepasse = checkInput($_POST['motdepasse']);
        
        $prenom = ucfirst(strtolower($prenom));
        $nom = ucfirst(strtolower($nom));

		if (!empty($prenom) && !empty($nom) && !empty($identifiant) && !empty($motdepasse)) {
			
			//if(preg_match('/[a-zA-Z]/', $prenom) && preg_match('/[a-zA-Z]/', $nom) && preg_match('/[a-zA-Z\d]/', $identifiant) && preg_match('/[^a-zA-Z\d]/', $motdepasse)) {}
			
			$statement = $db->prepare('SELECT IDENTIFIANT FROM UTILISATEURS WHERE ID_UTILISATEUR <> ? AND IDENTIFIANT = ?');
			$statement->execute([$id,$identifiant]);
			if ($statement->fetch()){
				$error = "Votre identifiant existe déjà.";
			} 
			else {
				$statement = $db->prepare('UPDATE UTILISATEURS
											SET PRENOM = ?, NOM = ?, IDENTIFIANT = ?, MOT_DE_PASSE = ?, TYPE_COMPTE = ?
											WHERE ID_UTILISATEUR = ?');
				$statement->execute(array($prenom, $nom, $identifiant, $motdepasse, 'admin',$id));
				header("location: profile.php");
			}
		}
	}
	
?>
