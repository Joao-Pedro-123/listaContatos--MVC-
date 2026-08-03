<?php
require_once('model.php');
?>

<h1>Insert (Create)</h1>
<?php
    create("email", [1, 'paulo-victor@gut', 'envie apenas documentos .ods']);
?>

<h1>Select (Read)</h1>
<?php 
    read('*', ['contato', 'email']); 
?>

<h1>Update</h1>
<?php
    update("contato", ['apelido' => 'Ulisses', 'data_nasc' => '2016-08-31'], '`id_contato` = 3');
?>

<h1>Delete</h1>
<?php
    delete('contato', '`id_contato` = 3');
?>