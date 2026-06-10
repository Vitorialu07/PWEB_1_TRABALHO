<?php
include '../header.php';
include_once "../db.class.php";

$db = new db('funcionario');
$success = '';
$actionError = '';
$errors = [];
$data = null; 

if (!empty($_GET['id'])){
    $data = $db->find(id: $_GET['id']);
}


if (!empty($_POST)) {
    $data = (object)$_POST;

    try {
        
        if (empty($_POST['nome'])) {
            $errors[] = "<li>O nome é obrigatório</li>";
        }

        if (empty($_POST['cpf'])) {
            $errors[] = "<li>O CPF é obrigatório</li>";
        } elseif (!preg_match('/^\d{11}$/', preg_replace('/\D/', '', $_POST['cpf']))) {
            $errors[] = "<li>CPF inválido (deve conter 11 dígitos)</li>";
        }

        if (empty($_POST['nascimento'])) {
            $errors[] = "<li>A data de nascimento é obrigatória</li>";
        }

        if (empty($_POST['admissao'])) {
            $errors[] = "<li>A data de admissão é obrigatória</li>";
        }

        if (empty($_POST['funcao'])) {
            $errors[] = "<li>A função do funcionário é obrigatória</li>";
        }

        if (empty($_POST['status'])) {
            $errors[] = "<li>O status é obrigatório</li>";
        }

        if (empty($_POST['salario']) && $_POST['salario'] != '0') {
            $errors[] = "<li>O salário é obrigatório</li>";
        } elseif (!is_numeric($_POST['salario']) || $_POST['salario'] < 0) {
            $errors[] = "<li>Salário inválido</li>";
        }

        
        if (empty($errors)) {   
            
            $dadosParaSalvar = $_POST;
            if (empty($dadosParaSalvar['demissao'])) {
                $dadosParaSalvar['demissao'] = null;
            }
            
            if (empty($_POST['id'])){
                $db->store($dadosParaSalvar);
                $success = "Registro salvo com sucesso!";
            } else {
                $db->update($dadosParaSalvar);
                $success = "Registro atualizado com sucesso!";
            }
            
            redirect('./FuncionarioList.php');
        }
    } catch (PDOException $e) {
        $actionError = "Erro no banco de dados: " . $e->getMessage();
    } catch (Exception $e) {
        $actionError = "Erro: " . $e->getMessage();
    }
}

function getFormValueSafe($data, $field, $default = '') {
    if (isset($data) && is_object($data) && property_exists($data, $field)) {
        return htmlspecialchars($data->$field);
    }
    return $default;
}
?>

<div class="container mt-4">
    <div class="row">
        <?php actionMessage($success, $actionError); ?>
        <?php showValidationError($errors); ?>

        <div class="card">
            <div class="card-header">
                <h3>Formulário Funcionário</h3>
            </div>
            <div class="card-body">
                <form action="FuncionarioForm.php" method="post">
                    <input type="hidden" name="id" value="<?php echo getFormValueSafe($data, 'id'); ?>">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nome" class="form-label">Nome *</label>
                            <input type="text" name="nome" id="nome" class="form-control" 
                                   value="<?php echo getFormValueSafe($data, 'nome'); ?>" required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="cpf" class="form-label">CPF *</label>
                            <input type="text" name="cpf" id="cpf" class="form-control" 
                                   value="<?php echo getFormValueSafe($data, 'cpf'); ?>" 
                                   placeholder="00000000000" maxlength="11" required>
                            <small class="text-muted">Apenas números (11 dígitos)</small>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="nascimento" class="form-label">Data de Nascimento *</label>
                            <input type="date" name="nascimento" id="nascimento" class="form-control" 
                                   value="<?php echo getFormValueSafe($data, 'nascimento'); ?>" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="admissao" class="form-label">Data de Admissão *</label>
                            <input type="date" name="admissao" id="admissao" class="form-control" 
                                   value="<?php echo getFormValueSafe($data, 'admissao'); ?>" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="demissao" class="form-label">Data de Demissão</label>
                            <input type="date" name="demissao" id="demissao" class="form-control" 
                                   value="<?php echo getFormValueSafe($data, 'demissao'); ?>">
                            <small class="text-muted">Preencher apenas se desligado</small>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="funcao" class="form-label">Função *</label>
                            <select name="funcao" id="funcao" class="form-select" required>
                                <option value="">Selecione uma função</option>
                                <option value="Atendente" <?php echo (getFormValueSafe($data, 'funcao') == 'Atendente') ? 'selected' : ''; ?>>Atendente</option>
                                <option value="Vendedor" <?php echo (getFormValueSafe($data, 'funcao') == 'Vendedor') ? 'selected' : ''; ?>>Vendedor</option>
                                <option value="Gerente" <?php echo (getFormValueSafe($data, 'funcao') == 'Gerente') ? 'selected' : ''; ?>>Gerente</option>
                                <option value="Oftalmologista" <?php echo (getFormValueSafe($data, 'funcao') == 'Oftalmologista') ? 'selected' : ''; ?>>Oftalmologista</option>
                                <option value="Administrativo" <?php echo (getFormValueSafe($data, 'funcao') == 'Administrativo') ? 'selected' : ''; ?>>Administrativo</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status *</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="">Selecione o status</option>
                                <option value="Ativo" <?php echo (getFormValueSafe($data, 'status') == 'Ativo') ? 'selected' : ''; ?>>Ativo</option>
                                <option value="Férias" <?php echo (getFormValueSafe($data, 'status') == 'Férias') ? 'selected' : ''; ?>>Férias</option>
                                <option value="Afastado" <?php echo (getFormValueSafe($data, 'status') == 'Afastado') ? 'selected' : ''; ?>>Afastado</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="salario" class="form-label">Salário (R$) *</label>
                            <input type="number" name="salario" id="salario" class="form-control" 
                                   value="<?php echo getFormValueSafe($data, 'salario'); ?>" 
                                   step="0.01" min="0" required>
                        </div>

                        <div class="col-12 mt-3">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Salvar
                            </button>
                            <a href="./FuncionarioList.php" class="btn btn-primary">
                                <i class="fas fa-arrow-left"></i> Voltar
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

document.getElementById('cpf')?.addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    if (value.length > 11) value = value.slice(0, 11);
    e.target.value = value;
});
</script>

<?php
include '../footer.php';
?>