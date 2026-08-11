<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="view.css">
    <title>Document</title>
</head>
<?php
include_once("index.php");

if (isset($_GET["id"])) {
    $id = intval($_GET["id"]);
    $user = getContactData($id);
    $dados_user = $user["contato"];
    print_r($dados_user["data_nasc"]);


    // for ($i = 0; $i < 4; $i++) {
    //     foreach ($user["email"] as $dados_user) {
    //         echo "<div class='emailItem'> <span>" . $dados_user['email'];
    //         "</span> <span>Obs:" . $dados_user["obs"] . "</span></div>";
    //     }
    // }
}

?>

<body>
    <dialog id="popupForm">
        <h2>Titulo do dialog</h2>

        <form method="post" action="">

            <div id="mainDialogInputs">
                <div>
                    <label for="nome">Nome:</label>
                    <input name="nome" type="text">
                </div>
                <div>
                    <label for="telefone">Telefone</label>
                    <input name="telefone" type="text">
                </div>
            </div>

            <!-- <div id="extraDialogInputs">
                <label for="nome">Nome:</label>
                <input name="nome" type="text">

                <label for="telefone">Telefone</label>
                <input name="telefone" type="text">
            </div> -->

            <input type="submit" onclick="submit()" value="Ação">
        </form>

    </dialog>

    <nav> <span> Olá, <b> User </b> </span> <span> <!-- Icone --> </span></nav>
    <!-- Navbar. Space Between nos estilos dps -->
    <section>
        <!-- Fazer um loop que renderize os elementos dos contatos com base nas informações que o controller dá. Pensando por esse lado dá até pra fazer com JS. :O-->

        <!-- Bom, no MVC, a view n tem contato com o model, o controller faz o intermédio de tudo. Então acho que o controller vai receber os dados do model e processar de modo que seja apresentável na view-->
        <div id="listContacts">
            <div id="listContactsHeader">
                <h4> Contatos </h4>
                <a onclick="popupFormOpen()"> + </a>
            </div>

            <a href="view.php?id=1">
                <div class="contactListItem" id="1">
                    <img class="contactListPhoto"
                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT4ECowJKykF42o6gD9CpzSM-4sXy7vadCAOb3OxT165g&s=10">
                    <span class="contactName">João Pedro</span>

                </div>
            </a>
            <a href="view.php?id=2">
                <div class="contactListItem" id="2">
                    <!-- Na verdade a section é o agrupamento dos dois blocos, e as duas divs são os blocos, entao teriamos apenas uma section-->
                    <!-- Obrigado por explicar :] -->

                    <img class="contactListPhoto"
                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT4ECowJKykF42o6gD9CpzSM-4sXy7vadCAOb3OxT165g&s=10">
                    <span class="contactListName">Kauã Padin</span>
                </div>
            </a>
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
                <img class="contactInfoPhoto"
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT4ECowJKykF42o6gD9CpzSM-4sXy7vadCAOb3OxT165g&s=10">
                <span class="contactInfoName">Zé</span>
                <span id="mainTel"> 17 98835-8054 </span>
                <img id="contactInfoBackGPhoto"
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSxKZxvfZtHhz0N9M2g1qZDiTwF95L_mY2OoOIcP5zDOg&s=10">
            </div>

            <div id="contactInfoGOne">
                <!-- Primeiro grupo de informações. Este contém telefone, e-mail e redes socias. GOne significa Group One-->
                <!-- Telephones -->
                <div id="contactInfoTel">
                    <h5> Telefones </h5>
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
                        echo "<div class='telItem'> <span> <b> Nome Completo: </b>" . $user["contato"]["nome"]. //Adicionar o mainTel aqui
                            "</span> <span> <b> Idade: </b>" .$user["contato"]["data_nasc"] . "</span></div>";
                    
                    ?>
                    <!-- <div id="contactInfoObs"> <b> Obs: </b> João 3:16 </div> -->
                </div>
                <div id="contacInfoAdress">
                    <h5> Endereços </h5>
                    <div class="adressItem">
                        <span>Logradouro: Linux</span>
                        <span>Numero: 3145</span>
                        <span>Cidade: Nova Vila Velha</span>
                        <span>Cep: 15804-080</span>
                        <span>Complemento: Barril</span>
                        <span>Obs: Barril pintado de verde escuro</span>
                        <span>Ponto de Referência: Vila do Chaves</span>
                    </div> <!-- adressItem-->
                </div> <!-- ContactAdress-->
            </div> <!-- ContactInfoGTwo -->
        </div> <!-- ContactInfo -->
    </section> <!-- Grupo dos Blocos -->
</body>
<script>
    const formDialog = document.getElementById("popupForm");


    function popupFormOpen() {
        formDialog.showModal();
    };

    function submit() {
        formDialog.close();
    };
</script>

</html>