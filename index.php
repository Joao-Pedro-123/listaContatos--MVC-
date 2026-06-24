<html> 
	<head> 
		<meta charset="UTF-8">
		<title> MVC </title>
	</head>
	<body> 

<?php
    include_once("conexao.php");

    $query = "SELECT * FROM rede_social";

    
    $resultado = @mysqli_query($conexao, $query);
    
    $rows = @mysqli_num_fields($resultado);
    
    while ($dados = mysqli_fetch_array($resultado)) {
        for ($i = 0; $i < $rows ; $i++) { 
            if ($dados[$i] != ""){
                echo '<br>', $dados[$i];
            }
        }
    }
?>

</body>
</html>