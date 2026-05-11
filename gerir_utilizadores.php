<?php

// Estas 3 diretivas ativam a geracao de erros no ecran
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// iniciar sessao
session_start();

// se não existirem estes dois elementos, entao a sessao não é válida
if(!isset($_SESSION['login_user']) || !isset($_SESSION['user_role'])) {
  header("Location: index.php");
}

// obter da sessão o nome do utilizador e o seu papel
$role = $_SESSION['user_role'];
$username = $_SESSION['login_user'];

// Reparar que existem segredos hardcoded no codigo fonte
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "aluno123";
$db = "otariobank";

// Ligar à base de dados
$conn = new mysqli($dbhost, $dbuser, $dbpass,$db)
	or die("Ligacao a base de dados falhou: %s\n". $conn -> error);

?>

<!-- A partir daqui é o código HTML -->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="styles2.css">
<script src="jquery-3.3.1.min.js"></script>
<title>Welcome to Otário Bank</title>
</head>


<body>

<!-- Esta div corresponde ao menu do lado esquerdo -->
<!-- Menu lateral -->
<div id='menu_div'>
  <?php include 'menu.php';?> 
</div> 


<!-- Esta div corresponde ao conteudo ao lado direito do menu -->
<div id='conteudo'>
    <h1> Lista de utilizadores </h1>

    <?php
      // obter a lista de utilizadores da base de dados
      $sqlQuery="SELECT * FROM users;";
	
      $result = $conn->query($sqlQuery);
      
      if ($result->num_rows > 0) {
        
        // percorrer todos os utilizadores e mostrã-los na página
        while ($row = $result->fetch_assoc()) {
          $username = $row['username'];
          echo "<p><useritem>$username</useritem>";
          echo "<a class='operation_item' href='editar_utilizador.php'>Editar</a>";
          echo "<a class='operation_item' href='apagar_utilizador.php?username=$username'>Apagar</a>";
        }
      }

      $conn -> close(); 
  

    ?>



</div>


</body>
</html>
