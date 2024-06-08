<!DOCTYPE html>

<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Wilder Reiter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Wireframe Stylesheets -->
    <link rel="stylesheet" href="/css/wireframe.css">
</head>
<body>
<header class="header">
    <div class="header-wrapper">
        <span class="header-logo">
            <a href="/">Wilder Reiter</a>
        </span>
        <nav class="header-menu">
            <a href="/login">Login</a>
            <a href="/register">Register</a>
        </nav>
    </div>
</header>
<main class="container">
    <?php echo $content; ?>
</main>
<footer class="footer">
    <a href="/imprint">Impressum</a>
    <a href="/privacy">Datenschutz</a>
    <a href="/rules">Regeln</a>
</footer>
</body>
</html>