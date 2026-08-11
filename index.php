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
    function getContactData($id) {
        $condition = 'id_contato = '. $id;
        $contactData["contato"] = read_json('*', 'contato', $condition)[0];
        $contactData["email"] = read_json('email, obs', 'email', $condition);
        $contactData["rede_social"] = read_json('link, nome_rede_social, obs', 'rede_social', $condition);
        $contactData["endereco"] = read_json('logradouro, numero, cidade, cep, complemento, obs, ponto_ref', 'endereco', $condition);
        $contactData["telefone"] = read_json('telefone, obs', 'telefone', $condition);
        return $contactData;
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
    update("contato", ['apelido' => 'Ulisses', 'data_nasc' => '2016-08-31'], '`id_contato` = 3');
?>

<h1>Delete</h1>
<?php
    delete('contato', '`id_contato` = 3');
?> -->