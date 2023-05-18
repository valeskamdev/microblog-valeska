<?php
require_once "../inc/funcoes-usuarios.php";

// capturando o valor recebido pelo parâmetro id atráves de \url
$id = $_GET['id'];

// chamando a função que exclui o usuário do BD
excluirUsuario($conexao, $id);

// redirecionando para a página de usuários
header("location: usuarios.php")
?>