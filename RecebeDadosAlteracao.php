<?php 
    include('conexao.php');
    session_start();
?>


<?php

    /* 
     * PARA TODOS OS DADOS QUE ELE RECEBE ATRAVES DO POST
     * UTILIZA-SE A FUNCAO isset() PARA VERIFICAR SE O POST FOI SETADO
     * E EM SEGUIDA ARMAZENA-SE ESSES DADOS NA VARIAVEL DA SESSAO
     */

    $processo = $_SESSION['ultimo_ps'];
    $id = $_SESSION['cpf'];
    
    $_SESSION['cpf'] = $cpf_passaporte = $_POST['cpf'];
    
    if(isset($_POST['senha-atual']) && $_POST['senha-atual'] == $_SESSION['senha-atual'] && $_POST['senha'] != "" && $_POST['senha'] == $_POST['re-senha'])
        $_SESSION['senha-atual'] = $senha = $_POST['senha'];
    else 
        $_SESSION['senha-atual'] = $senha = $_SESSION['senha-atual'];
    
    $_SESSION['nome'] = $nome_aluno = isset($_POST['nome'])?$_POST['nome']:"";
    $_SESSION['identidade'] = $identidade = isset($_POST['identidade'])?$_POST['identidade']:"";
    
    // faz um split na data para colocar no formato certo no BD
    $data_nasc="";
    if(isset($_POST['dtnascimento']) && $_POST['dtnascimento']!=""){
        $_SESSION['data_nasc'] = $_POST['dtnascimento'];
        $aux = explode("/", $_POST['dtnascimento']);
        $data_nasc = $aux[2]. '-' . $aux[1]. '-' .$aux[0];
    }
    
    $_SESSION['nacionalidade'] = $nacionalidade = isset($_POST['nacionalidade'])?$_POST['nacionalidade']:"";
    $_SESSION['pais'] = $pais = isset($_POST['pais'])?$_POST['pais']:"";
    $_SESSION['sexo'] = $sexo = isset($_POST['sexo'])?$_POST['sexo']:"";   
    $_SESSION['endereco'] = $endereco = isset($_POST['endereco'])?$_POST['endereco']:"";
    $_SESSION['bairro'] = $bairro = isset($_POST['bairro'])?$_POST['bairro']:"";
    $_SESSION['cep'] = $cep = isset($_POST['cep'])?$_POST['cep']:"";
    $_SESSION['cidade'] = $cidade_estado = isset($_POST['cidade'])?$_POST['cidade']:"";
    $_SESSION['telfixo'] = $tel_fixo =isset($_POST['telfixo'])?$_POST['telfixo']:"";
    $_SESSION['telcelular'] = $tel_celular = isset($_POST['telcelular'])?$_POST['telcelular']:"";
    $_SESSION['email'] = $email = isset($_POST['email'])?$_POST['email']:"";
    $_SESSION['raca'] = $cor_raca = isset($_POST['raca'])?$_POST['raca']:"";
    $_SESSION['graduacao'] = $graduacao = isset($_POST['graduacao'])?$_POST['graduacao']:"";
    $_SESSION['inst_grad'] = $inst_grad = isset($_POST['instituicao-grad'])?$_POST['instituicao-grad']:"";
    
    
    $dtini_grad="";
    if(isset($_POST['dtinicio-grad'])  && $_POST['dtinicio-grad']!=""){
        $_SESSION['dtini_grad'] = $_POST['dtinicio-grad'];
        $aux = explode("/", $_POST['dtinicio-grad']);
        $dtini_grad = $aux[2]. '-' . $aux[1]. '-' .$aux[0];
    }
    
   
    $dtfim_grad="";
    if(isset($_POST['dtfim-grad']) && $_POST['dtfim-grad']!=""){
        $_SESSION['dtfim_grad'] = $_POST['dtfim-grad'];
        $aux = explode("/", $_POST['dtfim-grad']);
        $dtfim_grad = $aux[2]. '-' . $aux[1]. '-' .$aux[0];
    }
        
    $_SESSION['especializacao'] = $especializacao = isset($_POST['especializacao'])?$_POST['especializacao']:"";
    $_SESSION['inst_esp'] = $inst_esp = isset($_POST['instituicao-esp'])?$_POST['instituicao-esp']:"";
    
    $dtini_esp="";
    if(isset($_POST['dtinicio-esp']) && $_POST['dtinicio-esp']!=""){
        $_SESSION['dtini_esp'] = $_POST['dtinicio-esp'];
        $aux2 = explode("/", $_POST['dtinicio-esp']);
        $dtini_esp = $aux2[2]. '-' . $aux2[1]. '-' .$aux2[0];
    }
    
    $dtfim_esp="";
    if(isset($_POST['dtfim-esp']) && $_POST['dtfim-esp']!=""){
        $_SESSION['dtfim_esp'] = $_POST['dtfim-esp'];
        $aux = explode("/", $_POST['dtfim-esp']);
        $dtfim_esp = $aux[2]. '-' . $aux[1]. '-' .$aux[0];
    }
    
    $_SESSION['mestrado'] = $mestrado = isset($_POST['mestrado'])?$_POST['mestrado']:"";
    $_SESSION['inst_mest'] = $inst_mest = isset($_POST['instituicao-mest'])?$_POST['instituicao-mest']:"";
    
    $dtini_mest="";
    if(isset($_POST['dtinicio-mest']) && $_POST['dtinicio-mest']!=""){
        $_SESSION['dtini_mest'] = $_POST['dtinicio-mest'];
        $aux = explode("/", $_POST['dtinicio-mest']);
        $dtini_mest = $aux[2]. '-' . $aux[1]. '-' .$aux[0];
    }
    

    $dtfim_mest="";
    if(isset($_POST['dtfim-mest']) && $_POST['dtfim-mest']!=""){
        $_SESSION['dtfim_grad'] = $_POST['dtfim-grad'];
        $aux = explode("/", $_POST['dtfim-mest']);
        $dtfim_mest = $aux[2]. '-' . $aux[1]. '-' .$aux[0];
    }    
    
    $_SESSION['cvlattes'] = $cvlattes = isset($_POST['cvlattes'])?$_POST['cvlattes']:"";

    $_SESSION['area_interesse'] = $area_interesse = isset($_POST['interesse'])?$_POST['interesse']:-1;
    
    /*$area_n_interesse="";
    if (isset($_POST["n_interesse"])) {
        foreach ($_POST["n_interesse"] as $it) {
            $area_n_interesse .= $it . ", " ;
        }
        $_SESSION['area_n_interesse'] = $area_n_interesse = preg_replace( "/, $/", "", $area_n_interesse);
    }*/
    
    $_SESSION['dedicacao'] = $dedicacao = isset($_POST['dedicacao'])?$_POST['dedicacao']:-1;
    $_SESSION['vinculo_emp'] = $vinculo_emp = isset($_POST['vinculoemp'])?$_POST['vinculoemp']:-1;
    $_SESSION['interesse_bolsa'] = $interesse_bolsa = isset($_POST['bolsa'])?$_POST['bolsa']:-1;
    $_SESSION['exp_profissional'] = $exp_profissional = isset($_POST['experiencia-prof'])?$_POST['experiencia-prof']:"";
    $_SESSION['ic'] = $ic = isset($_POST['ic'])?$_POST['ic']:-1;
    $_SESSION['ic_descricao'] = $ic_descricao = isset($_POST['experiencia-ic'])?$_POST['experiencia-ic']:"";
    $_SESSION['ingles'] = $ingles = isset($_POST['ingles'])?$_POST['ingles']:-1;
    
    $_SESSION['notamedia'] = $notamedia = isset($_POST['nota'])?$_POST['nota']:"";
    $notamedia = str_replace(",", ".", $notamedia);
    
    $_SESSION['nome_docente'] = $nome_docente = isset($_POST['docentes'])?$_POST['docentes']:"";
    //==================================================================================
    $_SESSION['provalocal'] = $provalocal = isset($_POST['provalocal'])?$_POST['provalocal']:"";
    $_SESSION['profnome'] = $profnome = isset($_POST['nomeprof'])?$_POST['nomeprof']:"";
    $_SESSION['profinst'] = $profinst = isset($_POST['instprof'])?$_POST['instprof']:"";
    $_SESSION['profemail'] = $profemail = isset($_POST['emailprof'])?$_POST['emailprof']:"";
    //==================================================================================
    $_SESSION['nome_r1'] = $nome_r1 = isset($_POST['nome-r1'])?$_POST['nome-r1']:"";
    $_SESSION['email_r1'] = $email_r1 = isset($_POST['email-r1'])?$_POST['email-r1']:"";
    
    $relacao_r1="";
    if (isset($_POST["recom1"])) {
        foreach ($_POST["recom1"] as $it) {
            $relacao_r1 .= $it . ", " ;
        }
    }
    $_SESSION['relacao_r1'] = $relacao_r1 = preg_replace( "/, $/", "", $relacao_r1);
    
    $_SESSION['outro_r1'] = $outro_r1 = isset($_POST['outro-r1'])?$_POST['outro-r1']:"";
    $_SESSION['nome_r2'] = $nome_r2 = isset($_POST['nome-r2'])?$_POST['nome-r2']:"";
    $_SESSION['email_r2'] = $email_r2 = isset($_POST['email-r2'])?$_POST['email-r2']:"";
    
    $relacao_r2="";
    if (isset($_POST["recom2"])) {
        foreach ($_POST["recom2"] as $it) {
            $relacao_r2 .= $it . ", " ;
        }
    }
    $_SESSION['relacao_r2'] = $relacao_r2 = preg_replace( "/, $/", "", $relacao_r2);
    
    $_SESSION['outro_r2'] = $outro_r2 = isset($_POST['outro-r2'])?$_POST['outro-r2']:"";
    
    //$finalizado = isset($_POST['finalizado'])?$_POST['finalizado']:'false';
    $finalizado='true';
    
    // monta a chamada 
    
    
    $sql_1 = "call uspAtualizaDadosAluno(
                $id,
                '$processo',
                $cpf_passaporte,
		'$senha',
		'$nome_aluno',
		'$identidade',
		'$data_nasc',
		'$nacionalidade',
                '$pais',
		'$sexo',
		'$endereco',
		'$bairro',
		$cep,
		'$cidade_estado',
		$tel_fixo,
		$tel_celular,
		'$email',
		'$cor_raca',
		'$graduacao',
		'$inst_grad',
		'$dtini_grad',
		'$dtfim_grad',
		'$especializacao',
		'$inst_esp',
		'$dtini_esp',
		'$dtfim_esp',
		'$mestrado',
		'$inst_mest',
		'$dtini_mest',
		'$dtfim_mest',
        '$cvlattes',
		$area_interesse,
		$dedicacao,
		$vinculo_emp,
		$interesse_bolsa,
		'$exp_profissional',
		$ic,
		'$ic_descricao',
		$ingles,
		$notamedia,
		'$nome_docente',
        '$provalocal',
        '$profnome',
        '$profinst',
        '$profemail',
		'$nome_r1',
		'$email_r1',
		'$relacao_r1',
		'$outro_r1',
		'$nome_r2',
		'$email_r2',
		'$relacao_r2',
		'$outro_r2',
                $finalizado)";
    
    $sql_2 = "call uspAtualizaDP(                   
                $id,
                $cpf_passaporte, 
		'$senha',
		'$nome_aluno',
		'$identidade',
		'$data_nasc',
		'$nacionalidade',
                '$pais',
		'$sexo',
		'$endereco',
		'$bairro',
		$cep,
		'$cidade_estado',
		$tel_fixo,
		$tel_celular,
		'$email',
		'$cor_raca')";

    $sql_3 = "call uspAtualizaFA(
                $id,
                '$graduacao',
		'$inst_grad',
		'$dtini_grad',
		'$dtfim_grad',
		'$especializacao',
		'$inst_esp',
		'$dtini_esp',
		'$dtfim_esp',
		'$mestrado',
		'$inst_mest',
		'$dtini_mest',
		'$dtfim_mest',
        '$cvlattes');";
    
    $sql_4 = "call uspAtualizaDC(
                $id,
                $area_interesse,
		$dedicacao,
		$vinculo_emp,
		$interesse_bolsa,
		'$exp_profissional',
		$ic,
		'$ic_descricao',
		$ingles,
		$notamedia,
		'$nome_docente',
        '$provalocal',
        '$profnome',
        '$profinst',
        '$profemail');";
    
    $sql_5 = "call uspAtualizaCR(
                 $id,
                '$nome_r1',
		'$email_r1',
		'$relacao_r1',
		'$outro_r1',
		'$nome_r2',
		'$email_r2',
		'$relacao_r2',
		'$outro_r2');";
    
    //echo $sql;
        
    if(!isset($_GET['dados']) || $_GET['dados'] == 'fim' || $_GET['dados'] == 'cr'){
        $ok = mysql_query($sql_1);
        $_SESSION['processo'] = $_SESSION['ultimo_ps'];
        $_SESSION['finalizado'] = $finalizado;
    }
    else if($_GET['dados'] == 'dp') $ok = mysql_query($sql_2);
    else if($_GET['dados'] == 'fa') $ok = mysql_query($sql_3);
    else if($_GET['dados'] == 'dc') $ok = mysql_query($sql_4);
    //else if($_GET['dados'] == 'cr') $ok = mysql_query($sql_5);
    else $ok = false;

    
    
    if ($ok) {
        //echo "Cadastro efetuado com sucessso!";
        if(!isset($_GET['dados']) || $_GET['dados'] == 'fim' || $_GET['dados'] == 'cr'){
           include('sucessoAlteracao.php');
        }
        else if($_GET['dados'] == 'dp')
            header('location: candidato.php?show=fa',true);
        else if($_GET['dados'] == 'fa')
            header('location: candidato.php?show=dc',true);
        else if($_GET['dados'] == 'dc')
            header('location: candidato.php?show=cr',true);
    } else {
        //echo "Cadastro não efetuado";
        include('erro.php');
        //echo $sql_4;
    }

    //fechar a conexao
    mysql_close();
?>


