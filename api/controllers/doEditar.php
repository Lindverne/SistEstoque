<?php

    //1) Verifica a sessão.
    require __DIR__ . '/../middleware/verificador.php';
    VerificarLogin();

    //2) Conexão com o banco.
    include __DIR__ . '/../config/conexao.php';
    require_once __DIR__ . '/upload_helper.php';

    $id = $_GET['id'] ?? null;
    if (!$id) { echo "ID do produto não encontrado."; exit; }

    //3) Recebe os dados do form.
    $nome = $_POST['nome'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $area = (int)$_POST['area'];
    $preco = (float)str_replace(',', '.', $_POST['preco'] ?? 0);
    $moeda = $_POST['moeda'] ?? '';
    $pais = $_POST['pais'] ?? '';

    $foto = $_FILES['foto'] ?? null;
    $urlExterna = trim($_POST['url_imagem'] ?? '');

    //4) Verifica se os campos obrigatórios estão preenchidos
    $sqlImg = "SELECT imagem FROM produtos WHERE id = ?";
    $stmtImg = mysqli_prepare($con, $sqlImg);
    mysqli_stmt_bind_param($stmtImg, "i", $id);
    mysqli_stmt_execute($stmtImg);
    $resImg = mysqli_stmt_get_result($stmtImg);
    $rowImg = mysqli_fetch_assoc($resImg);
    $imagemAtual = $rowImg['imagem'] ?? '';
    mysqli_stmt_close($stmtImg);

    $imagem = $imagemAtual;
    if ($foto && ($foto['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_OK) {
        $imagem = salvarImagemLocal($foto);
    } elseif (!empty($urlExterna)) {
        $imagem = baixarImagemDaUrl($urlExterna);
    }

    //5) Atualiza o produto com os novos dados fresquinhos
    $sqlUp = "UPDATE produtos SET nome=?, descricao=?, id_area=?, preco_uni=?, moeda=?, pais_origem=?, imagem=? WHERE id = ?";
    $stmtUp = mysqli_prepare($con, $sqlUp);
    mysqli_stmt_bind_param($stmtUp, "ssissssi", $nome, $descricao, $area, $preco, $moeda, $pais, $imagem, $id);
    $result = mysqli_stmt_execute($stmtUp);

    //6) Verifica se deu certo, se não... Deu pau de novo, ueba.
    if (!$result) 
    {
        echo "Erro ao atualizar produto!!!<br>" . mysqli_stmt_error($stmtUp);
    } 

    else 
    {
        mysqli_stmt_close($stmtUp);
        header("Location: /SistEstoque/public/pages/lista.php?status=atualizado");
        exit;
    }

?>