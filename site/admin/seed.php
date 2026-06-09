<?php
include_once "db.class.php";

echo "<!doctype html>";
echo "<html lang='pt-br'>";
echo "<head>";
echo "<meta charset='utf-8'>";
echo "<meta name='viewport' content='width=device-width, initial-scale=1'>";
echo "<title>Aumentar Estoque - Ótica Vision</title>";
echo "<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css' rel='stylesheet'>";
echo "<style>";
echo "body { padding: 20px; }";
echo ".container { max-width: 800px; margin: auto; }";
echo "</style>";
echo "</head>";
echo "<body>";
echo "<div class='container'>";
echo "<div class='card shadow-sm'>";
echo "<div class='card-header bg-success text-white'>";
echo "<h2 class='mb-0'><i class='fas fa-arrow-up'></i> Aumentando Estoque do Sistema</h2>";
echo "</div>";
echo "<div class='card-body'>";

// ==================== AUMENTAR ESTOQUE ====================
$dbEstoque = new db('estoque');
$dbProduto = new db('produto');

echo "<h4 class='mt-3 text-danger'><i class='fas fa-warehouse'></i> Aumentando Estoque dos Produtos:</h4>";
echo "<ul class='list-group mb-3'>";

$todosProdutos = $dbProduto->all();
$estoquesExistentes = $dbEstoque->all();

// Criar um mapa de estoque existente
$estoqueMap = [];
foreach($estoquesExistentes as $ee) {
    $estoqueMap[$ee->id_produto] = $ee;
}

$contEstoqueAtualizado = 0;

foreach($todosProdutos as $produto) {
    // Definir as novas quantidades (maiores)
    $novaQuantidade = 0;
    
    switch($produto->nome) {
        case 'Óculos de Sol Ray-Ban':
            $novaQuantidade = 50;
            break;
        case 'Lente de Contato':
            $novaQuantidade = 150;
            break;
        case 'Armação Oakley':
            $novaQuantidade = 40;
            break;
        case 'Lente Multifocal':
            $novaQuantidade = 35;
            break;
        case 'Óculos de Grau':
            $novaQuantidade = 60;
            break;
        case 'Lente Blue Filter':
            $novaQuantidade = 100;
            break;
        case 'Armação Infantil':
            $novaQuantidade = 80;
            break;
        case 'Óculos de Segurança':
            $novaQuantidade = 120;
            break;
        case 'Óculos Esportivo':
            $novaQuantidade = 45;
            break;
        case 'Lente Polarizada':
            $novaQuantidade = 90;
            break;
        default:
            $novaQuantidade = 70;
    }
    
    if(isset($estoqueMap[$produto->id])) {
        // Atualizar estoque existente
        $estoque = $estoqueMap[$produto->id];
        $quantidadeAntiga = $estoque->quantidade;
        
        try {
            $dbEstoque->update([
                'id' => $estoque->id,
                'id_produto' => $produto->id,
                'quantidade' => $novaQuantidade
            ]);
            echo "<li class='list-group-item list-group-item-success'>✓ <strong>{$produto->nome}</strong> → {$quantidadeAntiga} → {$novaQuantidade} unidades (+" . ($novaQuantidade - $quantidadeAntiga) . ")</li>";
            $contEstoqueAtualizado++;
        } catch(Exception $e) {
            echo "<li class='list-group-item list-group-item-danger'>✗ Erro ao atualizar estoque do produto '{$produto->nome}': " . $e->getMessage() . "</li>";
        }
    } else {
        // Criar novo estoque se não existir
        try {
            $dbEstoque->store(['id_produto' => $produto->id, 'quantidade' => $novaQuantidade]);
            echo "<li class='list-group-item list-group-item-success'>✓ <strong>{$produto->nome}</strong> → Estoque criado com {$novaQuantidade} unidades</li>";
            $contEstoqueAtualizado++;
        } catch(Exception $e) {
            echo "<li class='list-group-item list-group-item-danger'>✗ Erro ao criar estoque do produto '{$produto->nome}': " . $e->getMessage() . "</li>";
        }
    }
}

echo "<li class='list-group-item list-group-item-info'>📊 Total de produtos com estoque atualizado: {$contEstoqueAtualizado}</li>";
echo "</ul>";

// ==================== RESUMO FINAL ====================
echo "<div class='alert alert-success mt-3'>";
echo "<h4 class='alert-heading'><i class='fas fa-check-circle'></i> Estoque atualizado com sucesso!</h4>";
echo "<p>Todos os produtos agora têm estoque mais alto.</p>";
echo "</div>";

// Tabela de resumo do estoque
echo "<div class='card mt-3'>";
echo "<div class='card-header bg-dark text-white'>";
echo "<h5 class='mb-0'><i class='fas fa-chart-line'></i> Estoque Atualizado</h5>";
echo "</div>";
echo "<div class='card-body p-0'>";
echo "<div class='table-responsive'>";
echo "<table class='table table-striped mb-0'>";
echo "<thead class='table-light'>";
echo "<tr><th>Produto</th><th>Quantidade em Estoque</th><th>Status</th></tr>";
echo "</thead>";
echo "<tbody>";

$estoqueFinal = $dbEstoque->all();
$estoqueFinalMap = [];
foreach($estoqueFinal as $ef) {
    $estoqueFinalMap[$ef->id_produto] = $ef->quantidade;
}

foreach($todosProdutos as $produto) {
    $qtd = isset($estoqueFinalMap[$produto->id]) ? $estoqueFinalMap[$produto->id] : 0;
    $badgeClass = ($qtd <= 15) ? 'bg-warning' : 'bg-success';
    $status = ($qtd <= 15) ? 'BAIXO' : 'NORMAL';
    
    echo "<tr>";
    echo "<td>{$produto->nome}</td>";
    echo "<td><strong>{$qtd}</strong> unidades</td>";
    echo "<td><span class='badge {$badgeClass}'>{$status}</span></td>";
    echo "</tr>";
}
echo "</tbody>";
echo "</tr>";
echo "</div>";
echo "</div>";
echo "</div>";

echo "<div class='d-flex gap-2 mt-3'>";
echo "<a href='index.php' class='btn btn-primary'><i class='fas fa-home'></i> Voltar ao Dashboard</a>";
echo "<a href='estoque/EstoqueList.php' class='btn btn-danger'><i class='fas fa-warehouse'></i> Ver Estoque</a>";
echo "</div>";

echo "</div>";
echo "</div>";
echo "</div>";

echo "<script src='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js'></script>";
echo "<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js'></script>";
echo "</body>";
echo "</html>";