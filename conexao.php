<?php
$host = "localhost";
$banco = "listaContatos";
$user = "root";
$password = "";
$conexao = @mysqli_connect($host, $user, $password, $banco) or die ("Problemas na conexão");
?>