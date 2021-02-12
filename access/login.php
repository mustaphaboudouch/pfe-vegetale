<?php require 'includes/login.inc.php'; ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <link rel="icon" href="../images/leaf.ico" type="image/x-icon"/>
        <title>Login</title>
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
                        <a href="register.php"><i class="fa fa-user-plus"></i> Créer une compte</a>
                    </div>
                </div>
            </nav><br>

            <!-- LOGIN -->

            <div class="row my-login justify-content-center" align="center">
                <div class="col-lg-6 col-md-10 col-sm-11 col-xs-11 my-content">
                    <div class="row justify-content-center">
                        <div class="col-11">
                            <form method="post" action="login.php">
                                <input class="form-control" type="text" name="username" placeholder="Identifiant" required>
                                <input class="form-control" type="password" name="password" placeholder="Mot de passe" required>
                                <button class="btn btn-primary btn-block" name="submit" type="submit"><i class="fas fa-sign-in-alt"></i> Connexion</button>
                                <small class="text-muted" style="color:red!important;"><?php echo $error; ?></small>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </body>
</html>
