<?php
include './header.php';
include_once "./db.class.php";

$db = new db('usuario');
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
        if (empty($_POST['nome'])) {
            $errors[] = "<li>O nome é obrigatório</li>";
        }

        if (empty($_POST['email'])) {
            $errors[] = "<li>O email é obrigatório</li>";
        }

        if (empty($_POST['login'])) {
            $errors[] = "<li>O login é obrigatório</li>";
        }

        // CORREÇÃO: Verificação da senha
        if (empty($_POST['senha'])) {
            $errors[] = "<li>A senha é obrigatória</li>";
        } elseif (strlen($_POST['senha']) < 3) {
            $errors[] = "<li>A senha deve ter no mínimo 3 caracteres</li>";
        }

        if (empty($errors)) {
            $dado = [
                'nome' => $_POST['nome'],
                'email' => $_POST['email'],
                'login' => $_POST['login'],
                'senha' => password_hash($_POST['senha'], PASSWORD_DEFAULT),
                'telefone' => $_POST['telefone'] ?? '' // Adicionando telefone se existir
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
<div class="row mt-4 justify-content-center">
    <div class="col-md-6 card p-4 shadow-sm">
        <?php actionMessage($success, $actionError) ?>
        <?php showValidationError($errors) ?>

        <form action="registrar.php" method="post">
            <h3 class="mb-4">Registrar Usuário</h3>
            <div class="row g-3">
                <div class="col-12">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control" value="<?php echo getFormValue($data, 'nome') ?>" required>
                </div>

                <div class="col-12">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="<?php echo getFormValue($data, 'email') ?>" required>
                </div>

                <div class="col-12">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" name="telefone" id="telefone" class="form-control" value="<?php echo getFormValue($data, 'telefone') ?>">
                </div>

                <div class="col-12">
                    <!-- CORREÇÃO: mudar de 'nome' para 'login' -->
                    <label for="login" class="form-label">Login</label>
                    <input type="text" name="login" id="login" class="form-control" value="<?php echo getFormValue($data, 'login') ?>" required>
                </div>

                <div class="col-12">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" name="senha" id="senha" class="form-control" required>
                    <small class="text-muted">Mínimo de 3 caracteres</small>
                </div>
                
                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-success w-100">Cadastrar</button>
                    <div class="mt-3 text-center">
                        Já tem uma conta? <a href="./login.php" class="btn btn-link">Faça login aqui</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
include './footer.php';
?>