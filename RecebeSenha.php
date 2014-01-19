<?php

session_start();
if (sha1($_POST['senha-atual']) != $_SESSION['senha-atual']) {
    header("location: alterarSenha.php?p=erro", true);
} else {
    include('conexao.php');

    if (isset($_SESSION['usuario']) && $_SESSION['usuario'] == 'professor') {
        $id = $_SESSION['usuario'];
    }
    else
        $id = $_SESSION['cpf'];

    if ($_POST['senha'] != "" && $_POST['senha'] == $_POST['re-senha'])
        $senha = sha1($_POST['senha']);

    // monta a chamada 
    if($id != 'professor')
        $sql = "UPDATE dados_aluno SET senha='$senha' WHERE cpf_passaporte=$id";
    else
        $sql = "UPDATE dados_admin SET senha='$senha' WHERE usuario='$id'";

    $ok = mysql_query($sql);

    if ($ok) {
        include("sucessoAltSenha.php");
    } else {
        include("erro.php");
    }
    //fechar a conexao
    mysql_close();
} // fim else
?>


