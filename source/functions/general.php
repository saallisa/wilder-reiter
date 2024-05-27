<?php

declare(strict_types=1);

// ----------------------------------------------------------------------
// WILDER REITER - ALLGEMEINE FUNKTIONEN
// ----------------------------------------------------------------------

/**
 * Diese Funktion leitet zu einer anderen Seite um.
 */
function redirect(string $location): void
{
    // Leite zu einer anderen Seite um ...
    http_response_code(302);
    header('Location: ' . $location);

    // ... und beende die Ausführung des Skripts.
    exit();
}

/**
 * Fügt nur dann einen Wert zur Session hinzu, wenn sie gestartet wurde.
 */
function setSession(string $key, mixed $value): void
{
    if (session_status() !== PHP_SESSION_NONE) {
        $_SESSION[$key] = $value;
    }
}