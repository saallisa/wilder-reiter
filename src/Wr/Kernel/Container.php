<?php

declare(strict_types=1);

namespace Wr\Kernel;

use InvalidArgumentException;
use RuntimeException;

use function sprintf;

/**
 * Very simple Dependency Injection Container
 */
class Container
{
    private array $definitions = [];
    private array $instances = [];

    public function __construct(array $definitions = [])
    {
        foreach ($definitions as $id => $definition) {
            if (!is_callable($definition)) {
                throw new InvalidArgumentException(
                    sprintf('Invalid argument for ID "%s"', $id)
                );
            }
        }

        $this->definitions = $definitions;
    }

    /**
     * Registers a container entry.
     */
    public function register(string $id, callable $definition): void {
        $this->definitions[$id] = $definition;
    }

    /**
     * Finds an entry of the container by its identifier and returns it.
     */
    public function get(string $id): mixed
    {
        // Ensure that the object is registered before retrieving.
        if (!$this->has($id)) {
            throw new RuntimeException(
                sprintf('The entry "%s" does not exist.', $id)
            );
        }

        // Cache object in case it will be called another time
        if (!isset($this->instances[$id])) {
            $this->instances[$id] = $this->definitions[$id]($this);
        }

        return $this->instances[$id];
    }

    /**
     * Returns if the container can return an entry for the given identifier.
     */
    public function has(string $id): bool {
        return isset($this->definitions[$id]);
    }
}