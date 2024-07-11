<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="bootstrap/bootstrap-grid.css">
    <link rel="stylesheet" href="bootstrap/bootstrap-grid.min.css">
    <link rel="stylesheet" href="bootstrap/bootstrap-reboot.css">
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <title>creation un compte</title>
</head>
<body class=" my-custom-background">
<header>
        <div class="bg-transparent logo">
            <a href="index.php"><img src="image/logo11.jpg" alt="ABETO" class="jpglogo"></a>

        </div>

       
</header>
    




<section >
  <div class="bg-transparent container py-5 h-100">
    <div class="bg-transparent row justify-content-center align-items-center h-100">
      <div class="bg-transparent col-12 col-lg-9 col-xl-7">
        <div class="bg-transparent card shadow-2-strong card-registration" style="border-radius: 15px;">
          <div class="bg-transparent gmd gmd-5 card-body p-4 p-md-5">
            <h3 class="bg-transparent mb-4 pb-2 pb-md-0 mb-md-5">Créer un compte</h3>
            <form action='valider_creation.php' method="post">

              <div class="bg-transparent row">
                <div class="bg-transparent col-md-6 mb-4">

                  <div class="bg-transparent form-outline">
                    <input name="nom" required type="text" id="firstName" class="bg-transparent form-control form-control-lg text-warning" />
                    <label class="bg-transparent form-label" for="firstName">nom</label>
                  </div>

                </div>
                <div class="bg-transparent col-md-6 mb-4">

                  <div class="bg-transparent form-outline">
                    <input name="prenom" required type="text" id="lastName" class="bg-transparent form-control form-control-lg text-warning" />
                    <label class="bg-transparent form-label" for="lastName">Prénom</label>
                  </div>

                </div>
              </div>

              <div class="bg-transparent row">
                <div class="bg-transparent col-md-6 mb-4 d-flex align-items-center">

                  <div class="bg-transparent form-outline datepicker w-100">
                    <input name="numero_de_telephone" required type="tel" class="bg-transparent form-control form-control-lg text-warning" id="birthdayDate" />
                    <label for="birthdayDate" class="bg-transparent form-label">Téléphone</label>
                  </div>

                </div>
                <div class="bg-transparent form-outline">
                    <input name="adresse_postale" required type="text"  class="bg-transparent form-control form-control-lg text-warning" />
                    <label class="bg-transparent form-label" >Adresse</label>
                </div>
             
              </div>

              <div class="bg-transparent row">
                <div class="bg-transparent col-md-6 mb-4 pb-2">

                  <div class="bg-transparent form-outline">
                    <input name="adresse_email" required type="email" id="emailAddress" class="bg-transparent form-control form-control-lg text-warning" />
                    <label class="bg-transparent form-label" for="emailAddress">Email</label>
                  </div>
                  <div class="bg-transparent form-outline">
                    <input name="mot_de_passe" required type="password" id="emailAddress" class="bg-transparent form-control form-control-lg text-warning" />
                    <label class="bg-transparent form-label" for="emailAddress">Mot de passe</label>
                  </div>

                </div>

              </div>



              <div class="bg-transparent mt-4 pt-2">
                <input  class="btn btn-primary btn-lg" type="submit" value="Créer" />
                <button type="reset" class="btn  btn-lg btn-warning">Renitialiser</button>

              </div>


            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<footer class=" d-flex-row row-md-12  text-center text-uppercase text-light">
    <div class="row-md-5 ">
        <?php echo $_SESSION['admin_info']?>
    </div>
    <div class="row-md-5 ">
    
        <p class="text-uppercase">crée par badr eddine toubani</p>
    </div>
</footer>
</body>
</html>