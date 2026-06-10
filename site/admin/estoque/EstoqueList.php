<?php
include_once "../db.class.php";
include '../header.php';
include '../autenticacao.php';

$db = new db('estoque');
$dbProduto = new db('produto');

if (!empty($_POST)) {
    $dados = $db->search($_POST);
} else {
    $dados = $db->all();
}
?>

<div class="container mt-4">
    <div class="row">
        <div class="row">
            <form action="EstoqueList.php" method="post">
                <div class="row">
                    <h3> Listagem de Estoque</h3>
                    <div class="col-2">
                        <label for="nome">Tipo</label>
                        <select name="tipo" class="form-select">
                            <option value="id_produto">Produto</option>
                            <option value="quantidade">Quantidade</option>
                        </select>
                    </div>
                    <div class="col-5">
                        <label for="Pesquisa">Valor</label>
                        <input type="text" name="valor" placeholder="Pesquisar..." class="form-control" value="">
                    </div>
                    <div class="col-5">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i> Buscar
                        </button>
                        <a href="./EstoqueForm.php" class="btn btn-success">
                            <i class="fas fa-plus"></i> Novo
                        </a>
                        <?php if (!empty($_POST['valor'])): ?>
                            <a href="EstoqueList.php" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Limpar
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row mt-4">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Produto</th>
                        <th scope="col">Quantidade</th>
                        <th scope="col">Status</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($dados)): ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                Nenhum registro de estoque encontrado
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($dados as $item): ?>
                            <?php 
                                $produto = $dbProduto->find($item->id_produto);
                                $nomeProduto = $produto ? $produto->nome : "Produto não encontrado (ID: $item->id_produto)";
                            ?>
                            <tr>
                                <th scope="row"><?php echo $item->id; ?></th>
                                <td><?php echo htmlspecialchars($nomeProduto); ?></td>
                                <td>
                                    <?php if($item->quantidade <= 0): ?>
                                        <strong class="text-danger"><?php echo $item->quantidade; ?></strong>
                                    <?php else: ?>
                                        <?php echo $item->quantidade; ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($item->quantidade <= 0): ?>
                                        <span class="badge bg-danger">
                                            <i class="fas fa-times-circle"></i> SEM ESTOQUE
                                        </span>
                                    <?php elseif($item->quantidade <= 5): ?>
                                        <span class="badge bg-warning text-dark">
                                            <i class="fas fa-exclamation-triangle"></i> ESTOQUE BAIXO
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-success">
                                            <i class="fas fa-check-circle"></i> DISPONÍVEL
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href='./EstoqueForm.php?id=<?php echo $item->id; ?>' class='btn btn-warning btn-sm' title='Editar'>
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="row mt-3">
        <div class="col-12">
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> 
                <strong>Informação:</strong> Para dar baixa no estoque, utilize o botão <strong>Editar</strong> e altere a quantidade. 
                Coloque <strong>0 (zero)</strong> quando o produto estiver sem estoque.
            </div>
        </div>
    </div>
</div>

<?php
include '../footer.php';
?>