<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ótica Vision - Sistema de Gestão</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            margin: 5px 0;
            border-radius: 8px;
            transition: all 0.3s;
        }
        .sidebar .nav-link:hover {
            background: rgba(255,255,255,0.1);
            color: white;
            transform: translateX(5px);
        }
        .sidebar .nav-link.active {
            background: rgba(255,255,255,0.2);
            color: white;
        }
        .sidebar .nav-link i {
            margin-right: 10px;
            width: 25px;
        }
        .main-content {
            background-color: #f8f9fa;
            min-height: 100vh;
        }
        .navbar-top {
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .card-dashboard {
            transition: transform 0.3s;
            cursor: pointer;
        }
        .card-dashboard:hover {
            transform: translateY(-5px);
        }
        .table-responsive {
            border-radius: 10px;
            overflow: hidden;
        }
        .btn-action {
            margin: 0 2px;
        }
    </style>
</head>
<?php

if(session_status() === PHP_SESSION_NONE){
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

// Verifica se usuário está logado para mostrar menu completo
$isLoggedIn = isset($_SESSION['usuario_id']);
?>

<body>
    <?php if($isLoggedIn): ?>
    <div class="container-fluid p-0">
        <div class="row g-0">
            <div class="col-auto sidebar p-0">
                <div class="p-3 text-center text-white border-bottom">
                    <h4><i class="fas fa-glasses"></i> Ótica Vision</h4>
                    <small><?php echo $_SESSION['usuario_nome']; ?></small>
                </div>
                <nav class="nav flex-column p-3">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>" href="/PWEB_1_TRABALHO/site/admin/index.php">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                    
                    <h6 class="text-white-50 mt-3 mb-2 px-3">CADASTROS</h6>
                    
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
                    
                    <h6 class="text-white-50 mt-3 mb-2 px-3">ESTOQUE</h6>
                    
                    <a class="nav-link <?php echo strpos($_SERVER['PHP_SELF'], 'Estoque') !== false ? 'active' : ''; ?>" href="/PWEB_1_TRABALHO/site/admin/estoque/EstoqueList.php">
                        <i class="fas fa-warehouse"></i> Consultar Estoque
                    </a>
                    
                    <a class="nav-link <?php echo strpos($_SERVER['PHP_SELF'], 'Movimentacao') !== false ? 'active' : ''; ?>" href="/PWEB_1_TRABALHO/site/admin/movimentacao_estoque/MovimentacaoList.php">
                        <i class="fas fa-exchange-alt"></i> Movimentações
                    </a>
                    
                    <hr class="bg-light">
                    
                    <a class="nav-link text-danger" href="/PWEB_1_TRABALHO/site/admin/logout.php">
                        <i class="fas fa-sign-out-alt"></i> Sair do Sistema
                    </a>
                </nav>
            </div>
            
            <div class="col main-content">
                <nav class="navbar-top p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-store"></i> Sistema de Gestão Ótica Vision
                        </h5>
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle"></i> <?php echo $_SESSION['usuario_nome']; ?>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-user"></i> Meu Perfil</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="/PWEB_1_TRABALHO/site/admin/logout.php"><i class="fas fa-sign-out-alt"></i> Sair</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
                
                <div class="p-4">
    <?php else: ?>
        <div class="container mt-5">
    <?php endif; ?>