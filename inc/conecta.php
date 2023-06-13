<?php
// parâmetros de acesso ao servidor de banco de dados MySQL

// acesso local (XAMPP)
// $servidor = 'localhost';
// $usuario = 'root';
// $senha = '';
// $banco = 'microblog-valeska';

// acesso remoto
$servidor = 'localhost';
$usuario = 'wlvntvzg_microblog';
$senha = 'valeska1234#';
$banco = 'wlvntvzg_microblog';

// usando a funcao mysqli_connect para se conectar ao servidor
$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);
// Definindo o charset como utf8 tambem para a comunicacao com o banco de dados
mysqli_set_charset($conexao, 'utf8');

// teste de conexao
if(!$conexao) {
    die(mysqli_connect_error($conexao));
} // else {
//     echo "<p>Conectado com sucesso!<p>";
// }