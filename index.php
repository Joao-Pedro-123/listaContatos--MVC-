<?php
require_once('model.php');
?>

<h1>Insert (Create)</h1>
<?php
    // create("email", [1, 'paulo-victor@gut', 'envie apenas documentos .ods']);
?>

<h1>Select (Read)</h1>
<?php 
# Pegar todos os dados desse contato ($id=2)
# fica mais fácil de colocar em um Objeto pro View
    read('*', 'contato', 2);
    read('*', 'email', 2);
    read('*', 'rede_social', 2);
    read('*', 'endereco', 2);
    read('*', 'telefone', 2);
?>

<h1>Update</h1>
<?php
    update("contato", ['apelido' => 'Ulisses', 'data_nasc' => '2016-08-31'], '`id_contato` = 3');
?>

<h1>Delete</h1>
<?php
    delete('contato', '`id_contato` = 3');
?>