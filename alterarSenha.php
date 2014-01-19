<?php
session_start();
if (!isset($_SESSION['AUTH']) || $_SESSION['AUTH'] == false) {
    include('oops.php');
} else {
    include("cabecalho.php");
    include("conexao.php");
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
                    <a href="alterarSenha.php">Alterar Senha</a>
                    <span>|</span>
                    <a href="logout.php">Sair</a>
                </div>
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

                    <form method="post" action="RecebeSenha.php">
                        <!-- Box -->
                        <div class="box">
                            <!-- Box Head -->
                            <div class="box-head">
                                <h2>Alterar senha</h2>
                            </div>
                            <!-- End Box Head -->
                            <!-- Form -->
                            <div class="form">
                                <?php if (isset($_GET['p']) && $_GET['p'] == 'erro') { ?>
                                    <div class="msg msg-error" style="line-height: 1.2">
                                        <p><strong>Senha atual incorreta!</strong></p>
                                    </div>
                                <?php } ?>
                                <p>
                                    Preencha corretamente os campos abaixo para alterar sua senha
                                </p>
                                <p>
                                    <label>Senha Atual *</label>
                                    <input type="password" name="senha-atual" id="senha-atual" size="30" maxlength="30" class="field" />
                                </p>
                                <p>
                                    <label>Informe uma nova senha * <span>(de 6 a 30 caracteres)</span></label>
                                    <input type="password" name="senha" id="senha" size="30" maxlength="30" class="field" onkeyup="validaSenha(this.id,this.value)" />
                                </p>
                                <p>
                                    <label>Repita a nova senha *</label>
                                    <input type="password" name="re-senha" id="re-senha" size="30" maxlength="30" class="field" onkeyup="matchSenha(this.id,this.value)" />
                                </p>
                                <p><em>* Campos Obrigatórios</em></p>
                            </div>
                            <!-- End Form -->

                            <!-- Form Buttons -->
                            <div class="buttons">
                                <input type="submit" class="button" name="alterar-senha"  value="Alterar Senha" onclick="return validaNovaSenha();" />
                            </div>
                            <!-- End Form Buttons -->
                        </div>
                        <!-- End Box -->

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

    <?php
    include("rodape.php");
} // fim else
?>