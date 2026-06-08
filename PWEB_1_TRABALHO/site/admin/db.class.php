<?php

class db
{

    private $host     = 'localhost';
    private $user     = 'root';
    private $password = '';
    private $port     = '3306';
    private $dbname   = 'db_web_luiza_vitoria_banco';
    private $table_name = 'usuario';
    private $conn; // conexão fica guardada para reutilizar

    public function __construct($table_name)
    {
        $this->table_name = $table_name;
        $this->conn = $this->connect(); // cria a conexão uma única vez
    }

    // Método privado: apenas a própria classe pode chamar
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
    // Função que analisa os dados e retorna em formato de classe 
    // Seleciona todos os dados da tabela 
    public function all(){
        $sql = "SELECT * FROM $this->table_name"; 
        $st = $this->conn->prepare($sql);
        $st->execute();
        
        return $st->fetchAll(PDO::FETCH_CLASS); 
    }



    // INSERT INTO tabela` (`campo 1`, `campo 2`) VALUES ('?', '?');
    // Criação de método que recebe dados do formulário e executa comando de insert

    public function store($dados)
    {
        if (isset($dados['id']) && empty($dados['id'])) {
        unset($dados['id']);
        }

        $campos = "";
        $marcadores = "";
        $vetorData = [];
        $sep = "";

        // Criação de concatenação que preenche com os dados necessários

        foreach ($dados as $campo => $valor) {
            $campos .= $sep . $campo;
            $marcadores .= $sep . "?";
            $vetorData[] = $valor;
            $sep = ",";
        }
        $sql = "INSERT INTO $this->table_name ($campos) VALUES ($marcadores);";
      //  var_dump($sql, $dados);
      //  exit;

        try {
            $st = $this->conn->prepare($sql);
            $st->execute(params: $vetorData);
        } catch (PDOException $e) {
           throw new Exception("Erro ao inserir". $e->getMessage());
        }
    }

    public function update($dados){
    // Garante que $dados seja um array, mesmo se o formulário enviar como objeto
    if (is_object($dados)) {
        $dados = (array) $dados;
    }

    $campos = "";
    $vetorData = [];
    $sep = "";

    foreach ($dados as $campo => $valor) {
        // Usamos trim() para garantir que não existam espaços escondidos como 'id ' ou ' id'
        if (trim($campo) !== 'id') {
            $campos .= $sep . " $campo = ?";
            $vetorData[] = $valor;
            $sep = ", ";
        }
    }
    
    // O ID da cláusula WHERE precisa do valor correto do ID enviado
    $vetorData[] = $dados['id'];
    $sql = "UPDATE $this->table_name SET $campos WHERE id = ?;";

    try {
        $st = $this->conn->prepare($sql);
        $st->execute($vetorData); // Removido o 'params:' para evitar incompatibilidades de versão
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

// Select * from tabela where campo like 
  public function search($dados){
        $campo= $dados['tipo'];
        $valor=$dados['valor'];

        $sql = "SELECT * FROM $this->table_name WHERE $campo LIKE ?"; 
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