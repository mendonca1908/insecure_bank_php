<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// destruir a sessao ativa
session_destroy();

// transferir o utilizador para a pagina inicial de login
header("Location: index.php");

?>
