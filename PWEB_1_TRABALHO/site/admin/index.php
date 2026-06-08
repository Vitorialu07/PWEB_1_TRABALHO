<?php
include 'header.php';
include_once "db.class.php";
include 'autenticacao.php'; // Verifica login

// Buscar dados para dashboard
$dbProduto = new db('produto');
$dbCliente = new db('cliente');
$dbFuncionario = new db('funcionario');
$dbMovimentacao = new db('movimentacao_estoque');

$totalProdutos = count($dbProduto->all());
$totalClientes = count($dbCliente->all());
$totalFuncionarios = count($dbFuncionario->all());

// Últimas movimentações
$ultimasMovimentacoes = $dbMovimentacao->all();
$ultimasMovimentacoes = array_slice($ultimasMovimentacoes, 0, 5);
?>
<div class="container mt-4">
    <h1 class="mb-4">Dashboard - Ótica Vision</h1>
    <p>Bem-vindo, <?php echo $_SESSION['usuario_nome']; ?>!</p>
    
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Produtos</h5>
                    <p class="card-text display-4"><?php echo $totalProdutos; ?></p>
                    <a href="produtos/ProdutoList.php" class="text-white">Ver detalhes →</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Clientes</h5>
                    <p class="card-text display-4"><?php echo $totalClientes; ?></p>
                    <a href="clientes/ClienteList.php" class="text-white">Ver detalhes →</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5 class="card-title">Funcionários</h5>
                    <p class="card-text display-4"><?php echo $totalFuncionarios; ?></p>
                    <a href="funcionarios/FuncionarioList.php" class="text-white">Ver detalhes →</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Últimas Movimentações de Estoque</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Produto</th>
                                <th>Tipo</th>
                                <th>Quantidade</th>
                                <th>Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($ultimasMovimentacoes as $mov): ?>
                            <tr>
                                <td><?php echo $mov->id; ?></td>
                                <td>
                                    <?php 
                                    $produto = $dbProduto->find($mov->id_produto);
                                    echo $produto ? $produto->nome : 'N/A';
                                    ?>
                                </td>
                                <td>
                                    <span class="badge bg-<?php echo $mov->tipo == 'Entrada' ? 'success' : 'danger'; ?>">
                                        <?php echo $mov->tipo; ?>
                                    </span>
                                </td>
                                <td><?php echo $mov->quantidade; ?></td>
                                <td><?php echo date('d/m/Y H:i', strtotime($mov->data_movimentacao ?? 'now')); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <a href="movimentacoes/MovimentacaoList.php" class="btn btn-primary">Ver todas</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>