<?php
include 'header.php';
include_once "db.class.php";
include 'autenticacao.php';

// Instanciar as classes necessárias
$dbUsuario = new db('usuario');
$dbCliente = new db('cliente');
$dbProduto = new db('produto');
$dbFuncionario = new db('funcionario');
$dbEstoque = new db('estoque');
$dbMovimentacao = new db('movimentacao_estoque');

// Contadores para o dashboard
$totalUsuarios = count($dbUsuario->all());
$totalClientes = count($dbCliente->all());
$totalProdutos = count($dbProduto->all());
$totalFuncionarios = count($dbFuncionario->all());

// Últimos clientes cadastrados
$ultimosClientes = array_slice($dbCliente->all(), -5);

// Últimos produtos cadastrados
$ultimosProdutos = array_slice($dbProduto->all(), -5);

// Produtos com estoque baixo (menos de 10 unidades)
$estoqueBaixo = [];
$todosEstoques = $dbEstoque->all();
foreach($todosEstoques as $item) {
    if($item->quantidade < 10) {
        $produto = $dbProduto->find($item->id_produto);
        if($produto) {
            $estoqueBaixo[] = (object)[
                'produto' => $produto->nome,
                'quantidade' => $item->quantidade,
                'id_produto' => $item->id_produto
            ];
        }
    }
}

// Total de movimentações
$totalMovimentacoes = count($dbMovimentacao->all());
?>

