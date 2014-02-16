<?php

session_start();

include('conexao.php');

$id = $_POST['pa'];

if ($_POST['senha'] != "" && $_POST['senha'] == $_POST['re-senha'])
    $senha = sha1($_POST['senha']);

// monta a chamada 
$sql = "UPDATE dados_aluno SET senha='$senha' WHERE cpf_passaporte=$id";

$ok = mysql_query($sql);

if ($ok) {
    include("sucessoNovaSenha.php");
} else {
    include("erro.php");
}
//fechar a conexao
mysql_close();

?>


