<?php 
require_once "../inc/funcoes-usuarios.php";
require_once "../inc/cabecalho-admin.php";

// capturando o valor recebido pelo parametro id atraves de URL
$id = $_GET['id'];

// chamando a funcao que retorna os dados de um usuario especifico
$usuario = lerUmUsuario($conexao, $id);

// se o botao atualizar for clicado
if(isset($_POST['atualizar'])) {
	// capturando os dados do formulario
	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$tipo = $_POST['tipo'];

	// se o campo senha estiver vazio, mantem a senha atual ou se for preenchido, criptografa a nova senha
	if(empty( $_POST['senha']) || password_verify( $_POST['senha'], $usuario['senha'])) {
		$senha = $usuario['senha'];
	} else {
		$senha = password_hash( $_POST['senha'], PASSWORD_DEFAULT);  // criptografando a senha
	}

	// chamando a funcao que atualiza os dados do usuario no BD
	atualizarUsuario($conexao, $id, $nome, $email, $senha, $tipo);

	// redirecionando para a pagina de usuarios
	header("location:usuarios.php");
}

?>

<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">
		
		<h2 class="text-center">
		Atualizar dados do usuário
		</h2>
				
		<form class="mx-auto w-75" action="" method="post" id="form-atualizar" name="form-atualizar">

			<div class="mb-3">
				<label class="form-label" for="nome">Nome:</label>
				<input class="form-control" type="text" id="nome" name="nome" value="<?=$usuario['nome']?>" required>
			</div>

			<div class="mb-3">
				<label class="form-label" for="email">E-mail:</label>
				<input class="form-control" type="email" id="email" name="email" value="<?=$usuario['email']?>" required>
			</div>

			<div class="mb-3">
				<label class="form-label" for="senha">Senha:</label>
				<input class="form-control" type="password" id="senha" name="senha" placeholder="Preencha apenas se for alterar">
			</div>

			<div class="mb-3">
				<label class="form-label" for="tipo">Tipo:</label>
				<select class="form-select" name="tipo" id="tipo" required>
					<option value=""></option>
					<option value="editor" <?php if($usuario['tipo'] == "editor") echo "selected"; ?>
					>Editor</option>
					<option value="admin" <?php if($usuario['tipo'] == "admin") echo "selected"; ?>
					>Administrador</option>
				</select>
			</div>
			
			<button class="btn btn-primary" name="atualizar"><i class="bi bi-arrow-clockwise"></i> Atualizar</button>
		</form>
		
	</article>
</div>


<?php 
require_once "../inc/rodape-admin.php";
?>

