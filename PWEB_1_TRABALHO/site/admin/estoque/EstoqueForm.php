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
    $data=$db->find(id:$_GET['id']);
}

if (!empty($_POST)) {
    $data=(object)$_POST;

    try {
        if (empty($_POST['id_produto'])) {
            $errors[] = "<li>A seleção do produto é obrigatória</li>";
        }

        if (empty($_POST['quantidade'])) {
            $errors[] = "<li>É obrigatório informar a quantidade</li>";
        }

if (empty($errors)) {
            if (empty($_POST['id'])){
            $db->store($_POST); // $_POST é uma variável global que armazena o que é enviado no formulário 
            $success = "Registro salvo com sucesso!";
            }else {
                $db->update($_POST);
                $success="Registro atualizado com sucesso!";
            }
            
            redirect('./EstoqueList.php');
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

    <form action="EstoqueForm.php" method="post">
        <h3> Gerenciamento de Estoque</h3>
        <input type="hidden" name="id" value="<?php echo getFormValue($data, 'id');?>">
        <div class="row">
           <div class="col-md-8">
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
           <div class="col-md-4">
                    <label for="quantidade" class="form-label">Quantidade Atual</label>
                    <input type="number" name="quantidade" id="quantidade" min="0" class="form-control" placeholder="0" value="<?php echo getFormValue($data, 'quantidade') ?>">
                </div>

            <div class="mt-2">
                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="./EstoqueList.php" class="btn btn-primary">Voltar</a>
            </div>
        </div>
    </form>
</div>

<?php
include '../footer.php';
?>