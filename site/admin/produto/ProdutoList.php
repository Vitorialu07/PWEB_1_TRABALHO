<?php

session_start(); 
include_once "../db.class.php";

$db = new db('produto');
$erro_exclusao = '';
$mensagem_sucesso = '';


$mostrarInativos = isset($_GET['mostrar_inativos']) && $_GET['mostrar_inativos'] == '1';


if (!empty($_GET['id'])) {
    try {
        $db->softDelete($_GET['id']); 
        $_SESSION['success'] = "Produto desativado com sucesso!";
        header("Location: ProdutoList.php" . ($mostrarInativos ? "?mostrar_inativos=1" : ""));
        exit;
    } catch (Exception $e) {
        $erro_exclusao = "Não é possível desativar este produto pois ele possui movimentações de estoque!";
    }
}

// Buscar dados
if (!empty($_POST)) {
    $dados = $db->search($_POST, $mostrarInativos);
} else {
    $dados = $db->all($mostrarInativos);
}


if (isset($_SESSION['success'])) {
    $mensagem_sucesso = $_SESSION['success'];
    unset($_SESSION['success']);
}
if (isset($_SESSION['error'])) {
    $erro_exclusao = $_SESSION['error'];
    unset($_SESSION['error']);
}


include '../header.php';
include '../autenticacao.php';
?>

<div class="container mt-4">
    <?php if(!empty($mensagem_sucesso)): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $mensagem_sucesso; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if(!empty($erro_exclusao)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $erro_exclusao; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="row mb-4">
        <div class="row">
            <form action="ProdutoList.php<?php echo $mostrarInativos ? '?mostrar_inativos=1' : ''; ?>" method="post">
                <div class="row align-items-end">
                    <h3> Listagem de Produtos</h3>
                    <div class="col-2">
                        <label for="tipo" class="form-label">Tipo</label>
                        <select name="tipo" class="form-select">
                            <option value="nome">Nome</option>
                            <option value="descricao">Descricao</option>
                            <option value="marca">Marca</option>
                            <option value="preco_custo">Preco de custo</option>
                            <option value="preco_venda">Preco de venda</option>
                        </select>
                    </div>
                    <div class="col-5">
                        <label for="valor" class="form-label">Valor</label>
                        <input type="text" name="valor" id="valor" placeholder="Pesquisar..." class="form-control">
                    </div>
                    <div class="col-5">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i> Buscar
                        </button>
                        <a href="./ProdutoForm.php" class="btn btn-success">
                            <i class="fas fa-plus"></i> Novo Produto
                        </a>
                        <a href="?mostrar_inativos=<?php echo $mostrarInativos ? '0' : '1'; ?>" 
                           class="btn btn-info">
                            <?php echo $mostrarInativos ? 'Ocultar Inativos' : 'Mostrar Inativos'; ?>
                        </a>
                        <?php if (!empty($_POST['valor'])): ?>
                            <a href="ProdutoList.php" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Limpar
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Descricao</th>
                        <th scope="col">Marca</th>
                        <th scope="col">Preco Custo</th>
                        <th scope="col">Preco Venda</th>
                        <th scope="col">Situação</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($dados)): ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                Nenhum produto encontrado
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($dados as $item): ?>
                        <tr>
                            <th scope="row"><?php echo $item->id; ?></th>
                            <td><?php echo htmlspecialchars($item->nome); ?></td>
                            <td><?php echo htmlspecialchars($item->descricao ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($item->marca); ?></td>
                            <td>R$ <?php echo number_format($item->preco_custo, 2, ',', '.'); ?></td>
                            <td>R$ <?php echo number_format($item->preco_venda, 2, ',', '.'); ?></td>
                            <td>
                                <?php if(isset($item->ativo) && $item->ativo == 0): ?>
                                    <span class="badge bg-danger">Inativo</span>
                                <?php else: ?>
                                    <span class="badge bg-success">Ativo</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="./ProdutoForm.php?id=<?php echo $item->id; ?>" 
                                   class="btn btn-sm btn-warning" title="Editar">
                                    Editar
                                </a>
                                
                                <?php if(isset($item->ativo) && $item->ativo == 0): ?>
                                    <a href="./ProdutoRestore.php?id=<?php echo $item->id; ?>" 
                                       class="btn btn-sm btn-success"
                                       onclick="return confirm('Deseja reativar este produto?')">
                                        Reativar
                                    </a>
                                <?php else: ?>
                                    <a href="./ProdutoList.php?id=<?php echo $item->id; ?><?php echo $mostrarInativos ? '&mostrar_inativos=1' : ''; ?>" 
                                       class="btn btn-sm btn-danger" 
                                       onclick="return confirm('Desativar este produto? O histórico será mantido.')">
                                        Desativar
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../footer.php'; ?>