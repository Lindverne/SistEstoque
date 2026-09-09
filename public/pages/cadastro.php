<?php

$status = $_GET['status'] ?? "";

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro | SistEstoque</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="../assets/css/pages/cadastro.css">

    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/frieren_cute.ico">
</head>
<body data-status="<?php echo htmlspecialchars($status, ENT_QUOTES, 'UTF-8'); ?>">

<div class="register-card text-center">
    <div class="brand-logo"><i class="fa-solid fa-user-plus text-primary"></i></div>
    <h3 class="fw-bold text-dark mb-1">Criar Nova Conta</h3>
    <p class="text-muted small mb-4">Cadastre-se para gerenciar o painel!</p>

    <form action="../../api/controllers/doCadastro.php" method="POST">
        <div class="mb-3 position-relative">
            <i class="fa-solid fa-user input-group-icon"></i>
            <input type="text" class="form-control" name="login" placeholder="Crie seu Usuário" required />
        </div>
        
        <div class="mb-4 position-relative">
            <i class="fa-solid fa-lock input-group-icon"></i>
            <input type="password" class="form-control" name="senha" placeholder="Crie uma Senha" autocomplete="senha" required />
        </div>

        <button class="btn btn-primary text-white w-100 btn-register mb-3" type="submit">
            Criar conta <i class="fa-solid fa-check ms-1"></i>
        </button>

        <div class="text-center small">
            <span class="text-muted">Já possui conta?</span> 
            <a href="login.php" class="text-decoration-none fw-semibold link-success">Fazer Login</a>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../assets/js/pages/cadastro_form.js"></script>
<script src="../assets/js/global.js"></script>

</body>
</html>