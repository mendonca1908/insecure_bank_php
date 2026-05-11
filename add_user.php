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

echo "<br>Username: ".$username;

if ( !isset($_GET['new_username']) || !isset($_GET['new_password'])   ) {
  die("Faltam parametros");
}

$username = $_GET['new_username'];
$password = $_GET['new_password'];


$dbhost = "localhost";
$dbuser = "root";
$dbpass = "aluno123";
$db = "otariobank";

$conn = new mysqli($dbhost, $dbuser, $dbpass,$db)
	or die("Ligacao a base de dados falhou: %s\n". $conn -> error);

$sqlQuery="INSERT INTO users (username,password,role) VALUES  ('$username','$password','user');";
	
$result = $conn->query($sqlQuery);

$conn -> close();

header("Location: gerir_utilizadores.php");



?>
