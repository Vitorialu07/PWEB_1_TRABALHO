<?php
include '../header.php';
include_once "../db.class.php";

$db = new db('produto');
$success = '';
$actionError = '';
$errors = [];
$data = null;
$readonly = '';
$disabled = '';
$warning = '';

if (!empty($_GET['id'])){
    $data = $db->find($_GET['id']);
    
    
    if ($data && isset($data->ativo) && $data->ativo == 0) {
        $readonly = 'readonly';
        $disabled = 'disabled';
        $warning = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle"></i> 
                        Este produto está <strong>INATIVO</strong>. Apenas visualização permitida.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
    }
}

if (!empty($_POST)) {
    $data = (object)$_POST;

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
        
        if (empty($_POST['preco_custo']) || $_POST['preco_custo'] <= 0) {
            $errors[] = "<li>O preço de custo é obrigatório e deve ser maior que zero</li>";
        }

        if (empty($_POST['preco_venda']) || $_POST['preco_venda'] <= 0) {
            $errors[] = "<li>O preço de venda é obrigatório e deve ser maior que zero</li>";
        }

        if (empty($errors)) {
            $dadosProduto = [
                'nome' => $_POST['nome'],
                'descrição' => $_POST['descricao'],
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
    
    
    <?php echo $warning; ?>

    <form action="ProdutoForm.php" method="post">
        <h3> Cadastro de produtos</h3>
        <input type="hidden" name="id" value="<?php echo getFormValue($data, 'id');?>">
        <div class="row">
            <div class="col-6">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" name="nome" id="nome" class="form-control" 
                       value="<?php echo getFormValue($data, 'nome') ?>" 
                       <?php echo $readonly; ?> required>
            </div>
            <div class="col-6">
                <label for="descricao" class="form-label">Descrição</label>
                <input type="text" name="descricao" id="descricao" class="form-control" 
                       value="<?php echo getFormValue($data, 'descrição') ?>" 
                       <?php echo $readonly; ?> required>
            </div>

            <div class="col-6">
                <label for="marca" class="form-label">Marca</label>
                <input type="text" name="marca" id="marca" class="form-control" 
                       value="<?php echo getFormValue($data, 'marca') ?>" 
                       <?php echo $readonly; ?> required>
            </div>

            <div class="col-6">
                <label for="preco_custo" class="form-label">Preço de custo (R$)</label>
                <input type="number" step="0.01" name="preco_custo" id="preco_custo" class="form-control" 
                       value="<?php echo getFormValue($data, 'preco_custo') ?>" 
                       <?php echo $readonly; ?> required>
            </div>

            <div class="col-6">
                <label for="preco_venda" class="form-label">Preço de venda (R$)</label>
                <input type="number" step="0.01" name="preco_venda" id="preco_venda" class="form-control" 
                       value="<?php echo getFormValue($data, 'preco_venda') ?>" 
                       <?php echo $readonly; ?> required>
            </div>
            
            <div class="col-12 mt-4">
                <?php if($disabled != 'disabled'): ?>
                    <button type="submit" class="btn btn-success" <?php echo $disabled; ?>>
                        <i class="fas fa-save"></i> Salvar
                    </button>
                <?php endif; ?>
                <a href="./ProdutoList.php" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i> Voltar
                </a>
            </div>
        </div>
    </form>
</div>

<?php
include '../footer.php';