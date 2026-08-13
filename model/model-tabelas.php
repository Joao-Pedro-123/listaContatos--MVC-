////////////////////////////
/// FUNÇÕES PARA TABELAS ///
////////////////////////////

<?php
require_once 'model-crud.php';

/* READ */
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

function getContactList()
{
    $contactDatas = read();
    return $contactDatas;
}

/* TELEFONE */
function criar_novo_telefone($id, $fd){
    return create("telefone", [$id, $fd['telefone'], $fd['telefoneObs']]);
}

/* EMAIL */
function criar_novo_email($id, $fd){
    return create("email", [$id, $fd['email'], $fd['emailObs']]);
}

/* REDE_SOCIAL */
function criar_nova_rede_social($id, $fd){
    return create("rede_social", [$id, $fd['redesocialName'], $fd['redesocialLink'], $fd['redesocialObs']]);
}

/* ENDERECO */
function criar_novo_endereco($id, $fd){
    return create("endereco", [$id, $fd['logradouro'], $fd['numero'], $fd['cidade'], $fd['cep'], $fd['complemento'], $fd['observacao'], $fd['pontoref']]);
}

/* CONTATO */
function criar_novo_contato($form_data) // Essa função se refere ao dialog, após clicar no form essa função será executada: action="controller.php?action=create&data=..."
{
    global $conexao; // Pega a variável definida no escopo global pelo include_once("conexao.php");
    global $tabelas; // Pega a lookup table

    $fd = $form_data; // Para abreviar

    $dados_do_contato = [$fd['nome'], $fd['apelido'], $fd['data_nasc']];
    create("contato", $dados_do_contato);

    $id = mysqli_insert_id($conexao); // id do contato inserido (para associar os dados à ele no banco!)

    if (isset($form_data['telefone'])){
        criar_novo_telefone($id, $form_data);
    }
    
    if (isset($form_data['email'])){
        criar_novo_email($id, $form_data);
    }
    
    if (isset($form_data['redesocialName'])){
        criar_nova_rede_social($id, $form_data);
    }
    
    if (isset($form_data['cidade'])){
        criar_novo_endereco($id, $form_data);
    }

    // return $resultado;
}

function delete_contato($id) {
    // Primeiro deleta todas os dados 'referentes ao contato'
    delete('telefone', 'id_contato='. $id);
    delete('rede_social', 'id_contato='. $id);
    delete('email', 'id_contato='. $id);
    delete('endereco', 'id_contato='. $id);

    // Depois deleta os dados na tabela contato, para não dar erro da chave estrangeira ter sumido
    delete('contato', 'id_contato='. $id);
}

/* ?????? */

function create_contato($tabelas_add)
{
    global $conexao; // Pega a variável definida no escopo global pelo include_once("conexao.php");
    global $tabelas; // Pega a lookup table
    $tabelas_consulta = [];
    $queryGroup = [];
    # Pega as colunas da tabela usando a lookup table

    foreach ($tabelas_add as $tabela_add) { //É necessário adaptar os números para não sair como texto no implode.
        $colunas = [];
        foreach ($tabela_add as $coluna_add) {
            $colunas_add[] = $coluna_add;
            $colunas = implode("`, `", $colunas_add);
            foreach ($coluna_add as $valor_add) {
                $valores_add[] = $valor_add;
                $valores = implode("`, `", $valores_add);
            }
        }
        $queryGroup[] = "INSERT INTO `$tabela_add` (`$colunas`) VALUES ('$valores');";
    }

    foreach ($colunas as $coluna) {
        $colunasnew += $tabelas[$coluna];
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
    // return $resultado;
}

function verify_tables()
{
    $avaliable_colunas = array();
    $avaliable_tabelas = array();


    global $tabelas;

    foreach ($tabelas as $tabela) {
        $valorfilled = 0;
        foreach ($tabela as $coluna) {
            if (empty($_POST[$coluna]) || !$_POST[$coluna]) {
                continue;
            } else {
                $avaliable_colunas[$coluna] = $_POST[$coluna];
                $valorfilled++;
            }

        }

        if ($valorfilled === 0) {
            $avaliable_tabelas[] = 0;
        } else {
            foreach ($tabelas as $chosen) {
                if ($chosen == $tabela) {
                    $avaliable_tabelas[$tabela] = $avaliable_colunas;
                }
            }
        }

        $avaliable_colunas = [];
    }
    return $avaliable_tabelas;
}

?>