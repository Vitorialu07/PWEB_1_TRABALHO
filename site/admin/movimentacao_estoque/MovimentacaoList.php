<?php

include_once "../db.class.php";
include '../header.php';
include '../autenticacao.php';

$db = new db('movimentacao_estoque');
$dbProduto = new db('produto');
$dbFuncionario = new db('funcionario');

if (!empty($_POST)) {
    $dados = $db->search($_POST);
} else {
    $dados = $db->all();
}
?>

<div class="container mt-4">
    <div class="row">
        <div class="row">
            <form action="MovimentacaoList.php" method="post">
                <div class="row">
                    <h3> Histórico de Movimentações de Estoque</h3>
                    <div class="col-2">
                        <label for="tipo">Tipo de Busca</label>
                        <select name="tipo" class="form-select">
                            <option value="id_produto">Produto</option>
                            <option value="id_funcionario">Funcionário</option>
                            <option value="tipo">Tipo (Entrada/Saída)</option>
                        </select>
                    </div>
                    <div class="col-5">
                        <label for="valor">Valor</label>
                        <input type="text" name="valor" placeholder="Pesquisar..." class="form-control" value="">
                    </div>
                    <div class="col-5">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i> Buscar
                        </button>
                        <a href="./MovimentacaoForm.php" class="btn btn-success">
                            <i class="fas fa-plus"></i> Nova Movimentação
                        </a>
                        <?php if (!empty($_POST['valor'])): ?>
                            <a href="MovimentacaoList.php" class="btn btn-secondary">
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
                        <th scope="col">ID</th>
                        <th scope="col">Produto</th>
                        <th scope="col">Funcionário</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Quantidade</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($dados)): ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                Nenhuma movimentação encontrada
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($dados as $item): ?>
                            <?php 
                                $produto = $dbProduto->find($item->id_produto);
                                $funcionario = $dbFuncionario->find($item->id_funcionario);
                                $nomeProduto = $produto ? $produto->nome : "Produto não encontrado";
                                $nomeFuncionario = $funcionario ? $funcionario->nome : "Funcionário não encontrado";
                            ?>
                            <tr>
                                <th scope="row"><?php echo $item->id; ?></th>
                                <td><?php echo htmlspecialchars($nomeProduto); ?></td>
                                <td><?php echo htmlspecialchars($nomeFuncionario); ?></td>
                                <td>
                                    <?php if($item->tipo == 'Entrada'): ?>
                                        <span class="badge bg-success">
                                            <i class="fas fa-arrow-down"></i> ENTRADA
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">
                                            <i class="fas fa-arrow-up"></i> SAÍDA
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($item->tipo == 'Entrada'): ?>
                                        <strong class="text-success">+ <?php echo $item->quantidade; ?></strong>
                                    <?php else: ?>
                                        <strong class="text-danger">- <?php echo $item->quantidade; ?></strong>
                                    <?php endif; ?>
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
                <strong>Informação:</strong> Movimentações de estoque NÃO podem ser excluídas ou editadas para manter o histórico fiscal e auditoria. 
                Se necessário, registre uma nova movimentação de ajuste.
            </div>
        </div>
    </div>
</div>

<?php
include '../footer.php';
?>