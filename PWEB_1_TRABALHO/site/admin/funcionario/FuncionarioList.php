<?php
include '../header.php';
include '../autenticacao.php';
include_once "../db.class.php";
// Inicializa a variável para evitar erros caso o POST seja acionado

// Post para quando o formulário for submetido
$db = new db('usuario');

if (!empty($_GET['id'])) {
    $db->destroy($_GET['id']);
}

if (!empty($_POST)) {
    $dados = $db->search($_POST);
} else {
    $dados = $db->all();
    //  var_dump($dados);
    // exit;
}
?>
<div class="row">
    <div class="row">
        <form action="FuncionarioList.php" method="post">
            <div class="row">
                <h3> Listagem de Funcionário</h3>
                <div class="col-2">
                    <label for="nome">Tipo</label>
                    <select name="tipo" class="form-select">
                        <option value="nome">Nome</option>
                        <option value="cpf">CPF</option>
                        <option value="nascimento">Data de nascimento</option>
                        <option value="admissao">Data de admissão</option>
                        <option value="demissao">Data de demissão</option>
                        <option value="funcao">Função</option>
                        <option value="status">Status</option>
                        <option value="salario">Salário</option>
                    </select>
                </div>
                <div class="col-5">
                    <label for="email">Valor</label>
                    <input type="text" name="valor" placeholder="Pesquisar..." class="form-control" value="">
                </div>
                <div class="col-5">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                    <a href="./FuncionarioForm.php" class="btn btn-success">Novo</a>
                </div>
            </div>
        </form>
    </div>

</div>

<div class="row">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">CPF</th>
                <th scope="col">Data de nascimento</th>
                <th scope="col">Data de admissão</th>
                <th scope="col">Data de demissão</th>
                <th scope="col">Função</th>
                <th scope="col">Salário</th> 
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>


            <?php
            foreach ($dados as $item) {
                echo "<tr>
                    <th scope='row'>$item->id</th>
                    <td>$item->nome</td>
                    <td>$item->cpf</td>
                    <td>$item->nascimento</td>
                    <td>$item->admissao</td>
                    <td>$item->demissao</td>
                    <td>$item->funcao</td>
                    <td>$item->salario</td>
                   <td>
                   <a href='./FuncionarioForm.php?id=$item->id' 
                   class='btn btn-warning' title='Editar' >Editar</a></td>

                    <td>
                    <a href='./FuncionarioList.php?id=$item->id' 
                   class='btn btn-danger' title='Excluir' 
                   onclick='return confirm(\"Deseja excluir?\")''>Deletar</a></td>
    </tr>";
            }
            ?>
        </tbody>
    </table>

    <?php

    include '../footer.php';
    ?>