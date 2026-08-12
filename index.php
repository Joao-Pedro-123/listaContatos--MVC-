<?php
require_once('model.php');
?>
<!-- 
<h1>Insert (Create)</h1>
<?php
// create("email", [1, 'paulo-victor@gut', 'envie apenas documentos .ods']);

function criar_novo_telefone($id, $fd){
    return create("telefone", [$id, $fd['telefone'], $fd['telefoneObs']]);
}

function criar_novo_email($id, $fd){
    return create("email", [$id, $fd['email'], $fd['emailObs']]);
}

function criar_nova_rede_social($id, $fd){
    return create("rede_social", [$id, $fd['redesocialName'], $fd['redesocialLink'], $fd['redesocialObs']]);
}

function criar_novo_endereco($id, $fd){
    return create("endereco", [$id, $fd['logradouro'], $fd['numero'], $fd['cidade'], $fd['cep'], $fd['complemento'], $fd['observacao'], $fd['pontoref']]);
}

// Essa função se refere ao dialog, após clicar no form essa função será executada: action="controller.php?action=create&data=..."
function criar_novo_contato($form_data)
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

function getContactList()
{
    $contactDatas = read();
    return $contactDatas;
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