<?php

declare(strict_types=1);

namespace app\core;

class Database
{
    private \PDO $pdo;
    private static ?Database $instance = null;

    private function __construct()
    {
        $this->connect();
    }

    public static function getInstance(): Database
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function connect(): \PDO
    {
        $host     = 'localhost';
        $dbname   = 'clinica_db';
        $username = 'root';
        $password = '';
        $charset  = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

        $options = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
        ];

        try {
            $this->pdo = new \PDO($dsn, $username, $password, $options);
            return $this->pdo;
        } catch (\PDOException $e) {
            throw new \RuntimeException('Database connection failed: ' . $e->getMessage());
        }
    }

    public function query(string $sql, array $params = []): \PDOStatement
    {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (\PDOException $e) {
            throw new \RuntimeException('Database query failed: ' . $e->getMessage());
        }
    }

    public function fetch(string $sql, array $params = []): array
    {
        $stmt = $this->query($sql, $params);
        return $stmt->fetch();
    }

    public function fetchAll(string $sql, array $params = []): array
    {
        $stmt = $this->query($sql, $params);
        return $stmt->fetchAll();
    }

    public function execute(string $sql, array $params = []): int
    {
        $stmt = $this->query($sql, $params);
        return $stmt->rowCount();
    }

    public function lastInsertId(): string
    {
        return $this->pdo->lastInsertId();
    }
}
