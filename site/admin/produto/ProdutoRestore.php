<?php
session_start();
include_once "../db.class.php";

$db = new db('produto');

if (!empty($_GET['id'])) {
    try {
        $db->restore($_GET['id']);
        $_SESSION['success'] = "Produto reativado com sucesso!";
    } catch (Exception $e) {
        $_SESSION['error'] = "Erro ao reativar: " . $e->getMessage();
    }
}

header("Location: ProdutoList.php");
exit;