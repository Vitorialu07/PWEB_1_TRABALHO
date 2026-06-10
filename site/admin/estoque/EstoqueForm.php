<?php
include '../header.php';
include_once "../db.class.php";

$db = new db('estoque');
$dbProduto = new db('produto');
$produtos = $dbProduto->all(); 

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
        // Validações
        if (empty($_POST['id_produto'])) {
            $errors[] = "<li>A seleção do produto é obrigatória</li>";
        }

        // Permitir quantidade 0
        if (!isset($_POST['quantidade']) || $_POST['quantidade'] === '') {
            $errors[] = "<li>É obrigatório informar a quantidade</li>";
        } elseif (!is_numeric($_POST['quantidade']) || $_POST['quantidade'] < 0) {
            $errors[] = "<li>A quantidade não pode ser negativa</li>";
        }

        if (empty($errors)) {
            // Preparar dados salvar
            $dadosEstoque = [
                'id_produto' => $_POST['id_produto'],
                'quantidade' => (int)$_POST['quantidade']
            ];
            
            if (empty($_POST['id'])){
                
                $existe = $db->findBy('id_produto', $_POST['id_produto']);
                if ($existe) {
                    $errors[] = "<li>Já existe um registro de estoque para este produto. Utilize a opção de editar na lista.</li>";
                } else {
                    $db->store($dadosEstoque);
                    $success = "Estoque salvo com sucesso!";
                    redirect('./EstoqueList.php');
                }
            } else {
                $dadosEstoque['id'] = (int)$_POST['id'];
                $db->update($dadosEstoque);
                $success = "Estoque atualizado com sucesso!";
                redirect('./EstoqueList.php');
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
                <h3> Gerenciamento de Estoque</h3>
            </div>
            <div class="card-body">
                <form action="EstoqueForm.php" method="post">
                    <input type="hidden" name="id" value="<?php echo getFormValue($data, 'id');?>">
                    <div class="row">
                        <div class="col-md-8">
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
                        <div class="col-md-4">
                            <label for="quantidade" class="form-label">Quantidade *</label>
                            <input type="number" name="quantidade" id="quantidade" min="0" class="form-control" 
                                   placeholder="0" value="<?php echo getFormValue($data, 'quantidade') ?>" required>
                            <small class="text-muted">Digite <strong>0</strong> se o produto estiver sem estoque</small>
                        </div>

                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Salvar
                            </button>
                            <a href="./EstoqueList.php" class="btn btn-primary">
                                <i class="fas fa-arrow-left"></i> Voltar
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include '../footer.php';
?>