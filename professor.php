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
                    <li><a href="professor.php" id="buscar-candidatos" class="active">Buscar Candidatos</a></li>
                    <li><a href="procSeletivo.php" id="cad-ps">Processos Seletivos</a></li>
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

                    <div id="iniCad"> 
                        <!-- Box -->
                        <div class="box">
                            <!-- Box Head -->
                            <div class="box-head">
                                <h2>Buscar Candidatos - selecione as opções e clique em "Buscar"</h2>
                            </div>
                            <!-- End Box Head -->

                            <form action="professor.php" method="get"> 

                                <!-- Form -->
                                <div class="form">
                                    <p>
                                        <label>Processo Seletivo <span>(Ano/Semestre)</span></label>
                                        <select name="ps" class="field">
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
                                    <p>
                                        <label>Área de Interesse<span> (escolhida como primeira opção)</span></label>
                                        <select name="ai" class="field">
                                            <option value="3" <?php if (isset($_GET['ai']) && $_GET['ai'] == 3) echo 'selected' ?> >Candidatos de todas as áreas.</option>
                                            <option value="0" <?php if (isset($_GET['ai']) && $_GET['ai'] == 0) echo 'selected' ?> >Materiais Funcionais e Polímeros de Fontes Renováveis.</option>
                                            <option value="1" <?php if (isset($_GET['ai']) && $_GET['ai'] == 1) echo 'selected' ?> >Nanociência e Nanotecnologia de materiais.</option>
                                            <option value="2" <?php if (isset($_GET['ai']) && $_GET['ai'] == 2) echo 'selected' ?> >Candidatos com área ainda não definida.</option>
                                            <!-- <option value="2" <?php if (isset($_GET['ai']) && $_GET['ai'] == 2) echo 'selected' ?> >Redes de Computadores, Sistemas Distribuídos, Computação Móvel e Ubíqua.</option>
                                            <option value="3" <?php if (isset($_GET['ai']) && $_GET['ai'] == 3) echo 'selected' ?> >Teoria dos Grafos, Análise de Algoritmos e Teoria da Computação.</option>
                                            <option value="4" <?php if (isset($_GET['ai']) && $_GET['ai'] == 4) echo 'selected' ?> >Processamento de Imagens e Sinais, Computação Gráfica e Projeto e Desenvolvimento de Jogos Eletrônicos Interativos.</option>
                                            <option value="5" <?php if (isset($_GET['ai']) && $_GET['ai'] == 5) echo 'selected' ?> >Linguagens de Programação e Compiladores.</option> -->
                                        </select>
                                    </p>
                                </div>
                                <!-- End Form -->

                                <!-- Form Buttons -->
                                <div class="buttons">
                                    <input type="submit" class="button" name="buscar"  value="Buscar" onClick=""/>
                                </div>
                                <!-- End Form Buttons -->
                            </form> 
                        </div>
                        <!-- End Box -->
                    </div>
                    <!-- Final div -->

                    <?php
                    if (isset($_GET['ps']) && isset($_GET['ai'])) {
                        $ps = $_GET['ps']; // processo seletivo
                        $ai = $_GET['ai']; // area de interesse

                        if($ai == 3) {
                            $query = "SELECT nome_aluno,cpf_passaporte, area_interesse FROM dados_aluno WHERE proc_seletivo='$ps' AND finalizado=true";
                            $_SESSION['query_rel'] = "SELECT * FROM dados_aluno WHERE proc_seletivo='$ps' AND finalizado=true";
                        } else {
                            $query = "SELECT nome_aluno,cpf_passaporte, area_interesse FROM dados_aluno WHERE proc_seletivo='$ps' AND area_interesse=$ai AND finalizado=true";
                            $_SESSION['query_rel'] = "SELECT * FROM dados_aluno WHERE proc_seletivo='$ps' AND area_interesse=$ai AND finalizado=true";
                        }
                        // Executa a query no Banco de Dados
                        $rs = mysql_query($query);

                        // Conta o total de resultados encontrados
                        $total = mysql_num_rows($rs);

                        $pagina = (isset($_GET['pag'])) ? $_GET['pag'] : 0;

                        /* Inicio Paginação */

                        $num_reg_pag = "15"; // número de registros por página
                        //Se a página não for especificada a variável "pagina" tomará o 
                        //valor 1, isso evita de exibir a página 0 de início:
                        if (!$pagina) {
                            $pc = "1";
                        } else {
                            $pc = $pagina;
                        }

                        //Determina o valor inicial das buscas limitadas:

                        $inicio = $pc - 1;
                        $inicio = $inicio * $num_reg_pag;

                        //Vamos selecionar os dados e exibir a paginação:

                        $limite = mysql_query("$query LIMIT $inicio,$num_reg_pag");
                        $todos = mysql_query("$query");

                        $tr = mysql_num_rows($todos); // verifica o número total de registros

                        $tp = $tr / $num_reg_pag; // verifica o número total de páginas

                        if ($total == 0) {
                            echo "<h2>Sua busca não retornou nennhum candidato</h2>";
                        } else {
                            ?>

                            <!-- Box -->
                            <div class="box">
                                <!-- Box Head -->
                                <div class="box-head">
                                    <h2 class="left">Resultados da busca - clique no nome do candidato para ver detalhes</h2>
                                    <!--<div class="right">
                                        <label>search articles</label>
                                        <input type="text" class="field small-field" />
                                        <input type="submit" class="button" value="search" />
                                    </div> -->
                                </div>
                                <!-- End Box Head -->	
                                <!-- Table -->
                                <div class="table">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <center><a href="downloadDetalhes.php"><strong>Clique aqui</strong></a> para baixar os detalhes de todos os candidatos listados abaixo em um arquivo csv.</center>
                                        <tr>
                                            <th>Nome</th>
                                            <th width="290">Área de Interesse</th>
                                            <th width="150">CPF/Passaporte</th>
                                        </tr>
                                        <?php while ($dados = mysql_fetch_array($limite)) { 
                                            if($dados['area_interesse'] == 0) $area = "Materiais Funcionais e Polímeros de Fontes Renováveis";
                                            else if($dados['area_interesse'] == 1) $area = "Nanociência e Nanotecnologia de materiais";
                                            else if($dados['area_interesse'] == 2) $area = "Indefinida";
                                            // else if($dados['area_interesse'] == 3) $area = "Grafos, Análise de Algoritmos e TC";
                                            // else if($dados['area_interesse'] == 4) $area = "PI, CG e Desenvolvimento de Jogos";
                                            // else if($dados['area_interesse'] == 5) $area = "Linguagens de Programação e Compiladores";
                                            // else if($dados['area_interesse'] == 6) $area = "Indefinida";
                                            
                                            ?>
                                            <tr>
                                                <td><h3><a <?php echo "href='detalhes.php?id=$dados[cpf_passaporte]' target=new" ?> ><?php echo $dados['nome_aluno']; ?></a></h3></td>
                                                <td><?php echo $area; ?></td>
                                                <td><?php echo $dados['cpf_passaporte']; ?></td>
                                            </tr>

                                        <?php } // fim while     ?>
                                    </table>

                                    <!-- Pagging -->
                                    <div class="pagging">
                                        <div class="left">Página <?php echo $pc ?> de <?php echo ceil($tp) ?></div>
                                        <div class="right">
                                            <?php
                                            // agora vamos criar os botões "Anterior e próximo"
                                            $anterior = $pc - 1;
                                            $proximo = $pc + 1;
                                            if ($pc > 1) {
                                                ?>
                                                <a id="b_ant" <?php echo "href='professor.php?ps=$ps&ai=$ai&buscar=Buscar&pag=$anterior'" ?> >Anterior</a>
                                            <?php } // fim if ?>
                                            <?php
                                            if ($pc < $tp) {
                                                ?>
                                                <a id="b_prox" <?php echo "href='professor.php?ps=$ps&ai=$ai&buscar=Buscar&pag=$proximo'" ?> >Próximo</a>
                                            <?php } // fim if  ?>
                                        </div>
                                    </div>
                                    <!--End Pagging-->

                                </div>
                                <!--Table-->

                                <?php
                            } // fim do else $total != 0
                        } // fim do if(isset($_GET...   
                        ?>
                    </div>
                    <!--End Box-->

                </div>
                <!--End Content-->

                <div class = "cl">&nbsp;
                </div>
            </div>
            <!--Main-->
        </div>
    </div>
    <!--End Container-->

    <?php
    include("rodape.php");
}// fim do else   
?>