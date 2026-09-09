<?php

if (session_status() === PHP_SESSION_NONE) 
{
    session_start();
}

require_once __DIR__ . '/../config/conexao.php';

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../../public/pages/login.php");
    exit;
}

$idUsuario = $_SESSION['id_usuario'];
$fotoUrl   = trim($_POST['foto_url'] ?? '');
$arquivo   = $_FILES['foto_arquivo'] ?? null;

try {
    $nomeFotoFinal = null;

    if ($arquivo && $arquivo['error'] === UPLOAD_ERR_OK) 
    {
        $nomeFotoFinal = processarUploadLocal($arquivo);
    }

    elseif (!empty($fotoUrl)) 
    {
        $nomeFotoFinal = baixarImagemPorUrl($fotoUrl);
    }

    if ($nomeFotoFinal) {
        $sql  = "UPDATE login SET foto_perfil = ? WHERE id = ?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, 'si', $nomeFotoFinal, $idUsuario);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $_SESSION['foto_perfil'] = $nomeFotoFinal;
    }

    header("Location: ../../public/pages/perfil.php?status=sucess");
    exit;

} catch (Exception $e) {
    header("Location: ../../public/pages/perfil.php?erro=" . urlencode($e->getMessage()));
    exit;
}


function processarUploadLocal(array $arquivo): string
{
    $diretorio = __DIR__ . '/../../public/assets/img/perfis/';
    if (!is_dir($diretorio)) {
        mkdir($diretorio, 0755, true);
    }

    $extensao = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));
    
    if (empty($extensao)) {
        $extensao = 'jpg';
    }

    $nomeNovo = uniqid('perfil_', true) . '.' . $extensao;
    $destino  = $diretorio . $nomeNovo;

    if (!move_uploaded_file($arquivo['tmp_name'], $destino)) {
        throw new Exception('Erro interno ao salvar o arquivo no servidor.');
    }

    return $nomeNovo;
}

function baixarImagemPorUrl(string $url): string
{
    $conteudo = @file_get_contents($url);
    if ($conteudo === false) {
        throw new Exception('Não foi possível fazer o download da imagem a partir desta URL.');
    }

    $diretorio = __DIR__ . '/../../public/assets/img/perfis/';
    if (!is_dir($diretorio)) {
        mkdir($diretorio, 0755, true);
    }

    $extensao = 'jpg';
    if (preg_match('/\.([^.]+)$/', parse_url($url, PHP_URL_PATH), $matches)) {
        $extReq = strtolower($matches[1]);
        if (in_array($extReq, ['jpg', 'jpeg', 'png', 'webp', 'gif'])) {
            $extensao = $extReq;
        }
    }

    $nomeNovo = uniqid('perfil_', true) . '.' . $extensao;
    $destino  = $diretorio . $nomeNovo;


    file_put_contents($destino, $conteudo);

    return $nomeNovo;
}