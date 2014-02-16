<?php
session_start();
include ("conexao.php");
if (!isset($_SESSION['query_rel'])){
	include("oops.php");
} else {

	$query = $_SESSION['query_rel'];

	$rs = mysql_query($query);
	$qtde = mysql_num_rows($rs);

	$path = "temp";
	if (!file_exists($path)) {
		mkdir($path, 0777, true);
	}
	//create
	$my_file = $path."/lista_candidatos.csv";
	$_SESSION['path_to_file'] = $my_file;
	unlink($my_file);
	$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file); //implicitly creates file

	$escrever = "Nome,CPF/Passaporte,Documento de Identidade,Data de Nascimento,Nacionalidade,"
		."País de Nascimento,Sexo,Endereço,Bairro,CEP,Cidade,Telefone Fixo,Telefone Celular,Email,"
		. "Cor/Raça,Curso de Graduação,Instituição,Data de Início,Data de Término,Curso de Especialização,"
		. "Instituição,Data de Início,Data de Término,Curso de Mestrado,Instituição,Data de Início,"
		. "Data de Término,Link do Currículo Lattes,Possível área de interesse,Regime de dedicação ao curso,"
		. "Vículo Empregatício,Interesse em Bolsa de Estudo,Experiência Profissional,Iniciação Científica,"
		. "Experiência de Pesquisa ou IC,Conhecimento de Inglês,Nota Média da Graduação,Contato Prévio,"
		. "Local de Realização da Prova,Professor que aplicará a prova,Instituição do Professor,"
		. "Email do Professor,Nome do Recomendante 1,Email do Recomendante 1,Relação com o Recomendante 1,"
		. "Nome do Recomendante 2,Email do Recomandante 2,Relação com o Recomendante 2\n";
	fwrite($handle, $escrever);

	$area_interesse[0] = "Materiais Funcionais e Polímeros de Fontes Renováveis";
    $area_interesse[1] = "Nanociência e Nanotecnologia de materiais";
    $area_interesse[2] = "Área ainda indefinida";

    $dedicacao[0] = "Regime de estudos em tempo integral";
    $dedicacao[1] = "Regime de estudos em tempo parcial";

    $vinculo_emp[0] = "Não pretendo manter vínculo de emprego durante a realização do curso";
    $vinculo_emp[1] = "Pretendo manter meu emprego, com autorização de meu empregador para estudar em regime de tempo integral";
    $vinculo_emp[2] = "Pretendo manter meu emprego, sendo aluno em tempo parcial no PPGCM, entendendo que terei a necessária disponibilidade para estudar com dedicação";

    $interesse_bolsa[0] = "Pretendo estudar sem bolsa de estudos";
    $interesse_bolsa[1] = "Atendo às condições requeridas e gostaria de ter uma bolsa atribuída pelo Curso, mas acho que poderei estudar de forma satisfatória ainda que não seja contemplado com bolsa";
    $interesse_bolsa[2] = "Atendo às condições requeridas e considero IMPRESCINDÍVEL ter uma bolsa atribuída pelo Curso para viabilizar meus estudos";

    $ic[0] = "Fiz Iniciação Científica com bolsa";
    $ic[1] = "Fiz Iniciação Científica sem bolsa";
    $ic[2] = "Não fiz Iniciação Científica";

    $ingles[0] = "Leio, escrevo e falo Inglês com fluência";
    $ingles[1] = "Leio e escrevo razoavelmente, mas pretendo melhorar minha capacidade de conversação e redação na língua";
    $ingles[2] = "Tenho conhecimentos básicos de leitura e escrita da língua";

    $relacao[0] = "Fui aluno de disciplina do recomendador";
    $relacao[1] = "Fui orientado pelo recomendador";
    $relacao[2] = "Fui aluno em mais de uma disciplina do recomendador";
    $relacao[3] = "O recomendador foi chefe do departamento onde estudei";
    $relacao[4] = "O recomendador possuía cargo de chefia, gerência ou direção na empresa onde trabalhei";
    $relacao[5] = "Meu colega";

	while($resultado = mysql_fetch_array($rs)){
		
		$aux = explode("-", $resultado['data_nasc']);
        $data_nasc = $aux[2] . '/' . $aux[1] . '/' . $aux[0];

        $sexo = $resultado['sexo'] == 'm' ? "Masculino" : "Feminino";
		
		$aux = explode("-", $resultado['dtini_grad']);
        $dtini_grad = $aux[2] . '/' . $aux[1] . '/' . $aux[0];
        $aux = explode("-", $resultado['dtfim_grad']);
        $dtfim_grad = $aux[2] . '/' . $aux[1] . '/' . $aux[0];

        $aux = explode("-", $resultado['dtini_esp']);
        $dtini_esp = $aux[2] . '/' . $aux[1] . '/' . $aux[0];
        $aux = explode("-", $resultado['dtfim_esp']);
        $dtfim_esp = $aux[2] . '/' . $aux[1] . '/' . $aux[0];

        $aux = explode("-", $resultado['dtini_mest']);
        $dtini_mest = $aux[2] . '/' . $aux[1] . '/' . $aux[0];
        $aux = explode("-", $resultado['dtfim_mest']);
        $dtfim_mest = $aux[2] . '/' . $aux[1] . '/' . $aux[0];

        $relacao_r1 = "";
        if (strstr($resultado['relacao_r1'], "ruz") != "") {
        	if ($relacao_r1 != "")
        		$relacao_r1 = $relacao_r1 . " / " . $relacao[0];
        	else
            	$relacao_r1 = $relacao[0];
        }

        if (strstr($resultado['relacao_r1'], "ruu") != "") {
        	if ($relacao_r1 != "")
        		$relacao_r1 = $relacao_r1 . " / " . $relacao[1];
        	else
            	$relacao_r1 = $relacao[1];
        }

        if (strstr($resultado['relacao_r1'], "rud") != "") {
        	if ($relacao_r1 != "")
        		$relacao_r1 = $relacao_r1 . " / " . $relacao[2];
        	else
            	$relacao_r1 = $relacao[2];
        }

        if (strstr($resultado['relacao_r1'], "rut") != "") {
        	if ($relacao_r1 != "")
        		$relacao_r1 = $relacao_r1 . " / " . $relacao[3];
        	else
            	$relacao_r1 = $relacao[3];
        }

        if (strstr($resultado['relacao_r1'], "ruq") != "") {
        	if ($relacao_r1 != "")
        		$relacao_r1 = $relacao_r1 . " / " . $relacao[4];
        	else
            	$relacao_r1 = $relacao[4];
        }

        if (strstr($resultado['relacao_r1'], "ruc") != "") {
        	if ($relacao_r1 != "")
        		$relacao_r1 = $relacao_r1 . " / " . $relacao[5];
        	else
            	$relacao_r1 = $relacao[5];
        }

        if (strstr($resultado['relacao_r1'], "rus") != "") {
        	if ($relacao_r1 != "")
        		$relacao_r1 = $relacao_r1 . " / " . $resultado['outro_r1'];
        	else
            	$relacao_r1 = $resultado['outro_r1'];
        }



        $relacao_r2 = "";
        if (strstr($resultado['relacao_r2'], "rdz") != "") {
        	if ($relacao_r2 != "")
        		$relacao_r2 = $relacao_r2 . " / " . $relacao[0];
        	else
            	$relacao_r2 = $relacao[0];
        }

        if (strstr($resultado['relacao_r2'], "rdu") != "") {
        	if ($relacao_r2 != "")
        		$relacao_r2 = $relacao_r2 . " / " . $relacao[1];
        	else
            	$relacao_r2 = $relacao[1];
        }

        if (strstr($resultado['relacao_r2'], "rdd") != "") {
        	if ($relacao_r2 != "")
        		$relacao_r2 = $relacao_r2 . " / " . $relacao[2];
        	else
            	$relacao_r2 = $relacao[2];
        }

        if (strstr($resultado['relacao_r2'], "rdt") != "") {
        	if ($relacao_r2 != "")
        		$relacao_r2 = $relacao_r2 . " / " . $relacao[3];
        	else
            	$relacao_r2 = $relacao[3];
        }

        if (strstr($resultado['relacao_r2'], "rdq") != "") {
        	if ($relacao_r2 != "")
        		$relacao_r2 = $relacao_r2 . " / " . $relacao[4];
        	else
            	$relacao_r2 = $relacao[4];
        }

        if (strstr($resultado['relacao_r2'], "rdc") != "") {
        	if ($relacao_r2 != "")
        		$relacao_r2 = $relacao_r2 . " / " . $relacao[5];
        	else
            	$relacao_r2 = $relacao[5];
        }

        if (strstr($resultado['relacao_r2'], "rds") != "") {
        	if ($relacao_r2 != "")
        		$relacao_r2 = $relacao_r2 . " / " . $resultado['outro_r2'];
        	else
            	$relacao_r2 = $resultado['outro_r2'];
        }

		$escrever = "\"" . $resultado['nome_aluno']."\",\"".$resultado['cpf_passaporte']."\",\""
		.$resultado['identidade']."\",\"".$data_nasc."\",\"".$resultado['nacionalidade']."\",\""
		.$resultado['pais']."\",\"".$sexo."\",\"".$resultado['endereco']."\",\"".$resultado['bairro']."\",\""
		.$resultado['cep']."\",\"".$resultado['cidade_estado']."\",\"".$resultado['tel_fixo']."\",\""
		.$resultado['tel_celular']."\",\"".$resultado['email']."\",\""
		.$resultado['cor_raca']."\",\"".$resultado['graduacao']."\",\"".$resultado['inst_grad']."\",\""
		.$dtini_grad."\",\"".$dtfim_grad."\",\"".$resultado['especializacao']."\",\""
		.$resultado['inst_esp']."\",\"".$dtini_esp."\",\"".$dtfim_esp."\",\""
		.$resultado['mestrado']."\",\"".$resultado['inst_mest']."\",\"".$dtini_mest."\",\""
		.$dtfim_mest."\",\"".$resultado['cvlattes']."\",\"".$area_interesse[$resultado['area_interesse']]
		."\",\""
		.$dedicacao[$resultado['dedicacao']]."\",\"".$vinculo_emp[$resultado['vinculo_emp']]."\",\""
		.$interesse_bolsa[$resultado['interesse_bolsa']]."\",\""
		.$resultado['exp_profissional']."\",\"".$ic[$resultado['ic']]."\",\"".$resultado['ic_descricao']
		."\",\""
		.$ingles[$resultado['ingles']]."\",\"".$resultado['notamedia']."\",\"".$resultado['nome_docente']
		."\",\""
		.$resultado['provalocal']."\",\"".$resultado['profnome']."\",\"".$resultado['profinst']."\",\""
		.$resultado['profemail']."\",\"".$resultado['nome_r1']."\",\"".$resultado['email_r1']."\",\""
		.$relacao_r1."\",\"".$resultado['nome_r2']."\",\"".$resultado['email_r2']."\",\"".$relacao_r2."\"\n";
		fwrite($handle, $escrever);
	}

	//close
	fclose($handle);

	header("Location: down_rel.php");
}
?>