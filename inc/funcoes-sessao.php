<?php 
/* Sessões no PHP
Recurso usado para o controle de acesso à determinadas páginas e/ou recursos do site.
Exemplo: área administrativa, carrinho de compras, etc.

Nestas áreas, o acesso só possível mediante alguma forma de autenticação.
Exemplo: login e senha. */

// se não existir uma sessão em funcionamento, inicia uma nova sessão
if(!isset($_SESSION)) {
    // inicia uma nova sessão
    session_start();
}

// função para verificar se o usuário está logado
function verificaAcesso() {
    // se não existir a variável de sessão baseada no 'id' do usuario, significa que o usuário não está logado
    if(!isset($_SESSION['id'])) {

        // destrói a sessão
        session_destroy();

        // redireciona para a página de login
        header("location:../login.php");

        // interrompe a execução do script
        exit;
    } 
}

function login($id, $nome, $tipo) {
    //criacao de variaveis de sessao
    $_SESSION['id'] = $id;
    $_SESSION['nome'] = $nome;
    $_SESSION['tipo'] = $tipo;

    // as variaveis de sessao ficam disponiveis para todas as paginas do site,
    // enquanto o navegador estiver aberto
}

function logout() {
    session_start();
    session_destroy();
    header("location:../login.php?logout");
    exit;
}
?>