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

function verify_tables(){
    $avaliable_colunas = [];
    $avaliable_tabelas = [];
    global $tabelas;

    foreach ($tabelas as $tabela) {
        $valorfilled = 0;
       foreach ($tabela as $coluna) {
            if (empty($_POST[$coluna])){
                continue;   
            } 

            $avaliable_colunas[] = $_POST[$coluna];
            $valorfilled++;
            }

        if($valorfilled === 0){
            $avaliable_tabelas[] = 0;
        } else{
            $avaliable_tabelas[] = $avaliable_colunas;
            }
            
        $avaliable_colunas = [];
}}

# Essa mesma função vai servir para fazer insert em todas as colunas, baseado apenas no nome
function create_contato($tabela, $valores)
{
    global $conexao; // Pega a variável definida no escopo global pelo include_once("conexao.php");
    global $tabelas; // Pega a lookup table

    # Pega as colunas da tabela usando a lookup table
    $colunas = $tabelas[$tabela];

    foreach ($colunas as $coluna) {
        $colunasnew += $tabelas[$coluna];
    }

    # Cerca cada um das colunas e valores com '' e ``
    $colunas = implode("`, `", $colunasnew);
    $valores = implode("', '", $valores);

    # Prepara a query dinamicamente
    $query = "INSERT INTO `$tabela` (`$colunas`) VALUES ('$valores');";

    echo $query;

    # Colocar try-catch aqui??
    $resultado = @mysqli_query($conexao, $query);

    # Só não sei como tratar do resultado
    return $resultado;
}

function create($tabela, $valores)
{

    global $conexao; // Pega a variável definida no escopo global pelo include_once("conexao.php");
    global $tabelas; // Pega a lookup table

    # Pega as colunas da tabela usando a lookup table
    $colunas = $tabelas[$tabela];

    foreach ($colunas as $coluna) {
        $colunasnew += $tabelas[$coluna];
    }

    # Cerca cada um das colunas e valores com '' e ``
    $colunas = implode("`, `", $colunasnew);
    $valores = implode("', '", $valores);

    # Prepara a query dinamicamente
    $query = "INSERT INTO `$tabela` (`$colunas`) VALUES ('$valores');";

    echo $query;

    # Colocar try-catch aqui??
    $resultado = @mysqli_query($conexao, $query);

    # Só não sei como tratar do resultado
    return $resultado;
}

function read()
{
    // Pega a variável definida no escopo global pelo include_once("conexao.php");
    global $conexao;

    // Uma query que segue o padrão de escrita do SQL
    $query = "SELECT id_contato, nome, apelido FROM contato";

    $resultado = @mysqli_query($conexao, $query); //o @mysqli_query necessita de dois argumentos, a conexão e a query. Caso apenas um desses dados ou nenhum deles estejam presentes, a busca não funcionará.

    // echo "Rows: " . $rows ."<br>";
    $userResults = array();
    while ($dados = mysqli_fetch_array($resultado)) { //Enquanto for possível atribuir o dado recebido do mysqli_fetch_array ao $dados, esse loop acontecerá
        $userResults[] = $dados;
    }
    return $userResults;
}

function read_json($colunas, $tabelas, $condicao = "")
{
    // Pega a variável definida no escopo global pelo include_once("conexao.php");
    global $conexao;
    // global $tabelas;

    // Só é necessário o implode() se $colunas ou $tabelas for um array
    $colunas = !is_array($colunas) ? $colunas : implode(', ', $colunas);
    $tabelas = !is_array($tabelas) ? $tabelas : implode(', ', $tabelas);

    # Não precisa de WHERE se o argumento $condição estiver vazio
    $condicao = $condicao ? "WHERE $condicao" : "";

    // Uma query que segue o padrão de escrita do SQL
    $query = "SELECT $colunas FROM $tabelas $condicao";

    $resultado = @mysqli_query($conexao, $query); //o @mysqli_query necessita de dois argumentos, a conexão e a query. Caso apenas um desses dados ou nenhum deles estejam presentes, a busca não funcionará.

    $rows = array();
    // echo "Rows: " . $rows ."<br>";
    while ($dados = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) { //Enquanto for possível atribuir o dado recebido do mysqli_fetch_array ao $dados, esse loop acontecerá
        $rows[] = $dados;
    }
    return $rows;
}

function update($tabela, $atualizacoes, $condicao)
{
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

function delete($tabela, $condicao)
{
    global $conexao;

    $query = "DELETE FROM `$tabela` WHERE `$tabela`.$condicao;";
    echo $query;

    $resultado = mysqli_query($conexao, $query);
    return $resultado;
}
?>