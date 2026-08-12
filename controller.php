<?php

include_once "conexao.php";
include_once "index.php";
include_once "model.php";

if (isset($_GET["id"])) {
    $id = intval($_GET["id"]);
    $user = getContactData($id);
}


$userList = getContactList();

include "view.php";

?>