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

                <form method="post" action="recuperaSenha.php">
                    <!-- Box -->
                    <div class="box">
                        <!-- Box Head -->
                        <div class="box-head">
                            <h2>Recuperação de senha</h2>
                        </div>
                        <!-- End Box Head -->
                        <!-- Form -->
                        <div class="form">
                            <?php if (isset($_GET['p']) && $_GET['p'] == 'erroCadastro') { ?>
                                <div class="msg msg-error" style="line-height: 1.2">
                                    <p><strong>Não foi encontrado nenhum usuário cadastrados com estes dados! Verifique se digitou corretamente</strong></p>
                                </div>
                            <?php } ?>
                            <p>
                                Informe o seu CPF/Passaporte e o seu Documento de Identidade e em breve lhe enviaremos um email com a sua senha.
                            </p>
                            <p>
                                <label>CPF *</label>
                                <input type="text" name="cpf" id="cpf" placeholder="ex.: 9998883331" size="30" maxlength="30" class="field" onkeyup="validaNumero(this.id,this.value)" /> 
                            </p>	
                            <p>
                                <label>Documento de Identidade *</label>
                                <input type="text" name="identidade" id="identidade" placeholder="ex.: 99988833X" size="30" maxlength="30" class="field" onkeyup="validaIdentidade(this.id,this.value)" /> 
                            </p>
                            <p><em>* Campos Obrigatórios</em></p>
                        </div>
                        <!-- End Form -->

                        <!-- Form Buttons -->
                        <div class="buttons">
                            <input type="submit" class="button" name="esqueci"  value="Enviar" onClick=""/>
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

<?php include("rodape.php") ?>