<?php
include '../header.php';
include_once "../db.class.php";


$db = new db('movimentacao_estoque');

$dbProduto = new db('produto');
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

        if (empty($errors)) {
            if (empty($_POST['id'])){
                $db->store($_POST); 
                $success = "Movimentação registrada com sucesso!";
            } else {
                $db->update($_POST);
                $success = "Movimentação atualizada com sucesso!"; 
            }
            
            redirect('./MovimentacaoList.php');
        }
    } catch (PDOException $e) {
        $actionError = $e->getMessage();
    } catch (Exception $e) {
        $actionError = $e->getMessage();
    }
}
?>
<div class="row">
    <?php actionMessage($success, $actionError) ?>
    <?php showValidationError($errors) ?>

    <form action="MovimentacaoForm.php" method="post">
        <h3 class="mb-4"> Registro de movimentação de estoque</h3>
        
        <input type="hidden" name="id" value="<?php echo getFormValue($data, 'id');?>">
        
        <div class="row g-3">
            <div class="col-md-6">
                <label for="id_produto" class="form-label">Produto</label>
                <select name="id_produto" id="id_produto" class="form-select">
                    <option value="">Selecione um produto...</option>
                    <?php 
                    $produtoSelecionado = getFormValue($data, 'id_produto');
                    foreach ($produtos as $produto) {
                        $selected = ($produto->id == $produtoSelecionado) ? 'selected' : '';
                        echo "<option value='{$produto->id}' {$selected}>{$produto->nome}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="col-md-6">
                <label for="id_funcionario" class="form-label">Funcionário Responsável</label>
                <select name="id_funcionario" id="id_funcionario" class="form-select">
                    <option value="">Selecione o funcionário...</option>
                    <?php 
                    $funcSelecionado = getFormValue($data, 'id_funcionario');
                    foreach ($funcionarios as $funcionario) {
                        $selected = ($funcionario->id == $funcSelecionado) ? 'selected' : '';
                        echo "<option value='{$funcionario->id}' {$selected}>{$funcionario->nome}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="col-md-6">
                <label for="tipo" class="form-label">Tipo de Operação</label>
                <select name="tipo" id="tipo" class="form-select">
                    <option value="">Selecione...</option>
                    <option value="Entrada" <?php echo (getFormValue($data, 'tipo') == 'Entrada') ? 'selected' : ''; ?>>Entrada (Fornecedor/Ajuste)</option>
                    <option value="Saída" <?php echo (getFormValue($data, 'tipo') == 'Saída') ? 'selected' : ''; ?>>Saída (Venda/Avaria)</option>
                </select>
            </div>

            <div class="col-md-6">
                <label for="quantidade" class="form-label">Quantidade Movimentada</label>
                <input type="number" name="quantidade" id="quantidade" min="1" class="form-control" placeholder="Ex: 5" value="<?php echo getFormValue($data, 'quantidade') ?>">
            </div>

            <div class="col-12 mt-4">
                <button type="submit" class="btn btn-success">Confirmar Movimentação</button>
                <a href="./MovimentacaoList.php" class="btn btn-secondary">Voltar para o histórico de movimentações</a>
            </div>
        </div>
    </form>
</div>

<?php
include '../footer.php';
?>