<?php
include '../header.php';
include_once "../db.class.php";

$db = new db('cliente');
$success = '';
$actionError = '';
$errors = [];
$data= []; 

if (!empty($_GET['id'])){
    $data=$db->find(id:$_GET['id']);
}

if (!empty($_POST)) {
    $data=(object)$_POST;
    try {
        if (empty($_POST['nome'])) {
            $errors[] = "<li>O nome é obrigatório</li>";
        }

        if (empty($_POST['email'])) {
            $errors[] = "<li>O email é obrigatório</li>";
        }

          if (empty($_POST['telefone'])) {
            $errors[] = "<li>O telefone é obrigatório</li>";
        }

          if (empty($_POST['rua'])) {
            $errors[] = "<li>A rua é obrigatório</li>";
        }

          if (empty($_POST['cidade'])) {
            $errors[] = "<li>A cidade é obrigatória</li>";
        }

          if (empty($_POST['cep'])) {
            $errors[] = "<li>O cep é obrigatório</li>";
        }

        if (empty($errors)) {
            if (empty($_POST['id'])){
            $db->store($_POST); // $_POST é uma variável global que armazena o que é enviado no formulário 
            $success = "Registro salvo com sucesso!";
            }else {
                $success="Registro atualizado com sucesso!";
            }
            
            redirect('./ClienteList.php');
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

    <form action="ClienteForm.php" method="post">
        <h3> Cadastro de Clientes</h3>
        <input type="hidden" name="id" value="<?php echo getFormValue($data, 'id');?>">
        <div class="row">
            <div class=" col-6">
                <label for="nome">Nome</label>
                <input type="text" name="nome" class="form-control" value="<?php echo getFormValue($data,'nome') ?>">
            </div>

             <div class="col-6">
                <label for="razao_social">Razão social</label>
                <input type="text" name="razao_social" class="form-control" value="<?php echo getFormValue($data, 'razao_social') ?>">
            </div>

             <div class="col-6">
                <label for="cpf">CPF</label>
                <input type="text" name="cpf" class="form-control" value="<?php echo getFormValue($data, 'cpf') ?>">
            </div>

             <div class="col-6">
                <label for="cnpj">CNPJ</label>
                <input type="text" name="cnpj" class="form-control" value="<?php echo getFormValue($data, 'cnpj') ?>">
            </div>

            <div class="col-6">
                <label for="email">E-mail</label>
                <input type="mail" name="email" class="form-control" value="<?php echo getFormValue($data, 'email') ?>">
            </div>

            <div class=" col-6">
                <label for="telefone">Telefone</label>
                <input type="text" name="telefone" class="form-control" value="<?php echo getFormValue($data, 'telefone') ?>">
            </div>

             <div class="col-6">
                <label for="rua">Rua</label>
                <input type="text" name="rua" class="form-control" value="<?php echo getFormValue($data, 'rua') ?>">
            </div>

            <div class="col-6">
                <label for="cidade">Cidade</label>
                <input type="text" name="cidade" class="form-control" value="<?php echo getFormValue($data, 'cidade') ?>">
            </div>

            <div class="col-6">
                <label for="cep">CEP</label>
                <input type="text" name="cep" class="form-control" value="<?php echo getFormValue($data, 'cep') ?>">
            </div>

            <div class="mt-2">
                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="./ClienteList.php" class="btn btn-primary">Voltar</a>
            </div>
        </div>
    </form>
</div>

<?php
include '../footer.php';
?>