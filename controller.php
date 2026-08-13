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
            
            // redireciona para a página principal novamente
            header('Location: controller.php');
            break;
        
        case 'create_telefone':
            echo $_GET['id'];
            echo print_r($_POST);

            // registra no banco
            if (isset($_POST['telefone'])) {
                criar_novo_telefone($_GET['id'], $_POST);
            }

            // redireciona para a página principal novamente
            header('Location: controller.php');
            break;

        case 'create_email':
            echo $_GET['id'];
            echo print_r($_POST);

            // registra no banco
            if (isset($_POST['email'])) {
                criar_novo_email($_GET['id'], $_POST);
            }

            // redireciona para a página principal novamente
            header('Location: controller.php');
            break;

        case 'create_rede_social':
            echo $_GET['id'];
            echo print_r($_POST);

            if (isset($_POST['redesocialName'])) {
                criar_nova_rede_social($_GET['id'], $_POST);
            }

            // redireciona para a página principal novamente
            header('Location: controller.php');
            break;

        case 'novo_endereco':
            echo $_GET['id'];
            echo print_r($_POST);

            // registra no banco
            if (isset($_POST['logradouro'])) {
                criar_novo_endereco($_GET['id'], $_POST);
            }

            // redireciona para a página principal novamente
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