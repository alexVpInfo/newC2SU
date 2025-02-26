<?php

try { $mysqlClient = new PDO('mysql:host=localhost;dbname=users;charset=utf8', 'root', '');
	$mysqlClient->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); }
catch (Exception $e) { die('Erreur : ' . $e->getMessage()); }

$sqlSearch = 'SELECT * FROM users WHERE numero_etudiant = :id';
$retrieveUser = $mysqlClient->prepare($sqlSearch);


$userStatement = $mysqlClient->prepare('SELECT * FROM users.users');
$userStatement->execute();
$users = $userStatement->fetchAll();


function errReq ($sql, $req)
{	$debug=debug_backtrace();
$txt=date('d-m-Y H:i:s')." - ".$_SERVER['PHP_SELF']." - l.".$debug[0]['line']." : ".$sql.' ( '.implode(', ', $req -> errorInfo())." ) \r\n";
$path = ROOT_PATH.'library/log/err.txt';
if($log=fopen($path, 'a+'))
{if(!fputs($log, $txt)) {return FALSE;} fclose($log);} else{return FALSE;} return TRUE;
}
