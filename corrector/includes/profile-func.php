<?php 
// functions related to user informations

function userInfo($id_utilisateur){
    global $db,$nom,$prenom ,$identifiant,$motdepasse,$type,$image_user;
    $statement = $db->prepare('SELECT * FROM UTILISATEURS WHERE ID_UTILISATEUR = ?');
    $statement->execute([$id_utilisateur]);
    while($item = $statement->fetch()) {
        $nom = $item['NOM'];
        $prenom = $item['PRENOM'];
        $type = $item['TYPE_COMPTE'];
        $identifiant = $item['IDENTIFIANT'];
        $motdepasse = $item['MOT_DE_PASSE'];
        $image_user = $item['IMAGE_UTILISATEUR'];
    }
}

function updateUser($id){
    global $db,$message_error,$isExist;
    $nom = checkInput($_POST['nom']);
    $prenom = checkInput($_POST['prenom']);
    $identifiant = checkInput($_POST['identifiant']);
    $motdepasse = checkInput($_POST['motdepasse']);
    
    $prenom = ucfirst(strtolower($prenom));
    $nom = ucfirst(strtolower($nom));

    if (empty($nom) || empty($prenom) || empty($identifiant) || empty($motdepasse)) {
        $message_error = '<h6 style="color: #FF0000;">* Il y a des champs vides<h6>';
    }
    else {
        $message_error = "";
        $statement2 = $db->prepare('SELECT * FROM UTILISATEURS WHERE ID_UTILISATEUR <> ?');
        $statement2->execute(array($id));
        while ($item = $statement2->fetch()) {
            if ($item['IDENTIFIANT'] == $identifiant) {
                $isExist = true;
                break;
            }
        }
        if ($isExist == true) {
            $message_error = '<h6 style="color: #FF0000;">* Identifiant existe déjà<h6>';
        }
        else {
            $statement3 = $db->prepare('UPDATE UTILISATEURS
                                        SET NOM = ?, PRENOM = ?, IDENTIFIANT = ?,
                                        MOT_DE_PASSE = ?
                                        WHERE ID_UTILISATEUR = ?');
            $statement3->execute(array($nom, $prenom, $identifiant,$motdepasse,$id));
        }
    }
}

function selectedUserType($type){
    $accountTypes = ["admin","correcteur","auteur","utilisateur"];
    for ($i = 0;$i< count($accountTypes);$i++) {
        if(trim($accountTypes[$i]) == trim($type)) echo '<option value="'.$accountTypes[$i].'" selected>'.$accountTypes[$i].'</option>';
        else echo '<option value="'.$accountTypes[$i].'">'.$accountTypes[$i].'</option>';
    }
}

?>