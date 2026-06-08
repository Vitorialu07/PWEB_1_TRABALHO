<?php
include './header.php';
include_once "./db.class.php";

// Inicia a sessão caso ainda não tenha sido iniciada no header
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$db = new db('usuario');
$success = '';
$actionError = '';
$errors = [];
$data = null;

if (!empty($_POST)) {
    $data = (object)$_POST;

    try {
        if (empty($_POST['login'])) {
            $errors[] = "<li>O login é obrigatório</li>";
        }

        if (empty($_POST['senha'])) {
            $errors[] = "<li>A senha é obrigatória</li>";
        } else if (strlen($_POST['senha']) < 3) { 
            $errors[] = "<li>A senha deve ter no mínimo 3 caracteres</li>";
        }

        if (empty($errors)) {
            // Busca no banco de dados pela coluna 'login'
            $usuario = $db->findBy('login', $_POST['login']);
            
            if ($usuario && $_POST['senha'] === $usuario->senha) {
                $_SESSION['usuario_id']    = $usuario->id;
                $_SESSION['usuario_nome']  = $usuario->nome;
                $_SESSION['usuario_login'] = $usuario->login;   
            
                $success = "Usuário logado com sucesso, redirecionando para index...";
                redirect('./index.php');
            } else {
                $actionError = "Login ou senha inválidos. Tente novamente.";
            }
        }
    } catch (PDOException $e) {
        $actionError = $e->getMessage();
    } catch (Exception $e) {
        $actionError = $e->getMessage();
    }
}
?>
<div class="row mt-4 justify-content-center">
    <div class="col-md-6 card p-4 shadow-sm">
        <?php actionMessage($success, $actionError) ?>
        <?php showValidationError($errors) ?>

        <form action="login.php" method="post">
            <h3 class="mb-4">Acesso ao Sistema</h3>
            <div class="row g-3">
                <div class="col-12">
                    <label for="login" class="form-label">Login</label>
                    <input type="text" id="login" name="login" class="form-control" value="<?php echo getFormValue($data, 'login') ?>" required>
                </div>

                <div class="col-12">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" id="senha" name="senha" class="form-control" required>
                </div>
                
                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-success w-100">Acessar</button>
                    <div class="mt-3 text-center">
                        Não tem uma conta? <a href="./registrar.php">Crie sua conta aqui</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
include './footer.php';
?>