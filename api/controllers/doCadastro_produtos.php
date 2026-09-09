<?php

    //1) Verifica a sessão.
    require __DIR__ . '/../middleware/verificador.php';
    VerificarLogin();

    //2) Conexão com o banco.
    include __DIR__ . '/../config/conexao.php';
    require_once __DIR__ . '/upload_helper.php';

    //3) Recebe os dados do form.
    $nome      = $_POST['nome'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $area      = (int)($_POST['area'] ?? 0);
    $preco     = (float)str_replace(',', '.', $_POST['preco'] ?? 0);
    $moeda     = $_POST['moeda'] ?? '';
    $pais      = $_POST['pais'] ?? '';
    $foto       = $_FILES['foto'] ?? null;
    $urlExterna = $_POST['url_imagem'] ?? '';

    //4) É aqui que o usuário não preenche as coisas... que usuário bur--(sem ofensas...).
    if (empty($nome) || empty($_POST['preco'])) 
    {
        echo "Erro: Dados obrigatórios do produto não foram preenchidos.";
        exit;
    }

    try 
    {
        $imagem = null;
        if ($foto && $foto['error'] === UPLOAD_ERR_OK) {
            $imagem = salvarImagemLocal($foto);
        } elseif (!empty($urlExterna)) {
            $imagem = baixarImagemDaUrl($urlExterna);
        }

        // 5) Insere o novo produto com os dados recebidos
        $sql = "INSERT INTO produtos (nome, descricao, id_area, preco_uni, moeda, pais_origem, imagem) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "ssissss", $nome, $descricao, $area, $preco, $moeda, $pais, $imagem);
        
        // 6) Verifica se deu certo, se não... Deu pau.
        if (!mysqli_stmt_execute($stmt)) 
        {
            throw new Exception("Erro na execução do cadastro: " . mysqli_stmt_error($stmt));
        }
        mysqli_stmt_close($stmt);

        header("Location: /SistEstoque/public/pages/lista.php?status=cadastrado");
        exit;
    } 

    //7) Se der algum erro, mostra uma mensagem pedindo para tentar de novo... Sempre temos que dar segundas chances, não?
    catch (Exception $e) 
    {
        echo "<h3>Ocorreu um problema ao cadastrar o produto:</h3>";
        echo "<p style='color:red;'>" . htmlspecialchars($e->getMessage()) . "</p>";
        echo "<br><a href='../../public/pages/cadastro_produtos.php'>Tentar Novamente</a>";
        exit;
    }

?>