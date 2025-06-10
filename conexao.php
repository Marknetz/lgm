<?php
// Mude os valores abaixo conforme a configuração do seu servidor
$servidor = "localhost";
$usuario_bd = "root";
$senha_bd = "";
$banco = "img_streetwear";

// Cria a conexão
$conexao = mysqli_connect($servidor, $usuario_bd, $senha_bd, $banco);

// Checa a conexão
if (!$conexao) {
    die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
}

// Garante que a comunicação seja em UTF-8
mysqli_set_charset($conexao, "utf8mb4");
?>