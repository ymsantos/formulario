<?php

include('conexao.php');
session_start();
?>


<?php

$processo = $_POST['processo'];
$cpf_passaporte = $_POST['cpf'];
$senha = sha1($_POST['senha']);
$nome_aluno = $_POST['nome'];

$sql = "INSERT INTO dados_aluno(proc_seletivo, cpf_passaporte, senha, nome_aluno) 
        VALUES ('$processo', $cpf_passaporte, '$senha', '$nome_aluno')";

$ok = mysql_query($sql);

if ($ok) {
    //echo "Cadastro efetuado com sucessso!";
    // monta os dados da sessao:
    $_SESSION["AUTH"] = true;
    $_SESSION['cpf'] = $cpf_passaporte;
    $_SESSION['nome'] = $nome_aluno;
    $_SESSION['senha-atual'] = $senha; // já passa a senha criptografada
    $_SESSION['finalizado'] = 'false';


    header("location: validaLogin.php", true);
    //include('sucesso.php');
} else {
    //echo "Cadastro não efetuado";
    //include('erro.php');
    $query = "SELECT * FROM dados_aluno WHERE cpf_passaporte=" . $cpf_passaporte;
    $rs = mysql_query($query);
    if (mysql_num_rows($rs) != 0)
        header("location: index.php?p=erroCadastro");
    else
        include('erro.php');
}

//fechar a conexao
mysql_close();
?>


