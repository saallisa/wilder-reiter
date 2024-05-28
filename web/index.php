<?php

declare(strict_types=1);

// ----------------------------------------------------------------------
// WILDER REITER - HAUPTDATEI
// ----------------------------------------------------------------------

// Überprüfe, ob ein Cookie gesetzt wurde, dass Cookies erlaubt sind.
if (isset($_COOKIE['ConsentCookie'])) {
    // Falls ja, starte die Session, welche ebenfalls ein Cookie ist.
    session_start([
        // So lange bleibt die Session in Sekunden gespeichert:
        'cookie_lifetime' => 7200,
        // Die nachfolgenden Optionen sorgen für mehr Sicherheit:
        'cookie_httponly' => '1',
        'cookie_samesite' => 'Strict'
    ]);
}


// Binde die allgemeinen Funktionen ein.
include __DIR__ . '/../source/functions/general.php';

// Binde die Template Engine und ihre Konfiguration ein.
include __DIR__ . '/../config/template.php';
include __DIR__ . '/../source/functions/template.php';


// Definiere, welche Datei bei welcher Server-Anfrage eingebunden wird.
$routes = [
    'GET' => [
        // Startseite
        '/' => 'home.php',
        // Rechtliche Seiten
        '/imprint' => 'imprint.php',
        '/privacy' => 'privacy.php',
        '/rules' => 'rules.php',
        // Benutzersystem
        '/logout' => 'logout.php'
    ],
    'POST' => [
        // Benutzersystem
        '/login' => 'login.php',
        '/register' => 'register.php',
        '/verify-email' => 'verify-email.php'
    ]
];

// Anfrage-Methode
$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestMethod = trim($requestMethod);
$requestMethod = strtoupper($requestMethod);

// Anfrage-Pfad
$requestUri = $_SERVER['REQUEST_URI'];
$requestPath = strtok($requestUri, '?');
$requestPath = '/' . trim($requestPath, '/');

// Finde heraus, ob eine Datei dieser Anfrage zugewiesen wurde
if (isset($routes[$requestMethod][$requestPath])) {
    // Falls ja, baue den Pfad zur Datei
    $file = __DIR__ . '/../pages/' . $routes[$requestMethod][$requestPath];

    // Versuche die Datei einzubinden
    if (file_exists($file)) {
        include $file;
    } else {
        // Wenn keine Datei existiert, zeige einen Fehler an.
        include __DIR__ . '/../pages/server-error.php';
    }
} else {
    // Falls keine Datei der Anfrage zugewiesen wurde, zeige einen Fehler an.
    include __DIR__ . '/../pages/not-found.php';
}