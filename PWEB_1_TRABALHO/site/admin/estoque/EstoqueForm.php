<?php
include '../header.php';
include_once "../db.class.php";

$db = new db('produto');
$sucess = '';
$actionError = '';
$errors = [];
$data = null;

if (!empty($_GET['id'])) {
    $data = $db->find($_GET['id']);
}

if (!empty($_POST)) {
    $data = (object) $_POST;
    try {
        if (empty($_POST['nome'])) {
            $errors[] = "<li>O nome do produto é obrigatório</li>";
        }
        if (empty($_POST['categoria'])) {
            $errors[] = "<li>A categoria é obrigatória</li>";
        }
        
        if (empty($errors)) {
            $db->store($_POST); 
            $sucess = "Registro salvo com sucesso";
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
    <?php actionMessage($sucess, $actionError) ?>
    <?php showValidationError($errors) ?>
</div>

<form action="EstoqueForm.php" method="post">
    <h3>Formulário de Produto</h3>
    <input type="hidden" name="id" value="<?php echo getFormValue($data,'id')?>">
    
    <div class="row">
        <div class="col-6 mb-2">
            <label for="nome">Nome do Produto</label>
            <input type="text" name="nome" class="form-control" value="<?php echo getFormValue($data,'nome') ?>">  
        </div>
        
        <div class="col-6 mb-2">
            <label for="categoria">Categoria</label>
            <select name="categoria" class="form-select">
                <option value="Armação" <?php echo getFormValue($data,'categoria') == 'Armação' ? 'selected' : '' ?>>Armação</option>
                <option value="Lente" <?php echo getFormValue($data,'categoria') == 'Lente' ? 'selected' : '' ?>>Lente</option>
                <option value="Óculos de sol" <?php echo getFormValue($data,'categoria') == 'Óculos de sol' ? 'selected' : '' ?>>Óculos de sol</option>
                <option value="Outros" <?php echo getFormValue($data,'categoria') == 'Outros' ? 'selected' : '' ?>>Outros</option>
            </select>
        </div>

        <div class="col-6 mb-2">
            <label for="marca">Marca</label>
            <input type="text" name="marca" class="form-control" value="<?php echo getFormValue($data,'marca') ?>">
        </div>

        <div class="col-6 mb-2">
            <label for="estoque">Quantidade em Estoque</label>
            <input type="number" name="estoque" class="form-control" value="<?php echo getFormValue($data,'estoque') ?>">
        </div>

        <div class="col-6 mb-2">
            <label for="preco_custo">Preço de Custo</label>
            <input type="text" name="preco_custo" class="form-control" value="<?php echo getFormValue($data,'preco_custo') ?>">
        </div>

        <div class="col-6 mb-2">
            <label for="preco_venda">Preço de Venda</label>
            <input type="text" name="preco_venda" class="form-control" value="<?php echo getFormValue($data,'preco_venda') ?>">
        </div>

        <div class="col-12 mb-2">
            <label for="descricao">Descrição</label>
            <input type="text" name="descricao" class="form-control" value="<?php echo getFormValue($data,'descricao') ?>">
        </div>
    </div>

    <div class="mt-3">
        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="./EstoqueList.php" class="btn btn-primary">Voltar</a>
    </div>
</form>

<?php
include '../footer.php';
?>