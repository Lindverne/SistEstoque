<?php

    // Verificando a sessão
    require __DIR__ . '/../../api/middleware/verificador.php';
    VerificarLogin();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro de Produto | SistEstoque</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="../assets/css/pages/cadastro_produtos.css">

    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/frieren_cute.ico">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.css">

</head>
<body>

<div class="container mt-5 mb-5">
    <div class="hero-card p-4 mb-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
        <div>
            <h1 class="h3 fw-bold text-dark m-0">Adicionar Novo Mimo</h1>
            <p class="text-muted small m-0">Preencha os detalhes para disponibilizar o produto! (ノ°∀°)ノ</p>
        </div>
          <?php include __DIR__ . '/../components/header_usuario.php'; ?>
            <div class="d-flex align-items-center justify-content-end gap-2">
           <a href="../../api/controllers/logout.php" class="btn btn-outline-danger p-2 rounded-3 fs-7 d-flex align-items-center fw-semibold" style="line-height: 1; border-width: 1px; font-size: 0.875rem;" title="Sair do Sistema">
                <i class="fa-solid fa-right-from-bracket me-1"></i>Sair
            </a>
        </div>
    </div>

    <div class="mb-4">
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link active" href="#">
                    <i class="fa-solid fa-circle-plus me-2"></i>Cadastrar Produto
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="lista.php">
                    <i class="fa-solid fa-boxes-stacked me-2"></i>Lista Produtos
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="perfil.php">
                    <i class="fa-solid fa-user-gear me-2"></i>Meu Perfil
                </a>
            </li>
        </ul>
    </div>

    <div class="card form-card">
        <form action="../../api/controllers/doCadastro_produtos.php" method="POST" enctype="multipart/form-data" id="formProduto">
            
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Nome do Produto:</label>
                    <input type="text" name="nome" class="form-control" placeholder="Ex: Chaveiro" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">País de Origem:</label>
                    <input type="text" name="pais" class="form-control" placeholder="Ex: Brasil" required>
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold">Descrição do Produto:</label>
                    <input type="text" name="descricao" class="form-control" placeholder="Breve resumo sobre o produto..." required>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Área / Categoria:</label>
                    <select class="form-select" name="area" required>
                        <option value="" selected disabled>Escolha...</option>
                        <option value="1">Eletrodomésticos e Portáteis</option>
                        <option value="2">Áudio, Vídeo e Eletrônicos</option>
                        <option value="3">Moda, Calçados e Acessórios</option>
                        <option value="4">Informática e Celulares</option>
                        <option value="5">Livros, HQs e Mangás</option>
                        <option value="6">Beleza e Cuidados Pessoais</option>
                        <option value="7">Casa, Decoração e Banho</option>
                        <option value="8">Esporte e Lazer</option>
                        <option value="9">Brinquedos e Jogos</option>
                        <option value="10">Ferramentas e Manutenção</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Moeda:</label>
                    <select class="form-select" name="moeda" required>
                        <option value="" selected disabled>Escolha...</option>
                        <option value="BRL">R$ - Real</option>
                        <option value="USD">US$ - Dólar</option>
                        <option value="EUR">€ - Euro</option>
                        <option value="JPY">¥ - Iene</option>
                        <option value="KRW">₩ - Won</option>
                        <option value="CNY">¥ - Yuan</option>
                        <option value="GBP">£ - Libra Esterlina</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Preço Unitário:</label>
                    <input type="text" name="preco" class="form-control" placeholder="0.00" required>
                </div>

              <input type="file" name="foto" id="fotoReal" class="d-none">

                <input type="hidden" name="url_imagem" id="hiddenUrlInput">

                <div class="col-12 border-top pt-4">
                    <label class="form-label fw-semibold d-block">Imagem do Produto:</label>
                    <button type="button" class="btn btn-outline-primary rounded-3 px-4" data-bs-toggle="modal" data-bs-target="#imageModal">
                        <i class="fa-solid fa-image me-2"></i>Escolher Imagem
                    </button>
                    <span id="file-status-text" class="text-muted small ms-3">Nenhuma imagem selecionada</span>

                    <div class="preview-container" id="previewContainer">
                        <small class="text-muted d-block mb-1">Pré-visualização do Mimo</small>
                        <img src="" id="imagePreview" class="preview-box" alt="Preview do Produto">
                    </div>
                </div>

                <div class="col-12 d-flex gap-3 justify-content-end border-top pt-4 mt-4">
                    <a href="lista.php" class="btn btn-light btn-action text-muted">
                        Voltar para Lista
                    </a>
                    <button type="submit" class="btn btn-success btn-action text-white">
                        <i class="fa-solid fa-cloud-arrow-up me-2"></i>Cadastrar Item
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="imageModalLabel">Selecione a Imagem</h5>
                <button type="button" class="btn-close" data-bs-shadow="none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs border-bottom mb-3" id="mediaTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active small fw-bold" id="upload-tab" data-bs-toggle="tab" data-bs-target="#uploadPanel" type="button" role="tab">Arquivo Local</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link small fw-bold" id="url-tab" data-bs-toggle="tab" data-bs-target="#urlPanel" type="button" role="tab">Endereço URL</button>
                    </li>
                </ul>
                
                <div class="tab-content" id="mediaTabContent">
                    <div class="tab-pane fade show active" id="uploadPanel" role="tabpanel">
                        <div class="drop-zone" id="dropZone">
                            <i class="fa-solid fa-cloud-arrow-up text-primary fs-1 mb-2"></i>
                            <p class="mb-1 fw-medium text-dark">Arraste a imagem aqui</p>
                            <span class="text-muted small">ou clique para explorar o computador</span>
                        </div>
                    </div>
                    
                    <div class="tab-pane fade" id="urlPanel" role="tabpanel">
                        <div class="mb-3">
                            <label class="form-label small text-muted">Cole o link completo da imagem:</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-link"></i></span>
                               <input type="url" id="imgUrlInput" name="imgUrlInput" class="form-control" placeholder="https://exemplo.com/imagem.jpg">
                            </div>
                        </div>
                        <button type="button" id="btnApplyUrl" class="btn btn-primary w-100 rounded-3 small fw-bold">Confirmar Link</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script type="module" src="../assets/js/pages/cadastro.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.js"></script>
<script src="../assets/js/cropper-profile.js"></script>
<script src="../assets/js/global.js"></script>

</body>
</html>