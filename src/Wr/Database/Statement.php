<?php

declare(strict_types=1);

namespace Wr\Database;

use PDO;
use PDOStatement;

/**
 * Simple prepared statement wrapper class that enables the use of method
 * chaining.
 */
class Statement
{
    public function __construct(
        private PDOStatement $stmt
    ) {}

    /**
     * Binds parameters to a prepared statement.
     */
    public function bind(mixed $id, mixed $value, int $type = null): Statement
    {
        if(is_null($type))
        {
            $type = match (true) {
                is_null($value) => PDO::PARAM_NULL,
                is_int($value) => PDO::PARAM_INT,
                is_bool($value) => PDO::PARAM_BOOL,
                default => PDO::PARAM_STR,
            };
        }

        $this->stmt->bindValue($id, $value, $type);
        return $this;
    }

    /**
     * Executes a prepared statement.
     */
    public function execute(): bool {
        return $this->stmt->execute();
    }

    /**
     * Returns all result rows.
     */
    public function fetchAll(int $mode = PDO::FETCH_DEFAULT): array
    {
        $this->execute();
        return $this->stmt->fetchAll($mode);
    }

    /**
     * Selects one result row.
     */
    public function fetch(int $mode = PDO::FETCH_DEFAULT): array
    {
        $this->execute();
        return $this->stmt->fetch($mode);
    }

    /**
     * Selects one result column.
     */
    public function fetchColumn(int $position = 0): mixed
    {
        $this->execute();
        return $this->stmt->fetchColumn($position);
    }
}