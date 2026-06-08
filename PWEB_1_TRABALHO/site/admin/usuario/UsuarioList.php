<?php
include '../header.php';
include '../autenticacao.php';
include_once "../db.class.php";

$db = new db('usuario');

// Processa a exclusão (via GET)
if (!empty($_GET['id'])){
    $db->destroy($_GET['id']);
    header("Location: UsuarioList.php");
    exit;
}

// Lógica do Filtro de Pesquisa (via POST)
if (!empty($_POST['tipo']) && !empty($_POST['valor'])) {
    $dados = $db->search($_POST); 
} else {
    $dados = $db->all();
}

?> 

<div class="row mb-4">
    <h3>Filtro de Pesquisa</h3>
    <form action="UsuarioList.php" method="post">
        <div class="row align-items-end">
            <div class="col-md-2">
                <label for="tipo">Tipo</label>
                <select name="tipo" class="form-select">
                    <option value="nome">Nome</option>
                    <option value="telefone">Telefone</option>
                    <option value="email">Email</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="valor">Valor</label>
                <input type="text" name="valor" placeholder="Pesquisar..." class="form-control" value="<?php echo isset($_POST['valor']) ? $_POST['valor'] : ''; ?>">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Buscar</button>
                <?php if (!empty($_POST['valor'])): ?>
                    <a href="UsuarioList.php" class="btn btn-secondary">Limpar</a>
                <?php endif; ?>
            </div>
        </div>
    </form> </div> <div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Lista de Usuários</h3>
        <a href="./UsuarioForm.php" class="btn btn-success">Novo Usuário</a>
    </div>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($dados as $item): ?>
                <tr>
                    <td><?php echo $item->id; ?></td>
                    <td><?php echo $item->nome; ?></td>
                    <td><?php echo $item->telefone; ?></td>
                    <td><?php echo $item->email; ?></td>
                    <td><a href='./UsuarioForm.php?id=$item->id' 
                   class='btn btn-warning' title='Editar' >Editar</a>
                        <a class="btn btn-danger btn-sm" onclick="return confirm('Deseja realmente excluir?')" href="./UsuarioList.php?id=<?php echo $item->id; ?>">Deletar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            
            <?php if(empty($dados)): ?>
                <tr>
                    <td colspan="5" class="text-center text-muted">Nenhum usuário encontrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include '../footer.php'; ?>