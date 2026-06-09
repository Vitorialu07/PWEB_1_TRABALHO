<?php
// ==========================================
// 1. TODO O BLOCO PHP DEVE FICAR NO TOPO ABSOLUTO
// ==========================================
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function redirect($page, $time=1500){
    echo "
    <script>
        setTimeout(() => window.location.href ='$page', $time);
    </script>";
}

function actionMessage($success = "", $error = ""){
    if(!empty($success)){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                <i class='fas fa-check-circle'></i> <strong>Sucesso!</strong> $success
                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
              </div>";
    }   
    if(!empty($error)){
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <i class='fas fa-exclamation-triangle'></i> <strong>Erro!</strong> $error
                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
              </div>";
    }
}

function showValidationError($errors=[]){
    if(!empty($errors)){
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong><i class='fas fa-info-circle'></i> Erros nos campos:</strong>
                <ul>";
        foreach ($errors as $error){
            echo $error;
        }
        echo "</ul>
        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
      </div>";
    }
}

function getFormValue($data, $field=''){
    return isset($data->$field) ? htmlspecialchars($data->$field) : '';
}

$isLoggedIn = isset($_SESSION['usuario_id']);
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ótica Vision - Sistema de Gestão</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        :root {
            --glass-bg: rgba(255, 255, 255, 0.08);
            --glass-hover: rgba(255, 255, 255, 0.18);
            --gradient-sidebar: linear-gradient(135deg, #0b0b36 0%, #141475 50%, #1a5d89 100%);
            --gradient-active: linear-gradient(90deg, #639cf1 0%, #55a3f7 100%);
            --glow-shadow: 0 8px 25px rgba(94, 58, 237, 0.25);
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
            --text-dark: #1e293b;
            --text-muted: #64748b;
        }

        body {
            font-family: 'Poppins', 'Segoe UI', system-ui, sans-serif;
            background-color: #f3f4f6;
        }

        .sidebar {
            min-height: 100vh;
            background: var(--gradient-sidebar);
            box-shadow: 6px 0 30px rgba(0, 0, 0, 0.25);
            position: relative;
            z-index: 10;
        }
        
        .sidebar-brand {
            background: rgba(0, 0, 0, 0.15);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding: 25px 15px;
        }

        .sidebar-brand h4 {
            font-weight: 700;
            letter-spacing: 0.5px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .sidebar-heading {
            font-size: 0.75rem;
            font-weight: 800;
            letter-spacing: 1.5px;
            color: #8484fc !important;
            margin-top: 25px;
            margin-bottom: 10px;
            padding-left: 15px;
            text-shadow: 0 1px 2px rgba(0,0,0,0.2);
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.75);
            padding: 14px 20px;
            margin: 4px 12px;
            border-radius: 12px;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
        }

        .sidebar .nav-link:hover {
            background: var(--glass-hover);
            color: #ffffff;
            transform: translateX(8px);
            box-shadow: -4px 4px 15px rgba(0, 0, 0, 0.2);
        }

        .sidebar .nav-link.active {
            background: var(--gradient-active);
            color: white !important;
            font-weight: 600;
            box-shadow: var(--glow-shadow);
            border-left: 5px solid #e9d5ff;
            transform: scale(1.02) translateX(4px);
        }

        .sidebar .nav-link i {
            margin-right: 12px;
            width: 28px;
            font-size: 1.1rem;
            text-align: center;
            transition: transform 0.3s;
        }

        .sidebar .nav-link:hover i {
            transform: scale(1.2);
        }

        .sidebar hr {
            opacity: 0.15;
            margin: 20px 12px;
            border-top: 2px solid #fff;
        }

        .main-content {
            background: #f8fafc;
            min-height: 100vh;
        }

        .navbar-top {
            background: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            padding: 18px 30px !important;
        }

        .navbar-top h5 {
            color: var(--text-dark);
            font-weight: 700;
            font-size: 1.2rem;
        }

        .navbar-top .btn-outline-secondary {
            border: 2px solid #e2e8f0;
            background: #f8fafc;
            color: var(--text-dark);
            font-weight: 600;
            border-radius: 12px;
            padding: 8px 16px;
            transition: all 0.3s;
        }

        .navbar-top .btn-outline-secondary:hover {
            border-color: #5575f7;
            background: #f3e8ff;
            color: #2133a8;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            border-radius: 12px;
            overflow: hidden;
            padding: 0;
        }

        .dropdown-item {
            padding: 12px 20px;
            font-weight: 500;
            color: var(--text-dark);
        }

        .dropdown-item:hover {
            background-color: #f3e8ff;
            color: #3721a8;
        }

        .nav-link.text-danger {
            background: rgba(239, 68, 68, 0.1);
            color: #f87171 !important;
            margin-top: 15px;
        }

        .nav-link.text-danger:hover {
            background: #ef4444 !important;
            color: white !important;
            box-shadow: 0 8px 20px rgba(239, 68, 68, 0.3);
        }

        .alert {
            border: none;
            border-radius: 16px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.05);
            padding: 16px 24px;
        }
        .alert-success { background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%); color: #14532d; border-left: 6px solid #22c55e; }
        .alert-danger { background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); color: #7f1d1d; border-left: 6px solid #ef4444; }
        .alert-warning { background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); color: #78350f; border-left: 6px solid #f59e0b; }
    </style>
</head>

<body>
    <?php if($isLoggedIn): ?>
    <div class="container-fluid p-0">
        <div class="row g-0">
            <div class="col-auto sidebar p-0">
                <div class="sidebar-brand text-center text-white">
                    <h4><i class="fas fa-glasses me-2"></i> Ótica Vision</h4>
                    <span class="badge bg-light text-dark px-3 py-2 mt-2 rounded-pill fw-bold">
                        <i class="fas fa-user text-purple me-1"></i> <?php echo $_SESSION['usuario_nome']; ?>
                    </span>
                </div>
                <nav class="nav flex-column p-2">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>" href="/PWEB_1_TRABALHO/site/admin/index.php">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                    
                    <h6 class="sidebar-heading">CADASTROS</h6>
                    
                    <a class="nav-link <?php echo strpos($_SERVER['PHP_SELF'], 'Cliente') !== false ? 'active' : ''; ?>" href="/PWEB_1_TRABALHO/site/admin/cliente/ClienteList.php">
                        <i class="fas fa-users"></i> Clientes
                    </a>
                    
                    <a class="nav-link <?php echo strpos($_SERVER['PHP_SELF'], 'Produto') !== false ? 'active' : ''; ?>" href="/PWEB_1_TRABALHO/site/admin/produto/ProdutoList.php">
                        <i class="fas fa-boxes"></i> Produtos
                    </a>
                    
                    <a class="nav-link <?php echo strpos($_SERVER['PHP_SELF'], 'Funcionario') !== false ? 'active' : ''; ?>" href="/PWEB_1_TRABALHO/site/admin/funcionario/FuncionarioList.php">
                        <i class="fas fa-id-badge"></i> Funcionários
                    </a>
                    
                    <a class="nav-link <?php echo strpos($_SERVER['PHP_SELF'], 'Usuario') !== false ? 'active' : ''; ?>" href="/PWEB_1_TRABALHO/site/admin/usuario/UsuarioList.php">
                        <i class="fas fa-user-cog"></i> Usuários
                    </a>
                    
                    <h6 class="sidebar-heading">ESTOQUE</h6>
                    
                    <a class="nav-link <?php echo strpos($_SERVER['PHP_SELF'], 'Estoque') !== false ? 'active' : ''; ?>" href="/PWEB_1_TRABALHO/site/admin/estoque/EstoqueList.php">
                        <i class="fas fa-warehouse"></i> Consultar Estoque
                    </a>
                    
                    <a class="nav-link <?php echo strpos($_SERVER['PHP_SELF'], 'Movimentacao') !== false ? 'active' : ''; ?>" href="/PWEB_1_TRABALHO/site/admin/movimentacao_estoque/MovimentacaoList.php">
                        <i class="fas fa-exchange-alt"></i> Movimentações
                    </a>
                    
                    <hr>
                    
                    <a class="nav-link text-danger" href="/PWEB_1_TRABALHO/site/admin/logout.php">
                        <i class="fas fa-sign-out-alt"></i> Sair do Sistema
                    </a>
                </nav>
            </div>
            
            <div class="col main-content">
                <nav class="navbar-top p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-store text-primary me-2"></i> Sistema de Gestão Ótica Vision
                        </h5>
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle fs-5 text-purple"></i> <?php echo $_SESSION['usuario_nome']; ?>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2 text-primary"></i> Meu Perfil</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="/PWEB_1_TRABALHO/site/admin/logout.php"><i class="fas fa-sign-out-alt me-2"></i> Sair</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
                
                <div class="p-4">
    <?php else: ?>
        <div class="container mt-5">
    <?php endif; ?>