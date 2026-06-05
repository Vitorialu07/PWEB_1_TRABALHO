<?php
include './header.php';
include_once "./db.class.php";

$db = new db('usuario');
$success = '';
$actionError = '';
$errors = [];
$data = '';


if (!empty($_POST)) {
    $data=(object)$_POST;

    try {
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
    $usuario = $db->findBy('email', $_POST['email']);
    if ($usuario && password_verify($_POST['senha'], $usuario->senha)){
        $_SESSION['usuario_id']=$usuario->id;
        $_SESSION['usuario_nome']=$usuario->nome;
        $_SESSION['usuario_login']=$usuario->login;   
    
            $success = "Usuário logado com sucesso, redirecionando para index...";
            redirect('./index.php');}
            else{
                $actionError="Login ou senha inválidos. Tente novamente";
            }

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

    <form action="login.php" method="post">
        <h3> Registro de usuários</h3>
        <div class="row">
            <div class="col-6">
                <label for="email">Login</label>
                <input type="text" name="email" class="form-control" value="<?php echo getFormValue($data, 'login') ?>">
            </div>

            <div class=" col-6">
                <label for="senha">Senha</label>
                <input type="password" name="senha" class="form-control" value="<?php echo getFormValue($data, 'senha') ?>">
            </div>
            <div class="mt-2">
                <button type="submit" class="btn btn-success">Acessar</button>
                <br>
                Não tem uma conta?
                <a href="./registrar.php" class="btn btn-primary">Crie sua conta</a>
            </div>
        </div>
    </form>
</div>

<?php
include './footer.php';
?>