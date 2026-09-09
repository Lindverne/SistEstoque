<?php

    require __DIR__ . '/../../api/middleware/verificador.php';
    VerificarLogin();

    include __DIR__ . '/../../api/config/conexao.php';

    require_once __DIR__ . '/../../api/helpers/bandeiras_helper.php';

    $filtro_id  = $_GET['filtro_id'] ?? '';
    $filtro_cat = $_GET['filtro_cat'] ?? '';
    $filtro_ord = $_GET['filtro_ord'] ?? '';

    $itensPorPagina = 5;
    $paginaAtual    = max(1, (int)($_GET['pagina'] ?? 1));

    $sqlTotal   = "SELECT COUNT(*) as total FROM produtos WHERE 1=1";
    $paramsTotal = [];
    $typesTotal  = '';

    if (!empty($filtro_id)) 
    {
        $sqlTotal   .= " AND id = ?";
        $paramsTotal[] = (int)$filtro_id;
        $typesTotal   .= 'i';
    }

    if (!empty($filtro_cat)) 
    {
        $sqlTotal   .= " AND id_area = ?";
        $paramsTotal[] = (int)$filtro_cat;
        $typesTotal   .= 'i';
    }

    $stmtTotal = mysqli_prepare($con, $sqlTotal);
    if (!empty($typesTotal))
    {
        mysqli_stmt_bind_param($stmtTotal, $typesTotal, ...$paramsTotal);
    }

    mysqli_stmt_execute($stmtTotal);
    $totalRegistros = mysqli_fetch_assoc(mysqli_stmt_get_result($stmtTotal))['total'];
    $totalPaginas   = max(1, (int)ceil($totalRegistros / $itensPorPagina));
    $paginaAtual    = min($paginaAtual, $totalPaginas);
    $offset         = ($paginaAtual - 1) * $itensPorPagina;

    $sqlProdutos  = "SELECT * FROM produtos WHERE 1=1";
    $paramsList   = [];
    $typesList    = '';

    if (!empty($filtro_id)) 
    {
        $sqlProdutos .= " AND id = ?";
        $paramsList[]  = (int)$filtro_id;
        $typesList    .= 'i';
    }
    if (!empty($filtro_cat)) 
    {
        $sqlProdutos .= " AND id_area = ?";
        $paramsList[]  = (int)$filtro_cat;
        $typesList    .= 'i';
    }

    if ($filtro_ord === 'preco_asc') 
    {
        $sqlProdutos .= " ORDER BY preco_uni ASC";
    } 
    
    elseif ($filtro_ord === 'preco_desc')
    {
        $sqlProdutos .= " ORDER BY preco_uni DESC";
    } 
    
    else 
    {
        $sqlProdutos .= " ORDER BY id DESC";
    }

    $sqlProdutos .= " LIMIT ? OFFSET ?";
    $paramsList[]  = $itensPorPagina;
    $typesList    .= 'i';

    $paramsList[]  = $offset;
    $typesList    .= 'i';

    $stmtLista = mysqli_prepare($con, $sqlProdutos);
    mysqli_stmt_bind_param($stmtLista, $typesList, ...$paramsList);

    mysqli_stmt_execute($stmtLista);
    $produtos = mysqli_stmt_get_result($stmtLista);

    function gerarUrlPagina(int $pagina): string 
    {
        $p           = $_GET;
        $p['pagina'] = $pagina;
        return '?' . http_build_query($p);
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Listinha | SistEstoque</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.0.0/css/flag-icons.min.css"/>

    <link rel="stylesheet" href="../assets/css/pages/lista.css">
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/frieren_cute.ico">
</head>
<body>

<div class="container mt-5">

    <div class="hero-card p-4 mb-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
        <div>
            <h1 class="h3 fw-bold text-dark m-0">Listagem de Produtos</h1>
            <p class="text-muted small m-0">Gerencie seu catálogo de mimos fofos!</p>
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

    <div class="row g-3 align-items-center mb-4">

        <div class="mb-4">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link" href="cadastro_produtos.php">
                        <i class="fa-solid fa-circle-plus text-success me-2"></i>Cadastrar Produto
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#">
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

        <div class="col-md-7 col-12">
            <form method="GET" action="lista.php" class="row g-2 justify-content-md-end align-items-center">
                <div class="col-sm-3 col-6">
                    <input type="number" name="filtro_id"
                           class="form-control form-control-sm border rounded-3"
                           placeholder="Filtrar ID"
                           value="<?= htmlspecialchars($filtro_id) ?>">
                </div>
                <div class="col-sm-4 col-6">
                    <select name="filtro_cat" class="form-select form-select-sm border rounded-3">
                        <option value="">Todas as Categorias...</option>
                        <option value="1"  <?= $filtro_cat == '1'  ? 'selected' : '' ?>>Eletrodomésticos e Portáteis</option>
                        <option value="2"  <?= $filtro_cat == '2'  ? 'selected' : '' ?>>Áudio, Vídeo e Eletrônicos</option>
                        <option value="3"  <?= $filtro_cat == '3'  ? 'selected' : '' ?>>Moda, Calçados e Acessórios</option>
                        <option value="4"  <?= $filtro_cat == '4'  ? 'selected' : '' ?>>Informática e Celulares</option>
                        <option value="5"  <?= $filtro_cat == '5'  ? 'selected' : '' ?>>Livros, HQs e Mangás</option>
                        <option value="6"  <?= $filtro_cat == '6'  ? 'selected' : '' ?>>Beleza e Cuidados Pessoais</option>
                        <option value="7"  <?= $filtro_cat == '7'  ? 'selected' : '' ?>>Casa, Decoração e Banho</option>
                        <option value="8"  <?= $filtro_cat == '8'  ? 'selected' : '' ?>>Esporte e Lazer</option>
                        <option value="9"  <?= $filtro_cat == '9'  ? 'selected' : '' ?>>Brinquedos e Jogos</option>
                        <option value="10" <?= $filtro_cat == '10' ? 'selected' : '' ?>>Ferramentas e Manutenção</option>
                    </select>
                </div>
                <div class="col-sm-3 col-8">
                    <select name="filtro_ord" class="form-select form-select-sm border rounded-3">
                        <option value="">Preço...</option>
                        <option value="preco_asc"  <?= $filtro_ord == 'preco_asc'  ? 'selected' : '' ?>>Menor preço</option>
                        <option value="preco_desc" <?= $filtro_ord == 'preco_desc' ? 'selected' : '' ?>>Maior preço</option>
                    </select>
                </div>
                <div class="col-sm-2 col-4 d-grid">
                    <button type="submit" class="btn btn-sm btn-primary text-white rounded-3">
                        <i class="fa-solid fa-filter"></i>
                    </button>
                </div>
            </form>
        </div>

    </div>

        <div class="card main-card bg-white">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-muted fw-semibold" style="text-transform: uppercase; font-size: 0.75rem;">
                        <tr>
                            <th class="ps-4">ID</th>
                            <th>Foto</th>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Área</th>
                            <th>Preço</th>
                            <th>País</th>
                            <th class="text-center pe-4">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($linha = mysqli_fetch_array($produtos)): ?>
                        <tr>
                            <td class="ps-4 text-muted fw-medium">#<?= $linha['id'] ?></td>
                            <td>
                                <?php
                                    $caminhoImagem = !empty($linha['imagem'])
                                        ? '../assets/img/produtos/' . $linha['imagem']
                                        : '../assets/img/favicon/frieren_cute.ico';
                                ?>
                                <img src="<?= htmlspecialchars($caminhoImagem) ?>"
                                    class="product-img border shadow-sm item-zoom-trigger"
                                    alt="Produto"
                                    data-product-name="<?= htmlspecialchars($linha['nome']) ?>"
                                    onerror="this.onerror=null;this.src='../assets/img/favicon/frieren_cute.ico';">
                            </td>
                            <td><span class="fw-bold text-dark"><?= htmlspecialchars($linha['nome']) ?></span></td>
                            <td><span class="text-muted small"><?= htmlspecialchars($linha['descricao']) ?></span></td>
                            <td>
                                <span class="badge bg-secondary-subtle text-secondary px-2 py-1 rounded-3">
                                    Categoria <?= $linha['id_area'] ?>
                                </span>
                            </td>
                            <td class="fw-bold text-success">
                                <div class="d-flex align-items-center gap-1" style="white-space:nowrap;">
                                    <span><?= htmlspecialchars($linha['moeda']) ?></span>
                                    <span><?= number_format((float)$linha['preco_uni'], 2, ',', '.') ?></span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-1 text-dark" style="white-space:nowrap;">
                                    <?= obterBandeiraPais($linha['pais_origem']) ?>
                                    <span class="small"><?= htmlspecialchars($linha['pais_origem']) ?></span>
                                </div>
                            </td>
                            <td class="text-center pe-4">
                                <div class="btn-group btn-group-sm rounded-3 overflow-hidden shadow-sm">
                                    <a href="editar.php?id=<?= $linha['id'] ?>" class="btn btn-white border-end" title="Editar">
                                        <i class="fa-solid fa-pen-to-square text-warning"></i>
                                    </a>
                                    <button type="button" class="btn btn-white" title="Excluir"
                                            onclick="confirmarExclusao(<?= $linha['id'] ?>)">
                                        <i class="fa-solid fa-trash-can text-danger"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php if ($totalPaginas > 1): ?>
        <nav aria-label="Navegação de páginas" class="mt-4 mb-5">
            <ul class="pagination justify-content-center">
                <li class="page-item <?= $paginaAtual <= 1 ? 'disabled' : '' ?>">
                    <a class="page-link rounded-start-3" href="<?= gerarUrlPagina($paginaAtual - 1) ?>">
                        <i class="fa-solid fa-chevron-left fa-xs"></i>
                    </a>
                </li>
                <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                    <li class="page-item <?= $paginaAtual === $i ? 'active' : '' ?>">
                        <a class="page-link" href="<?= gerarUrlPagina($i) ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?= $paginaAtual >= $totalPaginas ? 'disabled' : '' ?>">
                    <a class="page-link rounded-end-3" href="<?= gerarUrlPagina($paginaAtual + 1) ?>">
                        <i class="fa-solid fa-chevron-right fa-xs"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <?php endif; ?>

    </div>

    <div class="modal fade" id="previewFotoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content border-0 shadow-lg overflow-hidden" style="border-radius: 20px;">
                <div class="modal-header border-0 px-4 pt-4 pb-2 position-relative">
                    <h5 class="modal-title fw-bold text-dark w-100 text-center" id="modalNomeProduto">
                        Nome do Produto
                    </h5>
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-3"
                            data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body p-0 d-flex justify-content-center align-items-center"
                    style="background: #f8f9fb; min-height: 300px;">
                    <img src="" id="modalImgPerfeita"
                        class="img-fluid"
                        style="max-height: 460px; object-fit: contain; width: 100%;"
                        alt="Foto do Produto">
                </div>
                <div class="modal-footer border-0 d-flex justify-content-center pb-4 pt-3"
                    style="background: #f8f9fb;">
                    <button type="button" class="btn btn-primary px-5 fw-semibold rounded-3"
                            data-bs-dismiss="modal">Sair</button>
                </div>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="../assets/js/pages/lista.js"></script>
<script src="../assets/js/global.js"></script>
</body>
</html>
