<?php

include_once "model/model-tabelas.php";

// With this, the default 'action' is to show the page as usual:
if (isset($_GET['action'])) :
    
    switch ($_GET["action"]) {
        case 'novo_contato':
            criar_novo_contato($_POST);
            print_r($_POST);
            echo "<hr>";
            
            // redireciona para a página principal novamente
            header('Location: controller.php?id='. $_GET['id']);
            break;
        
        case 'create_telefone':
            echo $_GET['id'];
            echo print_r($_POST);

            // registra no banco
            if (isset($_POST['telefone'])) {
                criar_novo_telefone($_GET['id'], $_POST);
            }

            // redireciona para a página principal novamente
            header('Location: controller.php?id='. $_GET['id']);
            break;

        case 'create_email':
            echo $_GET['id'];
            echo print_r($_POST);

            // registra no banco
            if (isset($_POST['email'])) {
                criar_novo_email($_GET['id'], $_POST);
            }

            // redireciona para a página principal novamente
            header('Location: controller.php?id='. $_GET['id']);
            break;

        case 'create_rede_social':
            echo $_GET['id'];
            echo print_r($_POST);

            if (isset($_POST['redesocialName'])) {
                criar_nova_rede_social($_GET['id'], $_POST);
            }

            // redireciona para a página principal novamente
            header('Location: controller.php?id='. $_GET['id']);
            break;

        case 'novo_endereco':
            echo $_GET['id'];
            echo print_r($_POST);

            // registra no banco
            if (isset($_POST['logradouro'])) {
                criar_novo_endereco($_GET['id'], $_POST);
            }

            // redireciona para a página principal novamente
            header('Location: controller.php?id='. $_GET['id']);
            break;
        
        case 'delete_contato':
            echo $_GET['id'];
            echo print_r($_POST);

            // Ação no banco (model)
            delete_contato($_GET['id']);

            // redireciona para a página principal novamente
            header('Location: controller.php?id='. $_GET['id']);
            break;

        case 'delete_user_data':
            $item_id = $_GET['user_data_id'];
            $tabela = $_GET['tabela'];

            delete($tabela, 'id_'. $tabela . '=' . $item_id);

            header('Location: controller.php?id='. $_GET['id']);
    }

else:
    
    // Renderiza a view padrão

    if (isset($_GET["id"])) {
        $id = intval($_GET["id"]);
        $user = getContactData($id);
        }
    
        
    // print_r($user);
        
    // todos os dialogs de forms ficam guardados aqui
    include "form-dialog.php";

    $userList = getContactList();

    // O código php da view é trazido para cá, e a view pode acessar a variável $user, $id e $userList
    include "view.php";

endif;
?>