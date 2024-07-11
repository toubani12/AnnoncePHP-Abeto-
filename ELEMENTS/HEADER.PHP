<!DOCTYPE html>
<html class="my-custom-background">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="bootstrap/bootstrap-grid.css">
    <link rel="stylesheet" href="bootstrap/bootstrap-grid.min.css">
    <link rel="stylesheet" href="bootstrap/bootstrap-reboot.css">
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>ABETO</title>
    
</head>
<body class="my-custom-background">
    <header>
        <div class="logo">
            <a href="index.php"><img src="image/logo11.jpg" alt="ABETO" class="jpglogo"></a>

        </div>
        <div class="salut">
        <?php 
        
        if ($est_connecte) { 
                if ($est_membre) { ?>
                    <h3 class="h3 text-success">Bienvenue, <?php echo $_SESSION['nom'] ?></h3>
                <?php } else { ?>
                    <h3 class="h3 text-danger">Administrateur  <?php echo $_SESSION['nom'] ?></h3>
                <?php }}else{ echo '<h1 class="h1 text-dark">ventes et services</h1>';}?>

        </div>
        <div >
            <?php if ($est_connecte) { 
                if ($est_membre) { ?>
                    <a class="btn btn-success" href="deposer_annonce.php">Déposer une annonce</a><br><br>  <a class="btn btn-danger" href="deconnexion.php">se déconnecter</a>
                <?php } else { ?>
                    <a class="btn btn-danger" href="Membres.php">Membres</a>
                    <a class="btn btn-danger" href="signalisation.php">Signalisations</a>
                    <a class="btn btn-danger" href="deconnexion.php">Se déconnecter</a>
                <?php } ?>
            <?php } else { ?>
                <div ><a class="btn btn-info" href="connexion.php">Se connecter</a></div>
                <p class="text-dark text-center"> ou</p> 
                <div><a class="btn btn-success" href="creer_compte.php">créer un compte</a></div>
                 <p class="text-dark text-center"> pour déposer une annonce</p>
            <?php } ?>  
        </div>
       
    </header>