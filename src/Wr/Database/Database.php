<?php

declare(strict_types=1);

namespace Wr\Database;

use Closure;
use PDO;
use PDOException;
use Throwable;

/**
 * Simple database wrapper class that enables the use of method chaining.
 */
class Database
{
    protected PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        $this->pdo = $pdo;
    }

    /**
     * Creates a new prepared statement.
     */
    public function query(string $query): Statement
    {
        $stmt = $this->pdo->prepare($query);
        return new Statement($stmt);
    }

    /**
     * Get last inserted id.
     */
    public function getLastInsertId(): int {
        return (int) $this->pdo->lastInsertId();
    }

    /**
     * Initiates a transaction.
     */
    public function beginTransaction(): bool {
        return $this->pdo->beginTransaction();
    }

    /**
     * Rolls back a transaction.
     */
    public function rollBack(): bool {
        return $this->pdo->rollBack();
    }

    /**
     * Commits a transaction.
     */
    public function commit(): bool {
        return $this->pdo->commit();
    }

    /**
     * Executes an anonymous function within a transaction and rolls back if
     * an exception occurred.
     */
    public function transaction(Closure $function): mixed
    {
        $this->beginTransaction();

        try {
            $result = $function($this);
            $this->commit();

            return $result;
        } catch (Throwable $exception) {
            $this->rollBack();

            throw new PDOException('Transaction failed');
        }
    }
}