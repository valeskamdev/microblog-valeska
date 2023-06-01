<?php
require "inc/cabecalho.php"; 
require "inc/funcoes-noticias.php";

// pegando o id da noticia que foi passado pela URL
$idNoticia = $_GET['id'];

// chamando a funcao que retorna os detalhes da noticia
$noticia = lerDetalhes($conexao, $idNoticia); 
?>  

<div class="row my-1 mx-md-n1">

    <article class="col-12">
        <h2><?=$noticia['titulo']?></h2>
        <p class="font-weight-light">
            <time><?=formatarData($noticia['data'])?></time> - <span><?=$noticia['nome']?></span>
        </p>
        <img src="imagem/<?=$noticia['imagem']?>" alt="" class="float-start pe-2 img-fluid">
        <p><?=nl2br($noticia['texto'])?></p>
    </article>
    

</div>        

<?php 
require_once "inc/rodape.php";
?>

