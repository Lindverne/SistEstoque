<?php 

        //1) Verificando a sessão.
        if (!isset($_SESSION)) 
        {
        session_start();
        }

        //2) Se a pessoa estiver logada, vai para o lista.
        if (isset($_SESSION['login'])) 
        {
        header("Location: pages/lista.php");
        exit;
        }

        //2.1) Se não, vai para o login.
        header("Location: pages/login.php");
        exit;

?>