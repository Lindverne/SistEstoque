<?php

    //1) Verifica a sessão.
    require('../middleware/verificador.php');
    VerificarLogin();

    //2) Conexão com o banco.
    include('../config/conexao.php');

    if (!isset($_GET['id']) || empty($_GET['id'])) 
    {
        header("Location: /SistEstoque/public/pages/lista.php");
        exit;
    }

    $id = (int)$_GET['id'];

    //3) Deleta o produto do banco. Rapído e seguro <3.
    $sql = "DELETE FROM produtos WHERE id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    $result = mysqli_stmt_execute($stmt);

    //4) Verifica se deu certo, se não... Deu pau até no excluir.
    if (!$result) 
    {
        echo "Erro ao excluir o produto!!!<br>" . mysqli_stmt_error($stmt);
    } 

    else 
    {
        mysqli_stmt_close($stmt);
        header("Location: /SistEstoque/public/pages/lista.php?status=deletado");
        exit;
    }

?>