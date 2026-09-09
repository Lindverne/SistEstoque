<?php

    if (session_status() === PHP_SESSION_NONE) 
    {
        session_start();
    }

    require_once __DIR__ . '/../../api/middleware/verificador.php';
    VerificarLogin();

    include __DIR__ . '/../../api/config/conexao.php';

    $sql  = "SELECT foto_perfil FROM login WHERE id = ? LIMIT 1";
    $stmt = mysqli_prepare($con, $sql);

    mysqli_stmt_bind_param($stmt, 'i', $_SESSION['id_usuario']);
    mysqli_stmt_execute($stmt);

    $row       = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    $fotoAtual = $row['foto_perfil'] ?? '';
    mysqli_stmt_close($stmt);

    $_SESSION['foto_perfil'] = $fotoAtual;

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Meu Perfil | SistEstoque</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
          rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.css">

    <link rel="stylesheet" href="../assets/css/pages/cadastro_produtos.css">
    <link rel="stylesheet" href="../assets/css/pages/perfil.css">

    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/frieren_cute.ico">
</head>
<body>

<div class="container mt-5 mb-5">

    <div class="hero-card p-4 mb-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
        <div>
            <h1 class="h3 fw-bold text-dark m-0">Meu Perfil</h1>
            <p class="text-muted small m-0">Atualize sua foto de exibição no sistema</p>
        </div>

        <?php include __DIR__ . '/../components/header_usuario.php'; ?>

        <div class="d-flex align-items-center justify-content-end gap-2">
            <a href="#" id="btnDeslogarSistema"
               class="btn btn-outline-danger p-2 rounded-3 d-flex align-items-center fw-semibold"
               style="font-size: 0.875rem; line-height: 1; border-width: 1px;"
               title="Sair do Sistema">
                <i class="fa-solid fa-right-from-bracket me-1"></i>Sair
            </a>
        </div>
    </div>

    <div class="mb-4">
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link" href="cadastro_produtos.php">
                   <i class="fa-solid fa-circle-plus text-success me-2"></i>Cadastrar Produto
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="lista.php">
                    <i class="fa-solid fa-boxes-stacked me-2"></i>Lista Produtos
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#">
                    <i class="fa-solid fa-user-gear me-2"></i>Meu Perfil
                </a>
            </li>
        </ul>
    </div>

    <div class="card form-card">
        <form action="../../api/controllers/atualizarPerfil.php" method="POST"
              enctype="multipart/form-data" id="formPerfil">

            <input type="file" name="foto_arquivo" id="fotoPerfilReal" class="d-none" accept="image/*">
            <input type="hidden" name="foto_url" id="hiddenFotoUrl">

            <div class="row g-4">

                <div class="col-md-4 d-flex flex-column align-items-center justify-content-start gap-3">
                    <label class="form-label fw-semibold w-100 text-center">Foto Atual</label>

                    <div class="pfp-hero-wrapper">
                        <img src="<?php
                                $srcPfp = !empty($fotoAtual)
                                    ? '../assets/img/perfis/' . htmlspecialchars($fotoAtual)
                                    : '../assets/img/favicon/frieren_cute.ico';
                                echo $srcPfp;
                            ?>"
                             class="pfp-atual"
                             id="pfpAtualImg"
                             alt="Foto atual"
                             onerror="this.onerror=null;this.src='../assets/img/favicon/frieren_cute.ico';">
                        <small>Clique para ampliar</small>
                    </div>

                    <button type="button" class="btn btn-outline-primary rounded-3 px-4 w-100"
                            data-bs-toggle="modal" data-bs-target="#perfilImageModal">
                        <i class="fa-solid fa-camera me-2"></i>Trocar Foto
                    </button>
                    <span id="pfp-status-text" class="text-muted small text-center">Nenhuma imagem selecionada</span>
                </div>

                <div class="col-md-8 d-flex flex-column justify-content-start">
                    <label class="form-label fw-semibold">Pré-visualização da Nova Foto</label>
                    <div id="pfpPreviewContainer" style="display:none; text-align:center; margin-top:8px;">
                        <img src="" id="pfpPreviewImg"
                             style="width:160px;height:160px;object-fit:cover;border-radius:50%;
                                    border:3px solid #e2e8f0;box-shadow:0 4px 16px rgba(0,0,0,.1);"
                             alt="Preview">
                        <p class="text-muted small mt-2">Esta será a sua nova foto de perfil</p>
                    </div>
                    <div id="pfpPreviewEmpty" class="text-muted small mt-3">
                        <i class="fa-solid fa-circle-info me-1"></i>
                        Clique em "Trocar Foto" para escolher uma nova imagem.
                        Você poderá recortá-la em formato quadrado antes de salvar.
                    </div>
                </div>

                <div class="col-12 d-flex gap-3 justify-content-end border-top pt-4 mt-2">
                    <a href="lista.php" class="btn btn-light btn-action text-muted">
                        Voltar para Lista
                    </a>
                    <button type="submit" class="btn btn-success btn-action text-white">
                        <i class="fa-solid fa-floppy-disk me-2"></i>Salvar Foto
                    </button>
                </div>

            </div>
        </form>

        <hr class="my-4">

        <form action="../../api/controllers/atualizarDadosUsuario.php" method="POST" id="formDadosUsuario">

            <div class="row g-4">

                <div class="col-12">
                    <h5 class="fw-bold text-dark mb-1">Alterar Dados da Conta</h5>
                    <p class="text-muted small mb-0">Deixe em branco os campos que não deseja alterar.</p>
                </div>

                <div class="col-md-12">
                    <label class="form-label fw-semibold">Novo Nome de Usuário</label>
                    <input type="text"
                           name="novo_nome"
                           class="form-control"
                           placeholder="<?= htmlspecialchars($_SESSION['login'] ?? '') ?>"
                           autocomplete="off">
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Nova Senha</label>
                    <input type="password"
                           name="nova_senha"
                           id="novaSenha"
                           class="form-control"
                           placeholder="Digite a nova senha"
                           autocomplete="new-password">
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Confirmar Nova Senha</label>
                    <input type="password"
                           name="confirmar_senha"
                           id="confirmarSenha"
                           class="form-control"
                           placeholder="Repita a nova senha"
                           autocomplete="new-password">
                </div>

                <div class="col-12 d-flex gap-3 justify-content-end border-top pt-4 mt-2">
                    <button type="submit" class="btn btn-primary btn-action text-white">
                        <i class="fa-solid fa-user-pen me-2"></i>Salvar Dados
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>

    <div class="modal fade" id="perfilImageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">Selecione a Foto de Perfil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs border-bottom mb-3" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active small fw-bold" data-bs-toggle="tab"
                                    data-bs-target="#pfpUploadPanel" type="button">Arquivo Local</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link small fw-bold" data-bs-toggle="tab"
                                    data-bs-target="#pfpUrlPanel" type="button">Endereço URL</button>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="pfpUploadPanel">
                            <div class="drop-zone" id="pfpDropZone">
                                <i class="fa-solid fa-cloud-arrow-up text-primary fs-1 mb-2"></i>
                                <p class="mb-1 fw-medium text-dark">Arraste a imagem aqui</p>
                                <span class="text-muted small">ou clique para explorar o computador</span>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pfpUrlPanel">
                            <div class="mb-3">
                                <label class="form-label small text-muted">Cole o link completo da imagem:</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted">
                                        <i class="fa-solid fa-link"></i>
                                    </span>
                                    <input type="url" id="pfpUrlInput" class="form-control"
                                        placeholder="https://exemplo.com/foto.jpg">
                                </div>
                            </div>
                            <button type="button" id="btnAplicarUrlPerfil"
                                    class="btn btn-primary w-100 rounded-3 small fw-bold">
                                Confirmar Link
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="cropperModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 24px; overflow: hidden;">

                <div class="modal-header border-0"
                    style="background: linear-gradient(135deg, #ffffff 0%, #f1f5f9 100%);
                            border-bottom: 1px solid #e2e8f0 !important; padding: 20px 24px;">
                    <h5 class="modal-title fw-bold" style="font-size: 1.1rem; color: #1e293b;">
                        <i class="fa-solid fa-crop-simple me-2 text-primary"></i>Recortar Foto
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body p-0" style="background-color: #0f172a; min-height: 350px;">
                    <img id="cropperImagePerfil" src="" alt="Recorte" style="max-width:100%; display:block;">
                </div>

                <div class="modal-footer border-0 justify-content-end gap-2"
                     style="background: linear-gradient(135deg, #f1f5f9 0%, #ffffff 100%);
                            border-top: 1px solid #e2e8f0 !important; padding: 16px 24px;">
                    <button type="button" class="btn btn-light rounded-3 px-4 fw-semibold"
                            data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" id="btnSalvarCropPerfil"
                            class="btn btn-primary rounded-3 px-4 fw-semibold">
                        <i class="fa-solid fa-check me-1"></i>Usar Esta Foto
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalPfpZoom" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
                <div class="modal-body p-0 text-center" style="background:#0f172a;">
                    <img id="modalPfpImg" src="" alt="Foto ampliada"
                         style="max-width:100%; max-height:80vh; object-fit:contain;">
                </div>
                <div class="modal-footer border-0 justify-content-center" style="background:#0f172a;">
                    <button type="button" class="btn btn-light rounded-3 px-4"
                            data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.js"></script>
<script src="../assets/js/pages/perfil.js"></script>
<script src="../assets/js/global.js"></script>

</body>
</html>