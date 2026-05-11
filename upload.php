<?php

// Estas 3 diretivas ativam a geracao de erros no ecran
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

//print_r($_POST);
//print_r(file_get_contents('php://input'));

// Caso não seja enviado nenhum ficheiro
$target_file='not_found.txt';

$error = $_FILES["fileToUpload"]["error"];
if (!$error) { // Se não há erros, processar o ficheiro
  $target_dir = "uploads/"; //pasta de destino
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $tempFile = $_FILES["fileToUpload"]["tmp_name"];
  $uploadOk = 1;

  echo "<p>Nome do ficheiro destino: ".$target_file;
  echo "<p>Nome do ficheiro temporário: ".$_FILES["fileToUpload"]["tmp_name"];
  echo "<p>Tamanho do ficheiro: ".$_FILES["fileToUpload"]["size"];
  echo "<p>Tipo de ficheiro: ".$_FILES["fileToUpload"]["type"];
  echo "<p>Código de erro: ".$error;



  // Check if file already exists
  if (file_exists($target_file)) {
    echo "<p>Sorry, file already exists.";
    $uploadOk = 0;  
  }


  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "<p>Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($tempFile, $target_file)) {
      echo "<p>The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    } else {
      echo "<p>Sorry, there was an error uploading your file.";
    }
  }
}


if (!isset($_POST['mensagem'])) {
  die("Mensagem vazia");
}

$mensagem = $_POST['mensagem'];
echo "<p>Mensagem: ".htmlentities($mensagem);


// Reparar que existem segredos hardcoded no codigo fonte
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "aluno123";
$db = "otariobank";

$conn = new mysqli($dbhost, $dbuser, $dbpass,$db)
	or die("Ligacao a base de dados falhou: %s\n". $conn -> error);

$sqlQuery="INSERT INTO mensagens (username,mensagem,uploaded_file) VALUES ('$username','$mensagem','$target_file');";

echo "<p>Query: ".$sqlQuery;
	
$result = $conn->query($sqlQuery);

$conn -> close();

header("Location: welcome.php");


?>
