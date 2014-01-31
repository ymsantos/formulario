<?php
session_start();
if (!isset($_SESSION['AUTH']) || $_SESSION['AUTH'] == false) {
    include('oops.php');
} else {
    //abre a pagina normalmente
    ?>

    <?php include("cabecalho.php");
          include('conexao.php'); ?>

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
                    <a href="alterarSenha.php">Alterar Senha</a>
                    <span>|</span>
                    <a href="javascript:void(0)" onclick="return cancelaInscricao();">Cancelar Inscrição</a>
                    <span>|</span>
                    <a href="logout.php">Sair</a>
                </div>
            </div>
            <!-- End Logo + Top Nav -->

            <!-- Main Nav -->
            <div id="navigation">
                <ul>
                    <li><a href="javascript:void(0)" id="m-dp" onclick="showDivMenu('dp')" <?php if (!isset($_GET['show']) || $_GET['show'] == 'dp') echo 'class="active"' ?> >Dados Pessoais</a></li>
                    <li><a href="javascript:void(0)" id="m-fa" onclick="showDivMenu('fa')" <?php if (isset($_GET['show']) && $_GET['show'] == 'fa') echo 'class="active"' ?> >Formação Acadêmica</a></li>
                    <li><a href="javascript:void(0)" id="m-dc" onclick="showDivMenu('dc')" <?php if (isset($_GET['show']) && $_GET['show'] == 'dc') echo 'class="active"' ?> >Dados Complementares</a></li>
                    <li><a href="javascript:void(0)" id="m-cr" onclick="showDivMenu('cr')" <?php if (isset($_GET['show']) && $_GET['show'] == 'cr') echo 'class="active"' ?> >Cartas de Recomendação</a></li>
                </ul>
            </div>
            <!-- End Main Nav -->
        </div> 
        <!-- End Shell div -->
    </div>
    <!-- End Header div -->


    <!-- Container -->
    <div id="container">
        <div class="shell">
            <br />
            <!-- Main -->
            <div id="main">
                <div class="cl">&nbsp;</div>

                <!-- Content -->
                <div id="content">
                    <form id="form-inscricao" name="form-inscricao" method="post" action="RecebeDadosAlteracao.php" enctype="multipart/form-data">

                        <?php if ($_SESSION['finalizado'] == true && ($_SESSION['processo'] == $_SESSION['ultimo_ps'])) { ?>
                            <h2>Você já está inscrito no Processo Seletivo <?php echo $_SESSION['processo']; ?>. 
                                <br /> Os dados cadastrados estão logo abaixo. Para alterá-los, basta fazer as modificações e clicar em <strong>"Salvar Alterações"</strong>.</h2><br />
                        <?php } else if ($_SESSION['processo'] != $_SESSION['ultimo_ps'] && $_SESSION['inscr_aberta']) { ?>
                            <h2>Seus dados já estão cadastrados no nosso banco, mas você ainda <strong style="color: red">não</strong> está inscrito no Processo Seletivo <?php echo $_SESSION['ultimo_ps']; ?>.
                                <br />Para se inscrever, confira os seus dados e clique no botão <strong>"Finalizar Inscrição"</strong></h2><br />
                        <?php } else if ($_SESSION['inscr_aberta']) { // Se falta terminar a inscricao ?>
                            <h2><strong style="color: red">Atenção!</strong> Você ainda não está inscrito no Processo Seletivo.<br />
                                Para concluir a inscrição preencha todos os dados corretamente e clique no botão <strong>"Finalizar Inscrição"</strong></h2><br />
                        <?php } ?>

                        <div id="dp" <?php if (isset($_GET['show']) && $_GET['show'] != 'dp') echo 'style="display:none"' ?> >
                            <!-- Box -->
                            <div class="box">
                                <!-- Box Head -->
                                <div class="box-head">
                                    <h2>Dados Pessoais</h2>
                                </div>
                                <!-- End Box Head -->

                                <!-- Form -->
                                <div class="form">
                                    <p>
                                        <label>Nome completo *</label>
                                        <input type="text" name="nome" id="nome" placeholder="ex.: Alan Turing" size="100" maxlength="100" class="field" value="<?php echo $_SESSION['nome']; ?>" onkeyup="validaLetra(this.id,this.value)" />
                                    </p>
                                    <p>
                                        <label>CPF *<span>(apenas números - caso seja estrangeiro, informe o passaporte)</span></label>
                                        <input type="text" name="cpf" id="cpf" placeholder="ex.: 9998887770" size="30" maxlength="30" class="field" value="<?php echo $_SESSION['cpf']; ?>" onkeyup="validaNumero(this.id,this.value)" /> 
                                    </p>
                                    <p>
                                        <label>Documento de Identidade * <span>(apenas números, ou 'X' quando houver)</span></label>
                                        <input type="text" name="identidade" id="identidade" placeholder="ex.: 48555222X" size="20" maxlength="20" class="field" value="<?php echo $_SESSION['identidade']; ?>" onkeyup="validaIdentidade(this.id,this.value)" /> 
                                    </p>
                                    <p>
                                        <label>Data de Nascimento * <span>(dd/mm/aaaa)</span></label>
                                        <input type="text" name="dtnascimento" id="dtnascimento" placeholder="ex.: 20/03/1988" size="20" maxlength="10" class="field" value="<?php echo $_SESSION['data_nasc']; ?>" onkeyup="validaData(this.id,this.value)" />
                                    </p>
                                    <p>
                                        <label>Nacionalidade *</label>
                                        <input type="text" name="nacionalidade" id="nacionalidade" placeholder="ex.: Brasileiro" size="30" maxlength="100" class="field" value="<?php echo $_SESSION['nacionalidade']; ?>" onkeyup="validaLetra(this.id,this.value)" />
                                    </p>
                                    <p>
                                        <label>País de Nascimento *</label>
                                        <input type="text" name="pais" id="pais" placeholder="ex.: Brasil" size="30" maxlength="100" class="field" value="<?php echo $_SESSION['pais']; ?>" onkeyup="validaLetra(this.id,this.value)" />
                                    </p>
                                    <p>
                                        <label>Sexo *</label>
                                        <input type="radio" name="sexo" id="sexom" value="m" <?php if ($_SESSION['sexo'] == 'm') echo 'checked' ?> /> Masculino 
                                        <input type="radio" name="sexo" id="sexof" value="f" <?php if ($_SESSION['sexo'] == 'f') echo 'checked' ?> /> Feminino
                                    </p>
                                    <p>
                                        <label>Endereço *</label>
                                        <input type="text" name="endereco" placeholder="ex.: Rua das Couves, 231" id="endereco" value="<?php echo $_SESSION['endereco']; ?>" size="100" maxlength="100" class="field" onkeyup="validaEndereco(this.id,this.value)" />
                                    </p>
                                    <p>
                                        <label>Bairro *</label>
                                        <input type="text" name="bairro" id="bairro" placeholder="ex.: Jardim das Flores" value="<?php echo $_SESSION['bairro']; ?>" size="100" maxlength="100" class="field" onkeyup="validaBairro(this.id,this.value)"/>
                                    </p>
                                    <p>
                                        <label>CEP * <span>(apenas números)</span></label>
                                        <input type="text" name="cep" id="cep" placeholder="ex.: 08834231" value="<?php echo $_SESSION['cep']; ?>" size="20" maxlength="20" class="field" onkeyup="validaNumero(this.id,this.value)"/>
                                    </p>
                                    <p>
                                        <label>Cidade *</label>
                                        <input type="text" name="cidade" id="cidade" placeholder="ex.: Sorocaba, SP" value="<?php echo $_SESSION['cidade']; ?>" size="100" maxlength="100" class="field" onkeyup="validaEndereco(this.id,this.value)"/>
                                    </p>
                                    <p>
                                        <label>Telefone Fixo * <span>(DDD)+(Telefone) - apenas números</span></label>
                                        <input type="text" name="telfixo" id="telfixo" placeholder="ex.: 1533223509" value="<?php echo $_SESSION['telfixo']; ?>" size="20" maxlength="20" class="field" onkeyup="validaNumero(this.id,this.value)"/>
                                    </p>
                                    <p>
                                        <label>Telefone Celular * <span>(DDD)+(Telefone) -apenas números</span></label>
                                        <input type="text" name="telcelular" id="telcelular" placeholder="ex.: 1597972231" value="<?php echo $_SESSION['telcelular']; ?>" size="20" maxlength="20" class="field" onkeyup="validaNumero(this.id,this.value)"/>
                                    </p>
                                    <p>
                                        <label>E-mail *</label>
                                        <input type="text" name="email" id="email" placeholder="ex.: exemplo@email.com" value="<?php echo $_SESSION['email']; ?>" size="100" maxlength="100" class="field" onkeyup="validaEmail(this.id,this.value)" />
                                    </p>
                                    <p>
                                        <label>Digite novamente o e-mail para confirmar *</label>
                                        <input type="text" name="email" id="re-email" placeholder="ex.: exemplo@email.com" value="<?php echo $_SESSION['email']; ?>" size="100" maxlength="100" class="field" onkeyup="matchEmail(this.id,this.value)" />
                                    </p>
                                    <p>
                                        <label>Cor/Raça *</label>
                                        <input type="radio" name="raca" id="branca" value="Branca" <?php if ($_SESSION['raca'] == "Branca") echo 'checked' ?> /> Branca<br />
                                        <input type="radio" name="raca" id="preta" value="Preta" <?php if ($_SESSION['raca'] == "Preta") echo 'checked' ?> /> Preta<br />
                                        <input type="radio" name="raca" id="amarela" value="Amarela" <?php if ($_SESSION['raca'] == "Amarela") echo 'checked' ?> /> Amarela<br />
                                        <input type="radio" name="raca" id="parda" value="Parda" <?php if ($_SESSION['raca'] == "Parda") echo 'checked' ?> /> Parda<br />
                                        <input type="radio" name="raca" id="indigena" value="Indigena" <?php if ($_SESSION['raca'] == "Indigena") echo 'checked' ?> /> Indígena<br />
                                        <input type="radio" name="raca" id="semdeclaracao" value="Sem Declaracao" <?php if ($_SESSION['raca'] == "Sem Declaracao") echo 'checked' ?> /> Sem declaração<br />
                                    </p>
                                    <p><em>* Campos Obrigatórios</em></p>
                                </div>
                                <!-- End Form -->

                                <!-- Form Buttons -->
                                <div class="buttons">
                                    <?php if ($_SESSION['inscr_aberta'] && ($_SESSION['finalizado'] == false || ($_SESSION['processo'] != $_SESSION['ultimo_ps']))) { ?>
                                        <input type="submit" class="button" style="float:left; margin-top: 3px;" name="salvar" value="Finalizar Inscrição" onclick="return confirma()" />
                                    <?php } else { ?>
                                        <input type="submit" class="button" style="float:left; margin-top: 3px;" name="salvar" value="Salvar Alterações" onclick="return finaliza('salvar-alteracoes')" />
                                    <?php } ?>
                                    <input type="submit" class="button" name="avancar"  value=" Salvar e continuar >>" onClick="return validaDadosPessoais();"/>
                                </div>
                                <!-- End Form Buttons -->
                            </div>
                            <!-- End Box -->
                        </div>
                        <!-- Final da div -->

                        <div id="fa" <?php if (!isset($_GET['show']) || $_GET['show'] != 'fa') echo 'style="display:none"' ?> >
                            <!-- Box -->
                            <div class="box">
                                <!-- Box Head -->
                                <div class="box-head">
                                    <h2>Formação Acadêmica - Graduação, Especialização e/ou Mestrado</h2>
                                </div>
                                <!-- End Box Head -->
                                <!-- Form -->
                                <div class="form">
                                    <p>
                                        <label>Curso de Graduação *</label>
                                        <input type="text" name="graduacao" id="graduacao" placeholder="ex.: Licenciatura em Física" value="<?php echo $_SESSION['graduacao']; ?>" size="100" maxlength="100" class="field" onkeyup="validaLetra(this.id,this.value)" />
                                    </p>	
                                    <p>
                                        <label>Instituição *</label>
                                        <input type="text" name="instituicao-grad" id="instituicao-grad" placeholder="ex.: UFSCar" value="<?php echo $_SESSION['inst_grad']; ?>" size="100" maxlength="100" class="field" onkeyup="validaLetra(this.id,this.value)" /> 
                                    </p>
                                    <p>
                                        <label>Data de início * <span>(dd/mm/aaaa)</span></label>
                                        <input type="text" name="dtinicio-grad" id="dtinicio-grad" placeholder="ex.: 01/01/2010" value="<?php echo $_SESSION['dtini_grad']; ?>" size="20" maxlength="10" class="field" onkeyup="validaData(this.id,this.value)" />
                                    </p>
                                    <p>
                                        <label>Data de fim * <span>(dd/mm/aaaa)</span></label>
                                        <input type="text" name="dtfim-grad" id="dtfim-grad" placeholder="ex.: 30/12/2013" value="<?php echo $_SESSION['dtfim_grad']; ?>" size="20" maxlength="10" class="field" onkeyup="validaData(this.id,this.value)" />
                                    </p>
                                    <hr />
                                    <p>
                                        <label>Já fez alguma especialização? *</label>
                                        <input type="radio" name="radio-esp" value="s" onchange="showDiv('esp');" <?php if ($_SESSION['fezespecializacao']) echo 'checked' ?> /> Sim 
                                        <input type="radio" name="radio-esp" value="n" onchange="hideDiv('esp');" <?php if (!$_SESSION['fezespecializacao']) echo 'checked' ?> /> Não
                                    </p>
                                    <div id="esp" <?php if (!$_SESSION['fezespecializacao']) echo 'style=display:none'; ?>>
                                        <p>
                                            <label>Curso de Especialização</label>
                                            <input type="text" name="especializacao" id="especializacao" value="<?php echo $_SESSION['especializacao']; ?>" size="100" maxlength="100" class="field" onkeyup="validaLetra(this.id,this.value)" />
                                        </p>	
                                        <p>
                                            <label>Instituição</label>
                                            <input type="text" name="instituicao-esp" id="instituicao-esp" value="<?php echo $_SESSION['inst_esp']; ?>" size="100" maxlength="100" class="field" onkeyup="validaLetra(this.id,this.value)" /> 
                                        </p>
                                        <p>
                                            <label>Data de início<span>(dd/mm/aaaa)</span></label>
                                            <input type="text" name="dtinicio-esp" id="dtinicio-esp" value="<?php echo $_SESSION['dtini_esp']; ?>" size="20" maxlength="10" class="field" onkeyup="validaData(this.id,this.value)" />
                                        </p>
                                        <p>
                                            <label>Data de fim<span>(dd/mm/aaaa)</span></label>
                                            <input type="text" name="dtfim-esp" id="dtfim-esp" value="<?php echo $_SESSION['dtfim_esp']; ?>" size="20" maxlength="10" class="field" onkeyup="validaData(this.id,this.value)" />
                                        </p>
                                    </div>
                                    <hr />
                                    <p>
                                        <label>Já fez mestrado? *</label>
                                        <input type="radio" name="radio-mest" value="s" onchange="showDiv('mest');" <?php if ($_SESSION['fezmestrado']) echo 'checked' ?> /> Sim 
                                        <input type="radio" name="radio-mest" value="n" onchange="hideDiv('mest');" <?php if (!$_SESSION['fezmestrado']) echo 'checked' ?> /> Não
                                    </p>
                                    <div id="mest" <?php if (!$_SESSION['fezmestrado']) echo 'style=display:none'; ?>>
                                        <p>
                                            <label>Curso de Mestrado</label>
                                            <input type="text" name="mestrado" id="mestrado" value="<?php echo $_SESSION['mestrado']; ?>" size="100" maxlength="100" class="field" onkeyup="validaLetra(this.id,this.value)" />
                                        </p>	
                                        <p>
                                            <label>Instituição</label>
                                            <input type="text" name="instituicao-mest" id="instituicao-mest" value="<?php echo $_SESSION['inst_mest']; ?>" size="100" maxlength="100" class="field" onkeyup="validaLetra(this.id,this.value)" /> 
                                        </p>
                                        <p>
                                            <label>Data de início<span>(dd/mm/aaaa)</span></label>
                                            <input type="text" name="dtinicio-mest" id="dtinicio-mest" value="<?php echo $_SESSION['dtini_mest']; ?>" size="20" maxlength="10" class="field" onkeyup="validaData(this.id,this.value)" />
                                        </p>
                                        <p>
                                            <label>Data de fim<span>(dd/mm/aaaa)</span></label>
                                            <input type="text" name="dtfim-mest" id="dtfim-mest" value="<?php echo $_SESSION['dtfim_mest']; ?>" size="20" maxlength="10" class="field" onkeyup="validaData(this.id,this.value)" />
                                        </p>
                                    </div>
                                    <hr />
                                    <p>
                                        <label>Link para Currículo Lattes:</label>
                                        <input type="text" name="cvlattes" id="cvlattes" value="<?php echo $_SESSION['cvlattes']; ?>" size="100" class="field" />
                                    </p>
                                    <p><em>* Campos Obrigatórios</em></p>
                                </div>
                                <!-- End Form -->

                                <!-- Form Buttons -->
                                <div class="buttons">
                                    <?php if ($_SESSION['inscr_aberta'] && ($_SESSION['finalizado'] == false || ($_SESSION['processo'] != $_SESSION['ultimo_ps']))) { ?>
                                        <input type="submit" class="button" style="float:left; margin-top: 3px;" name="salvar" value="Finalizar Inscrição" onclick="return confirma()" />
                                    <?php } else { ?>
                                        <input type="submit" class="button" style="float:left; margin-top: 3px;" name="salvar" value="Salvar Alterações" onclick="return finaliza('salvar-alteracoes')" />
                                    <?php } ?>

                                    <input type="button" class="button" name="voltar"  value="<< Voltar" onClick="showDivMenu('dp');"/>
                                    <input type="submit" class="button" name="avancar"  value=" Salvar e continuar >>" onClick="return validaFormacaoAcademica();"/>
                                </div>
                                <!-- End Form Buttons -->
                            </div>
                            <!-- End Box -->
                        </div>
                        <!-- Final da div -->

                        <div id="dc" <?php if (!isset($_GET['show']) || $_GET['show'] != 'dc') echo 'style="display:none"' ?> >
                            <!-- Box -->
                            <div class="box">
                                <!-- Box Head -->
                                <div class="box-head">
                                    <h2>Dados Complementares</h2>
                                </div>
                                <!-- End Box Head -->

                                <!-- Form -->
                                <div class="form">

                                    <label>Possível área de interesse: *<br />
                                        <span>O PPGCM procura selecionar os melhores alunos considerando a capacidade de orientação de seus professores. 
                                            Escolha abaixo a opção que melhor se enquadra em seus interesses de estudo e pesquisa.</span></label>
                                    <p>
                                        <input type="radio" name="interesse" value="0" <?php if ($_SESSION['area_interesse'] == "0") echo 'checked'; ?> /> Tenho interesse e gostaria de ser orientado(a) na(s) área(s) de Materiais Funcionais e Polímeros de Fontes Renováveis.
                                        <br /><input type="radio" name="interesse" value="1" <?php if ($_SESSION['area_interesse'] == "1") echo 'checked'; ?> /> Tenho interesse e gostaria de ser orientado(a) na(s) área(s) de Nanociência e Nanotecnologia de materiais.
                                        <br /><input type="radio" name="interesse" value="2" <?php if ($_SESSION['area_interesse'] == "2") echo 'checked'; ?> /> Ainda não defini em qual área quero trabalhar neste momento e pretendo defini-la ao longo do primeiro semestre.
                                        <!-- <br /><input type="radio" name="interesse" value="2" <?php if ($_SESSION['area_interesse'] == "2") echo 'checked'; ?> /> Tenho interesse e gostaria de ser orientado(a) na(s) área(s) de Redes de Computadores, Sistemas Distribuídos, Computação Móvel e Ubíqua. -->
                                        <!-- <br /><input type="radio" name="interesse" value="3" <?php if ($_SESSION['area_interesse'] == "3") echo 'checked'; ?> /> Tenho interesse e gostaria de ser orientado(a) na(s) área(s) de Teoria dos Grafos, Análise de Algoritmos e Teoria da Computação. -->
                                        <!-- <br /><input type="radio" name="interesse" value="4" <?php if ($_SESSION['area_interesse'] == "4") echo 'checked'; ?> /> Tenho interesse e gostaria de ser orientado (a) na(s) área(s) de Processamento de Imagens e Sinais, Computação Gráfica e Projeto e Desenvolvimento de Jogos Eletrônicos Interativos.-->
                                        <!-- <br /><input type="radio" name="interesse" value="5" <?php if ($_SESSION['area_interesse'] == "5") echo 'checked'; ?> /> Tenho interesse e gostaria de ser orientado (a) na(s) área(s) de Linguagens de Programação e Compiladores. -->
                                    </p>	
                                    <hr />
                                    <!-- <label>Possíveis áreas que NÃO lhe interessam: *<br /> 
                                        <span> Caso não seja aceito na área selecionada acima, escolha quais áreas você NÃO gostaria de atuar.</span></label>
                                    <p>
                                        <input type="checkbox" name="n_interesse[]" value="0" <?php //if (strstr($_SESSION['area_n_interesse'], "0") != "") echo 'checked'; ?> /> Não tenho interesse e não gostaria de ser orientado(a) na(s) área(s) de Banco de Dados e Inteligência Artificial.
                                        <br /><input type="checkbox" name="n_interesse[]" value="1" <?php //if (strstr($_SESSION['area_n_interesse'], "1") != "") echo 'checked'; ?> /> Não tenho interesse e não gostaria de ser orientado(a) na(s) área(s) de Engenharia de Software e Interface Humano-Computador.
                                        <br /><input type="checkbox" name="n_interesse[]" value="2" <?php //if (strstr($_SESSION['area_n_interesse'], "2") != "") echo 'checked'; ?> /> Não tenho interesse e não gostaria de ser orientado(a) na(s) área(s) de Redes de Computadores, Sistemas Distribuídos, Computação Móvel e Ubíqua.
                                        <br /><input type="checkbox" name="n_interesse[]" value="3" <?php //if (strstr($_SESSION['area_n_interesse'], "3") != "") echo 'checked'; ?> /> Não tenho interesse e não gostaria de ser orientado(a) na(s) área(s) de Teoria dos Grafos, Análise de Algoritmos e Teoria da Computação.
                                        <br /><input type="checkbox" name="n_interesse[]" value="4" <?php //if (strstr($_SESSION['area_n_interesse'], "4") != "") echo 'checked'; ?> /> Não tenho interesse e não gostaria de ser orientado (a) na(s) área(s) de Processamento de Imagens e Sinais, Computação Gráfica e Projeto e Desenvolvimento de Jogos Eletrônicos Interativos.
                                        <br /><input type="checkbox" name="n_interesse[]" value="5" <?php //if (strstr($_SESSION['area_n_interesse'], "5") != "") echo 'checked'; ?> /> Não tenho interesse e não gostaria de ser orientado (a) na(s) área(s) de Linguagens de Programação e Compiladores.
                                    </p>  
                                    <hr /> -->
                                    <label>Regime de dedicação ao curso: *<br />
                                        <span> O PPGCM espera que o aluno se dedique ao Curso de forma a viabilizar sua formação em 24 meses. 
                                            A dedicação em tempo integral é desejável, mas o Curso admite também alunos com projetos relevantes a serem executados em regime de dedicação parcial. 
                                            O regime de dedicação parcial pressupõe que o aluno terá condições para a realização de seus estudos e, caso o aluno tenha vínculo empregatício, espera-se o compromisso explícito do empregador com a formação do aluno. 
                                            Marque abaixo sua opção de regime de dedicação ao Curso:</span>
                                    </label>
                                    <p>
                                        <input type="radio" name="dedicacao" value="0" <?php if ($_SESSION['dedicacao'] == 0) echo 'checked' ?> /> Regime de estudos em tempo integral.
                                        <br /><input type="radio" name="dedicacao" value="1" <?php if ($_SESSION['dedicacao'] == 1) echo 'checked' ?> /> Regime de estudos em tempo parcial.
                                    </p>
                                    <hr />
                                    <label>Vínculo Empregatício: *<br />
                                        <span>Marque abaixo a sua situação em termos de vínculo empregatício durante a realização do Curso:</span>
                                    </label>
                                    <p>
                                        <input type="radio" name="vinculoemp" value="0" <?php if ($_SESSION['vinculo_emp'] == 0) echo 'checked' ?> /> Não pretendo manter vínculo de emprego durante a realização do curso.
                                        <br /><input type="radio" name="vinculoemp" value="1" <?php if ($_SESSION['vinculo_emp'] == 1) echo 'checked' ?> /> Pretendo manter meu emprego, com autorização de meu empregador para estudar em regime de tempo integral.
                                        <br /><input type="radio" name="vinculoemp" value="2" <?php if ($_SESSION['vinculo_emp'] == 2) echo 'checked' ?> /> Pretendo manter meu emprego, sendo aluno em tempo parcial no PPGCM, entendendo que terei a necessária disponibilidade para estudar com dedicação.
                                    </p>  
                                    <hr />
                                    <label>Interesse em bolsa de estudo: *<br />
                                        <span> As bolsas de estudos são concedidas apenas para alunos com dedicação em tempo integral. 
                                            Apesar de algumas exceções, a maioria das bolsas não pode ser concedida a alunos que mantenham vínculo empregatício. 
                                            Marque abaixo sua situação em termos de bolsa de estudos:</span></label>
                                    <p>
                                        <input type="radio" name="bolsa" value="0" <?php if ($_SESSION['interesse_bolsa'] == 0) echo 'checked' ?> /> Pretendo estudar sem bolsa de estudos.
                                        <br /><input type="radio" name="bolsa" value="1" <?php if ($_SESSION['interesse_bolsa'] == 1) echo 'checked' ?> /> Atendo às condições requeridas e gostaria de ter uma bolsa atribuída pelo Curso, mas acho que poderei estudar de forma satisfatória ainda que não seja contemplado com bolsa.
                                        <br /><input type="radio" name="bolsa" value="2" <?php if ($_SESSION['interesse_bolsa'] == 2) echo 'checked' ?> /> Atendo às condições requeridas e considero IMPRESCINDÍVEL ter uma bolsa atribuída pelo Curso para viabilizar meus estudos.
                                    </p>
                                    <hr />
                                    <label>Experiência Profissional:<br />
                                        <span> Descreva a seguir sua experiencia profissional, indicando a empresa e as tarefas desempenhadas (máximo de 1500 caracteres)</span></label>
                                    <p>
                                        <textarea name="experiencia-prof" rows="10" cols="50" maxlength="1500" class="field"><?php echo $_SESSION['exp_profissional']; ?></textarea>
                                    </p>
                                    <hr />
                                    <label>Iniciação Científica: *</label>
                                    <p>
                                        <input type="radio" name="ic" value="0" onchange="showDiv('exp_ic');" <?php if ($_SESSION['ic'] == 0) echo 'checked' ?> /> Fiz Iniciação Científica com bolsa.
                                        <br /><input type="radio" name="ic" value="1" onchange="showDiv('exp_ic');" <?php if ($_SESSION['ic'] == 1) echo 'checked' ?> /> Fiz Iniciação Científica sem bolsa.
                                        <br /><input type="radio" name="ic" value="2" onchange="hideDiv('exp_ic');" <?php if ($_SESSION['ic'] == 2) echo 'checked' ?> /> Não fiz Iniciação Científica.
                                    </p>
                                    <div id="exp_ic"  <?php if ($_SESSION['ic'] == 2) echo 'style=display:none'; ?> >
                                        <label>Experiência de Pesquisa ou Iniciação Científica: *<br />
                                            <span> Descreva a seguir sua eventual experiência de pesquisa ou iniciação científica, indicando instituição acolhedora, órgão financiador, 
                                                orientador ou equipe, principal tema de pesquisa e resultados alcançados (máximo de 1500 caracteres).</span></label>
                                        <p>                                    
                                            <textarea name="experiencia-ic" id="experiencia-ic" rows="10" cols="50" maxlength="1500" class="field"><?php echo $_SESSION['ic_descricao'] ?></textarea>
                                        </p>
                                    </div>
                                    <hr />
                                    <label>Conhecimento de Inglês: *<br />
                                        <span>Marque a seguir a situação em que você se enquadra especificamente com respeito ao domínio da língua inglesa: </span></label>
                                    <p>                                    
                                        <input type="radio" name="ingles" value="0" <?php if ($_SESSION['ingles'] == 0) echo 'checked' ?> /> Leio, escrevo e falo Inglês com fluência.
                                        <br /><input type="radio" name="ingles" value="1" <?php if ($_SESSION['ingles'] == 1) echo 'checked' ?> /> Leio e escrevo razoavelmente, mas pretendo melhorar minha capacidade de conversação e redação na língua.
                                        <br /><input type="radio" name="ingles" value="2" <?php if ($_SESSION['ingles'] == 2) echo 'checked' ?> /> Tenho conhecimentos básicos de leitura e escrita da língua.
                                    </p>
                                    <hr />
                                    <label>Nota média da graduação: *<br />
                                        <span>Se o histórico do curso não apresentar a média, favor somar as notas e dividir pelo número de disciplina do curso. 
                                            Considere também as reprovações no momento de fazer o cálculo. (Favor inserir a nota utilizando , (vírgula) como separador). 
                                            Para alunos graduados em instituições onde a nota é representada através de conceitos, os seguintes mapeamentos devem ser utilizados para fins de cálculo da média: 
                                            A =10; B=8,5; C=7,0; D=5,5; E=0.</span>
                                    </label>
                                    <p>
                                        <input type="text" name="nota" id="nota" placeholder="ex.: 6,4" value="<?php echo $_SESSION['notamedia'] ?>" class="field" onkeyup="validaNota(this.id,this.value)" /> 
                                    </p>
                                    <hr />
                                    <label> Contato prévio *<br />
                                        <span> Caso tenha conversado com algum professor previamente, selecione abaixo o nome do docente:</span></label>
                                    <p>
                                        <select name="docentes" class="field">
                                            <option value="Nenhum contato" <?php if ($_SESSION['nome_docente'] == "Nenhum contato") echo 'selected' ?> >Nenhum contato </option>
                                            <option value="Adriana de Oliveira Delgado Silva" <?php if ($_SESSION['nome_docente'] == "Adriana de Oliveira Delgado Silva") echo 'selected' ?>>Adriana de Oliveira Delgado Silva </option>
                                            <option value="Ana Lúcia Brandl" <?php if ($_SESSION['nome_docente'] == "Ana Lúcia Brandl") echo 'selected' ?>>Ana Lúcia Brandl </option>
                                            <option value="Andrea Madeira Kliauga" <?php if ($_SESSION['nome_docente'] == "Andrea Madeira Kliauga") echo 'selected' ?>>Andrea Madeira Kliauga </option>
                                            <option value="Antonio José Felix Carvalho" <?php if ($_SESSION['nome_docente'] == "Antonio José Felix Carvalho") echo 'selected' ?> >Antonio José Felix Carvalho </option>
                                            <option value="Antonio Riul Jr." <?php if ($_SESSION['nome_docente'] == "Antonio Riul Jr.") echo 'selected' ?> >Antonio Riul Jr. </option>
                                            <option value="Aparecido Junior de Menezes" <?php if ($_SESSION['nome_docente'] == "Aparecido Junior de Menezes") echo 'selected' ?> >Aparecido Junior de Menezes </option>
                                            <option value="Corinne Arrouvel" <?php if ($_SESSION['nome_docente'] == "Corinne Arrouvel") echo 'selected' ?> >Corinne Arrouvel </option>
                                            <option value="Eliana Ap. de Rezende Duek" <?php if ($_SESSION['nome_docente'] == "Eliana Ap. de Rezende Duek") echo 'selected' ?> >Eliana Ap. de Rezende Duek </option>
                                            <option value="Elisabete Alves Pereira" <?php if ($_SESSION['nome_docente'] == "Elisabete Alves Pereira") echo 'selected' ?> >Elisabete Alves Pereira </option>
                                            <option value="Fábio Minoru Yamaji" <?php if ($_SESSION['nome_docente'] == "Fábio Minoru Yamaji") echo 'selected' ?> >Fábio Minoru Yamaji </option>
                                            <option value="Francisco Trivinho Strixino" <?php if ($_SESSION['nome_docente'] == "Francisco Trivinho Strixino") echo 'selected' ?> >Francisco Trivinho Strixino </option>
                                            <option value="Jane Maria Faulstich de Paiva" <?php if ($_SESSION['nome_docente'] == "Jane Maria Faulstich de Paiva") echo 'selected' ?> >Jane Maria Faulstich de Paiva </option>
                                            <option value="Johnny Vilcarromero Lopez" <?php if ($_SESSION['nome_docente'] == "Johnny Vilcarromero Lopez") echo 'selected' ?> >Johnny Vilcarromero Lopez </option>
                                            <option value="José Benaque Rubert" <?php if ($_SESSION['nome_docente'] == "José Benaque Rubert") echo 'selected' ?> >José Benaque Rubert </option>
                                            <option value="Marystela Ferreira" <?php if ($_SESSION['nome_docente'] == "Marystela Ferreira") echo 'selected' ?> >Marystela Ferreira </option>
                                            <option value="Osvaldo Novais de Oliveira Jr" <?php if ($_SESSION['nome_docente'] == "Osvaldo Novais de Oliveira Jr") echo 'selected' ?> >Osvaldo Novais de Oliveira Jr </option>
                                            <option value="Tersio Guilherme de Souza Cruz" <?php if ($_SESSION['nome_docente'] == "Tersio Guilherme de Souza Cruz") echo 'selected' ?> >Tersio Guilherme de Souza Cruz </option>
                                            <option value="Vagner Roberto Botaro" <?php if ($_SESSION['nome_docente'] == "Vagner Roberto Botaro") echo 'selected' ?> >Vagner Roberto Botaro </option>
                                            <option value="Walter Ruggeri Waldman" <?php if ($_SESSION['nome_docente'] == "Walter Ruggeri Waldman") echo 'selected' ?> >Walter Ruggeri Waldman </option>
                                        </select>   
                                    </p>
                                    <hr />
                                    <p>
                                        <label>Prova de Ingresso: *<br />
                                            <span>Marque a seguir a situação em que você deseja realizar a prova de ingresso:</span>
                                        </label>
                                        <input type="radio" name="loc" value="0" onchange="hideDiv('localprova');" <?php if ($_SESSION['locprova'] == "0") echo 'checked'; ?> /> Em Sorocaba.
                                        <br /><input type="radio" name="loc" value="1" onchange="showDiv('localprova');" <?php if ($_SESSION['locprova'] == "1") echo 'checked'; ?> /> Fora de Sorocaba.
                                        <div id="localprova" <?php if ($_SESSION['locprova'] == "0") echo 'style=display:none'; ?>>
                                            <p>
                                            <label>Local onde deseja realizar a prova: *</label>
                                            <input type="text" name="provalocal" id="provalocal" value="<?php echo $_SESSION['provalocal'] ?>" size="50" class="field" />
                                            </p>
                                            <p>
                                            <label>Professor responsável pela aplicação: *</label>
                                            <input type="radio" name="profprova" value="0" onchange="hideDiv('provaprof');" <?php if ($_SESSION['profprova'] == "0") echo 'checked'; ?> /> Ainda não encontrei um professor para aplicar a prova.
                                            <br /><input type="radio" name="profprova" value="1" onchange="showDiv('provaprof');" <?php if ($_SESSION['profprova'] == "1") echo 'checked'; ?> /> Já encontrei um professor para aplicar a prova.
                                            </p>
                                            <div id="provaprof" <?php if ($_SESSION['profprova'] == "0") echo 'style=display:none'; ?>>
                                                <p>
                                                <label>Nome do professor responsável pela aplicação da prova: *</label>
                                                <input type="text" name="nomeprof" id="nomeprof" value="<?php echo $_SESSION['profnome'] ?>" size="50" class="field" />
                                                </p>
                                                <p>
                                                <label>Instituição do professor: *</label>
                                                <input type="text" name="instprof" id="instprof" value="<?php echo $_SESSION['profinst'] ?>" size="50" class="field" />
                                                </p>
                                                <p>
                                                <label>Email do professor: *</label>
                                                <input type="text" name="emailprof" id="emailprof" value="<?php echo $_SESSION['profemail'] ?>" size="50" class="field" />
                                                </p>
                                            </div>
                                        </div>
                                    </p>
                                    <p><em>* Campos Obrigatórios</em></p>
                                </div>
                                <!-- End Form -->

                                <!-- Form Buttons -->
                                <div class="buttons">
                                    <?php if ($_SESSION['inscr_aberta'] && ($_SESSION['finalizado'] == false || ($_SESSION['processo'] != $_SESSION['ultimo_ps']))) { ?>
                                        <input type="submit" class="button" style="float:left; margin-top: 3px;" name="salvar" value="Finalizar Inscrição" onclick="return confirma()" />
                                    <?php } else { ?>
                                        <input type="submit" class="button" style="float:left; margin-top: 3px;" name="salvar" value="Salvar Alterações" onclick="return finaliza('salvar-alteracoes')" />
                                    <?php } ?>
                                    <input type="button" class="button" name="voltar"  value="<< Voltar" onClick="showDivMenu('fa');"/>
                                    <input type="submit" class="button" name="avancar"  value=" Salvar e continuar >>" onClick="return validaDadosComplementares();"/>
                                </div>
                                <!-- End Form Buttons -->
                            </div>
                            <!-- End Box -->
                        </div>
                        <!-- Final da div -->

                        <div id="cr" <?php if (!isset($_GET['show']) || $_GET['show'] != 'cr') echo 'style="display:none"' ?>> 
                            <!-- Box -->
                            <div class="box">
                                <!-- Box Head -->
                                <div class="box-head">
                                    <h2>Cartas de Recomendação</h2>
                                </div>
                                <!-- End Box Head -->

                                <!-- Form -->
                                <div class="form">
                                    <p>
                                        <label>Nome do recomendante 1 *</label>
                                        <input type="text" name="nome-r1" id="nome-r1" placeholder="ex.: Roberto dos Santos" value="<?php echo $_SESSION['nome_r1'] ?>" size="100" maxlength="100" class="field" onkeyup="validaLetra(this.id, this.value)" /> 
                                    </p>	
                                    <p>
                                        <label>E-mail institucional do recomendante 1 *</label>
                                        <input type="text" name="email-r1" id="email-r1" placeholder="ex.: roberto@email.com"  value="<?php echo $_SESSION['email_r1'] ?>" size="100" maxlength="100" class="field" onkeyup="validaEmail(this.id, this.value)" /> 
                                    </p>	
                                    <label>Qual a sua relação com o recomendante 1: *</label>
                                    <p>    
                                        <input type="checkbox" name="recom1[]" value="0" <?php if (strstr($_SESSION['relacao_r1'], "0") != "") echo 'checked'; ?> /> Fui aluno de disciplina do recomendador.
                                        <br /><input type="checkbox" name="recom1[]" value="1" <?php if (strstr($_SESSION['relacao_r1'], "1") != "") echo 'checked'; ?> /> Fui orientado pelo recomendador.
                                        <br /><input type="checkbox" name="recom1[]" value="2" <?php if (strstr($_SESSION['relacao_r1'], "2") != "") echo 'checked'; ?> /> Fui aluno em mais de uma disciplina do recomendador.
                                        <br /><input type="checkbox" name="recom1[]" value="3" <?php if (strstr($_SESSION['relacao_r1'], "3") != "") echo 'checked'; ?> /> O recomendador foi chefe do departamento onde estudei.
                                        <br /><input type="checkbox" name="recom1[]" value="4" <?php if (strstr($_SESSION['relacao_r1'], "4") != "") echo 'checked'; ?> /> O recomendador possuía cargo de chefia, gerência ou direção na empresa onde trabalhei.
                                        <br /><input type="checkbox" name="recom1[]" value="5" <?php if (strstr($_SESSION['relacao_r1'], "5") != "") echo 'checked'; ?> /> Meu colega.
                                        <br /><input type="checkbox" name="recom1[]" value="6" <?php if (strstr($_SESSION['relacao_r1'], "6") != "") echo 'checked'; ?> onchange="showAndHide('outro1')"  /> Outro
                                    </p>
                                    <div id="outro1"  <?php if (!strstr($_SESSION['relacao_r1'], "5") != "") echo 'style=display:none'; ?> >
                                        <input type="text" name="outro-r1" id="outro-r1"  value="<?php echo $_SESSION['outro_r1'] ?>" size="50" maxlength="100" class="field"/> 
                                    </div>
                                    <?php 
                                        if ($_SESSION['carta1'] != ""){ ?>
                                            <p>
                                                <label>Carta de recomendação já enviada:</label>
                                                <a href="<?php echo $_SESSION['carta1'] ?>">Carta do recomendante 1</a>
                                            </p>
                                    <?php }
                                     ?>
                                    <!-- ==========================================================================================================-->
                                    <!-- ==========================================================================================================-->
                                    <label>Upload da carta de recomendação do recomendante 1 (em pdf ou jpg):</label>
                                    <input name="letterfile1" type="file" /><br />
                                    <!-- <input type="submit" value="Send files" /> -->
                                    <!-- ==========================================================================================================-->
                                    <!-- ==========================================================================================================-->
                                    <hr />
                                    <p>
                                        <label>Nome do recomendante 2 *</label>
                                        <input type="text" name="nome-r2" id="nome-r2" placeholder="ex.: Cecília Rodrigues" value="<?php echo $_SESSION['nome_r2'] ?>" size="100" maxlength="100" class="field" onkeyup="validaLetra(this.id,this.value)" /> 
                                    </p>	
                                    <p>
                                        <label>E-mail institucional do recomendante 2 *</label>
                                        <input type="text" name="email-r2" id="email-r2" placeholder="ex.: cecilia@email.com.br" value="<?php echo $_SESSION['email_r2'] ?>" size="100" maxlength="100" class="field" onkeyup="validaEmail(this.id, this.value)" /> 
                                    </p>	

                                    <label>Qual a sua relação com o recomendante 2: *</label>
                                    <p>
                                        <input type="checkbox" name="recom2[]" value="0" <?php if (strstr($_SESSION['relacao_r2'], "0") != "") echo 'checked'; ?> /> Fui aluno de disciplina do recomendador.
                                        <br /><input type="checkbox" name="recom2[]" value="1" <?php if (strstr($_SESSION['relacao_r2'], "1") != "") echo 'checked'; ?> /> Fui orientado pelo recomendador.
                                        <br /><input type="checkbox" name="recom2[]" value="2" <?php if (strstr($_SESSION['relacao_r2'], "2") != "") echo 'checked'; ?> /> Fui aluno em mais de uma disciplina do recomendador.
                                        <br /><input type="checkbox" name="recom2[]" value="3" <?php if (strstr($_SESSION['relacao_r2'], "3") != "") echo 'checked'; ?> /> O recomendador foi chefe do departamento onde estudei.
                                        <br /><input type="checkbox" name="recom2[]" value="4" <?php if (strstr($_SESSION['relacao_r2'], "4") != "") echo 'checked'; ?> /> O recomendador possuía cargo de chefia, gerência ou direção na empresa onde trabalhei.
                                        <br /><input type="checkbox" name="recom2[]" value="5" <?php if (strstr($_SESSION['relacao_r2'], "5") != "") echo 'checked'; ?> /> Meu colega.
                                        <br /><input type="checkbox" name="recom2[]" value="6" <?php if (strstr($_SESSION['relacao_r2'], "6") != "") echo 'checked'; ?> onchange="showAndHide('outro2')" /> Outro
                                    </p>
                                    <div id="outro2" <?php if (!strstr($_SESSION['relacao_r2'], "5")) echo 'style=display:none'; ?>>
                                        <input type="text" name="outro-r2" id="outro-r2" value="<?php echo $_SESSION['outro_r2'] ?>" size="50" maxlength="100" class="field"/> 
                                    </div>
                                    <?php 
                                        if ($_SESSION['carta2'] != ""){ ?>
                                            <p>
                                                <label>Carta de recomendação já enviada:</label>
                                                <a href="<?php echo $_SESSION['carta2'] ?>">Carta do recomendante 2</a>
                                            </p>
                                    <?php }
                                     ?>
                                    <!-- ==========================================================================================================-->
                                    <!-- ==========================================================================================================-->
                                    <label>Upload da carta de recomendação do recomendante 2 (em pdf ou jpg):</label>
                                    <input name="letterfile2" type="file" /><br />
                                    <!-- <input type="submit" value="Send files" /> -->
                                    <!-- ==========================================================================================================-->
                                    <!-- ==========================================================================================================-->
                                    <p><em>* Campos Obrigatórios</em></p>
                                </div>
                                <!-- End Form -->

                                <!-- Form Buttons -->
                                <div class="buttons">
                                    <?php if ($_SESSION['inscr_aberta'] && ($_SESSION['finalizado'] == false || ($_SESSION['processo'] != $_SESSION['ultimo_ps']))) { ?>
                                        <input type="submit" class="button" style="float:left; margin-top: 3px;" name="salvar" value="Finalizar Inscrição" onclick="return confirma()" />
                                    <?php } else { ?>
                                        <input type="submit" class="button" style="float:left; margin-top: 3px;" name="salvar" value="Salvar Alterações" onclick="return finaliza('salvar-alteracoes')" />
                                    <?php } ?>
                                    <input type="button" class="button" name="voltar"  value="<< Voltar" onClick="showDivMenu('dc');"/>
                                </div>
                                <!-- End Form Buttons -->
                            </div>
                            <!-- End Box -->
                        </div>
                        <!-- Final div -->



                    </form>
                    <!-- Final do Form -->
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