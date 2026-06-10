<?php

include_once "../db.class.php";

$db = new db('funcionario');
$erro_exclusao = '';


if (!empty($_GET['id'])) {
    try {
        $db->softDelete($_GET['id']);  
        $_SESSION['success'] = "Funcionário desativado com sucesso!";
        header("Location: FuncionarioList.php");
        exit;
    } catch (Exception $e) {
        $erro_exclusao = "Erro ao desativar funcionário: " . $e->getMessage();
    }
}

if (!empty($_POST)) {
    $dados = $db->search($_POST);
} else {
    $dados = $db->all();
}


include '../header.php';
include '../autenticacao.php';
?>

<div class="container mt-4">
    <?php if(!empty($erro_exclusao)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $erro_exclusao; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="row">
            <form action="FuncionarioList.php" method="post">
                <div class="row">
                    <h3> Listagem de Funcionario</h3>
                    <div class="col-2">
                        <label for="nome">Tipo</label>
                        <select name="tipo" class="form-select">
                            <option value="nome">Nome</option>
                            <option value="cpf">CPF</option>
                            <option value="nascimento">Data de nascimento</option>
                            <option value="admissao">Data de admissao</option>
                            <option value="demissao">Data de demissao</option>
                            <option value="funcao">Funcao</option>
                            <option value="status">Status</option>
                            <option value="salario">Salario</option>
                        </select>
                    </div>
                    <div class="col-5">
                        <label for="email">Valor</label>
                        <input type="text" name="valor" placeholder="Pesquisar..." class="form-control" value="">
                    </div>
                    <div class="col-5">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                        <a href="./FuncionarioForm.php" class="btn btn-success">Novo</a>
                        <?php if (!empty($_POST['valor'])): ?>
                            <a href="FuncionarioList.php" class="btn btn-secondary">Limpar</a>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row mt-4">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Data de nascimento</th>
                    <th scope="col">Data de admissao</th>
                    <th scope="col">Data de demissao</th>
                    <th scope="col">Funcao</th>
                    <th scope="col">Salario</th> 
                    <th scope="col">Acoes</th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($dados)): ?>
                    <tr>
                        <td colspan="9" class="text-center text-muted py-4">
                            Nenhum funcionario encontrado
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($dados as $item): ?>
                        <tr>
                            <th scope="row"><?php echo $item->id; ?></th>
                            <td><?php echo htmlspecialchars($item->nome); ?></td>
                            <td><?php echo htmlspecialchars($item->cpf); ?></td>
                            <td><?php echo htmlspecialchars($item->nascimento); ?></td>
                            <td><?php echo htmlspecialchars($item->admissao); ?></td>
                            <td><?php echo htmlspecialchars($item->demissao ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($item->funcao); ?></td>
                            <td>R$ <?php echo number_format($item->salario, 2, ',', '.'); ?></td>
                            <td>
                                <a href="./FuncionarioForm.php?id=<?php echo $item->id; ?>" 
                                   class="btn btn-warning btn-sm" title="Editar">Editar</a>
                                <a href="./FuncionarioList.php?id=<?php echo $item->id; ?>" 
                                   class="btn btn-danger btn-sm" title="Excluir" 
                                   onclick="return confirm('Deseja realmente excluir este funcionario?')">Deletar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../footer.php'; ?>