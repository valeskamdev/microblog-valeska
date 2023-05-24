<?php
require_once "../inc/funcoes-sessao.php";
require_once "../inc/funcoes-usuarios.php";

// verificando se o usuario logado não é admin, se não for,
// redireciona para a página de não autorizado
if($_SESSION['tipo'] != 'admin') {
	header("location:nao-autorizado.php");
	exit;
}

verificaAcesso();

// capturando o valor recebido pelo parâmetro id atráves de \url
$id = $_GET['id'];

// chamando a função que exclui o usuário do BD
excluirUsuario($conexao, $id);

// redirecionando para a página de usuários
header("location: usuarios.php")
?>