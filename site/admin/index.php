<?php
require_once 'autenticacao.php';  
require_once 'header.php';   
include_once "db.class.php";


$dbUsuario = new db('usuario');
$dbCliente = new db('cliente');
$dbProduto = new db('produto');
$dbFuncionario = new db('funcionario');
$dbEstoque = new db('estoque');
$dbMovimentacao = new db('movimentacao_estoque');


$totalUsuarios = count($dbUsuario->all());
$totalClientes = count($dbCliente->all());
$totalProdutos = count($dbProduto->all());
$totalFuncionarios = count($dbFuncionario->all());


$ultimosClientes = array_slice($dbCliente->all(), -5);


$ultimosProdutos = array_slice($dbProduto->all(), -5);


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


$totalMovimentacoes = count($dbMovimentacao->all());
?>

<style>
    :root {
        --zeiss-blue: #005A9C;
        --zeiss-dark-blue: #002D62;
        --zeiss-gray-bg: #F4F6F9;
        --zeiss-text-main: #1C1F22;
        --zeiss-text-muted: #6C757D;
        --zeiss-border: #E2E8F0;
        --zeiss-success: #10B981;
        --zeiss-danger: #DF2020;
        --zeiss-warning: #F59E0B;
    }

    /* Ajustes globais da página */
    .zeiss-dashboard {
        background-color: var(--zeiss-gray-bg);
        font-family: "Segoe UI", -apple-system, BlinkMacSystemFont, Roboto, sans-serif;
        color: var(--zeiss-text-main);
        padding-top: 20px;
        padding-bottom: 40px;
    }

    /* Banner de Boas-Vindas Técnico */
    .zeiss-banner {
        background: #FFFFFF;
        border: 1px solid var(--zeiss-border);
        border-left: 5px solid var(--zeiss-blue);
        border-radius: 0px !important; /* Cantos retos corporativos */
        color: var(--zeiss-dark-blue);
        padding: 1.5rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    .zeiss-banner h4 {
        font-weight: 600;
        letter-spacing: -0.5px;
    }


    .card-zeiss {
        background: #FFFFFF;
        border: 1px solid var(--zeiss-border);
        border-radius: 0px !important;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        transition: all 0.2s ease-in-out;
    }
    .card-zeiss:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        border-color: var(--zeiss-blue);
    }
    .card-zeiss .card-title {
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        font-weight: 700;
        color: var(--zeiss-text-muted);
        margin-bottom: 0.25rem;
    }
    .card-zeiss .display-4 {
        font-size: 2.2rem;
        font-weight: 300;
        color: var(--zeiss-dark-blue);
        margin-bottom: 0.75rem;
    }
    .card-zeiss .zeiss-link {
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--zeiss-blue) !important;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .card-zeiss .zeiss-link:hover {
        color: var(--zeiss-dark-blue) !important;
        text-decoration: underline !important;
    }
    .card-zeiss .icon-accent {
        color: var(--zeiss-blue);
        opacity: 0.12;
    }

    /* Bordas superiores sutis para identificar os cards */
    .accent-u { border-top: 3px solid var(--zeiss-blue); }
    .accent-c { border-top: 3px solid var(--zeiss-success); }
    .accent-p { border-top: 3px solid #6366F1; }
    .accent-f { border-top: 3px solid var(--zeiss-warning); }

    /* Painéis e Tabelas Clínicas */
    .card {
        border-radius: 0px !important;
        border: 1px solid var(--zeiss-border);
        box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        background: #FFFFFF;
    }
    .card-header {
        background-color: #FFFFFF !important;
        border-bottom: 2px solid var(--zeiss-gray-bg) !important;
        padding: 1rem 1.25rem;
    }
    .card-header h5 {
        font-size: 1rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--zeiss-dark-blue);
        margin: 0;
    }

    /* Tabelas precisas e limpas */
    .table {
        margin-bottom: 0;
    }
    .table th {
        background-color: var(--zeiss-gray-bg);
        color: var(--zeiss-text-main);
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 1px solid var(--zeiss-border);
        padding: 12px 1rem;
    }
    .table td {
        padding: 12px 1rem;
        font-size: 0.9rem;
        vertical-align: middle;
        border-bottom: 1px solid #EDF2F7;
    }
    .table-hover tbody tr:hover {
        background-color: #F8FAFC;
    }

    /* Badges Técnicos */
    .badge {
        border-radius: 0px !important;
        font-weight: 600;
        padding: 0.4em 0.6em;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        font-size: 0.7rem;
    }
    .bg-zeiss-blue { background-color: var(--zeiss-blue) !important; }

    /* Botões Prismáticos da Zeiss */
    .btn {
        border-radius: 0px !important;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 0.5rem 1rem;
        transition: all 0.2s;
    }
    .btn-zeiss-action {
        background: transparent;
        border: 1px solid var(--zeiss-blue);
        color: var(--zeiss-blue);
    }
    .btn-zeiss-action:hover {
        background: var(--zeiss-blue);
        color: #FFFFFF;
    }
    .btn-outline-zeiss {
        border: 1px solid var(--zeiss-border);
        color: var(--zeiss-text-main);
        background: #FFFFFF;
    }
    .btn-outline-zeiss:hover {
        border-color: var(--zeiss-blue);
        color: var(--zeiss-blue);
        background: #F8FAFC;
    }
