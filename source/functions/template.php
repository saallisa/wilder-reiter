<?php

declare(strict_types=1);

// ----------------------------------------------------------------------
// WILDER REITER - TEMPLATE ENGINE FUNKTIONEN
// ----------------------------------------------------------------------

/*
 * Rendere eine Template-Datei mit den angegebenen Parametern.
 */
function renderFile(string $file, array $params = []): string
{
    // Starte den Ausgabe-Puffer.
    ob_start();

    // Überprüfe, ob die Template-Datei existiert
    if (file_exists($file)) {
        // Falls ja, entpacke die Parameter in Variablen...
        extract($params);
        // ... und binde das Template File ein
        include $file;
    }

    // Beende den Ausgabe-Puffer und gebe seinen Inhalt zurück.
    return ob_get_clean();
}

/*
 * Rendere ein Template mit Layout und Parametern.
 */
function render(string $name, string $layout, array $params = []): string
{
    // Pfade zu dem Template und dem Layout.
    $pathToTemplate = VIEW_TEMPLATE_PATH . $name . VIEW_FILE_EXTENSION;
    $pathToLayout = VIEW_LAYOUT_PATH . $layout . VIEW_FILE_EXTENSION;

    // Rendere die Template-Datei und füge die Ausgabe den Parametern hinzu.
    $params['content'] = renderFile($pathToTemplate, $params);

    // Danach rendere das Template in das Layout.
    return renderFile($pathToLayout, $params);
}