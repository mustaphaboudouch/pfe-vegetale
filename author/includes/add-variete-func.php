<?php 

    function allEspeces(){
        global $db;
        $statement = $db->query('SELECT * from ESPECES');
        while ($item = $statement->fetch()) {
            echo '<option value="' . $item['ID_ESPECE'] . '">' . $item['NOM_ESPECE'] . '</option>';
        }
    }

    function addVariete($id_utilisateur){
        global $db,$message_error2,$message_error1,$message_error3;
        $nom_variete = checkInput($_POST['variete']);
        $id_espece = checkInput($_POST['espece']);
        $upload_img = true;
        $target_dir = "../../images/";
        $image_variete = date("_h_m_s_d_m_Y") ."_" . $_FILES['image']['name'];
        $image_temp =  $_FILES["image"]["tmp_name"];
        $check = @getimagesize($image_temp);
        if(!$check){
            $upload_img = false;
            $message_error3 = '<h6 style="color: #FF0000;text-align=center;">* Le fichier selectionné n\'est pas une image<h6>';
        }
        if($upload_img){
            $image_dest = $target_dir . $image_variete;
            move_uploaded_file($image_temp,$image_dest);
        }else return;
        
        $statement = $db->prepare('SELECT * FROM VARIETES WHERE NOM_VARIETE = ?');
        $statement->execute([$nom_variete]);
        if ($statement->fetch()) {
            $message_error2 = '<h6 style="color: #FF0000;text-align=center;">* Variete existe déjà<h6>';
        }
        else{
            $statement1 = $db->prepare('INSERT INTO 
                         VARIETES(ID_ESPECE,ID_UTILISATEUR,NOM_VARIETE,IMAGE_VARIETE,ETAT_VARIETE)
                                    values(?,?,?,?,?)');
            $statement1->execute([$id_espece,$id_utilisateur,$nom_variete,$image_variete,0]);

            $statement2 = $db->prepare('SELECT * FROM VARIETES WHERE NOM_VARIETE = ?');
            $statement2->execute([$nom_variete]);
            $variete = $statement2->fetch();
            $_SESSION['id_variete'] = $variete['ID_VARIETE'];
            header("location: preview-variete.php");
        }
    }

    function addEspece(){
        global $db,$message_error1;
        $espece = checkInput($_POST['new_espece']);
        if (empty($espece)){
                $message_error1 = '<h6 style="color: #FF0000;">* le champ est vide<h6>';
        }else{
            $statement = $db->prepare('SELECT * FROM ESPECES WHERE NOM_ESPECE = ?');
            $statement->execute([$espece]);
            if ($statement->fetch()) {
                $message_error1 = '<h6 style="color: #FF0000;">* Espece existe déjà<h6>';
            }
            else {
                $statement1 = $db->prepare('INSERT INTO ESPECES(NOM_ESPECE) values(?)');
                $statement1->execute([$espece]);
            }
        }
    }

?>