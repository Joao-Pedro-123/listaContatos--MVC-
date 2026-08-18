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


////////////////////
/// FUNÇÕES CRUD ///
////////////////////

# Essa mesma função vai servir para fazer insert em todas as colunas, baseado apenas no nome
function prepare_data($tabelas_add)
{

    $queryGroup = [];

    foreach ($tabelas_add as $tabela => $dados) {
        // Ignora tabelas que não possuem dados (valor 0)
        if (!is_array($dados)) {
            continue;
        }

        $colunas_add = [];
        $valores_add = [];

        foreach ($dados as $coluna => $valor) {
            $colunas_add[] = "`$coluna`";
            $valores_add[] = "'" . addslashes($valor) . "'";
        }

        $colunas = implode(", ", $colunas_add);
        $valores = implode(", ", $valores_add);

        $queryGroup[] = "INSERT INTO `$tabela` ($colunas) VALUES ($valores);";
    }

    # Cerca cada um das colunas e valores com '' e ``
    // $colunas = implode("`, `", $colunasnew);
    // $valores = implode("', '", $valores);

    # Prepara a query dinamicamente
    // $query = "INSERT INTO `$tabela` (`$colunas`) VALUES ('$valores');";

    // echo $query;

    // # Colocar try-catch aqui??
    // $resultado = @mysqli_query($conexao, $query);

    // # Só não sei como tratar do resultado
    return $queryGroup;
}

function create($valoresGroup)
{
    global $conexao;

    // Ativa o lançamento de exceções no MySQLi
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    try {
        // Inicia a transação para garantir integridade dos dados
        mysqli_begin_transaction($conexao);

        foreach ($valoresGroup as $sql) {
            mysqli_query($conexao, $sql);
        }

        // Se todas as inserções forem bem-sucedidas, confirma as alterações no banco
        mysqli_commit($conexao);

        return true;
    } catch (mysqli_sql_exception $e) {
        // Se alguma query falhar, desfaz todas as inserções realizadas na função
        mysqli_rollback($conexao);

        // Registra o erro no log do servidor para depuração
        error_log("Erro no cadastro SQL: " . $e->getMessage());
        $erro = $e->getMessage();

        return [false, $erro];
    }
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