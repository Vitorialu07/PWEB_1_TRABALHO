<?php
// Ativa a exibição de todos os erros ocultos do PHP
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once 'db.class.php';

echo "<h3>Testando Conexão com o Banco de Dados...</h3>";

try {
    // Tenta instanciar a classe apontando para qualquer tabela fictícia
    // Isso vai forçar a execução do construtor e do método connect()
    $teste = new db('usuario');
    
    echo "<div style='color: green; font-weight: bold; padding: 10px; background: #e6f4ea;'>
            ✓ SUCESSO: O PHP conseguiu se conectar ao MySQL e encontrou a database!
          </div>";

} catch (Exception $e) {
    echo "<div style='color: red; font-weight: bold; padding: 10px; background: #fce8e6;'>
            ❌ ERRO DE INFRAESTRUTURA: " . $e->getMessage() . "
          </div>";
}