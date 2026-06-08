<?php
include '../header.php';
include_once "../db.class.php";

$db = new db('funcionario');
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

         if (empty($_POST['cpf'])) {
            $errors[] = "<li>O cpf é obrigatório</li>";
        }

         if (empty($_POST['nascimento'])) {
            $errors[] = "<li>A data de nascimento é obrigatória</li>";
        }

         if (empty($_POST['admissao'])) {
            $errors[] = "<li>A data de admissão é obrigatória</li>";
        }

        if (empty($_POST['funcao'])) {
            $errors[] = "<li>A função do funcionário é obrigatória</li>";
        }

         if (empty($_POST['status'])) {
            $errors[] = "<li>O status é obrigatório</li>";
        }

         if (empty($_POST['salario'])) {
            $errors[] = "<li>O salario é obrigatório</li>";
        }

if (empty($errors)) {   
            if (empty($_POST['id'])){
            $db->store($_POST); // $_POST é uma variável global que armazena o que é enviado no formulário 
            $success = "Registro salvo com sucesso!";
            }else {
                $db->update($_POST);
                $success="Registro atualizado com sucesso!";
            }
            
            redirect('./FuncionarioList.php');
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

    <form action="FuncionarioForm.php" method="post">
        <h3> Formulário Funcionário</h3>
        <input type="hidden" name="id" value="<?php echo getFormValue($data, 'id');?>">
        <div class="row">
            <div class=" col-6">
                <label for="nome">Nome</label>
                <input type="text" name="nome" class="form-control" value="<?php echo getFormValue($data,'nome') ?>">
            </div>
            <div class="col-6">
                <label for="cpf">CPF</label>
                <input type="text" name="cpf" class="form-control" value="<?php echo getFormValue($data, 'cpf') ?>">
            </div>

            <div class=" col-6">
                <label for="nascimento">Data de nascimento</label>
                <input type="date" name="nascimento" class="form-control" value="<?php echo getFormValue($data, 'nascimento') ?>">
            </div>

            <div class=" col-6">
                <label for="admissao">Admissão</label>
                <input type="date" name="admissao" class="form-control" value="<?php echo getFormValue($data, 'admissao') ?>">
            </div>

            
            <div class=" col-6">
                <label for="demissao">Demissão</label>
                <input type="date" name="demissao" class="form-control" value="<?php echo getFormValue($data, 'demissao') ?>">
            </div>

            
            <div class=" col-6">
                <label for="funcao">Função</label>
                <input type="text" name="funcao" class="form-control" value="<?php echo getFormValue($data, 'funcao') ?>">
            </div>

            
            <div class=" col-6">
                <label for="status">Status</label>
                <input type="text" name="status" class="form-control" value="<?php echo getFormValue($data, 'status') ?>">
            </div>


            <div class="mt-2">
                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="./FuncionarioList.php" class="btn btn-primary">Voltar</a>
            </div>
        </div>
    </form>
</div>

<?php
include '../footer.php';
?>