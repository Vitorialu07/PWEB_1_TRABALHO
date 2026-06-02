<?php
include '../header.php';
include_once "../db.class.php"; // Certifique-se de que o caminho até o db.class.php está correto

$db = new db('usuario');
$sucess = '';
$actionError = '';
$errors = [];
$data = null;

if (!empty($_POST)) {
    $data = (object) $_POST;
    try {
        if (empty($_POST['nome']))  $errors[] = "<li>O nome é obrigatório</li>";
        if (empty($_POST['email'])) $errors[] = "<li>O email é obrigatório</li>";
        if (empty($_POST['login'])) $errors[] = "<li>O login é obrigatório</li>";
        if (empty($_POST['senha'])) $errors[] = "<li>A senha é obrigatória</li>";
        
        if (empty($errors)) {
            $db->store($_POST); 
            $sucess = "Usuário salvo com sucesso!";
            redirect('./UsuarioList.php');
        }
    } catch (Exception $e) {
        $actionError = $e->getMessage();
    }
}
?> 

<div class="container mt-4" style="max-width: 600px;">
    <div class="row">
        <?php actionMessage($sucess, $actionError) ?>
        <?php showValidationError($errors) ?>
    </div>

    <div class="card p-4 shadow-sm">
        <h3 class="mb-4">Cadastrar Usuário</h3>
        <form action="UsuarioForm.php" method="post" class="row g-3">
            <div class="col-12">
                <label class="form-label">Nome</label>
                <input type="text" name="nome" class="form-control" required>  
            </div>
            <div class="col-12">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="col-12">
                <label class="form-label">Telefone</label>
                <input type="text" name="telefone" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label">Login</label>
                <input type="text" name="login" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Senha</label>
                <input type="password" name="senha" class="form-control" required>
            </div>
            <div class="mt-4 text-end">
                <a href="./UsuarioList.php" class="btn btn-secondary">Voltar</a>
                <button type="submit" class="btn btn-success">Salvar</button>
            </div>
        </form>
    </div>
</div>

<?php include '../footer.php'; ?>