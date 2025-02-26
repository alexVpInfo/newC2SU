<?php
session_start();
session_destroy();
setcookie(
	'login',
	'non',
	['expires'=> time()+1, 'secure' => true, 'httponly' => true,]
);
header('Location: redirection.php');
?>
