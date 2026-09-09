<?php

require_once __DIR__ . '/../config/conexao.php';

$login = trim($_POST['login'] ?? '');
$senha = $_POST['senha'] ?? '';

processarCadastro($con, $login, $senha);


function processarCadastro(mysqli $con, string $login, string $senha): void 
{
    if (empty($login) || empty($senha)) {
        redirecionarParaCadastro('erro_campos');
    }

    if (usuarioExiste($con, $login)) {
        redirecionarParaCadastro('erro_existe');
    }

    if (criarUsuario($con, $login, $senha)) {
        header("Location: ../../public/pages/login.php?success=" . urlencode("Conta criada com sucesso! Entre agora (⌒‿⌒)"));
        exit;
    } else {
        redirecionarParaCadastro('erro_banco');
    }
}

function usuarioExiste(mysqli $con, string $login): bool 
{
    $sql = "SELECT id FROM login WHERE login = ? LIMIT 1";
    $stmt = mysqli_prepare($con, $sql);
    
    if (!$stmt) return false;
    
    mysqli_stmt_bind_param($stmt, "s", $login);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    
    $existe = mysqli_stmt_num_rows($stmt) > 0;
    mysqli_stmt_close($stmt);
    
    return $existe;
}

function criarUsuario(mysqli $con, string $login, string $senha): bool 
{
    $hashSeguro = password_hash($senha, PASSWORD_DEFAULT);
    $sql = "INSERT INTO login (login, senha) VALUES (?, ?)";
    $stmt = mysqli_prepare($con, $sql);
    
    if (!$stmt) return false;
    
    mysqli_stmt_bind_param($stmt, "ss", $login, $hashSeguro);
    $sucesso = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    
    return $sucesso;
}

function redirecionarParaCadastro(string $status): void 
{
    header("Location: ../../public/pages/cadastro.php?status=" . urlencode($status));
    exit;
}