<div class="container-fluid">
    <!-- Welcome Banner -->
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="alert-heading mb-1">
                    <i class="fas fa-smile-wink"></i> Bem-vindo(a), <?php echo $_SESSION['usuario_nome']; ?>!
                </h4>
                <p class="mb-0">Hoje é <?php echo date('d/m/Y H:i'); ?> - Gerencie seu negócio de forma eficiente</p>
            </div>
            <div class="text-end">
                <i class="fas fa-calendar-alt fa-2x"></i>
            </div>
        </div>
    </div>

    <!-- Cards Dashboard -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card card-dashboard bg-primary text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Total Usuários</h6>
                            <p class="card-text display-4"><?php echo $totalUsuarios; ?></p>
                            <a href="usuario/UsuarioList.php" class="text-white text-decoration-none">
                                Ver detalhes <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                        <div>
                            <i class="fas fa-users fa-3x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="card card-dashboard bg-success text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Total Clientes</h6>
                            <p class="card-text display-4"><?php echo $totalClientes; ?></p>
                            <a href="cliente/ClienteList.php" class="text-white text-decoration-none">
                                Ver detalhes <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                        <div>
                            <i class="fas fa-user-friends fa-3x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="card card-dashboard bg-info text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Total Produtos</h6>
                            <p class="card-text display-4"><?php echo $totalProdutos; ?></p>
                            <a href="produto/ProdutoList.php" class="text-white text-decoration-none">
                                Ver detalhes <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                        <div>
                            <i class="fas fa-boxes fa-3x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="card card-dashboard bg-warning text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Total Funcionários</h6>
                            <p class="card-text display-4"><?php echo $totalFuncionarios; ?></p>
                            <a href="funcionario/FuncionarioList.php" class="text-white text-decoration-none">
                                Ver detalhes <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                        <div>
                            <i class="fas fa-id-card fa-3x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alertas e Estoque Baixo -->
    <?php if(count($estoqueBaixo) > 0): ?>
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card border-danger">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-exclamation-triangle"></i> Alerta: Produtos com Estoque Baixo
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Produto</th>
                                    <th>Quantidade Atual</th>
                                    <th>Status</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($estoqueBaixo as $item): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($item->produto); ?></td>
                                    <td>
                                        <span class="badge bg-danger fs-6">
                                            <?php echo $item->quantidade; ?> unidades
                                        </span>
                                    </td>
                                    <td>
                                        <?php if($item->quantidade <= 0): ?>
                                            <span class="badge bg-dark">ESGOTADO</span>
                                        <?php elseif($item->quantidade <= 5): ?>
                                            <span class="badge bg-danger">CRÍTICO</span>
                                        <?php else: ?>
                                            <span class="badge bg-warning">BAIXO</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="movimentacao_estoque/MovimentacaoForm.php?id_produto=<?php echo $item->id_produto; ?>" 
                                           class="btn btn-sm btn-warning">
                                            <i class="fas fa-plus"></i> Repor Estoque
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Últimos Registros -->
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-user-plus"></i> Últimos Clientes</h5>
                    <a href="cliente/ClienteForm.php" class="btn btn-sm btn-light">
                        <i class="fas fa-plus"></i> Novo Cliente
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Telefone</th>
                                    <th>Cidade</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(empty($ultimosClientes)): ?>
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">
                                            <i class="fas fa-info-circle"></i> Nenhum cliente cadastrado
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach(array_reverse($ultimosClientes) as $cliente): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($cliente->nome); ?></td>
                                        <td><?php echo htmlspecialchars($cliente->telefone); ?></td>
                                        <td><?php echo htmlspecialchars($cliente->cidade); ?></td>
                                        <td>
                                            <a href="cliente/ClienteForm.php?id=<?php echo $cliente->id; ?>" 
                                               class="btn btn-sm btn-warning btn-action">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-box-open"></i> Últimos Produtos</h5>
                    <a href="produto/ProdutoForm.php" class="btn btn-sm btn-light">
                        <i class="fas fa-plus"></i> Novo Produto
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Produto</th>
                                    <th>Marca</th>
                                    <th>Preço Venda</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(empty($ultimosProdutos)): ?>
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">
                                            <i class="fas fa-info-circle"></i> Nenhum produto cadastrado
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach(array_reverse($ultimosProdutos) as $produto): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($produto->nome); ?></td>
                                        <td><?php echo htmlspecialchars($produto->marca); ?></td>
                                        <td>R$ <?php echo number_format($produto->preco_venda, 2, ',', '.'); ?></td>
                                        <td>
                                            <a href="produto/ProdutoForm.php?id=<?php echo $produto->id; ?>" 
                                               class="btn btn-sm btn-warning btn-action">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Ações Rápidas e Informações do Sistema -->
    <div class="row">
        <div class="col-md-8 mb-4">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0"><i class="fas fa-bolt"></i> Ações Rápidas</h5>
                </div>
                <div class="card-body">
                    <div class="row g-2">
                        <div class="col-md-4">
                            <a href="cliente/ClienteForm.php" class="btn btn-outline-primary w-100 text-start">
                                <i class="fas fa-user-plus"></i> Novo Cliente
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="produto/ProdutoForm.php" class="btn btn-outline-success w-100 text-start">
                                <i class="fas fa-box"></i> Novo Produto
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="funcionario/FuncionarioForm.php" class="btn btn-outline-info w-100 text-start">
                                <i class="fas fa-user-tie"></i> Novo Funcionário
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="movimentacao_estoque/MovimentacaoForm.php" class="btn btn-outline-warning w-100 text-start">
                                <i class="fas fa-exchange-alt"></i> Nova Movimentação
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="estoque/EstoqueList.php" class="btn btn-outline-danger w-100 text-start">
                                <i class="fas fa-chart-line"></i> Relatório Estoque
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="usuario/UsuarioForm.php" class="btn btn-outline-dark w-100 text-start">
                                <i class="fas fa-user-shield"></i> Novo Usuário
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0"><i class="fas fa-chart-pie"></i> Informações</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <i class="fas fa-database"></i> Versão do Sistema
                            <span class="badge bg-primary rounded-pill">2.0</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <i class="fas fa-chart-line"></i> Movimentações Totais
                            <span class="badge bg-info rounded-pill"><?php echo $totalMovimentacoes; ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <i class="fas fa-clock"></i> Último Acesso
                            <span class="badge bg-secondary rounded-pill"><?php echo date('d/m/Y H:i'); ?></span>
                        </li>
                        <li class="list-group-item">
                            <i class="fas fa-shield-alt"></i> Status do Sistema
                            <span class="badge bg-success float-end">Online</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>