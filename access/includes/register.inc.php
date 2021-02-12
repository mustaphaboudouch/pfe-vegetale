<?php

    require '../config/Database.php';

	$isExist = false;
    $insertImage = false;
	$prenom = $nom = $identifiant = $motdepasse = $confirmmotdepasse = $typedecompte = $type = $error = "";
    $target = $image = $tmp_image = "";

	$db = DatabaseUser::connect();

	if (isset($_POST['submit'])) {

        $prenom = checkInput($_POST['prenom']);
        $nom = checkInput($_POST['nom']);
        $identifiant = checkInput($_POST['username']);
        $motdepasse = checkInput($_POST['password']);
        $confirmmotdepasse = checkInput($_POST['confirmpassword']);
        $typedecompte = checkInput($_POST['typedecompte']);

        if (!empty($prenom) && !empty($nom) && !empty($identifiant) && !empty($motdepasse) && !empty($confirmmotdepasse) && !empty($typedecompte)) {

            if ($motdepasse == $confirmmotdepasse) {

                $statement1 = $db->query('SELECT * FROM UTILISATEURS');
                while ($item1 = $statement1->fetch()) {
                    if ($item1['IDENTIFIANT'] == $identifiant) {
                        $isExist = true;
                    }
                }

                if ($isExist == false) {

                    $image = $_FILES['image']['name'];
                    // $target = "../images/" . basename($_FILES['image']['name']);
                    // $target = __DIR__.'../images/'. $_FILES["image"]['name'];
                    if (move_uploaded_file($_FILES['image']['tmp_name'], "../images/".basename($_FILES['image']['name']))) {
                        echo "<h1>hhhhhhhhhhhhhhhhh</h1>";
                    } else {
                        echo "<h1>aaaaaaaaaaaaaaaaa</h1>";
                    }

                    if ($image == "") {
                        $image = "avatar.jpg";
                    }

                    if ($typedecompte == 1) {
                        $type = 'utilisateur';
                    } else if ($typedecompte == 2) {
                        $type = 'auteur';
                    }

                    $statement2 = $db->prepare('INSERT
                                                INTO UTILISATEURS (IDENTIFIANT, MOT_DE_PASSE, NOM, PRENOM, TYPE_COMPTE, IMAGE_UTILISATEUR)
                                                VALUES (?, ?, ?, ?, ?, ?)');
                    $statement2->execute(array($identifiant, $motdepasse, $nom, $prenom, $type, $image));
                    header("location: login.php");
                }
                else {
                    $error = '* Identifiant déjà existe.';
                }
            }
            else {
                $error = '* Mot de passe erroné.';
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
