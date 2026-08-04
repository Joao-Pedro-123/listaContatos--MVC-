<?php
include_once("conexao.php"); //Com este comando nós podemos utiliza a variável $conexão disponível no arquivo "conexão.php" e importar dentro das funções com 'global $conexao'

# Essa lookup table mapeia todas as colunas para fácil inserção nelas usando o nome da tabela.
$tabelas = [
    "contato" => ['nome', 'apelido', 'data_nasc'],
    "email" => ['id_contato', 'email', 'obs'],
    "endereco" => ['id_contato', 'logradouro', 'numero', 'cidade', 'cep', 'complemento', 'obs', 'ponto_ref'],
    "rede_social" => ['id_contato', 'link', 'nome_rede_social', 'obs'],
    "telefone" => ['id_contato', 'telefone', 'obs']
];

# Essa mesma função vai servir para fazer insert em todas as colunas, baseado apenas no nome
function create($tabela, $valores) {

    global $conexao; // Pega a variável definida no escopo global pelo include_once("conexao.php");
    global $tabelas; // Pega a lookup table
    
    # Pega as colunas da tabela usando a lookup table
    $colunas = $tabelas[$tabela]; 
    
    # Cerca cada um das colunas e valores com '' e ``
    $colunas = implode("`, `", $colunas);
    $valores = implode("', '", $valores);
    
    # Prepara a query dinamicamente
    $query = "INSERT INTO `$tabela` (`$colunas`) VALUES ('$valores');";
    
    echo $query;
    
    # Colocar try-catch aqui??
    $resultado = @mysqli_query($conexao, $query);
    
    # Só não sei como tratar do resultado
    return $resultado;
}

function read($colunas, $tabelas, $id){
    // Pega a variável definida no escopo global pelo include_once("conexao.php");
    global $conexao;
    // global $tabelas;

    // Só é necessário o implode() se $colunas ou $tabelas for um array
    $colunas = !is_array($colunas) ? $colunas : implode(', ', $colunas); 
    $tabelas = !is_array($tabelas) ? $tabelas : implode(', ', $tabelas);
    
    // Uma query que segue o padrão de escrita do SQL
    $query = "SELECT $colunas FROM $tabelas WHERE `id_contato` = $id"; 

    $resultado = @mysqli_query($conexao, $query); //o @mysqli_query necessita de dois argumentos, a conexão e a query. Caso apenas um desses dados ou nenhum deles estejam presentes, a busca não funcionará.
    
    $rows = @mysqli_num_fields($resultado);//Busca as a linhas totais do resultado
    echo "Rows: " . $rows ."<br>";
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

function update($tabela, $atualizacoes, $condicao){
    global $conexao;

    # Prepara as atualizações
    $atualizacoes_formatadas = [];
    
    # Guarda cada par de atualizações num array
    foreach ($atualizacoes as $key => $value) {
        $atualizacoes_formatadas[] = "`$key` = '$value'"; # Gemini me ensinou essa sintaxe legal []
    }

    # Coloca vírgulas pra separar cada uma das atualizações no array
    $atualizacoes_formatadas = implode(', ', $atualizacoes_formatadas);

    $query = "UPDATE `$tabela` SET $atualizacoes_formatadas WHERE `$tabela`.$condicao;";
    echo $query;

    $resultado = mysqli_query($conexao, $query);
    return $resultado;
}

//  "DELETE FROM email WHERE `email`.`id_email` = 5"

function delete($tabela, $condicao){
    global $conexao;

    $query = "DELETE FROM `$tabela` WHERE `$tabela`.$condicao;";
    echo $query;

    $resultado = mysqli_query($conexao, $query);
    return $resultado;
}
?>
