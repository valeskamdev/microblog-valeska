<?php
require_once "inc/funcoes-usuarios.php";
require_once "inc/funcoes-sessao.php";
require "inc/cabecalho.php"; 

/* se houver o parâmetro 'campos_obrigatorios' na URL,
 significa que o formulário foi enviado sem os campos preenchidos */
if(isset($_GET["campos_obrigatorios"])) {
	// mensagem de feedback
	$mensagem = "Você deve preecher e-mail e senha!";
} else if(isset($_GET["dados_incorretos"])) {
	// mensagem de feedback
	$mensagem = "Dados incorretos, verifique e-mail e/ou senha!";
} else if(isset($_GET["logout"])) {
	$mensagem = "Você saiu do sistema!";
}
?>

<div class="row">
    <div class="bg-white rounded shadow col-12 my-1 py-4">
    <h2 class="text-center fw-light">Acesso à área administrativa</h2>

        <form action="" method="post" id="form-login" name="form-login" class="mx-auto w-50" autocomplete="off">
				<?php if(isset($mensagem)) { ?>
				<p class="my-2 alert alert-warning text-center">
					<?=$mensagem?>
				</p>  
				
				<?php } ?>

				<div class="mb-3">
					<label for="email" class="form-label">E-mail:</label>
					<input class="form-control" type="email" id="email" name="email">
				</div>
				<div class="mb-3">
					<label for="senha" class="form-label">Senha:</label>
					<input class="form-control" type="password" id="senha" name="senha">
				</div>

				<button class="btn btn-primary btn-lg" name="entrar" type="submit">Entrar</button>

		</form>

		<?php
		// se o botão 'entrar' foi clicado
		if(isset($_POST['entrar'])) {
			
			//verificando se os campos foram preenchidos
			if(empty($_POST["email"]) || empty($_POST["senha"])) {
				header("location:login.php?campos_obrigatorios");
				exit(); // ou die()
			}

			// capturando os dados do formulário
			$email = $_POST["email"];
			$senha = $_POST["senha"];

			// buscando o usuário no BD
			$dadosUsuario = buscaUsuario($conexao, $email);

			// se o usuário não foi encontrado
			if($dadosUsuario != null && password_verify($senha, $dadosUsuario["senha"])) {
				// cria a sessão do usuário
				login($dadosUsuario["id"], $dadosUsuario["nome"], $dadosUsuario["tipo"]);
				// redireciona para a página inicial da área administrativa
				header("location:admin/index.php");
				exit();
			} else {
				// se o usuário não foi encontrado, permanece na página de login
				header("location:login.php?dados_incorretos");
				exit();
			}
		}
		
		
		?>

    </div>
    
    
</div>        

<?php 
require_once "inc/rodape.php";
?>

