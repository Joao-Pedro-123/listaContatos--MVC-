<html> 
	<head> 
		<meta charset="UTF-8">
		<title> MVC </title>
	</head>
	<body> 

<?php
    include_once("conexao.php");

    $query = "SELECT * FROM contatos";

    $resultado = @mysqli_query($conexao, $query);

    while ($dados = mysqli_fetch_array($resultado)) {
        for ($i = 0; $i < 7 ; $i++) { 
            if ($dados[$i] != ""){
                echo '<br>', $dados[$i];
            }
        }
    }
?>

</body>
</html>