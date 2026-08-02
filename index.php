<html> 
	<head> 
		<meta charset="UTF-8">
		<title> MVC </title>
	</head>
	<body> 

<h1>Select (Read)</h1>

<?php
include_once("conexao.php"); //Com este comando nós podemos utiliza a variável $conexão disponpivel no arquivo "conexão.php"
?>

<?php
    function select(){
        global $conexao; // Pega a variável definida no escopo global pelo include_once("conexao.php");
        
        $query = "SELECT * FROM contato, email"; //Uma query que segue o padrão de escrita do SQL
        
        $resultado = @mysqli_query($conexao, $query); //o @mysqli_query necessita de dois argumentos, a conexão e a query. Caso apenas um desses dados ou nenhum deles estejam presentes, a busca não funcionará.
        
        $rows = @mysqli_num_fields($resultado);//Busca as a linhas totais do resultado
        
        while ($dados = mysqli_fetch_array($resultado)) { //Enquanto for possível atribuir o dado recebido do mysqli_fetch_array ao $dados, esse loop acontecerá
            for ($i = 0; $i < $rows ; $i++) {  //Como o resultado começa em 0, o $i só chegará até o máximo de registros possíveis de serem buscados. Ex: O $rows retorna 8, os resultados começam com um index igual a 0, então teremos apenas 7 registros. Logo, o $i precisa ser menor que o $rows. E é bom utilizar uma variável ao invés de um número fixo ali pois agiliza a busca de registro, não necessitando a visualização do numero de colunas do registro toda vez que mudar a consulta.
                if ($dados[$i] != ""){
                    if ($i == ($rows -1)){ //Quando o $i for igual ao número de $rows -1(ja que os resultados começam no 0) então quer dizer que é o ultimo resultado da busca.
                        echo $dados[$i], '<br> <br>'; //Caso a condição seja verdadeira, aqui são adicionadas duas quebras de linha.
                    } else{
                        echo $dados[$i], '<br>';//Caso não, apenas uma quebra de linha é adicionada.
                    }
                }
            }
        }
    }

    select();
?>

<h1>Insert (Create)</h1>
<?php
    # Essa lookup table mapeia todas as colunas para fácil inserção nelas usando o mesmo código.
    $tabelas = [
        "contato" => ['nome', 'apelido', 'data_nasc'],
        "email" => ['id_contato', 'email', 'obs'],
        "endereco" => ['id_contato', 'logradouro', 'numero', 'cidade', 'cep', 'complemento', 'obs', 'ponto_ref'],
        "rede_social" => ['id_contato', 'link', 'nome_rede_social', 'obs'],
        "telefone" => ['id_contato', 'telefone', 'obs']
        ];
        
    # Variáveis da query (argumentos da função php)
    function create($tabela, $valores) {
        // include_once("conexao.php");
        
        global $conexao; // Pega a variável definida no escopo global pelo include_once("conexao.php");
        global $tabelas; // Pega a lookup table
        # Essa mesma função vai servir para fazer insert em todas as colunas, baseado apenas no nome
        
        $colunas = $tabelas[$tabela]; # Os campos/colunas da tabela
        
        # Cerca cada um das strings com '' e ``
        $colunas = implode("`, `", $colunas);
        $valores = implode("', '", $valores);
        
        $query = "INSERT INTO `$tabela` (`$colunas`) VALUES ('$valores');";
        
        echo $query;
        
        # Colocar try-catch aqui??
        $resultado = @mysqli_query($conexao, $query);
        
        # Só não sei como tratar do resultado
        return $resultado;
    }
    
    create("email", [1, 'paulo-victor@gut', 'envie apenas documentos .ods'])
?>


</body>
</html>