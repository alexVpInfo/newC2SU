<?php
session_start();

$page = 'tools';

?>

<!DOCTYPE HTML>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewort" content="width=device-width, initial-scale=1.0">
	<title>Redirection en cours</title>
	<link rel="icon" type="image/png" href="../images/logo.png">
	<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
	<link href="../css/redirection-style.css" rel="stylesheet">
</head>

<body>
<img class="wallpaper" src="../images/wallpaper.png" alt="wallpaper">

<h1 class="message">
<?php
if (isset($_SESSION['logged']) and $_SESSION['logged']) {
	echo("Vous êtes bien connecté, vous allez accéder à votre page dans un instant . . . ");
	$page=$_SESSION['page'];
}
elseif(isset($_SESSION['registered']) and $_SESSION['registered']) {
	echo("Votre compte a bien été créé, vous allez être redirigé vers l'accueil . . . ");
}
elseif(!isset($_SESSION['login']) or !$_SESSION['login']) {
	echo("Vous êtes maintenant déconnecté, vous allez être redirigé vers l'accueil . . . ");
}
else {
	header('Location: tools.php');
	exit();
}
?>
</h1>


<div class="divLogo" id="divLogo">
	<img class="logo" src="../images/logo.png" alt="Logo Corpo">
</div>

<div class="avancement" id="avancement">
	<h2 class="compte" id="compte">0%</h2>
</div>


<script>
function sleep(ms) {
	return new Promise(resolve => setTimeout(resolve, ms));
}

const avancement = document.getElementById("divLogo");
const compte = document.getElementById("compte");
let debut = null;
const duree = 3800;
const delai = 500;

async function premier() {
avancement.addEventListener("animationstart", async () => {
	debut = performance.now() + delai;
	actualisation();
});
async function actualisation() {
	while(true){
	if (!debut) return;
	const intervalle = performance.now()-delai;
	const pourcent = Math.min((intervalle/duree)*100,100);
	compte.textContent = `${Math.floor(pourcent)}%`;
	if (pourcent>=100) {break;}
	await sleep(89);
	}
}
}
premier()

avancement.addEventListener("animationend", () => {
	var page = <?php echo('"'.$page.'"') ; ?>;
	let direction = page + ".php";
	window.location.replace(direction);
});

</script>




</body>

</html>
