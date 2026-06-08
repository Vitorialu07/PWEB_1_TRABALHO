<?php
include '../header.php';
include '../autenticacao.php';
include_once "../database/db.class.php";
// Inicializa a variável para evitar erros caso o POST seja acionado

// Post para quando o formulário for submetido
$db = new db('cliente');

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
        <form action="ClienteList.php" method="post">
            <div class="row">
                <h3> Listagem de Clientes</h3>
                <div class="col-2">
                    <label for="nome">Tipo</label>
                    <select name="tipo" class="form-select">
                        <option value="nome">Nome</option>
                        <option value="razao_social">Razão social</option>
                        <option value="cpf">CPF</option>
                        <option value="cnpj">CNPJ</option>
                        <option value="telefone">Telefone</option>
                        <option value="nome">Email</option>
                        <option value="rua">Rua</option>
                        <option value="cidade">Cidade</option>
                        <option value="cep">CEP</option>
                    </select>
                </div>
                <div class="col-5">
                    <label for="email">Valor</label>
                    <input type="text" name="valor" placeholder="Pesquisar..." class="form-control" value="">
                </div>
                <div class="col-5">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                    <a href="./ClienteForm.php" class="btn btn-success">Novo</a>
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
                <th scope="col">Razão Social</th>
                <th scope="col">CPF</th>
                <th scope="col">CNPJ</th>
                <th scope="col">Telefone</th>
                <th scope="col">Email</th>
                <th scope="col">Rua</th>
                <th scope="col">Cidade</th>
                <th scope="col">CEP</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
        <tbody>


            <?php
            foreach ($dados as $item) {
                echo "<tr>
                    <th scope='row'>$item->id</th>
                    <td>$item->nome</td>
                    <td>$item->razao_social</td>
                    <td>$item->cpf</td>
                    <td>$item->cnpj</td>
                    <td>$item->telefone</td>
                    <td>$item->email</td>
                    <td>$item->rua</td>
                    <td>$item->cidade</td>
                    <td>$item->cep</td>
                   <td>
                   <a href='./ClienteForm.php?id=$item->id' 
                   class='btn btn-warning' title='Editar' >Editar</a></td>

                    <td>
                    <a href='./ClienteList.php?id=$item->id' 
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