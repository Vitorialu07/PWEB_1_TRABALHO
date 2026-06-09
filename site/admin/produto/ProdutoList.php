<?php
include '../header.php';
include '../autenticacao.php';
include_once "../db.class.php";

$db = new db('produto');

if (!empty($_GET['id'])) {
    $db->destroy($_GET['id']);
    header("Location: ProdutoList.php");
    exit;
}

if (!empty($_POST)) {
    $dados = $db->search($_POST);
} else {
    $dados = $db->all();
}
?>
<div class="row mb-4">
    <div class="row">
        <form action="ProdutoList.php" method="post">
            <div class="row align-items-end">
                <h3> Listagem de Produtos</h3>
                <div class="col-2">
                    <label for="tipo" class="form-label">Tipo</label>
                    <select name="tipo" class="form-select">
                        <option value="nome">Nome</option>
                        <option value="descrição">Descrição</option> <!-- CORRIGIDO -->
                        <option value="marca">Marca</option>
                        <option value="preco_custo">Preço de custo</option>
                        <option value="preco_venda">Preço de venda</option>
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
                    <th scope="col">Descrição</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Preço Custo</th>
                    <th scope="col">Preço Venda</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($dados)): ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            <i class="fas fa-info-circle"></i> Nenhum produto encontrado
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($dados as $item): ?>
                    <tr>
                        <th scope="row"><?php echo $item->id; ?></th>
                        <td><?php echo htmlspecialchars($item->nome); ?></td>
                        <td><?php echo htmlspecialchars($item->descrição); ?></td> <!-- CORRIGIDO -->
                        <td><?php echo htmlspecialchars($item->marca); ?></td>
                        <td>R$ <?php echo number_format($item->preco_custo, 2, ',', '.'); ?></td>
                        <td>R$ <?php echo number_format($item->preco_venda, 2, ',', '.'); ?></td>
                        <td>
                            <a href="./ProdutoForm.php?id=<?php echo $item->id; ?>" 
                               class="btn btn-sm btn-warning" title="Editar">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <a href="./ProdutoList.php?id=<?php echo $item->id; ?>" 
                               class="btn btn-sm btn-danger" title="Excluir" 
                               onclick="return confirm('Deseja realmente excluir este produto?')">
                                <i class="fas fa-trash"></i> Excluir
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../footer.php'; ?>