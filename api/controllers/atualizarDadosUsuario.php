<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../config/conexao.php';

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../../public/pages/login.php");
    exit;
}

$idUsuario    = $_SESSION['id_usuario'];
$novoNome     = trim($_POST['novo_nome'] ?? '');
$novaSenha    = $_POST['nova_senha'] ?? '';
$confirmarSenha = $_POST['confirmar_senha'] ?? '';

processarAtualizacaoDados($con, $idUsuario, $novoNome, $novaSenha, $confirmarSenha);

function processarAtualizacaoDados(mysqli $con, int $id, string $nome, string $senha, string $confirmacao): void
{
    if (!empty($nome)) {
        atualizarNome($con, $id, $nome);
    }

    if (!empty($senha)) {
        if ($senha !== $confirmacao) {
            header("Location: ../../public/pages/perfil.php?dados_erro=" . urlencode('As senhas não coincidem!'));
            exit;
        }
        atualizarSenha($con, $id, $senha);
    }

    header("Location: ../../public/pages/perfil.php?dados_status=sucesso");
    exit;
}

function atualizarNome(mysqli $con, int $id, string $nome): void
{
    $sql  = "UPDATE login SET login = ? WHERE id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'si', $nome, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $_SESSION['login'] = $nome;
}

function atualizarSenha(mysqli $con, int $id, string $senha): void
{
    $hash = password_hash($senha, PASSWORD_DEFAULT);
    $sql  = "UPDATE login SET senha = ? WHERE id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'si', $hash, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}