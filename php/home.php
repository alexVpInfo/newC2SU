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
	<style>
		@font-face
		{
			src: url('LeagueMono-VF.ttf');
			font-family: 'LeagueMonoVariable';
			font-style: normal;
			font-stretch: 1% 500% /* required by chrome */
		}
	</style>
</head>

<body>

<header>
	<?php include_once('header.php'); ?>
</header>

<main>

	<div class="intro">
		<div class="introTxt">
			<h1 class="title"> C2SU - l'association</h1>
			<p><span>C2SU</span> (<span>C</span>orporation des <span>C</span>arabins de <span>S</span>orbonne <span>U</span>niversité) est une association regroupant les étudiants en médecine de Sorbonne Université à Paris. Elle organise de nombreuses activités solidaires, culturelles, pédagogiques et sociales à toutes les échelles pour les étudiants en médecine de Sorbonne Université.</p>
		</div>
		<img src="../images/c2su.png" alt="Logo Corpo">
	</div>
	
	<div class="presentation">
		<div class="linkPoles">
			<a class="poles" href="poles.php" style="text-decoration:none;"><div class="divPoles"><p class="txtLink">Découvrir les<br> différents pôles</p></div></a>
			<img src="../images/fondPoles.png" alt="Logos de pôles" class="logoPoles">
		</div>
		<div class="presentationTxt">
			<h1> Un archipel de pôles </h1>
			<p>La corporation des carabins de Sorbonne Université est composée d'un ensemble de pôles garantissant tous des activités et des missions différentes. Chacun impactant les carabins dans différents aspects de leur cursus universitaire. On y retrouve des pôles dédiés au tutorat associatif, à la photographie, à la musique, aux partenariats de l'association, aux actions sociales, à l'évènementiel, à la représentation étudiante, à la communication ou encore à l'informatique (le meilleur pôle &#x1F975;).</p>
		</div>
	</div>

	<div class="bureau">
		<h1>Bureau actuel de C2SU</h1>
	</div>
	<img class="photoBureau" src="../images/bureau.jpg" alt="Photo Bureau Actuel">
	
	<div class="action">
		<div class="actionTxt">
			<h1>C2SU en quelques chiffres</h1>
			<p> <span>C2SU</span> c'est ... <br> Plus de <span>1500</span> étudiants aides <br> Plus de <span>600</span> adhérents <br> Plus de <span>100</span> étudiants investis <br> Plus de <span>50</span> projets </p>
		</div>
		<img src="../images/action.png" class="actionImg" alt="C2SU en action">
	</div>

	<div class="lutte">
		<div class="lutteImg">
			<input type="checkbox" id="checkEduc" class="checkEduc" hidden>
			<div class="educ">
				<img src="../images/egalEduc.png" alt="Poing tenant un crayon" id="educImg">
				<label id="educLabel" for="checkEduc" >v</label>
				<p id="educTxt">L'accès à l'éduction est un droit fondamental, et C2SU investit pour un accès équitable et juste de ses ressources. Elle peut compter notamment sur son Tutorat des Années Supérieures pour construire et assurer ses projets.</p>
			</div>
			<input type="checkbox" id="checkSexes" class="checkSexes" hidden>
			<div class="sexes">
				<img id="sexesImg" src="../images/egalSex.png" alt="Symboles homme/femme">
				<label id="sexesLabel" for="checkSexes">v</label>
				<p id="sexesTxt">C2SU prend part contre les Violences Sexistes et Sexuelles, en organisant des évènements plus sûrs et en accompagnant les victimes pour bâtir une faculté plus inclusive, notamment avec le pôle SGS.</p>
			</div>
		</div>
		<div class="lutteTxt">
			<h1>Les idées défendues à C2SU</h1>
			<p>La corporation des carabins de Sorbonne Université s'investit pour améliorer la qualité de vie étudiante autour de nombreux projets. Elle se positionne à côté de ses adhérents pour bâtir ces projets autour de thématiques qui les impactent directement et qu'ils jugent essentielles, comme l'éducation pour tous et la lutte contre les VSS.</p>
		</div>
	</div>

</main>

<footer>
	<?php include_once('footer.php'); ?>
</footer>

</body>
</html>
