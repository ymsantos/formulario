<?php
include("cabecalho.php");
include("conexao.php");

// Para garantir que nao tem nada na sessao
session_start();
session_destroy();
session_unset();

session_start();
?>


<!-- Header -->
<div id="header">
    <div class="shell">
        <!-- Logo + Top Nav -->
        <div id="top">
            <img src="css/images/logo-pos3.png" style="float:left"/>
            <h1><a href="index.php">Processo Seletivo</a></h1>
        </div>
        <!-- End Logo + Top Nav -->

        <!-- Main Nav 
        <div id="navigation">
            <ul>
                <li><a href="javascript:void(0)" id="m-iniCad" onclick="showDivMenu('iniCad');" class="active"> Início Inscrição </a></li>
            </ul>
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

            <!-- Content -->
            <div id="content">

                <form method="post" action="RecebeDadosInscricao.php">
                    <div id="inscricao"> 

                        <?php
                        // seleciona processo seletivo mais recente
                        $sql = "SELECT * FROM processo_seletivo ORDER BY processo DESC LIMIT 1";
                        $rs = mysql_query($sql);
                        $ps = mysql_fetch_array($rs);

                        $dtini = $ps['dt_inicio'];
                        $dtfim = $ps['dt_fim'];
                        $dthoje = date("Y-m-d");


                        if ($dthoje >= $dtini && $dthoje <= $dtfim)
                            $inscr_aberta = true;
                        else
                            $inscr_aberta = false;

                        $_SESSION['inscr_aberta'] = $inscr_aberta;
                        ?>

                        <?php if (mysql_num_rows($rs) != 1) { ?>
                            <!-- Box -->
                            <div class="box">
                                <!-- Box Head -->
                                <div class="box-head">
                                    <h2>Inscrição - Processo Seletivo</h2>
                                </div>
                                <!-- End Box Head -->
                                <!-- Form -->
                                <div class="form">
                                    <div class="msg msg-error" style="line-height: 1.2">
                                        <p><strong>Não há nenhum Processo Seletivo cadastrado </strong></p>
                                    </div>
                                </div>
                                <!-- End Form -->
                            </div>
                            <!-- End Box -->
                        <?php } else if (!$inscr_aberta) { ?>
                            <!-- Box -->
                            <div class="box">
                                <!-- Box Head -->
                                <div class="box-head">
                                    <h2>Inscrição - Processo Seletivo <?php echo $ps['processo'] ?></h2>
                                </div>
                                <!-- End Box Head -->
                                <!-- Form -->
                                <div class="form">
                                    <div class="msg msg-error" style="line-height: 1.2">
                                        <p><strong>As inscrições já foram encerradas!</strong></p>
                                    </div>
                                </div>
                                <!-- End Form -->
                            </div>
                            <!-- End Box -->
                        <?php } else { ?>
                            <!-- Box -->
                            <div class="box">
                                <!-- Box Head -->
                                <div class="box-head">
                                    <h2>Inscrição - Processo Seletivo <?php echo $ps['processo'] ?></h2>
                                </div>
                                <!-- End Box Head -->
                                <!-- Form -->
                                <div class="form">
                                    <!-- Carregar do BD -->
                                    <input type="hidden" name="processo" value="<?php echo $ps['processo'] ?>" /> 
                                    <?php if (isset($_GET['p']) && $_GET['p'] == 'erroCadastro') { ?>
                                        <div class="msg msg-error" style="line-height: 1.2">
                                            <p><strong>Usuário já cadastrado!</strong></p>
                                        </div>
                                    <?php } ?>
                                    <p>
                                        Para se inscrever no processo seletivo, informe os dados abaixo e em seguida clique em 'Fazer Inscrição'
                                    </p>
                                    <p>
                                        <label>Nome completo *</label>
                                        <input type="text" name="nome" id="nome" placeholder="ex.: José de Oliveira" size="50" maxlength="100" class="field" onkeyup="validaLetra(this.id,this.value)" />
                                    </p>	
                                    <p>
                                        <label>CPF *<span>(apenas números - caso seja estrangeiro, informe o passaporte)</span></label>
                                        <input type="text" name="cpf" id="cpf" placeholder="ex.: 9998883331" size="30" maxlength="30" class="field" onkeyup="validaNumero(this.id,this.value)" /> 
                                    </p>	
                                    <p>
                                        <label>Informe uma Senha *<span>(de 6 a 30 caracteres)</span></label>
                                        <input type="password" name="senha" id="senha" size="30" maxlength="30" class="field" onkeyup="validaSenha(this.id,this.value)" />
                                    </p>
                                    <p>
                                        <label>Repita a Senha *</label>
                                        <input type="password" name="re-senha" id="re-senha" size="30" maxlength="30" class="field" onkeyup="matchSenha(this.id,this.value)" />
                                    </p>
                                    <p><em>* Campos Obrigatórios</em></p>
                                </div>
                                <!-- End Form -->

                                <!-- Form Buttons -->
                                <div class="buttons">
                                    <input type="submit" class="button" name="inscricao"  value="Fazer Inscrição" onclick="return verificaCampos()"/>
                                </div>
                                <!-- End Form Buttons -->
                                <!-- </form> -->
                            </div>
                            <!-- End Box -->
                        <?php } //fim else   ?>

                    </div>
                    <!-- Final div -->
                </form>
                <!-- Final do Form -->


                <form method="post" action="validaLogin.php">
                    <div id="login"> 
                        <!-- Box -->
                        <div class="box">
                            <!-- Box Head -->
                            <div class="box-head">
                                <h2>Login</h2>
                            </div>
                            <!-- End Box Head -->
                            <!-- Form -->
                            <div class="form">
                                <?php if (isset($_GET['p']) && $_GET['p'] == 'erroLogin') { ?>
                                    <div class="msg msg-error" style="line-height: 1.2">
                                        <p><strong>Usuário e/ou senha inválidos!</strong></p>
                                    </div>
                                <?php } ?>
                                <p>
                                    Se você já se inscreveu em algum processo seletivo do PPGCM faça o login para ver seus dados.
                                </p>	
                                <p>
                                    <label>Usuário <span>(CPF/Passaporte)</span></label>
                                    <input type="text" name="cpf-login" id="cpf-login" size="30" maxlength="30" class="field" onkeyup="validaUser(this.id,this.value)" /> 
                                </p>	
                                <p>
                                    <label>Senha</label>
                                    <input type="password" name="senha-login" id="senha-login" size="30" maxlength="30" class="field" onkeyup="validaSenha(this.id,this.value)" />
                                </p>

                                <p>
                                    <!-- <a href="esqueci.php">Esqueceu a senha?</a> -->
                                    <a href="#" onclick="showDiv('esqueci')">Esqueceu a senha?</a>    
                                </p>
                                <div id="esqueci" style="display:none"> 
                                    <p>Por favor entre em contato através do email <strong>ppgcm@ufscar.br</strong> com seu Nome e CPF e em breve lhe enviaremos uma nova senha</p>
                                </div>

                            </div>
                            <!-- End Form -->

                            <!-- Form Buttons -->
                            <div class="buttons">
                                <input type="submit" class="button" name="entrar" value="Entrar" onClick="return verificaLogin();"/>
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

            <!-- Gambiarra para o rodape ficar em baixo (veio com o template..rs) -->
            <div class="cl">&nbsp;</div>
        </div>
        <!-- Main -->
    </div>
    <!-- End Shell -->
</div>
<!-- End Container -->

<?php include("rodape.php") ?>