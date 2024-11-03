<?php
class DDBB {
    private const DB_HOST = DDBB_HOST;
    private const DB_NAME = DDBB_NAME;
    private const DB_USER = DDBB_USER;
    private const DB_PASSWORD = DDBB_PASSWORD;

    private $pdo;

    protected $table;

    public function __construct() {
        try {
            $dsn = "mysql:host=" . self::DB_HOST . ";dbname=" . self::DB_NAME;
            $this->pdo = new PDO($dsn, self::DB_USER, self::DB_PASSWORD);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function insert($params) {
        try {
            if(sizeof($params) == 0){
                return false;
            }
            $params['create_date'] = time();
            $insertStr = "INSERT INTO {$this->table} (";
            $valuesStr = "VALUES (";
            $insert = [];
            $values = [];
            $cont = 1;
            foreach($params AS $key => $param) {
                $insert[] = $key;
                $values[] = ":field$cont";
                $cont++;
            }
            $insert = implode(', ', $insert);
            $values = implode(', ', $values);

            $stmt = $this->pdo->prepare($insertStr . $insert . ") " . $valuesStr . $values . ")");

            $cont = 1;
            $stmt->test = [];
            foreach($params AS $key => $param) {
                $stmt->test[] = ":field$cont - $param";
                $stmt->bindValue(":field$cont", $param);
                $cont++;
            }
            $stmt->execute();
            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            die("Insert failed: " . $e->getMessage());
        }
    }

    public function getById($id) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Fetch by ID failed: " . $e->getMessage());
        }
    }

    public function get($params) {
        try {
            if(sizeof($params) == 0){
                return false;
            }
            $selectStr = "SELECT * FROM {$this->table} WHERE ";
            $conditions = [];
            $cont = 1;
            foreach($params AS $key => $param) {
                $conditions[] = "$key = :field$cont";
                $cont++;
            }
            $conditions = implode(' AND ', $conditions);

            $stmt = $this->pdo->prepare($selectStr . $conditions);

            $cont = 1;
            foreach($params AS $key => $param) {
                $stmt->bindValue(":field$cont", $param);
                $cont++;
            }
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Insert failed: " . $e->getMessage());
        }
    }

    public function getAll() {
        try {
            $stmt = $this->pdo->query("SELECT * FROM {$this->table}");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Fetch all failed: " . $e->getMessage());
        }
    }

    public function remove($id) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } catch (PDOException $e) {
            die("Remove by ID failed: " . $e->getMessage());
        }
    }

    public function update($wheres, $params)
    {
        try {
            if(sizeof($wheres) == 0){
                return false;
            }
            if(sizeof($params) == 0){
                return false;
            }

            $updateStr = "UPDATE {$this->table} SET ";
            
            $values = [];
            $cont = 1;
            foreach($params AS $key => $param) {
                $values[] = "$key = :field$cont";
                $cont++;
            }
            $values = implode(', ', $values);
            
            $conditions = [];
            foreach($wheres AS $key => $where) {
                $conditions[] = "$key = :field$cont";
                $cont++;
            }
            $conditions = implode(' AND ', $conditions);

            $stmt = $this->pdo->prepare($updateStr . $values . ' WHERE ' . $conditions);

            $cont = 1;
            foreach($params AS $key => $param) {
                $stmt->bindValue(":field$cont", $param);
                $cont++;
            }
            foreach($wheres AS $key => $where) {
                $stmt->bindValue(":field$cont", $where);
                $cont++;
            }

            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            die("Fetch all failed: " . $e->getMessage());
        }
    }
}
/*
UPDATE table_name
SET column1 = value1, column2 = value2, ...
WHERE condition;
*/
?>

