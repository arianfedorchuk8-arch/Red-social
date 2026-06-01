<?php
session_start();
require_once "../Controlador/conexion.php";

if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit;
}

$id = $_GET["id"] ?? 0;

$sql = "SELECT * FROM usuario WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$usuario = $stmt->get_result()->fetch_assoc();

if (!$usuario) {
    die("Usuario no encontrado.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil de usuario</title>
</head>
<body>

<h1>Perfil de <?php echo $usuario["usr_name"]; ?></h1>

<p>Email: <?php echo $usuario["usr_email"]; ?></p>

<?php if ($usuario["imagen"] != null): ?>
    <img src="../uploads/<?php echo $usuario["imagen"]; ?>" width="150">
<?php else: ?>
    <p>Sin imagen de perfil.</p>
<?php endif; ?>

<br><br>

<a href="perfil.php">Volver a mi perfil</a>

</body>
</html>
