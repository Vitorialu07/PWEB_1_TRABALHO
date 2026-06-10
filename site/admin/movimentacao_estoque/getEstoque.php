<?php
include_once "../db.class.php";

$dbEstoque = new db('estoque');

if (!empty($_GET['produto_id'])) {
    $estoque = $dbEstoque->findBy('id_produto', $_GET['produto_id']);
    if ($estoque) {
        echo json_encode(['quantidade' => $estoque->quantidade]);
    } else {
        echo json_encode(['quantidade' => 0]);
    }
}
?>