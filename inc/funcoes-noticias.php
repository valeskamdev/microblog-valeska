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
function lerNoticias($conexao, $idUsuarioLogado, $tipoUsuarioLogado){

    // se o usuario logado for admin, exibe todas as noticias
    if($tipoUsuarioLogado == 'admin'){
        // relacionando as tabelas noticias e usuarios para obter o nome do autor da noticia
        $sql = "SELECT noticias.id, noticias.titulo, noticias.data, usuarios.nome FROM noticias INNER JOIN usuarios ON noticias.usuario_id = usuarios.id ORDER BY `noticias`.`data` DESC";
    } else {
        // se o usuario logado for autor, exibe apenas as noticias criadas por ele
        $sql = "SELECT * FROM noticias WHERE usuario_id = $idUsuarioLogado ORDER BY data DESC";
    }

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

// usada em noticias.php e paginas da area publica
function formatarData($data){
    // convertendo a data do formato do BD para o formato brasileiro
    return date('d/m/Y H:i', strtotime($data));
}

// usada em noticia-atualiza.php
function lerUmaNoticia($conexao, $idNoticia, $idUsuarioLogado, $tipoUsuarioLogado){
    // se o usuario logado for admin, exibe todas as noticias
    if($tipoUsuarioLogado == 'admin'){
        // sql do admin: carrega os dados de qualquer noticia
        $sql = "SELECT * FROM noticias WHERE id = $idNoticia";
    } else {
        // sql do editor, 'exibe apenas as noticias criadas por ele
        $sql = "SELECT * FROM noticias WHERE id = $idNoticia AND usuario_id = $idUsuarioLogado";
    }

    $resultado = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
    
    // retornando a noticia encontrada
    return mysqli_fetch_assoc($resultado);
}

// usada em noticia-atualiza.php
function atualizarNoticia($conexao, $titulo, $texto, $resumo, $imagem, $idNoticia, $idUsuarioLogado, $tipoUsuarioLogado) {

    $sql = "UPDATE noticias SET titulo = '$titulo', texto = '$texto', resumo = '$resumo', imagem = '$imagem'";

    // se o usuario logado for admin, atualiza qualquer noticia
    if($tipoUsuarioLogado == 'admin'){
        // sql do admin: atualiza os dados de qualquer noticia
        $sql .= " WHERE id = $idNoticia";
    } else {
        // sql do editor, atualiza apenas as noticias criadas por ele
        $sql .= " WHERE id = $idNoticia AND usuario_id = $idUsuarioLogado";
    }

    mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
}

// usada em noticia-exclui.php
function excluirNoticia($conexao, $idNoticia, $idUsuarioLogado, $tipoUsuarioLogado) {
    // se o usuario logado for admin, exclui qualquer noticia
    if($tipoUsuarioLogado == 'admin'){
        // sql do admin: exclui qualquer noticia
        $sql = "DELETE FROM noticias WHERE id = $idNoticia";
    } else {
        // sql do editor, exclui apenas as noticias criadas por ele
        $sql = "DELETE FROM noticias WHERE id = $idNoticia AND usuario_id = $idUsuarioLogado";
    }

    mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
}

/* FUNCOES USADAS NAS PAGINAS DA AREA PUBLICA */

// usada em index.php
function lerTodasAsNoticias($conexao){
    $sql = "SELECT * FROM noticias ORDER BY data DESC";
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

// usada em noticia.php
function lerDetalhes($conexao, $id){
    $sql = "SELECT noticias.id, noticias.titulo, noticias.texto, noticias.data, noticias.imagem, usuarios.nome FROM noticias INNER JOIN usuarios ON noticias.usuario_id = usuarios.id WHERE noticias.id = $id";

    $resultado = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));

    // retornando a noticia encontrada
    return mysqli_fetch_assoc($resultado);
}

function buscar($conexao, $termo){
    $sql = "SELECT * FROM noticias WHERE titulo LIKE '%$termo%' OR texto LIKE '%$termo%' OR resumo LIKE '%$termo%' ORDER BY data DESC";

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