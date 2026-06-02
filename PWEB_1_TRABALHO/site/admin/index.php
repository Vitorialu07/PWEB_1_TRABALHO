<?php
// 1. INCLUSÃO DO CABEÇALHO (Carrega o Bootstrap, FontAwesome e o Menu)
include_once './header.php';
//http://localhost/PWEB_1_TRABALHO/site/admin/index.php

// 2. SEU BANCO DE DADOS (Comentado para não inserir dados repetidos a cada refresh de página)
/*
include_once './db.class.php';
$conn = new db("usuario");
$dados = [
  'nome'     => "julia",
  'telefone' => "49998332064",
  'email'    => "vi@gmail.com",
];
$conn->store($dados);
echo "<div class='alert alert-info'>Teste: Inserido com sucesso!</div>";
*/

// Fechamos a tag PHP aqui para o HTML abaixo funcionar perfeitamente
?>

<div class="col-12 mb-5">
    <div class="p-5 bg-dark text-white rounded-3 shadow text-center text-md-start position-relative overflow-hidden" 
         style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); border-left: 6px solid #ffc107;">
        <div class="row align-items-center">
            <div class="col-md-9">
                <h1 class="display-4 fw-bold mb-2 text-warning">
                    <i class="fa-solid fa-glasses me-2"></i> Ótica Visão • Admin
                </h1>
                <p class="fs-5 text-light opacity-75 mb-0">
                    Painel Central de Controlo Interno.
                </p>
            </div>
            <div class="col-md-3 text-center d-none d-md-block text-warning opacity-25">
                <i class="fa-solid fa-eye fa-8x"></i>
            </div>
        </div>
    </div>
</div>

<div class="col-12 mb-4">
    <h3 class="fw-bold text-secondary text-uppercase fs-5 border-bottom pb-2">
        <i class="fa-solid fa-sliders me-2 text-primary"></i> Módulos Administrativos (CRUDs)
    </h3>
</div>

<div class="col-md-6 col-lg-4 mb-4">
    <div class="card h-100 shadow-sm border-0 card-otica">
        <div class="card-body d-flex flex-column p-4">
            <div class="d-flex align-items-center mb-3">
                <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-3 me-3">
                    <i class="fa-solid fa-glasses fa-2x"></i>
                </div>
                <h5 class="card-title mb-0 fw-bold text-dark">Produtos e Estoque</h5>
            </div>
            <p class="card-text text-muted flex-grow-1 fs-6">
                Controle o inventário de armações premium, óculos de sol, lentes de visão simples ou progressivas. Monitorize preços de custo, venda e quantidades disponíveis.
            </p>
            <a href="./produto/ProdutoList.php" class="btn btn-primary w-100 fw-bold mt-3 py-2 shadow-sm">
                <i class="fa-solid fa-boxes-stacked me-2"></i> Ver Catálogo
            </a>
        </div>
    </div>
</div>

<div class="col-md-6 col-lg-4 mb-4">
    <div class="card h-100 shadow-sm border-0 card-otica">
        <div class="card-body d-flex flex-column p-4">
            <div class="d-flex align-items-center mb-3">
                <div class="bg-success bg-opacity-10 text-success p-3 rounded-3 me-3">
                    <i class="fa-solid fa-user-check fa-2x"></i>
                </div>
                <h5 class="card-title mb-0 fw-bold text-dark">Carteira de Clientes</h5>
            </div>
            <p class="card-text text-muted flex-grow-1 fs-6">
                Faça a gestão dos clientes da ótica. Registe dados de contacto, moradas, CPF para pessoas físicas ou dados de CNPJ/Razão Social para convénios corporativos.
            </p>
            <a href="./cliente/ClienteList.php" class="btn btn-success w-100 fw-bold mt-3 py-2 shadow-sm">
                <i class="fa-solid fa-users me-2"></i> Gerir Clientes
            </a>
        </div>
    </div>
</div>

<div class="col-md-6 col-lg-4 mb-4">
    <div class="card h-100 shadow-sm border-0 card-otica">
        <div class="card-body d-flex flex-column p-4">
            <div class="d-flex align-items-center mb-3">
                <div class="bg-info bg-opacity-10 text-info p-3 rounded-3 me-3">
                    <i class="fa-solid fa-id-card fa-2x text-info"></i>
                </div>
                <h5 class="card-title mb-0 fw-bold text-dark">Equipa Técnica</h5>
            </div>
            <p class="card-text text-muted flex-grow-1 fs-6">
                Registe e consulte o quadro de colaboradores, técnicos de laboratório e optometristas. Controle datas de admissão, funções internas e status de atividade.
            </p>
            <a href="./funcionario/FuncionarioList.php" class="btn btn-info text-white w-100 fw-bold mt-3 py-2 shadow-sm">
                <i class="fa-solid fa-user-tie me-2"></i> Ver Funcionários
            </a>
        </div>
    </div>
</div>

<div class="col-md-6 col-lg-4 mb-4">
    <div class="card h-100 shadow-sm border-0 card-otica">
        <div class="card-body d-flex flex-column p-4">
            <div class="d-flex align-items-center mb-3">
                <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-3 me-3">
                    <i class="fa-solid fa-user-gear fa-2x text-warning-emphasis"></i>
                </div>
                <h5 class="card-title mb-0 fw-bold text-dark">Utilizadores Admin</h5>
            </div>
            <p class="card-text text-muted flex-grow-1 fs-6">
                Módulo padrão exigido para a segurança do painel. Administre os logins, e-mails e as palavras-passe encriptadas dos utilizadores com permissão de administrador.
            </p>
            <a href="./usuario/UsuarioList.php" class="btn btn-warning text-dark w-100 fw-bold mt-3 py-2 shadow-sm">
                <i class="fa-solid fa-shield-halved me-2"></i> Configurar Acessos
            </a>
        </div>
    </div>
</div>

<style>
    .card-otica {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }
    .card-otica:hover {
        transform: translateY(-5px);
        box-shadow: 0 .5rem 1.5rem rgba(0,0,0,.15) !important;
    }
</style>

<?php
// 3. INCLUSÃO DO RODAPÉ (Fecha o container e as tags HTML de forma segura)
include_once './footer.php';
?>