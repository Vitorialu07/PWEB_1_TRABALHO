<?php
include '../header.php';
include '../autenticacao.php';
include_once "../database/db.class.php";
// Inicializa a variável para evitar erros caso o POST seja acionado

// Post para quando o formulário for submetido
$db = new db('produto');

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
        <form action="ProdutoList.php" method="post">
            <div class="row">
                <h3> Listagem de Produtos</h3>
                <div class="col-2">
                    <label for="nome">Tipo</label>
                    <select name="tipo" class="form-select">
                        <option value="nome">Nome</option>
                        <option value="descricao">Descrição</option>
                        <option value="marca">Marca</option>
                        <option value="preco_custo">Preço de custo</option>
                        <option value="preco_venda">Preço de venda</option>
                    </select>
                </div>
                <div class="col-5">
                    <label for="email">Valor</label>
                    <input type="text" name="valor" placeholder="Pesquisar..." class="form-control" value="">
                </div>
                <div class="col-5">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                    <a href="./ProdutoForm.php" class="btn btn-success">Novo</a>
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
                <th scope="col">Descrição</th>
                <th scope="col">Marca</th>
                <th scope="col">Preço de custo</th>
                <th scope="col">Preço de venda</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
        <tbody>


            <?php
            foreach ($dados as $item) {
                echo "<tr>
                    <th scope='row'>$item->id</th>
                    <td>$item->nome</td>
                    <td>$item->descricao</td>
                    <td>$item->marca</td>
                    <td>$item->preco_custo</td>
                    <td>$item->preco_venda</td>
                   <td>
                   <a href='./ProdutoForm.php?id=$item->id' 
                   class='btn btn-warning' title='Editar' >Editar</a></td>

                    <td>
                    <a href='./ProdutoList.php?id=$item->id' 
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