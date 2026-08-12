<?php
$dialog_create_contato = '
<dialog id=contatoPopupForm>
        <h2>Novo Contato</h2>

        <form method="post" action="controller.php?action=novo_contato">

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
                </div>
                <hr>
                <div id="mainDialogInputsNumber">
                <h3>Telefone</h3><br>
                    <div>
                        <label for="telefone">Telefone: </label>
                        <input name="telefone" type="text" required>
                    </div>
                    <div>
                        <label for="telefoneObs">Obs: </label>
                        <input name="telefoneObs" type="text">
                    </div>
                </div>

                <hr>

                <div id="extraDialogInputs">
                    <div id="extraDialogInputsEmails">
                        <h3>Correio Eletrônico</h3><br>
                        <label for="email"> Email:</label>
                        <input name="email" type="email">

                        <label for="emailObs"> Obs: </label>
                        <input name="emailObs" type="text">
                    </div>
                <br><hr><br>
                    <div id="extraDialogInputsSocial">
                        <h3>Rede Social</h3><br>
                        <div>
                            <label for="redesocialName"> Rede Social:</label>
                            <input name="redesocialName" type="text">
                        </div>

                        <div>
                            <label for="redesocialLink"> Link: </label>
                            <input name="redesocialLink" type="text">
                        </div>

                        <div>
                            <label for="redesocialObs"> Obs: </label>
                            <input name="redesocialObs" type="text">
                        </div>
                    </div>
                <br><hr><br>
                    <div id="extraDialogInputsAdress">
                        <h3>Endereço</h3><br>
                        <label for="logradouro"> Logradouro: </label>
                        <input name="logradouro" type="text">

                        <label for="numero"> Número: </label>
                        <input name="numero" type="text">

                        <label for="cidade"> Cidade: </label>
                        <input name="cidade" type="text">

                        <label for="cep"> CEP: </label>
                        <input name="cep" type="text">

                        <label for="complemento"> Complemento: </label>
                        <input name="complemento" type="text">

                        <label for="observacao"> Observação: </label>
                        <input name="observacao" type="text">

                        <label for="pontoref"> Ponto de Referência: </label>
                        <input name="pontoref" type="text">
                    </div> <br>
                </div>
            </div>

            <div id="dialogActionButtons">
                <input type="submit" onclick="submit()" value="Adicionar">
            </div>
        </form>

    </dialog>
';

$dialog_create_telefone = '
<dialog id=telefonePopupForm>
        <h2>Adicionar telefone</h2>
        <form method="post" action="controller.php?action=create_telefone&id='. (isset($id) ? $id : "")  .'">
                <div id="mainDialogInputsNumber">
                <h3>Telefone</h3><br>
                    <div>
                        <label for="telefone">Telefone: </label>
                        <input name="telefone" type="text" required>
                    </div>
                    <div>
                        <label for="telefoneObs">Obs: </label>
                        <input name="telefoneObs" type="text">
                    </div>
                </div>
            <div id="dialogActionButtons">
                <input type="submit" onclick="submit()" value="Adicionar">
            </div>
        </form>
    </dialog>
';
?>