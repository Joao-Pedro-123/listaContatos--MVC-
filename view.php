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
    $user2 = getContacts();

    function data_treating($index, $secondindex) //Função para possibilitar uma rapidez na adição e alteração de um usuário
    {
        global $user2;
        $data_users_treated = [];

        foreach ($user2 as $data_users) {
            // echo "<br>";
            // echo $data_users["id_contato"] . "<br>";
            // echo $data_users["nome"] . "<br>";
            // echo $data_users["apelido"] . "<br>";

            array_push($data_users_treated, [$data_users["id_contato"], $data_users["nome"], $data_users["apelido"]]);
        }

        return $data_users_treated[$index][$secondindex];
    }

    echo data_treating(0, 2);

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

        <form method="post" action="#">

            <div id="inputs">
                <div id="mainDialogInputs">
                    <div id="mainDialogInputsName">
                        <label for="nome">Nome:</label>
                        <input name="nome" type="text" requires>
                    </div>
                    <div id="mainDialogInputsNick">
                        <label for="apelido">Apelido: </label>
                        <input name="apelido" type="text">
                    </div>
                    <div id="mainDialogInputsBirth">
                        <label for="data_nasc">Data de Nacimento: </label>
                        <input name="data_nasc" type="date">
                    </div>

                    <div id="mainDialogInputsNumber">
                        <label for="telefoneOne">Telefone: </label>
                        <input name="telefoneOne" type="text" required> <br> <br>
                    </div>
                </div>
                <hr>
                <div id="extraDialogInputs">
                    <div id="extraDialogInputsEmails">
                        <label for="emailOne"> Email:</label>
                        <input name="emailOne" type="email">

                        <label for="emailTwo"> Email: </label>
                        <input name="emailTwo" type="email">
                    </div> <br>

                    <div id="extraDialogInputsNumbers">
                        <label for="telefoneTwo"> Telefone 2:</label>
                        <input name="telefoneTwo" type="text">

                        <label for="telefoneThree"> Telefone 3: </label>
                        <input name="telefoneThree" type="text">
                    </div> <br>

                    <div id="extraDialogInputsSocialM">
                        <div>
                            <label for="redesocialOneName"> Rede Social 1:</label>
                            <input name="redesocialOneName" type="text">

                            <label for="redesocialTwoName"> Rede Social 2: </label>
                            <input name="redesocialTwoName" type="text">
                        </div>

                        <div>
                            <label for="redesocialOneLink"> Link 1: </label>
                            <input name="redesocialOneLink" type="text">


                            <label for="redesocialTwoLink"> Link 2: </label>
                            <input name="redesocialTwoLink" type="text">
                        </div>
                    </div> <br>

                    <div id="extraDialogInputsAdress">
                        <label for="logradouroOne"> Logradouro 1: </label>
                        <input name="logradouroOne" type="text">

                        <label for="numeroOne"> Número 1: </label>
                        <input name="numeroOne" type="text">

                        <label for="cidadeOne"> Cidade 1: </label>
                        <input name="cidadeOne" type="text">

                        <label for="cepOne"> CEP 1: </label>
                        <input name="cepOne" type="text">

                        <label for="complementoOne"> Complemento 1: </label>
                        <input name="complementoOne" type="text">

                        <label for="observacaoOne"> Observação 1: </label>
                        <input name="observacaoOne" type="text">

                        <label for="pontorefOne"> Ponto de Referência 1: </label>
                        <input name="pontorefOne" type="text">
                    </div> <br>
                </div>
            </div>

            <div id="dialogActionButtons">
                <input type="submit" onclick="submit()" value="Ação">
            </div>
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

            <?php
                foreach ($user2 as $data_users) {
                    $nomeExibido = !empty($data_users['apelido']) ? $data_users['apelido'] : $data_users['nome'];

                    echo "<a href='view.php?id=" . $data_users["id_contato"] . "'>";
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
                <img class="contactInfoPhoto"
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT4ECowJKykF42o6gD9CpzSM-4sXy7vadCAOb3OxT165g&s=10">
                <span class="contactInfoName"><?php echo $user["contato"]["apelido"] ?></span>
                <span id="mainTel"> <?php echo $user["telefone"][0]["telefone"] ?> </span>
                <img id="contactInfoBackGPhoto"
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSxKZxvfZtHhz0N9M2g1qZDiTwF95L_mY2OoOIcP5zDOg&s=10">
            </div>

            <div id="contactInfoGOne">
                <!-- Primeiro grupo de informações. Este     contém telefone, e-mail e redes socias. GOne significa Group One-->
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
                    echo "<div class='telItem'> <span> <b> Nome Completo: </b>" . $user["contato"]["nome"] . //Adicionar o mainTel aqui
                        "</span> <span> <b> Idade: </b>" . $user["contato"]["data_nasc"] . "</span></div>";
                    ?>
                </div>
                <div id="contacInfoAdress">
                    <h5> Endereços </h5>
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
    const formDialog = document.getElementById("popupForm");


    function popupFormOpen() {
        formDialog.showModal();
    };

    function submit() {
        formDialog.close();
    };
</script>

</html>