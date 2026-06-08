<?php
include './header.php';
include_once "./db.class.php";

$db = new db('usuario');
$success = '';
$actionError = '';
$errors = [];
$data = '';

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

        if (empty($_POST['login'])) {
            $errors[] = "<li>O login é obrigatório</li>";
        }

        if (empty($_POST['senha'])) {
            $errors[] = "<li>A senha é obrigatória</li>";
            if (strlen($_POST['senha']< 3)){
                $errors[]="<li> A senha deve ter no mínimo 3 caracteres</li>";
            }
        }

if (empty($errors)) {

        $dado=[
            'nome'=>$_POST['nome'],
            'email'=>$_POST['email'],
            'login'=>$_POST['login'],
            'senha'=>password_hash($_POST['senha'], PASSWORD_DEFAULT),
        ];
            $db->store($dado); 
            $success = "Usuário cadastrado com sucesso, redirecionando para login...";
            redirect('./login.php');
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

    <form action="registrar.php" method="post">
        <h3> Registrar Usuário</h3>
        <div class="row">
            <div class=" col-6">
                <label for="nome">Nome</label>
                <input type="text" name="nome" class="form-control" value="<?php echo getFormValue($data,'nome') ?>">
            </div>
            <div class="col-6">
                <label for="email">Email</label>
                <input type="mail" name="email" class="form-control" value="<?php echo getFormValue($data, 'email') ?>">
            </div>
            <div class=" col-6">
                <label for="nome">Logim</label>
                <input type="text" name="nome" class="form-control" value="<?php echo getFormValue($data,'login') ?>">
            </div>

            <div class=" col-6">
                <label for="senha">Senha</label>
                <input type="password" name="senha" class="form-control" value="<?php echo getFormValue($data, 'senha') ?>">
            </div>
            <div class="mt-2">
                <button type="submit" class="btn btn-success">Salvar</button>
                <br>
                Já tem uma conta?
                <a href="./login.php" class="btn btn-primary">Login</a>
            </div>
        </div>
    </form>
</div>

<?php
include './footer.php';
?>