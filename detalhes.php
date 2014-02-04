<?php
session_start();
if (!isset($_SESSION['AUTH']) || $_SESSION['AUTH'] == false || !isset($_SESSION['usuario'])) {
    include('oops.php');
} else {
//abre a pagina normalmente
    ?>

    <?php
    include("cabecalho.php");
    include("conexao.php");

    if (isset($_GET['id'])) {
        $sql = "SELECT * FROM dados_aluno WHERE cpf_passaporte=" . $_GET['id'];
        $rs = mysql_query($sql);
        $candidato = mysql_fetch_array($rs);
    }
    ?>

    <!-- Header -->
    <div id="header">
        <div class="shell">
            <!-- Logo + Top Nav -->
            <div id="top">
                <img src="css/images/logo-pos3.png" style="float:left"/>
                <h1><a href="index.php">Processo Seletivo</a></h1>

                <div id="top-navigation">
                    <?php $nome = explode(" ", $_SESSION['nome']); // para pegar o primeiro nome?>
                    Bem-vindo <strong><?php echo $nome[0]; ?></strong>
                    <span>|</span>
                    <a href="logout.php">Sair</a>
                </div>
            </div>
            <!-- End Logo + Top Nav -->

            <!-- Main Nav --
            <div id="navigation">
            </div>
            <!-- End Main Nav -->
        </div> 
        <!-- End Shell div -->
    </div>
    <!-- End Header div -->


    <!-- Container -->
    <div id="index-container">
        <div class="shell">

            <br />
            <!-- Main -->
            <div id="main">
                <div class="cl">&nbsp;</div>

                <!-- Content -->
                <div id="content" style="line-height: 2.5;">

                    <h2>Detalhes do Candidato - Processo Seletivo <?php echo $candidato['proc_seletivo']; ?></h2> <br />

                    <?php
                    /* Trata os dados recebidos da busca (somente o necessario) */

                    // faz um split na data para colocar no formato certo
                    $aux = explode("-", $candidato['data_nasc']);
                    $data_nasc = $aux[2] . '/' . $aux[1] . '/' . $aux[0];

                    $sexo = $candidato['sexo'] == 'm' ? "Masculino" : "Feminino";

                    $aux = explode("-", $candidato['dtini_grad']);
                    $dtini_grad = $aux[2] . '/' . $aux[1] . '/' . $aux[0];
                    $aux = explode("-", $candidato['dtfim_grad']);
                    $dtfim_grad = $aux[2] . '/' . $aux[1] . '/' . $aux[0];

                    $aux = explode("-", $candidato['dtini_esp']);
                    $dtini_esp = $aux[2] . '/' . $aux[1] . '/' . $aux[0];
                    $aux = explode("-", $candidato['dtfim_esp']);
                    $dtfim_esp = $aux[2] . '/' . $aux[1] . '/' . $aux[0];

                    $aux = explode("-", $candidato['dtini_mest']);
                    $dtini_mest = $aux[2] . '/' . $aux[1] . '/' . $aux[0];
                    $aux = explode("-", $candidato['dtfim_mest']);
                    $dtfim_mest = $aux[2] . '/' . $aux[1] . '/' . $aux[0];

                    $cvlattes = $candidato['cvlattes'];

                    $area_interesse[0] = "Materiais Funcionais e Polímeros de Fontes Renováveis";
                    $area_interesse[1] = "Nanociência e Nanotecnologia de materiais";
                    $area_interesse[2] = "Área ainda indefinida";
                    // $area_interesse[3] = "Teoria dos Grafos, Análise de Algoritmos e Teoria da Computação";
                    // $area_interesse[4] = "Processamento de Imagens e Sinais, Computação Gráfica e Projeto e Desenvolvimento de Jogos Eletrônicos Interativos";
                    // $area_interesse[5] = "Linguagens de Programação e Compiladores";
                    // $area_interesse[6] = "Área ainda indefinida";

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
                    ?>

                    <div id="dp" >
                        <!-- Box -->
                        <div class="box">
                            <!-- Box Head -->
                            <div class="box-head">
                                <h2>Dados Pessoais</h2>
                            </div>
                            <!-- End Box Head -->

                            <!-- Div Form -->
                            <div class="form">
                                <label>Nome: <span><?php echo $candidato['nome_aluno']; ?></span></label>
                                <label>CPF/Passaporte: <span><?php echo $candidato['cpf_passaporte']; ?></span></label>
                                <label>Documento de Identidade: <span><?php echo $candidato['identidade']; ?></span></label>
                                <label>Data de Nascimento: <span><?php echo $data_nasc; ?></span></label>
                                <label>Nacionalidade: <span><?php echo $candidato['nacionalidade']; ?></span></label>
                                <label>País de Nascimento: <span><?php echo $candidato['pais']; ?></span></label>
                                <label>Sexo: <span><?php echo $sexo; ?></span></label>
                                <label>Endereço: <span><?php echo $candidato['endereco']; ?></span></label>
                                <label>Bairro: <span><?php echo $candidato['bairro']; ?></span></label>
                                <label>CEP: <span><?php echo $candidato['cep']; ?></span></label>
                                <label>Cidade: <span><?php echo $candidato['cidade_estado']; ?></span></label>
                                <label>Telefone Fixo: <span><?php echo $candidato['tel_fixo']; ?></span></label>
                                <label>Telefone Celular: <span><?php echo $candidato['tel_celular']; ?></span></label>
                                <label>Email: <span><?php echo $candidato['email']; ?></span></label>
                                <label>Cor/Raça: <span><?php echo $candidato['cor_raca']; ?></span></label>
                            </div>
                            <!-- End Div Form -->
                        </div>
                        <!-- End Box -->
                    </div>
                    <!-- Final da div -->

                    <div id="fa">
                        <!-- Box -->
                        <div class="box">
                            <!-- Box Head -->
                            <div class="box-head">
                                <h2>Formação Acadêmica</h2>
                            </div>
                            <!-- End Box Head -->
                            <!-- Form -->
                            <div class="form">
                                <label>Curso de Graduação: <span><?php echo $candidato['graduacao']; ?></span></label>
                                <label>Instituição: <span><?php echo $candidato['inst_grad']; ?></span></label>
                                <label>Data de Início: <span><?php echo $dtini_grad; ?></span></label>
                                <label>Data de Término: <span><?php echo $dtfim_grad; ?></span></label>
                                <hr />
                                <?php
                                if ($candidato['especializacao'] == "") {
                                    echo "<label>Curso de Especialização: <span>Não possui</span></label>";
                                } else {
                                    ?>
                                    <label>Curso de Especialização: <span><?php echo $candidato['especializacao']; ?></span></label>
                                    <label>Instituição: <span><?php echo $candidato['inst_esp']; ?></span></label>
                                    <label>Data de Início: <span><?php echo $dtini_esp; ?></span></label>
                                    <label>Data de Término: <span><?php echo $dtfim_esp; ?></span></label>
                                <?php } ?>
                                <hr />
                                <?php
                                if ($candidato['mestrado'] == "") {
                                    echo "<label>Curso de Mestrado: <span>Não possui</span></label>";
                                } else {
                                    ?> 
                                    <label>Curso de Mestrado: <span><?php echo $candidato['mestrado']; ?></span></label>
                                    <label>Instituição: <span><?php echo $candidato['inst_mest']; ?></span></label>
                                    <label>Data de Início: <span><?php echo $dtini_mest; ?></span></label>
                                    <label>Data de Término: <span><?php echo $dtfim_mest; ?></span></label>
                                <?php } ?>
                                <hr />
                                <label>Link do Currículo Lattes: <span><a href="<?php echo $candidato['cvlattes']; ?>" target="_blank"><?php echo $candidato['cvlattes']; ?></a></span></label>
                                <br />
                            </div>
                            <!-- End Form -->
                        </div>
                        <!-- End Box -->
                    </div>
                    <!-- Final da div -->

                    <div id="dc">
                        <!-- Box -->
                        <div class="box">
                            <!-- Box Head -->
                            <div class="box-head">
                                <h2>Dados Complementares</h2>
                            </div>
                            <!-- End Box Head -->

                            <!-- Form -->
                            <div class="form">

                                <label>Possível área de interesse: <span><?php echo $area_interesse[$candidato['area_interesse']] ?></span></label>

                                <hr />
                                
                                <label>Regime de dedicação ao curso: <span><?php echo $dedicacao[$candidato['dedicacao']] ?></span></label>
                                <hr />
                                <label>Vínculo Empregatício: <span><?php echo $vinculo_emp[$candidato['vinculo_emp']] ?></span></label>
                                <hr />
                                <label>Interesse em bolsa de estudo: <span><?php echo $interesse_bolsa[$candidato['interesse_bolsa']] ?></span></label>
                                <hr />
                                <label>Experiencia profissional:<br /><span><?php echo $candidato['exp_profissional'] ?></span></label>
                                <hr />
                                <label>Iniciação Científica: <span><?php echo $ic[$candidato['ic']] ?></span></label>
                                <?php if ($candidato['ic'] != 2) { ?>
                                    <label>Experiência de Pesquisa ou IC:<br /><span><?php echo $candidato['ic_descricao'] ?></span></label>
                                <?php } ?>
                                <hr />
                                <label>Conhecimento de Inglês: <span><?php echo $ingles[$candidato['ingles']] ?></span></label>
                                <hr />
                                <label>Nota média da graduação: <span><?php echo $candidato['notamedia'] ?></span></label>
                                <hr />
                                <label>Contato Prévio: <span><?php echo $candidato['nome_docente'] ?></span></label>
                                <?php
                                if ($candidato['provalocal'] == "") {
                                    echo "<hr />";
                                    echo "<label>Local de realização da prova: <span>Sorocaba</span></label>";
                                } else {
                                    ?>
                                    <hr /> 
                                    <label>Local de realização da prova: <span><?php echo $candidato['provalocal']; ?></span></label>
                                    <?php
                                    if ($candidato['profnome'] == "") {
                                        echo "<hr />";
                                        echo "<label>Professor que aplicará a prova: <span>Ainda não encontrei</span></label>";
                                    } else {
                                        ?> 
                                        <hr />
                                        <label>Professor que aplicará a prova: <span><?php echo $candidato['profnome']; ?></span></label>
                                        <hr />
                                        <label>Instituição do professor: <span><?php echo $candidato['profinst']; ?></span></label>
                                        <hr />
                                        <label>Email do professor: <span><?php echo $candidato['profemail']; ?></span></label>
                                    <?php }
                                      } ?>
                                <br />

                            </div>
                            <!-- End Form -->
                        </div>
                        <!-- End Box -->
                    </div>
                    <!-- Final da div -->

                    <div id="cr"> 
                        <!-- Box -->
                        <div class="box">
                            <!-- Box Head -->
                            <div class="box-head">
                                <h2>Cartas de Recomendação</h2>
                            </div>
                            <!-- End Box Head -->

                            <!-- Form -->
                            <div class="form">
                                <label>Nome do recomendante 1: <span><?php echo $candidato['nome_r1']; ?></span></label>
                                <label>E-mail do recomendante 1: <span><?php echo $candidato['email_r1']; ?></span></label>
                                <label>Relação com o recomendante 1:<span>
                                        <?php
                                        $flag_nenuhum = true;
                                        for ($i = 0; $i < 5; $i++) {
                                            if (strstr($candidato['relacao_r1'], "$i") != "") {
                                                echo "<br />" . "$relacao[$i]";
                                                $flag_nenuhum = false;
                                            }
                                        } // fim for  
                                        // para a opcao 'outro'
                                        if (strstr($candidato['relacao_r1'], "5") != "") {
                                            echo "<br />" . $candidato['outro_r1'];
                                            $flag_nenuhum = false;
                                        }
                                        if ($flag_nenuhum)
                                            echo "-";
                                        ?>
                                    </span></label>
                                    <a href="<?php echo $candidato['carta1']; ?>" target="_blank">Carta do recomendante 1</a>
                                <hr />
                                <label>Nome do recomendante 2: <span><?php echo $candidato['nome_r2']; ?></span></label>
                                <label>E-mail do recomendante 2: <span><?php echo $candidato['email_r2']; ?></span></label>
                                <label>Relação com o recomendante 2:<span>
                                        <?php
                                        $flag_nenuhum = true;
                                        for ($i = 0; $i < 5; $i++) {
                                            if (strstr($candidato['relacao_r2'], "$i") != "") {
                                                echo "<br />" . "$relacao[$i]";
                                                $flag_nenuhum = false;
                                            }
                                        } // fim for  
                                        // para a opcao 'outro'
                                        if (strstr($candidato['relacao_r2'], "5") != "") {
                                            echo "<br />" . $candidato['outro_r2'];
                                            $flag_nenuhum = false;
                                        }
                                        if ($flag_nenuhum)
                                            echo "-";
                                        ?>

                                    </span></label>
                                    <a href="<?php echo $candidato['carta2']; ?>" target="_blank">Carta do recomendante 2</a>
                                <br />
                            </div>
                            <!-- End Form -->

                        </div>
                        <!-- End Box -->
                    </div>
                    <!-- Final div -->

                </div>
                <!-- End Content -->

                <div class="cl">&nbsp;</div>			
            </div>
            <!-- Main -->
        </div>
    </div>
    <!-- End Container -->

    <?php
    include("rodape.php");
}// fim do else   
?>