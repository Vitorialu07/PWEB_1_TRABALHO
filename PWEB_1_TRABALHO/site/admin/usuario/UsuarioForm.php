<?php
include '../header.php';
include_once "../db.class.php";

$db = new db('usuario');
$success = '';
$actionError = '';
$errors = [];
$data = null;

if (!empty($_GET['id'])){
    $data = $db->find($_GET['id']);
}

if (!empty($_POST)) {
    
    if (!empty($_GET['id'])) {
        $_POST['id'] = $_GET['id'];
    }

    $data = (object) $_POST;
    try {
        if (empty($_POST['nome']))  $errors[] = "<li>O nome é obrigatório</li>";
        if (empty($_POST['email'])) $errors[] = "<li>O email é obrigatório</li>";
        if (empty($_POST['login'])) $errors[] = "<li>O login é obrigatório</li>";
        
        if (empty($_POST['id']) && empty($_POST['senha'])) {
            $errors[] = "<li>A senha é obrigatória para novos cadastros</li>";
        }
        
        if (empty($errors)) {
            if (empty($_POST['id'])) {
                $_POST['senha'] = password_hash($_POST['senha'], PASSWORD_DEFAULT);
                $db->store($_POST); 
                $success = "Usuário salvo com sucesso!";
            } else {
                if (empty($_POST['senha'])) {
                    $usuarioAtual = $db->find($_POST['id']);
                    $_POST['senha'] = $usuarioAtual->senha; 
                } else {
                    $_POST['senha'] = password_hash($_POST['senha'], PASSWORD_DEFAULT);
                }
                
                $db->update($_POST);
                $success = "Usuário atualizado com sucesso!";
            }
            
            header("Location: ./UsuarioList.php");
            exit;
        }
    } catch (Exception $e) {
        $actionError = $e->getMessage();
    }
}
?>

<div class="container mt-4" style="max-width: 600px;">
    <div class="row">
        <?php actionMessage($success, $actionError) ?>
        <?php showValidationError($errors) ?>
    </div>

    <div class="card p-4 shadow-sm">
        <h3 class="mb-4">Formulário de Usuários</h3>
        <form action="UsuarioForm.php" method="post" class="row g-3">
            <input type="hidden" name="id" value="<?php echo isset($data->id) ? (int)$data->id : ''; ?>">

            <div class="col-12">
                <label class="form-label">Nome</label>
                <input type="text" name="nome" class="form-control" value="<?php echo isset($data->nome) ? $data->nome : ''; ?>" required> 
            </div>
            <div class="col-12">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo isset($data->email) ? $data->email : ''; ?>" required>
            </div>
            <div class="col-12">
                <label class="form-label">Telefone</label>
                <input type="text" name="telefone" class="form-control" value="<?php echo isset($data->telefone) ? $data->telefone : ''; ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label">Login</label>
                <input type="text" name="login" class="form-control" value="<?php echo isset($data->login) ? $data->login : ''; ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Senha</label>
                <input type="password" name="senha" class="form-control" <?php echo empty($_GET['id']) ? 'required' : ''; ?>>
                <?php if(!empty($_GET['id'])): ?>
                    <small class="text-muted">Deixe em branco para manter a senha atual</small>
                <?php endif; ?>
            </div>
            <div class="mt-4 text-end">
                <a href="./UsuarioList.php" class="btn btn-secondary">Voltar</a>
                <button type="submit" class="btn btn-success">Salvar</button>
            </div>
        </form>
    </div>
</div>

<?php include '../footer.php'; ?>