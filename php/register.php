<?php 
session_start();
$isRegister=true;   /* indique que c'est la page register.php */?>
<?php 
if (!isset($_POST['page'])) {
	$_POST['page']='tools';
}
require_once(__DIR__.'/manageUsers.php');

$erreursListe=array();    /*variable qui stocke le message d'erreur*/
$erreurFirst=null;  /*première erreur qui sera affichée*/

if (!isset($_SESSION['attR'])) {
	$_SESSION['attR']=true;
	$_SESSION['att']=true;
}  /*évite les messages d'erreurs en arrivant sur la page*/

if (isset($_COOKIE['login']) && $_COOKIE['login']==='oui') {
	$_SESSION['login']=true;
}
else {
	$_SESSION['login']=false;
}

if ($_SESSION['login']) {
	header('Location: '.$_POST['page'].'.php');
	exit();
}   /* corriger l'adresse quand plus en local*/
?>

<!DOCTYPE HTML>

<html>

<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Connexion/Inscription</title>
	<link rel="icon" type="image/png" href="../images/logo.png">
	<link href="../css/login-style.css" rel="stylesheet">
	<link href="../css/header-style.css" rel="stylesheet">
	<link href="../css/footer-style.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
</head>

<?php
/* sécurisation des entrées:*/
if (isset($_POST['numEtu']) && !empty($_POST['numEtu'])) {
	$_POST['numEtu']=htmlspecialchars($_POST['numEtu']);
}
if (isset($_POST['psw']) && !empty($_POST['psw'])) {
	$_POST['psw']=htmlspecialchars($_POST['psw']);
}
if (isset($_POST['nomFamille']) && !empty($_POST['nomFamille'])) {
	$_POST['nomFamille']=htmlspecialchars($_POST['nomFamille']);
}
if (isset($_POST['prenom']) && !empty($_POST['prenom'])) {
	$_POST['prenom']=htmlspecialchars($_POST['prenom']);
}
if (isset($_POST['email']) && !empty($_POST['email'])) {
	$_POST['psw']=htmlspecialchars($_POST['psw']);
}
if (isset($_POST['emailCheck']) && !empty($_POST['emailCheck'])) {
	$_POST['emailCheck']=htmlspecialchars($_POST['emailCheck']);
}
if (isset($_POST['pswCheck']) && !empty($_POST['pswCheck'])) {
	$_POST['pswCheck']=htmlspecialchars($_POST['pswCheck']);
}

$dejaInscrit = false;
foreach ($users as $user) {
	if (isset($_POST['numEtu']) && $user['numero_etudiant'] === $_POST['numEtu']) {
		$dejaInscrit = true;
	}
}


if (!isset($_POST['prenom']) || empty($_POST['prenom'])) {
	$erreursListe[1]= 'Veuillez rentrer votre prénom.'; 
	$_POST['prenom']=0;
}

if (!isset($_POST['nomFamille']) || empty($_POST['nomFamille'])) {
	$erreursListe[2] = 'Veuillez rentrer votre nom de famille.';
	$_POST['nomFamille']=0;
}

if (!isset($_POST['numEtu']) || empty($_POST['numEtu'])) {
	$erreursListe[3] = 'Veuillez rentrer votre numéro étudiant.';
	$_POST['numEtu']=0;
}

if ($dejaInscrit) {
	$erreursListe[4] = 'Compte déjà existant.';
	$_POST['numEtu'] = 0;
}

if (!isset($_POST['email']) || empty($_POST['email'])) {
	$erreursListe[5] = 'Veuillez rentrer votre email.';
	$_POST['email']=0;
}

if (!isset($_POST['emailCheck']) || empty($_POST['emailCheck'])) {
	$erreursListe[6] = 'Veuillez confirmer votre email.';
	$_POST['emailCheck']=0;
}

if (!isset($_POST['psw']) || empty($_POST['psw'])) {
	$erreursListe[7] = 'Veuillez définir votre mot de passe.';
	$_POST['psw']=0;
}

if (!isset($_POST['pswCheck']) || empty($_POST['pswCheck'])) {
	$erreursListe[8] = 'Veuillez confirmer votre mot de passe.';
	$_POST['pswCheck']=0;
}

if (intval($_POST['numEtu'])<1000000 || intval($_POST['numEtu'])>999999999) {
	$erreursListe[9]= 'Numéro étudiant non valide';
       	$_POST['numEtu']=0;
}


if (str_contains($_POST['numEtu'], ';') || str_contains($_POST['psw'], ';') || str_contains($_POST['pswCheck'], ';') || str_contains($_POST['prenom'], ';') || str_contains($_POST['nomFamille'], ';') || str_contains($_POST['email'], ';') || str_contains($_POST['emailCheck'], ';')) {
	$erreursListe[10]= 'Caractère  ";"  ,  "<"  et  ">"  interdits';
}

if ($_POST['email'] !== $_POST['emailCheck']) {
	$erreursListe[11] = 'Les emails ne correspondent pas.';
	$_POST['email']=0;
	$_POST['emailCheck']=0;
}

