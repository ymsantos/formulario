<?php

session_start();
include('conexao.php');

$cpf = $_SESSION['cpf'];
$senha = $_SESSION['senha-atual'];
// Dados do Candidato
$sql = "call uspSelecionaAluno($cpf,'$senha')";
$result = mysql_query($sql);

// quantidade de linhas retornada na consulta, deve ser igual a 1 (nesse caso)
$linhas = mysql_num_rows($result);

if ($linhas == 1) {
    $dadosAluno = mysql_fetch_array($result);

    $_SESSION["AUTH"] = true; // indica que o usuario está logado
    // Carrega na sessão os dados do usuário:
    $_SESSION["processo"] = $dadosAluno['proc_seletivo'];
    $_SESSION["nome"] = $dadosAluno['nome_aluno']; // guarda o nome do usuário
    $_SESSION["identidade"] = $dadosAluno['identidade'];

    // faz um split na data para colocar no formato certo
    $aux = explode("-", $dadosAluno['data_nasc']);
    if ($aux[2] != "0000" && $aux[2] != "")
        $_SESSION['data_nasc'] = $aux[2] . '/' . $aux[1] . '/' . $aux[0];
    else
        $_SESSION['data_nasc'] = "";


    $_SESSION['nacionalidade'] = $dadosAluno['nacionalidade'];
    $_SESSION['pais'] = $dadosAluno['pais'];
    $_SESSION['sexo'] = $dadosAluno['sexo'];
    $_SESSION['endereco'] = $dadosAluno['endereco'];
    $_SESSION['bairro'] = $dadosAluno['bairro'];
    $_SESSION['cep'] = $dadosAluno['cep'];
    $_SESSION['cidade'] = $dadosAluno['cidade_estado'];
    $_SESSION['telfixo'] = $dadosAluno['tel_fixo'];
    $_SESSION['telcelular'] = $dadosAluno['tel_celular'];
    $_SESSION['email'] = $dadosAluno['email'];
    $_SESSION['raca'] = $dadosAluno['cor_raca'];

    $_SESSION['graduacao'] = $dadosAluno['graduacao'];
    $_SESSION['inst_grad'] = $dadosAluno['inst_grad'];

    // faz um split na data para colocar no formato certo
    $aux = explode("-", $dadosAluno['dtini_grad']);
    if ($aux[2] != "0000" && $aux[2] != "")
        $_SESSION['dtini_grad'] = $aux[2] . '/' . $aux[1] . '/' . $aux[0];
    else
        $_SESSION['dtini_grad'] = "";

    $aux = explode("-", $dadosAluno['dtfim_grad']);
    if ($aux[2] != "0000" && $aux[2] != "")
        $_SESSION['dtfim_grad'] = $aux[2] . '/' . $aux[1] . '/' . $aux[0];
    else
        $_SESSION['dtfim_grad'] = "";

    $_SESSION['especializacao'] = $dadosAluno['especializacao'];
    $_SESSION['fezespecializacao'] = ($dadosAluno['especializacao']) == "" ? false : true;
    $_SESSION['inst_esp'] = $dadosAluno['inst_esp'];

    // faz um split na data para colocar no formato certo
    $aux = explode("-", $dadosAluno['dtini_esp']);
    if ($aux[2] != "0000" && $aux[2] != "")
        $_SESSION['dtini_esp'] = $aux[2] . '/' . $aux[1] . '/' . $aux[0];
    else
        $_SESSION['dtini_esp'] = "";

    $aux = explode("-", $dadosAluno['dtfim_esp']);
    if ($aux[2] != "0000" && $aux[2] != "")
        $_SESSION['dtfim_esp'] = $aux[2] . '/' . $aux[1] . '/' . $aux[0];
    else
        $_SESSION['dtfim_esp'] = "";

    $_SESSION['mestrado'] = $dadosAluno['mestrado'];
    $_SESSION['fezmestrado'] = ($dadosAluno['mestrado']) == "" ? false : true;
    $_SESSION['inst_mest'] = $dadosAluno['inst_mest'];

    // faz um split na data para colocar no formato certo
    $aux = explode("-", $dadosAluno['dtini_mest']);
    if ($aux[2] != "0000" && $aux[2] != "")
        $_SESSION['dtini_mest'] = $aux[2] . '/' . $aux[1] . '/' . $aux[0];
    else
        $_SESSION['dtini_mest'] = "";

    $aux = explode("-", $dadosAluno['dtfim_mest']);
    if ($aux[2] != "0000" && $aux[2] != "")
        $_SESSION['dtfim_mest'] = $aux[2] . '/' . $aux[1] . '/' . $aux[0];
    else
        $_SESSION['dtfim_mest'] = "";

    $_SESSION['cvlattes'] = $dadosAluno['cvlattes'];
    $_SESSION['area_interesse'] = $dadosAluno['area_interesse'];
    $_SESSION['dedicacao'] = $dadosAluno['dedicacao'];
    $_SESSION['vinculo_emp'] = $dadosAluno['vinculo_emp'];
    $_SESSION['interesse_bolsa'] = $dadosAluno['interesse_bolsa'];
    $_SESSION['exp_profissional'] = $dadosAluno['exp_profissional'];
    $_SESSION['ic'] = $dadosAluno['ic'];
    $_SESSION['ic_descricao'] = $dadosAluno['ic_descricao'];
    $_SESSION['ingles'] = $dadosAluno['ingles'];
    $_SESSION['notamedia'] = str_replace(".", ",", $dadosAluno['notamedia']);

    $_SESSION['nome_docente'] = $dadosAluno['nome_docente'];

    $_SESSION['provalocal'] = $dadosAluno['provalocal'];
    $_SESSION['locprova'] = ($dadosAluno['provalocal']) == "" ? 0 : 1;
    
    $_SESSION['profnome'] = $dadosAluno['profnome'];
    $_SESSION['profprova'] = ($dadosAluno['profnome']) == "" ? 0 : 1;
    $_SESSION['profinst'] = $dadosAluno['profinst'];
    $_SESSION['profemail'] = $dadosAluno['profemail'];           

    $_SESSION['nome_r1'] = $dadosAluno['nome_r1'];
    $_SESSION['email_r1'] = $dadosAluno['email_r1'];
    $_SESSION['relacao_r1'] = $dadosAluno['relacao_r1'];
    $_SESSION['carta1'] = $dadosAluno['carta1'];
    $_SESSION['outro_r1'] = $dadosAluno['outro_r1'];
    $_SESSION['nome_r2'] = $dadosAluno['nome_r2'];
    $_SESSION['email_r2'] = $dadosAluno['email_r2'];
    $_SESSION['relacao_r2'] = $dadosAluno['relacao_r2'];
    $_SESSION['carta2'] = $dadosAluno['carta2'];
    $_SESSION['outro_r2'] = $dadosAluno['outro_r2'];

    $_SESSION['finalizado'] = $dadosAluno['finalizado'];


    // Redireciona para a pagina do aluno
    // header("location: candidato.php", true);
    include('sucessoAlteracao.php');
}
?>

