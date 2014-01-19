<?php
session_start();
if (!isset($_SESSION['AUTH']) || $_SESSION['AUTH'] == false || !isset($_SESSION['usuario'])) {
// 'usuario' só é setado qdo é prof-ppgcm
    include('oops.php');
} else {
//abre a pagina normalmente
    ?>

    <?php include("cabecalho.php") ?>
    <?php include("conexao.php") ?>



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



            <!-- Main Nav -->
            <div id="navigation">
                <ul>
                    <li><a href="professor.php" id="buscar-candidatos">Buscar Candidatos</a></li>
                    <li><a href="procSeletivo.php" id="cad-ps" class="active">Processos Seletivos</a></li>
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

                    <div id="p-seletivo"> 
                        <!-- Box -->
                        <div class="box">
                            <!-- Box Head -->
                            <div class="box-head">
                                <h2>Cadastrar um novo processo seletivo</h2>
                            </div>
                            <!-- End Box Head -->
                            <form id="ins-ps" action="RecebeDadosPS.php?p=inserir" method="post"> 
                                <div class="form">
                                    <?php if (isset($_GET['p']) && $_GET['p'] == 'erroCadastro') { ?>
                                        <div class="msg msg-error" style="line-height: 1.2">
                                            <p><strong>Processo Seletivo já foi cadastrado anteriormente!</strong></p>
                                        </div>
                                    <?php } ?>
                                    <p>
                                        <label>Processo Seletivo <span>(Ano/Semestre)</span></label>
                                        <input type="text" name="proc" id="proc" placeholder="ex.: 2013/1" size="10" maxlength="6" class="field" />
                                    </p>
                                    <p>
                                        <label>Data de Início <span>(dd/mm/aaaa)</span></label>
                                        <input type="text" name="datai" id="datai" placeholder="ex.: 10/10/2012" size="20" maxlength="10" class="field" onkeyup="validaData(this.id,this.value)" />
                                    </p>
                                    <p>
                                        <label>Data de Término <span>(dd/mm/aaaa)</span></label>
                                        <input type="text" name="dataf" id="dataf" placeholder="ex.: 10/12/2012" size="20" maxlength="10" class="field" onkeyup="validaData(this.id,this.value)" />
                                    </p>

                                </div>
                                <!-- End Div Form -->


                                <!-- Form Buttons -->
                                <div class="buttons">
                                    <input type="submit" class="button" name="salvar"  value="Cadastrar Processo Seletivo" onClick="return validaPS('proc','datai','dataf');"/>
                                </div>
                                <!-- End Form Buttons -->

                            </form>

                        </div>
                        <!-- End Box -->



                        <!-- Box -->
                        <div class="box">
                            <!-- Box Head -->
                            <div class="box-head">
                                <h2>Buscar e alterar dados do Processo Seletivo</h2>
                            </div>
                            <!-- End Box Head -->

                            <form id="ps" action="procSeletivo.php" method="get"> 

                                <!-- Form -->
                                <div class="form">
                                    <p>
                                        <label>Processo Seletivo <span>(Selecione o processo seletivo que deseja alterar)</span></label>
                                        <select name="ps" class="field" onchange="submit()">
                                            <option value="">Selecione... </option>
                                            <!-- Carregar do BD -->
                                            <?php
                                            $q = "SELECT * FROM processo_seletivo ORDER BY processo DESC";
                                            $result = mysql_query($q);
                                            while ($proc = mysql_fetch_array($result)) {
                                                ?>
                                                <option value="<?php echo $proc['processo'] ?>" <?php if (isset($_GET['ps']) && $_GET['ps'] == $proc['processo']) echo 'selected' ?> ><?php echo $proc['processo'] ?></option>
                                            <?php } //fim while  ?>
                                        </select>
                                    </p>
                                </div>
                                <!-- End Div Form -->
                            </form> 
                            <?php
                            if (isset($_GET['ps']) && $_GET['ps'] != "") {
                                $q = "SELECT * FROM processo_seletivo WHERE processo='" . $_GET['ps'] . "'LIMIT 1";
                                $result = mysql_query($q);
                                $ps = mysql_fetch_array($result);

                                if (mysql_num_rows($result) == 1) {

                                    $aux = explode("-", $ps['dt_inicio']);
                                    $dt_inicio = $aux[2] . '/' . $aux[1] . '/' . $aux[0];
                                    $aux = explode("-", $ps['dt_fim']);
                                    $dt_fim = $aux[2] . '/' . $aux[1] . '/' . $aux[0];
                                    ?>
                                    <!-- Form -->
                                    <form id="proc-seletivo" action="RecebeDadosPS.php?p=alterar" method="post"> 
                                        <hr />
                                        <div class="form">
                                            <input type="hidden" name="seleciona-ps" id="seleciona-ps" value="<?php echo $_GET['ps'] ?>" />
                                            <p>
                                                <label>Processo Seletivo <span>(Ano/Semestre)</span></label>
                                                <input type="text" name="processo" id="processo" size="10" maxlength="6" class="field" value="<?php echo $ps['processo']; ?>" />
                                            </p>
                                            <p>
                                                <label>Data de Início <span>(dd/mm/aaaa)</span></label>
                                                <input type="text" name="dtini_ps" id="dtini_ps" size="20" maxlength="10" class="field" value="<?php echo $dt_inicio; ?>" onkeyup="validaData(this.id,this.value)" />
                                            </p>
                                            <p>
                                                <label>Data de Término <span>(dd/mm/aaaa)</span></label>
                                                <input type="text" name="dtfim_ps" id="dtfim_ps" size="20" maxlength="10" class="field" value="<?php echo $dt_fim; ?>" onkeyup="validaData(this.id,this.value)" />
                                            </p>

                                        </div>
                                        <!-- End Div Form -->


                                        <!-- Form Buttons -->
                                        <div class="buttons">
                                            <input type="submit" class="button" name="salvar"  value="Salvar Alterações" onClick="return validaPS('processo','dtini_ps','dtfim_ps');"/>
                                        </div>
                                        <!-- End Form Buttons -->

                                    </form>

                                    <?php
                                }// fim if
                            } // fim if  
                            ?>

                        </div>
                        <!-- End Box -->

                        <!-- Box -->
                        <div class="box">
                            <!-- Box Head -->
                            <div class="box-head">
                                <h2>Remover Processo Seletivo</h2>
                            </div>
                            <!-- End Box Head -->

                            <form id="pro-seletivo" action="RecebeDadosPS.php?p=remover" method="post"> 

                                <!-- Form -->
                                <div class="form">
                                    <p>
                                        <label>Processo Seletivo <span>(Selecione o processo seletivo que deseja alterar)</span></label>
                                        <select name="select-ps" class="field">
                                            <option value="">Selecione... </option>
                                            <!-- Carregar do BD -->
                                            <?php
                                            $q = "SELECT * FROM processo_seletivo ORDER BY processo DESC";
                                            $result = mysql_query($q);
                                            while ($proc = mysql_fetch_array($result)) {
                                                ?>
                                                <option value="<?php echo $proc['processo'] ?>" <?php if (isset($_GET['ps']) && $_GET['ps'] == $proc['processo']) echo 'selected' ?> ><?php echo $proc['processo'] ?></option>
                                            <?php } //fim while  ?>
                                        </select>
                                    </p>
                                </div>
                                <!-- End Div Form -->
                                <!-- Form Buttons -->
                                <div class="buttons">
                                    <input type="submit" class="button" name="remover"  value="Remover Processo Seletivo" onClick="return confirmaRemocaoPS();"/>
                                </div>
                                <!-- End Form Buttons -->
                            </form> 
                        </div>
                        <!-- End Box -->


                    </div>
                    <!-- Final div -->

                </div>
                <!--End Content-->

                <div class = "cl">&nbsp;</div>
            </div>
            <!--Main-->
        </div>
    </div>
    <!--End Container-->

    <?php
    include("rodape.php");
}// fim do else   
?>