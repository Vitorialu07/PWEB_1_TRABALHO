<?php
include '../header.php';
include_once "../database/db.class.php";

$db = new db('produto');
$success = '';
$actionError = '';
$errors = [];

if (!empty($_GET['id'])){
    $data=$db->find(id:$_GET['id']);
}

if (!empty($_POST)) {
    $data=(object)$_POST;

    try {
        if (empty($_POST['nome'])) {
            $errors[] = "<li>O nome é obrigatório</li>";
        }

        if (empty($_POST['descricao'])) {
            $errors[] = "<li>A descrição é obrigatória</li>";
        }

        if (empty($_POST['marca'])) {
            $errors[] = "<li>A marca é obrigatória</li>";
        }
        
        if (empty($_POST['preco_custo'])) {
            $errors[] = "<li>O preço de custo é obrigatório</li>";
        }

        if (empty($_POST['preco_venda'])) {
            $errors[] = "<li>O preço de venda é obrigatório</li>";
        }

if (empty($errors)) {
            if (empty($_POST['id'])){
            $db->store($_POST); // $_POST é uma variável global que armazena o que é enviado no formulário 
            $success = "Registro salvo com sucesso!";
            }else {
                $db->update($_POST);
                $sucess="Registro atualizado com sucesso!";
            }
            
            redirect('./ProdutoList.php');
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

    <form action="ProdutoForm.php" method="post">
        <h3> Cadastro de produtos</h3>
        <input type="hidden" name="id" value="<?php echo getFormValue($data, 'id');?>">
        <div class="row">
            <div class=" col-6">
                <label for="nome">Nome</label>
                <input type="text" name="nome" class="form-control" value="<?php echo getFormValue($data,'nome') ?>">
            </div>
            <div class="col-6">
                <label for="descricao">descricao</label>
                <input type="text" name="descricao" class="form-control" value="<?php echo getFormValue($data, 'descricao') ?>">
            </div>

            <div class=" col-6">
                <label for="marca">Marca</label>
                <input type="text" name="marca" class="form-control" value="<?php echo getFormValue($data, 'marca') ?>">
            </div>

            <div class=" col-6">
                <label for="preco_custo">Preço de custo</label>
                <input type="number" name="preco_custo" class="form-control" value="<?php echo getFormValue($data, 'preco_custo') ?>">
            </div>

            <div class=" col-6">
                <label for="preco_venda">Preço de venda</label>
                <input type="number" name="preco_venda" class="form-control" value="<?php echo getFormValue($data, 'preco_venda') ?>">
            </div>
            <div class="mt-2">
                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="./ProdutoList.php" class="btn btn-primary">Voltar</a>
            </div>
        </div>
    </form>
</div>

<?php
include '../footer.php';
?>