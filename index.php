<?php
require_once('model.php');
?>
<!-- 
<h1>Insert (Create)</h1>
<?php
// create("email", [1, 'paulo-victor@gut', 'envie apenas documentos .ods']);
?>

<h1>Select (Read)</h1> -->
<?php
# Pegar todos os dados desse contato ($id=2)
# fica mais fácil de colocar em um Objeto pro View
function getContactData($id)
{
    $condition = 'id_contato = ' . $id;
    $contactData["contato"] = read_json('*', 'contato', $condition)[0];
    $contactData["email"] = read_json('email, obs', 'email', $condition);
    $contactData["rede_social"] = read_json('link, nome_rede_social, obs', 'rede_social', $condition);
    $contactData["endereco"] = read_json('logradouro, numero, cidade, cep, complemento, obs, ponto_ref', 'endereco', $condition);
    $contactData["telefone"] = read_json('telefone, obs', 'telefone', $condition);
    return $contactData;
}

function getContacts()
{
    $contactDatas = read();
    return $contactDatas;
}

function verify_tables()
{
    $avaliable_colunas = array(); 
    $avaliable_tabelas = array();

    global $tabelas;

    foreach ($tabelas as $tabela => $colunas) { //Um loop que percorre todas as tabelas
    $avaliable_colunas = [];    
        foreach ($colunas as $coluna) { //Um loop que percorre todas as colunas
            if (empty($_POST[$coluna]) || !$_POST[$coluna]) { //Verificando se o valor do $_POST não esta vazio ou null ou outra condição vazia
                continue; //Caso o valor não seja utilizável o loop volta ao início 
            } else {
               //Caso o valor seja utilizável, então, no array associativo o valor é adicionado e associado à coluna.
                $avaliable_colunas[$coluna] = $_POST[$coluna]; 
            }
        }

        if (empty($avaliable_colunas)) {//Caso o valorfilled seja 0, então, um zero será colocado no lugar de uma tabela que poderia estar ali
            $avaliable_tabelas[] = 0;
        } else {
            $avaliable_tabelas[$tabela] = $avaliable_colunas; //Atribuição das colunas e seus valores em uma tabela
        }
    }
    return $avaliable_tabelas;
}

function startInsert($avaliable)
{
    // Usa o parâmetro enviado ou chama a função caso não tenha sido passado
    $dados = $avaliable ?? verify_tables();
    // Interrompe se o array contiver apenas o valor 0 em todos os índices
    foreach ($avaliable as $valor) {
        if ($valor === 0) {
            return false; // Interrompe a execução imediatamente
        }
    }

    $queries = prepare_data($dados);
    $sucesso = create($queries);

    if ($sucesso[0]) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro ao cadastrar no banco de dados.";
        echo $sucesso[1];
    }
}

startInsert(verify_tables());
// $user = getContactData(1);
// // $dados_user = $user["email"][0];
// $dados_user = $user;
// echo "<pre>";
// print_r($dados_user);
// echo "</pre>";
?>

<!-- 
<h1>Update</h1>
<?php
    // update("contato", ['apelido' => 'Ulisses', 'data_nasc' => '2016-08-31'], '`id_contato` = 3');
?>

<h1>Delete</h1>
<?php
    // delete('contato', '`id_contato` = 3');
?> -->