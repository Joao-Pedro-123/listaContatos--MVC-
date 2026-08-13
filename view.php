<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="view.css">
    <title>Document</title>
</head>
<body>
    
    <?php  
    echo $dialog_create_contato;
    echo $dialog_create_telefone;
    echo $dialog_create_email;
    echo $dialog_create_rede_social;
    echo $dialog_create_endereco;
    ?>

    <nav> <span> Olá, <b> User </b> </span> <span> <!-- Icone --> </span></nav>
    <!-- Navbar. Space Between nos estilos dps -->
    <section>
        <!-- Fazer um loop que renderize os elementos dos contatos com base nas informações que o controller dá. Pensando por esse lado dá até pra fazer com JS. :O-->

        <!-- Bom, no MVC, a view n tem contato com o model, o controller faz o intermédio de tudo. Então acho que o controller vai receber os dados do model e processar de modo que seja apresentável na view-->
        <div id="listContacts">
            <div id="listContactsHeader">
                <h4> Contatos </h4>
                <a onclick="popupFormOpen('contato')" > + </a>
            </div>

            <?php
                foreach ($userList as $data_users) {
                    $nomeExibido = !empty($data_users['apelido']) ? $data_users['apelido'] : $data_users['nome'];

                    echo "<a href='controller.php?id=" . $data_users["id_contato"] . "'>";
                    echo "<div class='contactListItem'>";
                    echo "<img class='contactListPhoto' src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT4ECowJKykF42o6gD9CpzSM-4sXy7vadCAOb3OxT165g&s=10'>";
                    echo "<span class='contactName'>" . $nomeExibido . "</span>";
                    echo "</div>";
                    echo "</a>";
                }
            ?>
            <!-- <div id="noDataDiv">
                <img id="noDataImg" src="user.png"> <br>
                <span> NÃO HÁ NENHUM CONTATO ADICIONADO AINDA! </span>
            </div> ADICIONA ISSO DEPOIS ✅ --> 
        </div>

        <!-- Quando a pessoa clicar em algum contato...
        
            - Como a lista de contatos do whatsapp na esquerda, e um bloco à direita. que ao invés de ser conversas, seria as informações assim como no esboço que eu te mandei no google cha :O Ja volto OK
            Aí nesse bloco de Read teriam as ações possíveis de CRUD: Update, Remove
            Na própria lista poderia ter a opção de adicionar um contato novo (Create)
            Sim, mas de modo não tão explicito, mas ao clicar em um botão de três pontinhos
            
            Como faríamos para um lado existir a lista, e do outro existir as informações adicionais?
            Bom, usando o id do link que referencia um objeto
            -->
        <div id="contactInfo">
            <!-- Heading Bar -->
            <div id="contactInfoHeading">
            <?php
            if (! isset($id)) {
                echo "<h1>Selecione um Contato na Lista</h1>";
                die();
            }
            ?>
                <img class="contactInfoPhoto"
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT4ECowJKykF42o6gD9CpzSM-4sXy7vadCAOb3OxT165g&s=10">
                <span class="contactInfoName"><?php echo $user["contato"]["apelido"] ?></span>
                <span id="mainTel"> <?php echo $user["telefone"][0]["telefone"] ?> </span>
                <a href='controller.php?action=delete_contato&id=<?php echo $id; ?>'>[Apagar Contato]</a>
                <img id="contactInfoBackGPhoto"
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSxKZxvfZtHhz0N9M2g1qZDiTwF95L_mY2OoOIcP5zDOg&s=10">
            </div>

            <div id="contactInfoGOne">
                <!-- Primeiro grupo de informações. Este     contém telefone, e-mail e redes socias. GOne significa Group One-->
                <!-- Telephones -->
                <div id="contactInfoTel">
                    <h5> Telefones </h5> 
                    <a onclick="popupFormOpen('telefone')"> + </a>
                    <!-- <a href="controller.php?action=create_telefone&id=<?php echo $id; ?>" class="addBtn"> + </a> -->
                    <?php
                    foreach ($user["telefone"] as $dados_user) {
                        echo "<div class='telItem'> <span>" . $dados_user['telefone'] . //Adicionar o mainTel aqui depois
                            "</span> <span>Obs: " . $dados_user["obs"] . "</span></div>";
                    }
                    ?>
                </div>

                <!-- Emails -->
                <div id="contactInfoEmail">
                    <h5> E-mails </h5>
                    <!-- <a href="controller.php?action=create_email&id=<?php echo $id; ?>" class="addBtn"> + </a> -->
                     <a onclick="popupFormOpen('email')"> + </a>
                    <?php
                    foreach ($user["email"] as $dados_user) {
                        echo "<div class='emailItem'> <span>" . $dados_user['email'] .
                            "</span> <span>Obs: " . $dados_user["obs"] . "</span></div>";
                    }
                    ?>
                </div>

                <!-- Social Media -->
                <div id="contactInfoSocialMedia">
                    <h5> Redes Sociais </h5>
                    <!-- <a href="controller.php?action=create_rede_social&id=<?php echo $id; ?>" class="addBtn"> + </a> -->
                     <a onclick="popupFormOpen('rede_social')"> + </a>
                    <?php
                    foreach ($user["rede_social"] as $dados_user) {
                        echo "<div class='socialMediaItem'> <span> Nome: " . $dados_user['nome_rede_social'] . //Adicionar o mainTel aqui
                            "</span> <span>Link: " . $dados_user["link"] . "</span> <span>Obs:  " . $dados_user["obs"] . "</span> </div>";
                    }
                    ?>
                </div>
            </div> <!-- ContactInfoGOne -->

            <div id="contactInfoGTwo">
                <!-- Nomes e outros-->
                <div id="contactInfoNameAndAge">
                    <?php
                    echo "<div class='telItem'> <span> <b> Nome Completo: </b>" . $user["contato"]["nome"] . //Adicionar o mainTel aqui
                        "</span> <span> <b> Idade: </b>" . $user["contato"]["data_nasc"] . "</span></div>";
                    ?>
                </div>
                <div id="contacInfoAdress">
                    <h5> Endereços </h5>
                    <!-- <a href="controller.php?action=create_endereco&id=<?php echo $id; ?>" class="addBtn"> + </a> -->
                    <a onclick="popupFormOpen('endereco')"> + </a>
                    <?php
                    foreach ($user["endereco"] as $data_user) {
                        echo "<div class='adressItem'> <span>Logradouro: " . $data_user["logradouro"] . "</span> <span>Numero: " . $data_user["numero"] . "</span> <span>Cidade: " . $data_user["cidade"] . "</span> <span>Cep:" . $data_user["cep"] . "</span> <span>Complemento: " . $data_user["complemento"] . "</span> <span>Obs: " . $data_user["obs"] . "</span><span>Ponto de Referência: " . $data_user["ponto_ref"] . "</span> </div>";
                    }
                    ?>
                </div> <!-- ContactAdress-->
            </div> <!-- ContactInfoGTwo -->
        </div> <!-- ContactInfo -->
    </section> <!-- Grupo dos Blocos -->
</body>
<script>
    // Um popup para cada tabela ser criada
    const contatoFormDialog = document.getElementById('contatoPopupForm');
    const telefoneFormDialog = document.getElementById('telefonePopupForm');
    const emailFormDialog = document.getElementById('emailPopupForm');
    const redeSocialFormDialog = document.getElementById('redeSocialPopupForm');
    const enderecoFormDialog = document.getElementById('enderecoPopupForm');

    // O popup a ser aberto entra como argumento
    function popupFormOpen(tipo) {
        switch (tipo) {
            case 'contato':
                contatoFormDialog.showModal();
                break;
            case 'telefone':
                telefoneFormDialog.showModal();
                break;
            case 'email':
                emailFormDialog.showModal();
                break;
            case 'rede_social':
                redeSocialFormDialog.showModal();
                break;
            case 'endereco':
                enderecoFormDialog.showModal();
                break;
        }
    };

    function submit() {
        contatoFormDialog.close();
        telefoneFormDialog.close()
        emailFormDialog.close()
        redeSocialFormDialog.close()
        enderecoFormDialog.close()
    };
</script>

</html>