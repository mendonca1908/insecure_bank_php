<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Se a sessão não está ativa...
if(!isset($_SESSION['login_user']))
{
  header("Location: index.php");
}

$username = $_SESSION['login_user'];

if ( !isset($_GET['username']) ) {
  die("Faltam parametros");
}

$username_to_delete = $_GET['username'];

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "aluno123";
$db = "otariobank";

$conn = new mysqli($dbhost, $dbuser, $dbpass,$db)
	or die("Ligacao a base de dados falhou: %s\n". $conn -> error);

$sqlQuery="DELETE FROM users WHERE username='$username_to_delete';";
	
$result = $conn->query($sqlQuery);

$conn -> close();

header("Location: gerir_utilizadores.php");

?>
