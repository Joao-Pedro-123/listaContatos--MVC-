<?php

include_once "conexao.php";
include_once "index.php";
include_once "model.php";



// With this, the default 'action' is to show the page as usual:
if (isset($_GET['action'])) :
    
    switch ($_GET["action"]) {
        case 'novo_contato':
            criar_novo_contato($_POST);
            print_r($_POST);
            echo "<hr>";
            sleep(5);
            header('Location: "controller.php"');
            break;
        
        case 'create_telefone':
            criar_novo_telefone($params);
            break;
    }

else:
    include "form-dialog.php";
    $dialog = $dialog_create_contato;

    if (isset($_GET["id"])) {
        $id = intval($_GET["id"]);
        $user = getContactData($id);
    }
    $userList = getContactList();
    include "view.php";

endif;



?>