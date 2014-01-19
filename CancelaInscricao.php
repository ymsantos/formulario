<?php

include('conexao.php');
session_start();
?>


<?php

$id = $_SESSION['cpf'];
$sql = "DELETE FROM dados_aluno WHERE cpf_passaporte=$id";
$ok = mysql_query($sql);

if ($ok) {
    include("sucessoRemocao.php");
} else {
    echo "Usuário não deletado!";
}

//fechar a conexao
mysql_close();
?>
