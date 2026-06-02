<?php

class db
{
    private $host     = 'localhost';
    private $user     = 'root';
    private $password = '';
    private $port     = '3306';
    private $dbname   = 'db_web_luiza_vitoria_banco';
    private $table_name;
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

    //INSERT INTO `db_pweb_2026_1`.`aluno` (`telefone`) VALUES ('499988332064');


    public function all()
    {
        $sql = "SELECT * FROM $this->table_name";
        $st = $this->conn->prepare($sql);
        $st->execute();

        return $st->fetchAll(PDO::FETCH_CLASS);
    }

    public function store($dados)
    {

        unset($dados['id']);
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

      // var_dump($dados, $sql);
      //  exit();
        try {
            $st = $this->conn->prepare($sql);
            $st->execute($vetorData);
        } catch (PDOException $e) {
            var_dump('erro na inserção: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $sql = " DELETE FROM $this->table_name WHERE id=?;";
            $st = $this->conn->prepare($sql);
            $st->execute([$id]);
        } catch (PDOException $e) {
            throw new Exception('erro na inserção: ' . $e->getMessage());
        }
        //return $st->fetchAll(PDO::FETCH_CLASS);
    }


    public function search($dados)
    {
        $campo = $dados['tipo'];
        $valor = $dados['valor'];

        $sql = "SELECT * FROM $this->table_name WHERE $campo LIKE ?";
        try {
            $st = $this->conn->prepare($sql);
            $st->execute(["%$valor%"]);

            return $st->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            throw new Exception('erro na inserção: ' . $e->getMessage());
        }
    }

    public function find($id)
    {
        $sql = "SELECT * FROM $this->table_name WHERE id= ?";
        $st = $this->conn->prepare($sql);
        $st->execute([$id]);

        return $st->fetchObject();
    }
}
