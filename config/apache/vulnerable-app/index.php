<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == "dante" && $password == "dante123") {
        $_SESSION["user"] = $username;
        setcookie("PHPSESSID", session_id(), time() + 3600);
        header("Location: welcome.php");
        exit;
    } else {
        $error = "Nombre de usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Iniciar Sesión</h2>
<?php if (isset($error)) { echo "<p>$error</p>"; } ?> 

<form action="index.php" method="post">
    <label for="username">Usuario: </label>
    <input type="text" id="username" name="username" required>
    <br>
    <label for="password">Contraseña: </label>
    <input type="password" id="password" name="password" required>
    <br>
    <button type="submit">Iniciar Sesión</button>
</form>

</body>
</html>
