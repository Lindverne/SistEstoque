<?php

function salvarImagemLocal(array $arquivo): string
{
    $diretorio = __DIR__ . '/../../public/assets/img/produtos/';

    if (!is_dir($diretorio)) {
        mkdir($diretorio, 0755, true);
    }

    $extensao = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));

    $nomeArquivo = uniqid('produto_', true) . '.' . $extensao;

    $caminhoFinal = $diretorio . $nomeArquivo;

    if (!move_uploaded_file($arquivo['tmp_name'], $caminhoFinal)) {
        throw new Exception('Não foi possível salvar a imagem.');
    }

    return $nomeArquivo;
}

function baixarImagemDaUrl(string $url): string
{
    $conteudo = @file_get_contents($url);

    if ($conteudo === false) {
        throw new Exception('Não foi possível baixar a imagem.');
    }

    $diretorio = __DIR__ . '/../../public/assets/img/produtos/';

    if (!is_dir($diretorio)) {
        mkdir($diretorio, 0755, true);
    }

    $mime = @mime_content_type($url);

    $extensao = match ($mime) {
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/webp' => 'webp',
        'image/gif' => 'gif',
        default => 'jpg'
    };

    $nomeArquivo = uniqid('produto_', true) . '.' . $extensao;

    file_put_contents(
        $diretorio . $nomeArquivo,
        $conteudo
    );

    return $nomeArquivo;
}