<?php
// Caso não exista seção, iniciar
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

// Caso o usuário não esteja logado, expulsar da página
if(!isset($_SESSION['usuario_id'])){
    header('Location: ../login.php');
    exit; // Importante adicionar exit após header
}
?>