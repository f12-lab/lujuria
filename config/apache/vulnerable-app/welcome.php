<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: index.php"); 
    exit;
}

# Capturar el parámetro de la URL para luego mostrarlo
$query = $_GET['q'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="welcome-container">
        <h1>¡Bienvenido a <span class="highlight">lujuriosas.es</span>!</h1>
        <h2>¿Qué buscas? Déjanos tus deseos...</h2>
        
        <form action="welcome.php" method="GET" class="search-form">
            <label for="q" class="hidden-label">Escribe aquí:</label>
            <input type="text" id="q" name="q" placeholder="Escribe tu deseo más profundo..." autocomplete="off" required>
            <button type="submit">Buscar el placer</button>
        </form>
        
        <?php if ($query): ?>
        <p class="result-text">Tu deseo: <span id="result"><?php echo $query; ?></span></p>
        <?php endif; ?>
        
        <a href="logout.php" class="logout-link">Cerrar sesión</a>
    </div>
</body>
</html>
