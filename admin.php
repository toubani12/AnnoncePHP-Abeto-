<?php
session_start();

$connexion = mysqli_connect('localhost', 'root', '', 'site_annonciette');

$admin = mysqli_query($connexion, "SELECT * FROM utilisateurs where  est_administrateur=1");
if(mysqli_num_rows($admin)==1)header("location:index.php");
?>
<title>Inscription Administrateur</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<h1 class="text-center my-5">Inscription Administrateur</h1>
		<form method="post" action="">
			<div class="form-group">
				<label for="nom">Nom :</label>
				<input type="text" id="nom" name="nom" class="form-control" required>
			</div>

			<div class="form-group">
				<label for="prenom">Prénom :</label>
				<input type="text" id="prenom" name="prenom" class="form-control" required>
			</div>

			<div class="form-group">
				<label for="adresse_email">Adresse Email :</label>
				<input type="email" id="adresse_email" name="adresse_email" class="form-control" required>
			</div>

			<div class="form-group">
				<label for="adresse_postale">Adresse Postale :</label>
				<input type="text" id="adresse_postale" name="adresse_postale" class="form-control" required>
			</div>

			<div class="form-group">
				<label for="numero_de_telephone">Numéro de Téléphone :</label>
				<input type="tel" id="numero_de_telephone" name="numero_de_telephone" class="form-control" required>
			</div>

			<div class="form-group">
				 <label for="mot_de_passe">Mot de passe :</label>
				 <input type="password" id="mot_de_passe" name="mot_de_passe" class="form-control" required>
			</div>



			<button type="submit" name="submit" class="btn btn-primary">S'inscrire</button>
		</form>


	<?php
		// Vérifier si le formulaire est soumis
		if(isset($_POST['submit'])){
			// Récupérer les valeurs des champs
			$nom = $_POST['nom'];
			$prenom = $_POST['prenom'];
			$adresse_email = $_POST['adresse_email'];
			$adresse_postale = $_POST['adresse_postale'];
			$numero_de_telephone = $_POST['numero_de_telephone'];
			$mot_de_passe = $_POST['mot_de_passe'];

			



			// Préparer la requête SQL
			$query = "INSERT INTO utilisateurs (nom, prenom, adresse_email, adresse_postale, numero_de_telephone, mot_de_passe, est_administrateur) VALUES ('$nom', '$prenom', '$adresse_email', '$adresse_postale', '$numero_de_telephone', md5('$mot_de_passe'), 1)";

			// Exécuter la requête SQL
			if ($connexion->query($query) === TRUE) {
			    header('location:index.php');
			} else {
			    echo "Erreur: " . $query . "<br>" . $connexion->error;
			}}
    ?>b 
