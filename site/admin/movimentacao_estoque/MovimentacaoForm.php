<?php
include '../header.php';
include_once "../db.class.php";

$db = new db('movimentacao_estoque');
$dbProduto = new db('produto');
$dbEstoque = new db('estoque');

$produtos = $dbProduto->all(); 
$dbFuncionario = new db('funcionario');
$funcionarios = $dbFuncionario->all();

$success = '';
$actionError = '';
$errors = [];
$data = null;

if (!empty($_GET['id'])){
    $data = $db->find(id: $_GET['id']);
}

if (!empty($_POST)) {
    $data = (object)$_POST;

    try {
        
        if (empty($_POST['id_produto'])) {
            $errors[] = "<li>A seleção do produto é obrigatória</li>";
        }

        if (empty($_POST['id_funcionario'])) {
            $errors[] = "<li>É obrigatório informar o funcionário responsável</li>";
        }

        if (empty($_POST['tipo'])) {
            $errors[] = "<li>Selecione o tipo de movimentação (Entrada/Saída)</li>";
        }

        if (empty($_POST['quantidade']) || $_POST['quantidade'] <= 0) {
            $errors[] = "<li>A quantidade deve ser maior que zero</li>";
        }

        
        if ($_POST['tipo'] == 'Saída') {
            $estoqueAtual = $dbEstoque->findBy('id_produto', $_POST['id_produto']);
            $quantidadeAtual = $estoqueAtual ? $estoqueAtual->quantidade : 0;
            
            if ($_POST['quantidade'] > $quantidadeAtual) {
                $errors[] = "<li>Quantidade insuficiente em estoque! Disponível: {$quantidadeAtual} unidades.</li>";
            }
        }

        if (empty($errors)) {
           
            $dadosMovimentacao = [
                'id_produto' => $_POST['id_produto'],
                'id_funcionario' => $_POST['id_funcionario'],
                'tipo' => $_POST['tipo'],
                'quantidade' => (int)$_POST['quantidade']
            ];
            
            
            $estoque = $dbEstoque->findBy('id_produto', $_POST['id_produto']);
            
            if ($estoque) {
                
                $novaQuantidade = $estoque->quantidade;
                if ($_POST['tipo'] == 'Entrada') {
                    $novaQuantidade += (int)$_POST['quantidade'];
                } else {
                    $novaQuantidade -= (int)$_POST['quantidade'];
                    if ($novaQuantidade < 0) $novaQuantidade = 0;
                }
                
                $dbEstoque->update([
                    'id' => $estoque->id,
                    'id_produto' => $_POST['id_produto'],
                    'quantidade' => $novaQuantidade
                ]);
            } else {
                if ($_POST['tipo'] == 'Entrada') {
                    $dbEstoque->store([
                        'id_produto' => $_POST['id_produto'],
                        'quantidade' => (int)$_POST['quantidade']
                    ]);
                } else {
                    $errors[] = "<li>Não é possível dar saída: produto sem registro de estoque!</li>";
                }
            }
            
            
            if (empty($errors)) {
                if (empty($_POST['id'])){
                    $db->store($dadosMovimentacao); 
                    $success = "Movimentação registrada com sucesso!";
                } else {
                    
                    $errors[] = "<li>Movimentações não podem ser editadas para manter o histórico!</li>";
                }
                
                if (empty($errors)) {
                    redirect('./MovimentacaoList.php');
                }
            }
        }
    } catch (PDOException $e) {
        $actionError = "Erro no banco de dados: " . $e->getMessage();
    } catch (Exception $e) {
        $actionError = $e->getMessage();
    }
}
?>
<div class="container mt-4">
    <div class="row">
        <?php actionMessage($success, $actionError) ?>
        <?php showValidationError($errors) ?>

        <div class="card">
            <div class="card-header">
                <h3 class="mb-0"> Registro de Movimentação de Estoque</h3>
            </div>
            <div class="card-body">
                <form action="MovimentacaoForm.php" method="post">
                    <input type="hidden" name="id" value="<?php echo getFormValue($data, 'id');?>">
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="id_produto" class="form-label">Produto *</label>
                            <select name="id_produto" id="id_produto" class="form-select" required>
                                <option value="">Selecione um produto...</option>
                                <?php 
                                $produtoSelecionado = getFormValue($data, 'id_produto');
                                foreach ($produtos as $produto) {
                                    $selected = ($produto->id == $produtoSelecionado) ? 'selected' : '';
                                    echo "<option value='{$produto->id}' {$selected}>" . htmlspecialchars($produto->nome) . " (Marca: " . htmlspecialchars($produto->marca) . ")</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="id_funcionario" class="form-label">Funcionário Responsável *</label>
                            <select name="id_funcionario" id="id_funcionario" class="form-select" required>
                                <option value="">Selecione o funcionário...</option>
                                <?php 
                                $funcSelecionado = getFormValue($data, 'id_funcionario');
                                foreach ($funcionarios as $funcionario) {
                                    
                                    if (isset($funcionario->ativo) && $funcionario->ativo == 0) continue;
                                    $selected = ($funcionario->id == $funcSelecionado) ? 'selected' : '';
                                    echo "<option value='{$funcionario->id}' {$selected}>" . htmlspecialchars($funcionario->nome) . "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="tipo" class="form-label">Tipo de Operação *</label>
                            <select name="tipo" id="tipo" class="form-select" required>
                                <option value="">Selecione...</option>
                                <option value="Entrada" <?php echo (getFormValue($data, 'tipo') == 'Entrada') ? 'selected' : ''; ?>>📥 Entrada (Fornecedor/Ajuste)</option>
                                <option value="Saída" <?php echo (getFormValue($data, 'tipo') == 'Saída') ? 'selected' : ''; ?>>📤 Saída (Venda/Avaria)</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="quantidade" class="form-label">Quantidade *</label>
                            <input type="number" name="quantidade" id="quantidade" min="1" class="form-control" 
                                   placeholder="Ex: 5" value="<?php echo getFormValue($data, 'quantidade') ?>" required>
                            <small class="text-muted" id="estoque-disponivel"></small>
                        </div>

                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-check-circle"></i> Confirmar Movimentação
                            </button>
                            <a href="./MovimentacaoList.php" class="btn btn-secondary">
                                <i class="fas fa-history"></i> Ver Histórico
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

document.getElementById('id_produto').addEventListener('change', function() {
    var produtoId = this.value;
    if (produtoId) {
        fetch('getEstoque.php?produto_id=' + produtoId)
            .then(response => response.json())
            .then(data => {
                var estoqueSpan = document.getElementById('estoque-disponivel');
                if (data.quantidade !== undefined) {
                    estoqueSpan.innerHTML = 'Estoque disponível: ' + data.quantidade + ' unidades';
                    estoqueSpan.style.color = data.quantidade <= 5 ? 'orange' : 'green';
                } else {
                    estoqueSpan.innerHTML = '';
                }
            });
    }
});
</script>

<?php
include '../footer.php';
?>