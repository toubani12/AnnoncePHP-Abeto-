<?php 
session_start();
 ?>
<!DOCTYPE html>
<html class="my-custom-background">
<head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="bootstrap/bootstrap-grid.css">
    <link rel="stylesheet" href="bootstrap/bootstrap-grid.min.css">
    <link rel="stylesheet" href="bootstrap/bootstrap-reboot.css">
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Connexion</title>
</head>
<body class="my-custom-background">
  <main class="flex-xl-column justify-content-between ">


    <header>
            <div class="logo">
                <a href="index.php"><img src="image/logo11.jpg" alt="ABETO" class="jpglogo"></a>

            </div>
            <div >
                <h1 class="text-danger">Connexion</h1> 
            </div>
          
    </header>




    <form class=" formA form-horizontal" action="valider-conn.php" method="post" >
        <?php if (isset($_SESSION['erreur'])) { ?>
            <div class="alert alert-danger"><?php 
            echo $_SESSION['erreur'];
            $_SESSION['erreur']=null;
            ?></div>
        <?php } ?>
        <div class="form-group">
        <label class="control-label col-sm-2" for="email">Email:</label>
        <div class="col-sm-10">
          <input type="email" class="form-control bg-transparent text-warning font-19" id="email" name="email" placeholder="Enter email">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="pwd">Password:</label>
        <div class="col-sm-10">
          <input type="password" class="form-control bg-transparent text-warning font-19" id="pwd" name="mot_de_passe" placeholder="Enter password">
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-success">Connecter</button>
        </div>
      </div>
    </form>
    <footer class="position-absolute top-100 start-50 translate-middle text-center text-uppercase w-100">
      <div>
        <?php echo $_SESSION['admin_info']?>
      </div>
        
    </footer>
  </main>
</body>
</html>