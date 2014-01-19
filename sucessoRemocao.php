<?php
if (!isset($_POST['nome']) && !isset($_SESSION['nome'])) {
    include('oops.php');
} else {
    //abre a pagina normalmente
    ?>

    <html>
        <head>
            <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
            <script type="text/javascript" src="javascript.js"></script>  
            <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
            <title>Inscricao PPGCM</title>
        </head>
        <body>

            <!-- Header -->
            <div id="header">
                <div class="shell">
                    <!-- Logo + Top Nav -->
                    <div id="top">
                        <img src="css/images/logo-pos3.png" style="float:left"/>
                        <h1><a href="index.php">Processo Seletivo</a></h1>

                        <div id="top-navigation">
                            <!--<?php //$nome = explode(" ", $_SESSION['nome']); // para pegar o primeiro nome?>
                            Bem-vindo <strong><?php // echo $nome[0]; ?></strong>
                            <span>|</span>
                             <a href="#">Ajuda</a>
                             <span>|</span>
                             <a href="#">Configurações do Perfil</a>
                             <span>|</span> 
                            <a href="logout.php">Sair</a> -->
                        </div>
                    </div>
                    <!-- End Logo + Top Nav -->

                </div> 
                <!-- End Shell div -->
            </div>
            <!-- End Header div -->


            <!-- Container -->
            <div id="container">
                <div class="shell">

                    <!-- Message OK --> 		
                    <div class="msg msg-ok">
                        <p><strong>Sua inscrição foi apagada do nosso sistema!</strong></p>
                        <br /><a href="index.php"> Voltar </a>
                    </div>
                    <!-- End Message OK -->		
                    <br />
                    <!-- Main -->
                    <div id="main">
                        <div class="cl">&nbsp;</div>

                    </div>
                    <!-- End Content -->

                    <div class="cl">&nbsp;</div>			
                </div>
            </div>
            <!-- End Container -->

            <?php
            include("rodape.php");
        }// fim do else   
        ?>