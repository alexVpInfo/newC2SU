<?php 
session_start();
$isLogin=true;   /* indique que c'est la page login.php */?>
<?php 
if (!isset($_POST['page'])) {
	$_POST['page']='tools';
}
require_once(__DIR__.'/manageUsers.php');

$erreursListe=array();    /*variable qui stocke le message d'erreur*/
$erreurFirst=null;  /*première erreur qui sera affichée*/

if (!isset($_SESSION['att'])) {
	$_SESSION['att']=true;
	$_SESSION['attR']=true;
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



if (!isset($_POST['numEtu']) || empty($_POST['numEtu'])) {
	$erreursListe[1]= 'Veuillez rentrer un numéro étudiant.'; 
	$_POST['numEtu']=0;
}

if (!isset($_POST['psw']) || empty($_POST['psw'])) {
	$erreursListe[2] = 'Veuillez rentrer votre mot de passe';
	$_POST['psw']=0;
}

if (intval($_POST['numEtu'])<1000000 || intval($_POST['numEtu'])>999999999) {
	$erreursListe[3]= 'Numéro étudiant non valide';
       	$_POST['numEtu']=0;
}



if (str_contains($_POST['numEtu'], ';') || str_contains($_POST['psw'], ';')) {
	$erreursListe[5]= 'Caractère ";", "<" et ">" interdits';
}

if (str_contains($_POST['numEtu'], '>') || str_contains($_POST['psw'], '>') || str_contains($_POST['psw'], '<') || str_contains($_POST['numEtu'], '<')) {
	$erreursListe[6]= 'Caractères "<" et ">" interdits';
}

$sql=null;
$request=null;
$passCrypt=null;

if (count($erreursListe)===0) {
$sql = 'SELECT id, password FROM users.users WHERE numero_etudiant = :numEtu LIMIT 1';
$request = $mysqlClient -> prepare ($sql);
$request -> bindValue('numEtu', intval($_POST['numEtu']), PDO::PARAM_INT);
}
if (count($erreursListe)===0 && !($request->execute())) {
	errReq($sql, $request);
       	$erreursListe[7]= 'Connexion temporairement impossible';
}

if (count($erreursListe)===0 && $res = $request->fetch()) { 
	$passCrypt =password_hash($_POST['psw'], PASSWORD_DEFAULT);
}

else {
	$erreursListe[8]= 'Mot de passe ou numéro étudiant incorrect';
}

if ($passCrypt ==false) {
	$erreursListe[9]= 'Une erreur est survenue, veuillez réessayer';
}

if (count($erreursListe)===0 && password_verify($_POST['psw'], $res['password'])){
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
	$_SESSION['logged'] = true;
	$_SESSION['page'] = $_POST['page'];
	header('Location: redirection.php');
	exit();
	
}

else {
	$erreursListe[10]= 'Numéro étudiant ou mot de passe incorrect';
}

if (count($erreursListe)>0) {
	for ($i=20; $i>=0; $i--) {
		if (isset($erreursListe[$i]) && !empty($erreursListe[$i])) {
			$erreurFirst=$erreursListe[$i];
		}
	}
}

?>
	
<?php if ($_SESSION['att']) {$erreurFirst=null; $_SESSION['att']=false;}?>
<body>

	<header>
		<?php require_once(__DIR__.'/header.php'); ?>
	</header>

	<main>
			<form method="POST" action="login.php">
				<p class="titleConnexion">CONNEXION</p>
				<?php if (empty($erreurFirst)) {echo "<h3><br></h3>";} 
				else {echo '<h2 class="alerte">'.$erreurFirst.'</h2>';}?>
				<div class="divForm">
					<label for="numEtu" class="label">Numéro Etudiant:</label>
					<input type="text" class="input txt" id="numEtu" name="numEtu" placeholder="ex: 21302524" 
					<?php if (isset($_COOKIE['remindLogin'])) {echo 'value="'.$_COOKIE['remindLogin'].'"';} ?>>
				</div>
				<div class="divForm">
					<label for="psw" class="label">Mot de passe:</label>
					<input type="password" class="input txt" id="psw" name="psw">
				</div>
				<div class="souvenir">
					<label for="souvenir" class="label">Se souvenir de moi: </label>
					<input type="checkbox" class="inputCheckbox" id="souvenir" name="souvenir" value="check"
					<?php if (isset($_COOKIE['remindLogin'])) {echo "checked";} ?>>
				</div>
				<input type="hidden" name="page" id="page" value="<?php echo $_POST['page']; ?>">
				<button type="submit" class="button">Valider</button>
				<div class="divIn"><p class="txtInscription">Pas encore de compte?</p> <a href="register.php">Inscris-toi</a></div>
			</form>
	</main>


	<footer>
		<?php require_once(__DIR__.'/footer.php'); ?>
	</footer>

</body>

</html>

