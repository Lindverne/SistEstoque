<?php

if (session_status() === PHP_SESSION_NONE) 
{
    session_start();
}

$fotoUsuario = $_SESSION['foto_perfil'] ?? 'default_avatar.png';
$nomeUsuario = htmlspecialchars($_SESSION['login'] ?? 'Usuário');

?>

<div class="user-panel d-flex align-items-center gap-2">
    <div class="avatar-wrapper position-relative" style="width: 40px; height: 40px; flex-shrink: 0;">
        <a href="perfil.php" class="d-block w-100 h-100" title="Perfil do usuário">
            <img src="../assets/img/perfis/<?= $fotoUsuario ?>"
                 class="rounded-circle border border-2 border-light shadow-sm w-100 h-100"
                 style="object-fit: cover;"
                 id="fotoPerfilPreview"
                 alt="Foto de Perfil"
                 onerror="this.onerror=null;this.src='../assets/img/favicon/frieren_cute.ico';">
        </a>
    </div>
    <div>
        <div class="fw-bold text-dark mb-0" style="line-height: 1.2; font-size: 0.875rem;">
            Olá, <strong><?= $nomeUsuario ?></strong>
        </div>
        <small class="text-muted" style="font-size: 0.75rem;">Administrador do Sistema</small>
    </div>
</div>