</style>

<div class="container-fluid zeiss-dashboard">
    <div class="zeiss-banner alert-dismissible fade show mb-4" role="alert">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="mb-1">
                    <i class="fas fa-desktop text-primary me-2"></i> Terminal de Controle: <?php echo $_SESSION['usuario_nome']; ?>
                </h4>
                <p class="mb-0 text-muted small">Data do Sistema: <?php echo date('d/m/Y H:i'); ?> — Módulos operacionais ativos.</p>
            </div>
            <div class="text-end text-muted opacity-50 d-none d-md-block">
                <i class="fas fa-clock fa-2x"></i>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card card-zeiss accent-u h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="card-title">Total Usuários</h6>
                            <p class="card-text display-4"><?php echo $totalUsuarios; ?></p>
                        </div>
                        <div class="icon-accent">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                    </div>
                    <a href="usuario/UsuarioList.php" class="zeiss-link text-decoration-none mt-2">
                        Acessar Registros <i class="fas fa-chevron-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="card card-zeiss accent-c h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="card-title">Total Clientes</h6>
                            <p class="card-text display-4"><?php echo $totalClientes; ?></p>
                        </div>
                        <div class="icon-accent">
                            <i class="fas fa-user-friends fa-2x"></i>
                        </div>
                    </div>
                    <a href="cliente/ClienteList.php" class="zeiss-link text-decoration-none mt-2">
                        Acessar Registros <i class="fas fa-chevron-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="card card-zeiss accent-p h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="card-title">Total Produtos</h6>
                            <p class="card-text display-4"><?php echo $totalProdutos; ?></p>
                        </div>
                        <div class="icon-accent">
                            <i class="fas fa-boxes fa-2x"></i>
                        </div>
                    </div>
                    <a href="produto/ProdutoList.php" class="zeiss-link text-decoration-none mt-2">
                        Acessar Registros <i class="fas fa-chevron-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="card card-zeiss accent-f h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="card-title">Total Funcionários</h6>
                            <p class="card-text display-4"><?php echo $totalFuncionarios; ?></p>
                        </div>
                        <div class="icon-accent">
                            <i class="fas fa-id-card fa-2x"></i>
                        </div>
                    </div>
                    <a href="funcionario/FuncionarioList.php" class="zeiss-link text-decoration-none mt-2">
                        Acessar Registros <i class="fas fa-chevron-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <?php if(count($estoqueBaixo) > 0): ?>
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card style-danger" style="border-top: 3px solid var(--zeiss-danger);">
                <div class="card-header bg-white d-flex align-items-center">
                    <h5 class="mb-0 text-danger" style="color: var(--zeiss-danger) !important;">
                        <i class="fas fa-exclamation-triangle me-2"></i> Relatório Crítico: Volume Mínimo de Estoque
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Produto</th>
                                    <th>Quantidade Atual</th>
                                    <th>Status Operacional</th>
                                    <th class="text-end">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($estoqueBaixo as $item): ?>
                                <tr>
                                    <td class="font-weight-600"><?php echo htmlspecialchars($item->produto); ?></td>
                                    <td>
                                        <span class="text-danger font-weight-600">
                                            <?php echo $item->quantidade; ?> unidades
                                        </span>
                                    </td>
                                    <td>
                                        <?php if($item->quantidade <= 0): ?>
                                            <span class="badge bg-dark">ESGOTADO</span>
                                        <?php elseif($item->quantidade <= 5): ?>
                                            <span class="badge bg-danger">CRÍTICO</span>
                                        <?php else: ?>
                                            <span class="badge bg-warning text-dark">BAIXO</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-end">
                                        <a href="movimentacao_estoque/MovimentacaoForm.php?id_produto=<?php echo $item->id_produto; ?>" 
                                           class="btn btn-sm btn-zeiss-action">
                                            <i class="fas fa-plus me-1"></i> Repor Unidades
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

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5><i class="fas fa-user-plus me-2 text-muted"></i>Últimos Clientes</h5>
                    <a href="cliente/ClienteForm.php" class="btn btn-sm btn-zeiss-action">
                        <i class="fas fa-plus me-1"></i> Incluir Cliente
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
                                    <th class="text-end">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(empty($ultimosClientes)): ?>
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">
                                            <i class="fas fa-info-circle me-1"></i> Base de dados vazia.
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach(array_reverse($ultimosClientes) as $cliente): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($cliente->nome); ?></td>
                                        <td class="text-muted"><?php echo htmlspecialchars($cliente->telefone); ?></td>
                                        <td><?php echo htmlspecialchars($cliente->cidade); ?></td>
                                        <td class="text-end">
                                            <a href="cliente/ClienteForm.php?id=<?php echo $cliente->id; ?>" 
                                               class="btn btn-sm btn-outline-zeiss p-1 px-2">
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
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5><i class="fas fa-box-open me-2 text-muted"></i>Últimos Produtos</h5>
                    <a href="produto/ProdutoForm.php" class="btn btn-sm btn-zeiss-action">
                        <i class="fas fa-plus me-1"></i> Incluir Produto
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
                                    <th class="text-end">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(empty($ultimosProdutos)): ?>
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">
                                            <i class="fas fa-info-circle me-1"></i> Base de dados vazia.
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach(array_reverse($ultimosProdutos) as $produto): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($produto->nome); ?></td>
                                        <td class="text-muted"><?php echo htmlspecialchars($produto->marca); ?></td>
                                        <td class="font-weight-600">R$ <?php echo number_format($produto->preco_venda, 2, ',', '.'); ?></td>
                                        <td class="text-end">
                                            <a href="produto/ProdutoForm.php?id=<?php echo $produto->id; ?>" 
                                               class="btn btn-sm btn-outline-zeiss p-1 px-2">
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

    <div class="row">
        <div class="col-md-8 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-bolt me-2 text-muted"></i>Ações Diretas</h5>
                </div>
                <div class="card-body">
                    <div class="row g-2">
                        <div class="col-md-4">
                            <a href="cliente/ClienteForm.php" class="btn btn-outline-zeiss w-100 text-start d-flex align-items-center justify-content-between">
                                <span><i class="fas fa-user-plus me-2 text-muted"></i> Novo Cliente</span>
                                <i class="fas fa-chevron-right opacity-50 small"></i>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="produto/ProdutoForm.php" class="btn btn-outline-zeiss w-100 text-start d-flex align-items-center justify-content-between">
                                <span><i class="fas fa-box me-2 text-muted"></i> Novo Produto</span>
                                <i class="fas fa-chevron-right opacity-50 small"></i>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="funcionario/FuncionarioForm.php" class="btn btn-outline-zeiss w-100 text-start d-flex align-items-center justify-content-between">
                                <span><i class="fas fa-user-tie me-2 text-muted"></i> Novo Funcionário</span>
                                <i class="fas fa-chevron-right opacity-50 small"></i>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="movimentacao_estoque/MovimentacaoForm.php" class="btn btn-outline-zeiss w-100 text-start d-flex align-items-center justify-content-between">
                                <span><i class="fas fa-exchange-alt me-2 text-muted"></i> Nova Movimentação</span>
                                <i class="fas fa-chevron-right opacity-50 small"></i>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="estoque/EstoqueList.php" class="btn btn-outline-zeiss w-100 text-start d-flex align-items-center justify-content-between">
                                <span><i class="fas fa-chart-line me-2 text-muted"></i> Relatório Estoque</span>
                                <i class="fas fa-chevron-right opacity-50 small"></i>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="usuario/UsuarioForm.php" class="btn btn-outline-zeiss w-100 text-start d-flex align-items-center justify-content-between">
                                <span><i class="fas fa-user-shield me-2 text-muted"></i> Novo Usuário</span>
                                <i class="fas fa-chevron-right opacity-50 small"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-info-circle me-2 text-muted"></i>Métricas Operacionais</h5>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-3 py-3">
                            <span class="text-muted"><i class="fas fa-code-branch me-2"></i> Versão Core</span>
                            <span class="badge bg-zeiss-blue">v2.0.0</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-3 py-3" style="border-top: 1px solid #EDF2F7;">
                            <span class="text-muted"><i class="fas fa-history me-2"></i> Volumetria de Cargas</span>
                            <span class="badge bg-secondary"><?php echo $totalMovimentacoes; ?> logs</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-3 py-3" style="border-top: 1px solid #EDF2F7;">
                            <span class="text-muted"><i class="fas fa-shield-alt me-2"></i> Integridade</span>
                            <span class="text-success small font-weight-600"><i class="fas fa-check-circle me-1"></i> ONLINE</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>