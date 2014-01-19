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
                            <?php $nome = explode(" ", $_SESSION['nome']); // para pegar o primeiro nome?>
                            Bem-vindo <strong><?php echo $nome[0]; ?></strong>
                            <span>|</span>
                            <a href="logout.php">Sair</a>
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

                    <!-- Message Error -->
                    <div class="msg msg-error">
                        <p><strong>Desculpe, mas houve um erro ao salvar seus dados.</strong></p>
                        <!--<a href="#" class="close">close</a> -->
                    </div>
                    <!-- End Message Error -->


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