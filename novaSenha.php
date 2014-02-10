<?php
session_start();

include("cabecalho.php");
include("conexao.php");

$id = $_GET['pa'];
$hash = $_GET['pb'];

$sql = "SELECT * FROM dados_aluno WHERE cpf_passaporte=$id AND senha='$hash'";
$rs = mysql_query($sql);
$dados = mysql_fetch_array($rs);

if (mysql_num_rows($rs) == 0){
    header('location: oops.php');
} else {
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

                <form method="post" action="RecebeNovaSenha.php">
                    <!-- Box -->
                    <div class="box">
                        <!-- Box Head -->
                        <div class="box-head">
                            <h2>Cadastrar nova senha</h2>
                        </div>
                        <!-- End Box Head -->
                        <!-- Form -->
                        <div class="form">
                            <p>
                                Preencha corretamente os campos abaixo para alterar sua senha
                            </p>
                            <p>
                                <label>Informe uma nova senha * <span>(de 6 a 30 caracteres)</span></label>
                                <input type="password" name="senha" id="senha" size="30" maxlength="30" class="field" onkeyup="validaSenha(this.id,this.value)" />
                            </p>
                            <p>
                                <label>Repita a nova senha *</label>
                                <input type="password" name="re-senha" id="re-senha" size="30" maxlength="30" class="field" onkeyup="matchSenha(this.id,this.value)" />
                            </p>
                            <input type="hidden" id="pa" name="pa" value="<?php echo $id; ?>" />
                            <p><em>* Campos Obrigatórios</em></p>
                        </div>
                        <!-- End Form -->

                        <!-- Form Buttons -->
                        <div class="buttons">
                            <input type="submit" class="button" name="nova-senha"  value="Salvar Senha" onclick="return validaNovaSenha();" />
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
}
?>