<?php require 'includes/register.inc.php'; ?>

<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="../images/leaf.ico" type="image/x-icon"/>
	<title>Register</title>
	<!-- META tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- CSS Files -->
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../font-awesome/css/all.min.css">
	<!-- JS Files -->
	<script type="text/javascript" href="../js/jquery.min.js"></script>
	<script type="text/javascript" href="../js/bootstrap.min.js"></script>
</head>
<body>

    <div class="container-fluid">

        <!-- MENU -->

        <nav class="row navigation">
            <div class="container">
                <div class="logo">
                    <i class="fa fa-leaf"></i> PFE
                </div>
                <div class="link">
                    <a href="login.php"><i class="fas fa-sign-in-alt"></i> Connexion</a>
                </div>
            </div>
        </nav><br>

        <!-- REGISTER -->

        <div class="row my-register justify-content-center" align="center">
            <div class="col-lg-6 col-md-10 col-sm-11 col-xs-11 my-content">
                <div class="row justify-content-center">
                    <div class="col-11">
                        <form method="post" action="register.php" enctype="multipart/form-data">
							<div class="custom-file">
								<input type="hidden" name="MAX_FILE_SIZE" value="500000" />
                                <input type="file" class="custom-file-input" name="image" id="image">
                                <label class="custom-file-label" for="image">Selectionner l'image</label>
                            </div>
                            <select name="typedecompte" class="custom-select">
                                <option value="">Type du compte</option>
                                <option value="1">Utilisateur</option>
                                <option value="2">Auteur</option>
                            </select>
                            <div class="form-row">
                                <div class="col-6">
                                    <input class="form-control" type="text" name="prenom" placeholder="Prénom" required>
                                </div>
                                <div class="col-6">
                                    <input class="form-control" type="text" name="nom" placeholder="Nom" required>
                                </div>
                            </div>
                            <input class="form-control" type="text" name="username" placeholder="Identifiant" required>
                            <input class="form-control" type="password" name="password" placeholder="Mot de passe" required>
                            <input class="form-control" type="password" name="confirmpassword" placeholder="Confirmer mot de passe" required>
                            <button class="btn btn-primary btn-block" name="submit" type="submit"><i class="fa fa-user-plus"></i> Inscription</button>
                            <small class="text-muted" style="color:red!important;"><?php echo $error; ?></small>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>
</html>
