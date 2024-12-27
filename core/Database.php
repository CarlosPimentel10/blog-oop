<?php
declare(strict_types=1);

namespace Core;

class Database
{
    protected \PDO $pdo;

    public function __construct(array $config)
    {
        try {
            $dsn = $this->createDsn($config);
            $username = $config['username'] ?? null;
            $password = $config['password'] ?? null;
            $options = $config['options'] ?? null;
            $this->pdo = new \PDO($dsn, $username, $password, $options);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            throw new \Exception("Could not connect to the database");
        }
    }

    protected function createDsn(array $config)
    {
        $driver = $config['driver'];
        $dbName = $config['dbName'];

        return match ($driver) {
            'sqlite' => "sqlite:$dbName",
            default => throw new \Exception("Unsupported database driver: $driver")
        };
    }

    public function query(string $sql, array $params = []):\PDOStatement {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public function fetchAll(string $sql, array $params = []):array {
        return $this->query($sql,$params)->fetchAll(\PDO::FETCH_OBJ);
    }

    public function fetch(string $sql,array $params = []): object|false {
        return $this->query($sql, $params)->fetch(\PDO::FETCH_OBJ);
    }

    public function lastInsertId(): string|false {
        return $this->pdo->lastInsertId();
    }

}


?>