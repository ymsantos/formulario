<?php

include('conexao.php');
session_start();
?>


<?php

$cpf = $_POST['cpf'];
$identidade = $_POST['identidade'];

$sql = "SELECT * FROM dados_aluno WHERE cpf_passaporte=$cpf OR identidade='$identidade'";
$rs = mysql_query($sql);
$dados = mysql_fetch_array($rs);

if (mysql_num_rows($rs)){
    //include("sucessoSenha.php");
    
    $from = "From: nahimsouza@gmail.com";
    $to = "nahimsouza@yahoo.com.br";
    $subject = "PPGCCS - Recuperação da Senha";
    $message = "Testando a email para recuperar a senha do PPGCCS";
    
    ini_set('SMTP',localhost);
    ini_set('smtp_port',25);
    ini_set('send_mail_from','nahimsouza@gmail.com');
    
    mail($to, $subject, $message, $from);

} else {
    header("location: esqueci.php?p=erroCadastro");
}

//fechar a conexao
mysql_close();
?>


