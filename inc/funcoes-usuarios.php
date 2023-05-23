<?php
// carregando o script de acesso ao BD
require "conecta.php";

// usada em admin/usuario-insere.php
function inserirUsuario($conexao, $nome, $email, $senha, $tipo) {
    // variavel que armazena o comando SQL, com os dados do formulário
    $sql = "INSERT INTO usuarios(nome, email, senha, tipo) VALUES ('$nome', '$email', '$senha', '$tipo')";

    // executando o comando SQL
    mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
}

// usada em admin/usuario.php
function lerUsuarios($conexao) {
    $sql = "SELECT id, nome, email, tipo FROM usuarios ORDER BY nome";

    // armazenando o resultado da operação de consulta SELECT
    $resultado = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));

    // criando um array para armazenar os dados de todos os usuarios
    $usuarios = [];

    // percorrendo o resultado da consulta e armazenando no array $usuarios.
    // cada linha do array $usuarios é um array associativo com os dados de um usuario
    // ex: $usuarios[0]['nome'] retorna o nome do primeiro usuario
    // ex: $usuarios[1]['email'] retorna o email do segundo usuario
    // ex: $usuarios[2]['tipo'] retorna o tipo do terceiro usuario
    // e assim por diante...
    
    while ($usuario = mysqli_fetch_assoc($resultado)) {
        array_push($usuarios, $usuario);
    }

    // retornando o array com todos os usuarios
    return $usuarios;
}

// usada em admin/usuario-exclui.php
function excluirUsuario($conexao, $id) {
    // comando de exclusao passando a condicao ()WHERE) o id do usuario que sera excluido
    $sql = "DELETE FROM usuarios WHERE id = $id";
    mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
}

// usada em usuario-atualiza.php
// retorna os dados de um usuario especifico 
function lerUmUsuario($conexao, $id) {
    $sql = "SELECT * FROM usuarios WHERE id = $id";
    $resultado = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
    return mysqli_fetch_assoc($resultado);
}

// usada em usuario-atualiza.php
// atualiza os dados de um usuario especifico
function atualizarUsuario($conexao, $id, $nome, $email, $senha, $tipo) {
    $sql = "UPDATE usuarios SET nome = '$nome', email = '$email', senha = '$senha', tipo = '$tipo' WHERE id = $id";
    mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
}   