if ($_POST['psw'] !== $_POST['pswCheck']) {
	$erreursListe[12] = 'Les mots de passe ne correspondent pas.';
	$_POST['psw']=0;
	$_POST['pswCheck']=0;
}

if (strlen($_POST['psw']) < 8) {
	$erreursListe[13] = 'Le mot de passe doit contenir 8 caractères minimum.';
	$_POST['psw']=0;
}


$dateInscription = date('Y-m-d' , time());   /* date d'inscription de l'utilisateur */

$passCrypt = password_hash($_POST['psw'], PASSWORD_DEFAULT);   /* sécurisation diu mot de passe */


$sql=null;
$request=null;
$passCrypt=password_hash($_POST['psw'], PASSWORD_DEFAULT);

if (count($erreursListe)===0) {
	$sql = 'INSERT INTO users.users ( numero_etudiant , password , nom , prenom , mail , date ) 
	VALUES (\''.$_POST['numEtu'].'\',\''.$passCrypt.'\',\''.$_POST['nomFamille'].'\',\''.$_POST['prenom'].'\',\''.$_POST['email'].'\',\''.$dateInscription.'\')';
	$request = $mysqlClient -> prepare($sql);
}

if (count($erreursListe)===0  &&  $request->execute()) {
	$_SESSION['login'] = True;
	setcookie(
		'login',
		'oui',
		['expires' => time() + 3600*3, 'secure' => true, 'httponly' => true,]
	);
	if (isset($_POST['souvenir']) && $_POST['souvenir']==='check'){
		setcookie(
			'remindLogin',
			$_POST['numEtu'],
			['expires' => time()+3600*24*365*6, 'secure' => true, 'httponly' => true,]
		);
	}
	if (!isset($_POST['souvenir']) && isset($_COOKIE['remindLogin'])) {
		setcookie(
			'remindLogin',
			'',
			['expires' => time()+1, 'secure' => true, 'httponly' => true,]
		);
	}
	$_SESSION['registered'] = true;
	header('Location: redirection.php');
	exit();

}

else {
	$erreursListe[14] = 'Erreur, réessayez ultérieurement.';
}


if (count($erreursListe)>0) {
	for ($i=20; $i>=0; $i--) {
		if (isset($erreursListe[$i]) && !empty($erreursListe[$i])) {
			$erreurFirst=$erreursListe[$i];
		}
	}
}

?>
	
<?php if ($_SESSION['attR']) {$erreurFirst=null; $_SESSION['attR']=false;}?>
<body>

	<header>
		<?php require_once(__DIR__.'/header.php'); ?>
	</header>

	<main>
			<form method="POST" action="register.php">
				<p class="titleConnexion">INSCRIPTION</p>
				<?php if (empty($erreurFirst)) {echo "<h3><br></h3>";} 
				else {echo '<h2 class="alerte">'.$erreurFirst.'</h2>';}?>

				<div class="divForm">
					<label for="prenom" class="label">Prénom:</label>
					<input type="text" class="input txt" id="prenom" name="prenom" placeholder="ex: Jean">
				</div>

				<div class="divForm">
					<label for="nomFamille" class="label">Nom de famille:</label>
					<input type="text" class="input txt" id="nomFamille" name="nomFamille" placeholder="ex: Dubois">
				</div>

				<div class="divForm">
					<label for="numEtu" class="label">Numéro Etudiant:</label>
					<input type="text" class="input txt" id="numEtu" name="numEtu" placeholder="ex: 21302524">
				</div>

				<div class="divForm">
					<label for="email" class="label">Email:</label>
					<input type="mail" class="input txt" id="email" name="email" placeholder="ex: nom.prenom@etc.com">
				</div>

				<div class="divForm">
					<label for="emailCheck" class="label">Confirmation email:</label>
					<input type="mail" class="input txt" id="emailCheck" name="emailCheck">
				</div>

				<div class="divForm">
					<label for="psw" class="label">Mot de passe:</label>
					<input type="password" class="input txt" id="psw" name="psw">
				</div>

				<div class="divForm">
					<label for="pswCheck" class="label">Confirmation mot de passe:</label>
					<input type="password" class="input txt" id="pswCheck" name="pswCheck">
				</div>

				<div class="souvenir">
					<label for="souvenir" class="label">Se souvenir de moi: </label>
					<input type="checkbox" class="inputCheckbox" id="souvenir" name="souvenir" value="check"
					<?php if (isset($_COOKIE['remindLogin'])) {echo "checked";} ?>>
				</div>

				<input type="hidden" name="page" id="page" value="<?php echo $_POST['page']; ?>">
				<button type="submit" class="button">Valider</button>
				<div class="divIn"><p class="txtInscription">Déjà un compte ?</p> <a href="login.php">Connecte-toi</a></div>
			</form>
	</main>


	<footer>
		<?php require_once(__DIR__.'/footer.php'); ?>
	</footer>

</body>

</html>

