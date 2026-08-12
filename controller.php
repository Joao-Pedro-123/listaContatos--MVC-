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
            
            // sleep(5);
            header('Location: controller.php');
            break;
        
        case 'create_telefone':
            echo $_GET['id'];
            echo print_r($_POST);

            if (isset($_POST['telefone'])) {
                criar_novo_telefone($_GET['id'], $_POST);
            }

            // sleep(5);
            header('Location: controller.php');
            break;
    }

else:
    
    if (isset($_GET["id"])) {
        $id = intval($_GET["id"]);
        $user = getContactData($id);
        }
    
    include "form-dialog.php";
    $userList = getContactList();
    include "view.php";

endif;



?>