
<?php
session_start();
require_once __DIR__ . '/../config/conexao.php';

$id = $_SESSION['id_usuario'];

if (!isset($_FILES['foto'])) {
    header("Location: ../../public/pages/perfil.php?erro=upload");
    exit;
}

$ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
$name = uniqid("perfil_") . "." . $ext;

$path = "../../public/assets/img/perfil/" . $name;

move_uploaded_file($_FILES['foto']['tmp_name'], $path);

mysqli_query($con, "UPDATE login SET foto_perfil='$name' WHERE id=$id");

header("Location: ../../public/pages/perfil.php?sucesso=1");
exit;
