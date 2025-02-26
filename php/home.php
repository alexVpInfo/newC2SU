<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible"content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Accueil&ensp;-&ensp;C2SU</title>
	<link rel="icon" type="image/png" href="../images/logo.png">
	<link href="../css/home-style.css" rel="stylesheet">
	<link href="../css/header-style.css" rel="stylesheet">
	<link href="../css/footer-style.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>

<body>

<header>
	<?php include_once('header.php'); ?>
</header>

<main>

	<div class="intro">
		<div class="introTxt">
			<h1 class="title"> C2SU - l'association</h1>
			<p><span style="color: #9F3367; font-weight: 600;">C2SU</span> (<span style="color:#9F3367; font-weight: 600;">C</span>orporation des <span style="color:#9F3367; font-weight: 600;">C</span>arabins de <span style="color:#9F3367; font-weight: 600;">S</span>orbonne <span style="color:#9F3367; font-weight: 600;">U</span>niversité) est une association regroupant les étudiants en médecine de Sorbonne Université à Paris. Elle organise de nombreuses activités solidaires, culturelles, pédagogiques et sociales à toutes les échelles pour les étudiants en médecine de Sorbonne Université.</p>
		</div>
		<img src="../images/c2su.png" alt="Logo Corpo">
	</div>
	
	<div class="presentation">
		<div class="linkPoles">
			<a class="poles" href="poles.php" style="text-decoration:none;"><div class="divPoles"><p class="txtLink">Découvrir les<br> différents pôles</p></div></a>
			<img src="../images/fondPoles.png" alt="Logos de pôles" class="logoPoles">
		</div>
		<div class="presentationTxt">
			<h1> Un archipel de pôles à C2SU </h1>
			<p>La corporation des carabins de Sorbonne Université est composée d'un ensemble de pôles garantissant tous des activités et des missions différentes. Chacun impactant les carabins dans différents aspects de leur cursus universitaire. On y retrouve des pôles dédiés au tutorat associatif, à la photographie, à la musique, aux partenariats de l'association, aux actions sociales, à l'évènementiel, à la représentation étudiante, à la communication ou encore à l'informatique (le meilleur pôle &#x1F975;).</p>
		</div>
	</div>

	<div class="bureau">
		<h1>Bureau actuel de C2SU</h1>
	</div>
	<img class="photoBureau" src="../images/bureau.jpg" alt="Photo Bureau Actuel">

</main>

<footer>
	<?php include_once('footer.php'); ?>
</footer>

</body>
</html>
