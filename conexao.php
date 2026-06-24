<?php
$host = "localhost";
$banco = "lista_de_contatos";
$user = "root";
$password = "";
$conexao = @mysqli_connect($host, $user, $password, $banco) or die ("Problemas na conexão");
?>