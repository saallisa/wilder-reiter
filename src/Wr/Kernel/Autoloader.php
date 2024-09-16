<?php

declare(strict_types=1);

namespace Wr\Kernel;

use function file_exists;
use function rtrim;
use function spl_autoload_register;
use function strlen;
use function str_replace;
use function str_starts_with;
use function substr;
use function trim;

/**
 * Automatically loads classes with a namespace prefix from the configured
 * file path.
 */
class Autoloader
{
    private array $prefixes = [];

    /**
     * Add a namespace prefix to the collection.
     */
    public function addNamespace(string $prefix, string $path): void
    {
        // Normalize the prefix and the path
        $prefix = trim($prefix, '\\') . '\\';
        $path = rtrim($path, '/') . '/';

        $this->prefixes[$prefix] = $path;
    }

    /**
     * Register the autoloader.
     */
    public function register(): void {
        spl_autoload_register([$this, 'loadClass']);
    }

    /**
     * Load class from the file system.
     */
    private function loadClass(string $class): bool
    {
        foreach ($this->prefixes as $prefix => $path) {
            if ($this->hasPrefix($class, $prefix)) {
                $class = $this->removePrefix($class, $prefix);

                // Build file path and attempt to load class
                $file = $path . str_replace('\\', '/', $class) . '.php';
                return $this->requireFile($file);
            }
        }

        return false;
    }

    /**
     * Removes the namespace prefix from the start of the classname.
     */
    private function removePrefix(string $class, string $prefix): string {
        return substr($class, strlen($prefix));
    }

    /**
     * Check if the namespace prefix is at the start of the classname.
     */
    private function hasPrefix(string $class, string $prefix): bool {
        return str_starts_with($class, $prefix);
    }

    /**
     * If the given file exists, require it from the file system.
     */
    private function requireFile(string $file): bool
    {
        $exists = file_exists($file);

        if ($exists) {
            require $file;
        }

        return $exists;
    }
}