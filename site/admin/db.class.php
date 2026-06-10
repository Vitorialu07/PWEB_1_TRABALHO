<?php

class db
{

    private $host     = 'localhost';
    private $user     = 'root';
    private $password = '';
    private $port     = '3306';
    private $dbname   = 'db_web_luiza_vitoria_banco';
    private $table_name = 'usuario';
    private $conn; 

    public function __construct($table_name)
    {
        $this->table_name = $table_name;
        $this->conn = $this->connect(); 
    }

   
    private function connect()
    {
        try {
            return new PDO(
                "mysql:host=$this->host;dbname=$this->dbname;port=$this->port;charset=utf8",
                $this->user,
                $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                ]
            );
        } catch (PDOException $e) {
            die('Erro na conexão: ' . $e->getMessage());
        }
    }
     
    public function all($includeInactive = false){
        $sql = "SELECT * FROM $this->table_name";
       
        if (!$includeInactive && $this->columnExists('ativo')) {
            $sql .= " WHERE ativo = 1";
        }
        $st = $this->conn->prepare($sql);
        $st->execute();
        
        return $st->fetchAll(PDO::FETCH_CLASS); 
    }

    private function columnExists($column) {
        try {
            $sql = "SHOW COLUMNS FROM $this->table_name LIKE '$column'";
            $st = $this->conn->prepare($sql);
            $st->execute();
            return $st->rowCount() > 0;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function store($dados)
    {
        if (isset($dados['id']) && empty($dados['id'])) {
            unset($dados['id']);
        }

        
        if (!isset($dados['ativo']) && $this->columnExists('ativo')) {
            $dados['ativo'] = 1;
        }

        $campos = "";
        $marcadores = "";
        $vetorData = [];
        $sep = "";

        foreach ($dados as $campo => $valor) {
            $campos .= $sep . $campo;
            $marcadores .= $sep . "?";
            $vetorData[] = $valor;
            $sep = ",";
        }
        $sql = "INSERT INTO $this->table_name ($campos) VALUES ($marcadores);";

        try {
            $st = $this->conn->prepare($sql);
            $st->execute(params: $vetorData);
        } catch (PDOException $e) {
           throw new Exception("Erro ao inserir". $e->getMessage());
        }
    }

    public function update($dados)
{
    if (is_object($dados)) {
        $dados = (array) $dados;
    }

  
    if (!isset($dados['id']) || empty($dados['id'])) {
        throw new Exception("ID não informado para atualização");
    }

    $id = (int)$dados['id'];
    unset($dados['id']); 

    $campos = "";
    $vetorData = [];
    $sep = "";

    foreach ($dados as $campo => $valor) {
        $campos .= $sep . " $campo = ?";
        $vetorData[] = $valor;
        $sep = ", ";
    } 
    
    $vetorData[] = $id; 
    $sql = "UPDATE $this->table_name SET $campos WHERE id = ?;"; 

    try {
        $st = $this->conn->prepare($sql);
        $st->execute($vetorData); 
        return true;
    } catch (PDOException $e) {
        throw new Exception("Erro ao atualizar: " . $e->getMessage());
    }
}
   
    public function destroy($id){
        try{
            $sql = "DELETE FROM $this->table_name WHERE id=?;"; 
            $st = $this->conn->prepare($sql);
            $st->execute([$id]);
        
            return $st->fetchAll(PDO::FETCH_CLASS); 
        }catch(PDOException $e){
            throw new Exception("Erro ao deletar: ". $e->getMessage());
        }
    }

   
    public function softDelete($id){
        try{
            
            if (!$this->columnExists('ativo')) {
                throw new Exception("Esta tabela não suporta soft delete (coluna 'ativo' não existe)");
            }
            $sql = "UPDATE $this->table_name SET ativo = 0, deleted_at = NOW() WHERE id = ?"; 
            $st = $this->conn->prepare($sql);
            $st->execute([$id]);
            
            return true;
        }catch(PDOException $e){
            throw new Exception("Erro ao desativar: ". $e->getMessage());
        }
    }

    
    public function restore($id){
        try{
            if (!$this->columnExists('ativo')) {
                throw new Exception("Esta tabela não suporta restauração (coluna 'ativo' não existe)");
            }
            $sql = "UPDATE $this->table_name SET ativo = 1, deleted_at = NULL WHERE id = ?"; 
            $st = $this->conn->prepare($sql);
            $st->execute([$id]);
            
            return true;
        }catch(PDOException $e){
            throw new Exception("Erro ao reativar: ". $e->getMessage());
        }
    }

    public function search($dados, $includeInactive = false){
        $campo = $dados['tipo'];
        $valor = $dados['valor'];

        $sql = "SELECT * FROM $this->table_name WHERE $campo LIKE ?";
       
        if (!$includeInactive && $this->columnExists('ativo')) {
            $sql .= " AND ativo = 1";
        }
        $st = $this->conn->prepare($sql);
        $st->execute(["%$valor%"]); 
        
        return $st->fetchAll(PDO::FETCH_CLASS); 
    }

    public function find($id){
        $sql = "SELECT * FROM $this->table_name WHERE id=?"; 
        $st = $this->conn->prepare($sql);
        $st->execute([$id]);
        
        return $st->fetchObject(); 
    }

    public function findBy($campo, $valor){
        $sql = "SELECT * FROM $this->table_name WHERE $campo= ?"; 
        $st = $this->conn->prepare($sql);
        $st->execute([$valor]);
        
        return $st->fetchObject(); 
    }
}