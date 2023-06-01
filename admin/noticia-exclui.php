<?php 
require_once "../inc/funcoes-sessao.php";
require_once "../inc/funcoes-noticias.php";

verificaAcesso();

// capturando o valor recebido pelo parametro id atraves de URL
$idNoticia = $_GET['id'];

// capturando os dados de quem está logado
$idUsuario = $_SESSION['id'];
$tipoUsuario = $_SESSION['tipo'];

// chamando a funcao que exclui a noticia do BD
excluirNoticia($conexao, $idNoticia, $idUsuario, $tipoUsuario);

// redireciona para pagina de noticias
header("location:noticias.php");