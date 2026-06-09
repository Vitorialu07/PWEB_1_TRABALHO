<?php
include '../header.php';
include_once "../db.class.php";

$db = new db('produto');
$success = '';
$actionError = '';
$errors = [];
$data = null;


if (!empty($_GET['id'])){
    $data = $db->find($_GET['id']);
}

if (!empty($_POST)) {
    $data = (object)$_POST;

    try {
        if (empty($_POST['nome'])) {
            $errors[] = "<li>O nome é obrigatório</li>";
        }

        // CORRIGIDO: mudar 'descricao' para 'descrição' (com acento e ç)
        if (empty($_POST['descricao'])) {
            $errors[] = "<li>A descrição é obrigatória</li>";
        }

        if (empty($_POST['marca'])) {
            $errors[] = "<li>A marca é obrigatória</li>";
        }
        
        if (empty($_POST['preco_custo']) || $_POST['preco_custo'] <= 0) {
            $errors[] = "<li>O preço de custo é obrigatório e deve ser maior que zero</li>";
        }

        if (empty($_POST['preco_venda']) || $_POST['preco_venda'] <= 0) {
            $errors[] = "<li>O preço de venda é obrigatório e deve ser maior que zero</li>";
        }

        if (empty($errors)) {
            // CORRIGIDO: usar o nome correto da coluna 'descrição' no array
            $dadosProduto = [
                'nome' => $_POST['nome'],
                'descrição' => $_POST['descricao'], // Atenção: nome com acento e ç
                'marca' => $_POST['marca'],
                'preco_custo' => str_replace(',', '.', $_POST['preco_custo']),
                'preco_venda' => str_replace(',', '.', $_POST['preco_venda'])
            ];
            
            if (empty($_POST['id'])){
                $db->store($dadosProduto);
                $success = "Produto salvo com sucesso!";
            } else {
                $dadosProduto['id'] = $_POST['id'];
                $db->update($dadosProduto);
                $success = "Produto atualizado com sucesso!";
            }
            
            redirect('./ProdutoList.php');
        }
    } catch (PDOException $e) {
        $actionError = "Erro no banco de dados: " . $e->getMessage();
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
            <div class="col-6">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" name="nome" id="nome" class="form-control" value="<?php echo getFormValue($data, 'nome') ?>" required>
            </div>
            <div class="col-6">
                <label for="descricao" class="form-label">Descrição</label>
                <input type="text" name="descricao" id="descricao" class="form-control" value="<?php echo getFormValue($data, 'descrição') ?>" required>
            </div>

            <div class="col-6">
                <label for="marca" class="form-label">Marca</label>
                <input type="text" name="marca" id="marca" class="form-control" value="<?php echo getFormValue($data, 'marca') ?>" required>
            </div>

            <div class="col-6">
                <label for="preco_custo" class="form-label">Preço de custo (R$)</label>
                <input type="number" step="0.01" name="preco_custo" id="preco_custo" class="form-control" value="<?php echo getFormValue($data, 'preco_custo') ?>" required>
            </div>

            <div class="col-6">
                <label for="preco_venda" class="form-label">Preço de venda (R$)</label>
                <input type="number" step="0.01" name="preco_venda" id="preco_venda" class="form-control" value="<?php echo getFormValue($data, 'preco_venda') ?>" required>
            </div>
            
            <div class="col-12 mt-4">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Salvar
                </button>
                <a href="./ProdutoList.php" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i> Voltar
                </a>
            </div>
        </div>
    </form>
</div>

<?php
include '../footer.php';
?>