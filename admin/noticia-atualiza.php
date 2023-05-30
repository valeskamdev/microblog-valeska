<?php
require_once "../inc/funcoes-noticias.php";
require_once "../inc/cabecalho-admin.php";

// capturando o valor recebido pelo parametro id atraves de URL
$idNoticia = $_GET['id'];

// capturando os dados de quem está logado
$idUsuario = $_SESSION['id'];
$tipoUsuario = $_SESSION['tipo'];

// chamando a funcao que retorna os dados de uma noticia especifica
$noticia = lerUmaNoticia($conexao, $idNoticia, $idUsuario, $tipoUsuario);

// se o botao atualizar for clicado
if(isset($_POST['atualizar'])) {
    $titulo = $_POST['titulo'];
    $texto = $_POST['texto'];
    $resumo = $_POST['resumo'];

    // algorítmo para atualizar a imagem (se o usuário selecionar uma nova imagem)

    if(empty($_FILES['imagem']['name'])) {
        // se o usuário não selecionar uma nova imagem, mantém a imagem existente
        $imagem = $_POST['imagem-existente'];
    } else {
        // se o usuário selecionar uma nova imagem, faz o upload da nova imagem
        $imagem = $_FILES['imagem']['name'];
        upload($_FILES['imagem']); //envio da imagem para o servidor
    }

    // chamando a funcao que atualiza os dados da noticia
    atualizarNoticia($conexao, $titulo, $texto, $resumo, $imagem, $idNoticia, $idUsuario, $tipoUsuario);

    // redirecionando para a página de notícias
    header("location:noticias.php");
}

?>



<div class="row">
    <article class="col-12 bg-white rounded shadow my-1 py-4">

        <h2 class="text-center">
            Atualizar dados da notícia
        </h2>

        <!-- ATRIBUTO ENCTYPE VALENDO MULTIPART/FORM-DATA NESSESÁRIO em formulários que receberão
			ARQUIVOS (imagens, documentos, pdf's, planilhas) para processamento -->
        <form enctype="multipart/form-data" class="mx-auto w-75" action="" method="post" id="form-atualizar" name="form-atualizar">

            <div class="mb-3">
                <label class="form-label" for="titulo">Título:</label>
                <input class="form-control" required type="text" id="titulo" name="titulo" value="<?=$noticia['titulo']?>">
            </div>

            <div class="mb-3">
                <label class="form-label" for="texto">Texto:</label>
                <textarea class="form-control" required name="texto" id="texto" cols="50" rows="6"><?=$noticia['texto']?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label" for="resumo">Resumo (máximo de 300 caracteres):</label>
                <span id="maximo" class="badge bg-danger">0</span>
                <textarea class="form-control" required name="resumo" id="resumo" cols="50" rows="2" maxlength="300"><?=$noticia['resumo']?></textarea>
            </div>

            <div class="mb-3">
                <label for="imagem-existente" class="form-label">Imagem da notícia:</label>
                <!-- campo somente leitura, meramente informativo -->
                <input class="form-control" type="text" id="imagem-existente" name="imagem-existente" value="<?=$noticia['imagem']?>" readonly>
            </div>

            <div class="mb-3">
                <label for="imagem" class="form-label">Caso queira mudar, selecione outra imagem:</label>
                <input class="form-control" type="file" id="imagem" name="imagem" accept="image/png, image/jpeg, image/gif, image/svg+xml">
            </div>

            <button class="btn btn-primary" name="atualizar"><i class="bi bi-arrow-clockwise"></i> Atualizar</button>
        </form>

    </article>
</div>


<?php
require_once "../inc/rodape-admin.php";
?>