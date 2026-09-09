<?php

    $erro = $_GET['erro'] ?? "";
    $success = $_GET['success'] ?? "";

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | SistEstoque</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
  
    <link rel="stylesheet" href="../assets/css/pages/login.css">

    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/frieren_cute.ico">
    
</head>

<body data-login-error="<?php echo htmlspecialchars($erro, ENT_QUOTES, 'UTF-8'); ?>" data-login-success="<?php echo htmlspecialchars($success, ENT_QUOTES, 'UTF-8'); ?>">

    <div class="login-card text-center">
        <div class="brand-logo"><i class="fa-solid fa-boxes-stacked text-primary"></i></div>
        <h3 class="fw-bold text-dark mb-1">SistEstoque</h3>
        <p class="text-muted small mb-4">Seja bem-vindo de volta! (⌒‿⌒)</p>

        <form action="../../api/controllers/doLogin.php" method="POST">
            <div class="mb-3 position-relative">
                <i class="fa-solid fa-user input-group-icon"></i>
                <input type="text" class="form-control" name="login" placeholder="Seu usuário" required />
            </div>
            
            <div class="mb-4 position-relative">
                <i class="fa-solid fa-lock input-group-icon"></i>
                <input type="password" class="form-control" name="senha" placeholder="Sua senha" autocomplete="senha" required />
            </div>

            <button class="btn btn-primary w-100 btn-login mb-3" type="submit">
                Entrar <i class="fa-solid fa-arrow-right-to-bracket ms-1"></i>
            </button>

            <div class="d-flex justify-content-between small px-1">
                <a href="#" id="btnEsqueciSenha" class="text-decoration-none fw-semibold link-danger">Esqueci a Senha</a>
                <a href="cadastro.php" class="text-decoration-none fw-semibold link-success">Registrar</a>
            </div>
        </form>
    </div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../assets/js/pages/login.js"></script>
<script src="../assets/js/global.js"></script>

</body>
</html>