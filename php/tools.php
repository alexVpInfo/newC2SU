<?php 
session_start();
if (isset($_COOKIE['login']) && $_COOKIE['login']==='oui') {
	$_SESSION['login']=true;
}
else {
	$_SESSION['login']=false;
}

$isTools=true;
$_SESSION['att']=true;
?>

<!DOCTYPE html>
<html>

<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Tools&ensp;-&ensp;C2SU</title>
	<link rel="icon" type="image/png" href="../images/logo.png">
	<link href="../css/footer-style.css" rel="stylesheet">
	<link href="../css/header-style.css" rel="stylesheet">
	<link href="../css/tools-style.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
</head>

<body>
	<header>
		<?php require_once(dirname(__DIR__).'/php/header.php'); ?>
	</header>

	<main>
		<div class="listeSites">
			<div class="listeSitesContainer">
				<div class="blockSite">
					<h3 class="titleSite">WEI</h3>
					<?php if ($_SESSION['login']): ?>
					<a href="wei.php"><button><img src="../images/wei_icon.svg" alt="Logo WEI" class="imgLink"></button></a>
					<?php else: ?>
					<form method="POST" action="login.php"> <input type="hidden" id="page" name="page" value="wei">
					<button type="submit"><img src="../images/wei_icon.svg" alt="Logo WEI" class="imgLink"></button>
					</form>
					<?php endif; ?>
					<p class="description">C'est le site dédié à l'inscription du Week End d'Intégration</p>
				</div>
				<div class="blockSite">
					<h3 class="titleSite">Ronéos</h3>
					<?php if ($_SESSION['login']): ?>
					<a href="roneo.php"><button><img src="../images/roneo_icon.svg" alt="Logo ronéos" class="imgLink"></button></a>
					<?php else: ?>
					<form method="POST" action="login.php"> <input type="hidden" id="page" name="page" value="roneo">
					<button type="submit"><img src="../images/roneo_icon.svg" alt="Logo ronéos" class="imgLink"></button>
					</form>
					<?php endif; ?>
					<p class="description">Tu retrouveras ici toute la collection de polycopiés rédigés pour les p2.</p>
				</div>
				<div class="blockSite">
					<h3 class="titleSite">Vote</h3>
					<?php if ($_SESSION['login']): ?>
					<a href="vote.php"><button><img src="../images/vote_icon.svg" alt="Logo vote" class="imgLink"></button></a>
					<?php else: ?>
					<form method="POST" action="login.php"> <input type="hidden" id="page" name="page" value="vote">
					<button type="submit"><img src="../images/vote_icon.svg" alt="Logo vote" class="imgLink"></button>
					</form>
					<?php endif; ?>
					<p class="description">Ce site est utilisé lors des Assemblées Générales de ta Corpo pour voter.</p>
				</div>
				<div class="blockSite">
					<h3 class="titleSite">Errata</h3>
					<?php if ($_SESSION['login']): ?>
					<a href="errata.php"><button><img src="../images/errata_icon.svg" alt="Logo errata" class="imgLink"></button></a>
					<?php else: ?>
					<form method="POST" action="login.php"><input type="hidden" id="page" name="page" value="errata">
					<button type="submit" ><img src="../images/errata_icon.svg" alt="Logo errata" class="imgLink"></button>
					</form>
					<?php endif; ?>
					<p class="description">Même moi je sais pas à quoi ça sert cette page, hâte de découvrir</p>
				</div>
				<div class="blockSite">
					<h3 class="titleSite">Mindmaps</h3>
					<?php if ($_SESSION['login']): ?>
					<a href="cartes.php"><button><img src="../images/cartes_icon.svg" alt="Logo cartes" class="imgLink"></button></a>
					<?php else: ?>
					<form method="POST" action="login.php"> <input type="hidden" id="page" name="page" value="cartes">
					<button type="submit"><img src="../images/cartes_icon.svg" alt="Logo cartes" class="imgLink"></button>
					</form>
					<?php endif; ?>
					<p class="description">Ici tu as des cartes mentales récapitulant les ronéos, générées par IA</p>
				</div>
			</div>
		</div>

	<footer>
		<?php require_once(dirname(__DIR__).'/php/footer.php'); ?>
	</footer>

</main>

</body>

</html>
