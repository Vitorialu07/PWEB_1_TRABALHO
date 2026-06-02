<?php
include '../header.php';
include_once "../db.class.php";

// Conecta especificamente na tabela 'produto'
$db = new db('produto');

if (!empty($_GET['id'])){
    $db->destroy($_GET['id']);
}

if(!empty($_POST)){
    $dados = $db->search($_POST);
} else {
    $dados = $db->all();
}

if (!empty($_GET['id'])){
    $data = $db->find($_GET['id']);
}
?> 

<div class="row mb-4">
    <h3>Filtro de Pesquisa - Estoque</h3>
    <form action="EstoqueList.php" method="post">
        <div class="row align-items-end">
            <div class="col-md-2">
                <label for="tipo">Tipo</label>
                <select name="tipo" class="form-select">
                    <option value="nome">Nome</option>
                    <option value="categoria">Categoria</option>
                    <option value="marca">Marca</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="valor">Valor</label>
                <input type="text" name="valor" placeholder="Pesquisar..." class="form-control">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Buscar</button>
                <a href="./EstoqueForm.php" class="btn btn-success">Novo</a>
            </div>
        </div>
    </form> 
</div>

<div class="row">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Categoria</th>
                <th scope="col">Marca</th>
                <th scope="col">Preço Venda</th>
                <th scope="col">Estoque</th>
                <th scope="col" colspan="2">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($dados as $item){
                echo "<tr>
                    <th scope='row'>$item->id</th>
                    <td>$item->nome</td>
                    <td>$item->categoria</td>
                    <td>$item->marca</td>
                    <td>R$ " . number_format($item->preco_venda, 2, ',', '.') . "</td>
                    <td>$item->estoque</td>
                    <td>
                        <a class='btn btn-warning btn-sm' title='Editar'
                           href='./EstoqueForm.php?id=$item->id'>Editar</a>
                    </td>
                    <td>
                        <a class='btn btn-danger btn-sm' title='Excluir'
                           onclick='return confirm(\"Deseja realmente excluir?\")'
                           href='./EstoqueList.php?id=$item->id'>Deletar</a>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php
include '../footer.php';
?>