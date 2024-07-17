<?php
class DDBB {
    private const DB_HOST = DDBB_HOST;
    private const DB_NAME = DDBB_NAME;
    private const DB_USER = DDBB_USER;
    private const DB_PASSWORD = DDBB_PASSWORD;

    private $pdo;

    public function __construct() {
        try {
            $dsn = "mysql:host=" . self::DB_HOST . ";dbname=" . self::DB_NAME;
            $this->pdo = new PDO($dsn, self::DB_USER, self::DB_PASSWORD);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function insert($name, $excel_path, $pdf_path, $from, $to) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO kilometros (name, excel_path, pdf_path, create_date, from_date, to_date) VALUES (:field1, :field2, :field3, :field4, :field5, :field6)");
            $stmt->bindParam(':field1', $name);
            $stmt->bindParam(':field2', $excel_path);
            $stmt->bindParam(':field3', $pdf_path);
            $timestamp = time();
            $stmt->bindParam(':field4', $timestamp);
            $stmt->bindParam(':field5', $from);
            $stmt->bindParam(':field6', $to);
            $stmt->execute();
            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            die("Insert failed: " . $e->getMessage());
        }
    }

    public function getById($id) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM kilometros WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Fetch by ID failed: " . $e->getMessage());
        }
    }

    public function getAll() {
        try {
            $stmt = $this->pdo->query("SELECT * FROM kilometros");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Fetch all failed: " . $e->getMessage());
        }
    }

    public function remove($id) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM kilometros WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $id;
        } catch (PDOException $e) {
            die("Remove by ID failed: " . $e->getMessage());
        }
    }
}
?>