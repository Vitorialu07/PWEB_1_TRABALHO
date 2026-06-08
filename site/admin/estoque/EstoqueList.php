<?php
include '../header.php';
include '../autenticacao.php';
include_once "../db.class.php";


$db = new db('estoque');
$dbProduto = new db('produto');

if (!empty($_GET['id'])) {
    $db->destroy($_GET['id']);
    header("Location: EstoqueList.php");
    exit;
}

if (!empty($_POST)) {
    $dados = $db->search($_POST);
} else {
    $dados = $db->all();
   
}
?>
<div class="row">
    <div class="row">
        <form action="EstoqueList.php" method="post">
            <div class="row">
                <h3> Listagem de Estoque</h3>
                <div class="col-2">
                    <label for="nome">Tipo</label>
                    <select name="tipo" class="form-select">
                        <option value="id_produto">Produto</option>
                        <option value="quantidade">Quantidade</option>
                    </select>
                </div>
                <div class="col-5">
                    <label for="Pesquisa">Valor</label>
                    <input type="text" name="valor" placeholder="Pesquisar..." class="form-control" value="">
                </div>
                <div class="col-5">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                    <a href="./EstoqueForm.php" class="btn btn-success">Novo</a>
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
                <th scope="col">Produto</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
        <tbody>

            <?php
            foreach ($dados as $item) {
                    $produto = $dbProduto->find($item->id_produto);
                    $nomeProduto = $produto ? $produto->nome : "Produto não encontrado (ID: $item->id_produto)";

                    echo "<tr>
                        <th scope='row'>$item->id</th> <td>$nomeProduto</td>       <td>$item->quantidade</td>
                        <td>
                            <a href='./EstoqueForm.php?id=$item->id' class='btn btn-warning' title='Editar'>Editar</a>
                        </td>
                        <td>
                            <a href='./EstoqueList.php?id=$item->id' class='btn btn-danger' title='Excluir' onclick='return confirm(\"Deseja excluir?\")'>Deletar</a>
                        </td>
                    </tr>";
                }
            ?>
        </tbody>
    </table>

    <?php

    include '../footer.php';
    ?>