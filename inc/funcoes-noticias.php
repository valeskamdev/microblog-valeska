<?php
require_once "conecta.php";

// usada em noticia-insere.php
function inserirNoticia($conexao, $titulo, $texto, $resumo, $imagem, $idUsuarioLogado) {
    $sql = "INSERT INTO noticias(titulo, texto, resumo, imagem, usuario_id) VALUES ('$titulo', '$texto', '$resumo', '$imagem', $idUsuarioLogado)";
    mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
}

// usada em noticia-insere.php e noticia-atualiza.php
function upload($arquivo){
    // array com os tipos de arquivos permitidos
    $tiposValidos = ["image/png", "image/jpeg", "image/gif","image/svg+xml"];

    // verifica se o tipo do arquivo enviado está dentro do array de tipos permitidos
    if( !in_array($arquivo['type'], $tiposValidos) ){
        echo "<script>alert('Formato inválido!'); history.back();</script>";
        exit;
    }   

    // extraindo do arquivo apenas o 'name'
    $nome = $arquivo['name'];

    // extraindo o diretorio/nome temporario do arquivo
    $temporario = $arquivo['tmp_name'];

    // definindo o destino do arquivo
    $destino = "../imagem/".$nome;
    
    // movendo o arquivo do diretorio temporario para o destino
    move_uploaded_file($temporario, $destino);
}

// usada em noticias.php
function lerNoticias($conexao){
    // relacionando as tabelas noticias e usuarios para obter o nome do autor da noticia
    $sql = "SELECT noticias.id, noticias.titulo, noticias.data, usuarios.nome FROM noticias INNER JOIN usuarios ON noticias.usuario_id = usuarios.id ORDER BY `noticias`.`data` ASC";
    $resultado = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
    
    $noticias = [];

    // percorrendo o resultado da consulta e armazenando no array $noticias
    while ($noticia = mysqli_fetch_assoc($resultado)) {
        // adicionando cada noticia no array '$noticias'
        array_push($noticias, $noticia);
    }

    // retornando o array com todas as noticias
    return $noticias;
}