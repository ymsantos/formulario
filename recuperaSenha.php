<?php

include('conexao.php');
include ('MailSender.php');
session_start();
?>


<?php

$cpf = $_POST['cpf'];
$identidade = $_POST['identidade'];

$sql = "SELECT * FROM dados_aluno WHERE cpf_passaporte=$cpf AND identidade='$identidade'";
$rs = mysql_query($sql);
$dados = mysql_fetch_array($rs);

$id = $dados['cpf_passaporte'];
$hash = $dados['senha'];

if (mysql_num_rows($rs)){
    //include("sucessoSenha.php");
    
    // $from = "From: jonas.jmsantos@gmail.com";
    // $to = "jonas.jms@live.com";
    // $subject = "PPGCM - Recuperação da Senha";
    // $message = "Testando a email para recuperar a senha do PPGCM";
    
    // ini_set('SMTP',localhost);
    // ini_set('smtp_port',25);
    // ini_set('send_mail_from','jonas.jmsantos@gmail.com');
    
    // mail($to, $subject, $message, $from, "-r");
    
    $email = new MailSender;
    
    $emailDest = (string)$dados["email"];
    $nomeDest = (string)$dados["nome_aluno"];
    $email->setDestino($emailDest);
    $email->setAssunto("PPGCM - Recuperação de senha esquecida");
    $email->setMensagem("Prezado(a) $nomeDest,<br><br>Sua senha de acesso ao formulário 
        de inscrição do Programa de Pós-graduação em Ciência dos Materiais pode ser redefinida
        clicando no seguinte link (se ao clicar a página não abrir, copie e cole o link na barra
        de endereços do seu navegador):<br><br> <a href=\"http://localhost/formulario/novaSenha.php?pa=$id&pb=$hash\" >
        http://localhost/formulario/novaSenha.php?pa=$id&pb=$hash</a><br><br>Atenciosamente,<br>PPGCM.");
    $email->enviarMensagem();


    header("location: index.php");

} else {
    header("location: esqueci.php?p=erroCadastro");
}

//fechar a conexao
mysql_close();
?>


