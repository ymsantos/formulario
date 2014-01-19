<?php

include('conexao.php');
session_start();
?>


<?php

if (isset($_GET['p']) && $_GET['p'] == "alterar") {

    $id = $_POST['seleciona-ps'];
    $ps = $_POST['processo'];

    $aux = explode("/", $_POST['dtini_ps']);
    $dt_inicio = $aux[2] . '-' . $aux[1] . '-' . $aux[0];

    $aux = explode("/", $_POST['dtfim_ps']);
    $dt_fim = $aux[2] . '-' . $aux[1] . '-' . $aux[0];

    // monta a chamada 
    $sql = "call uspAlterarPS('$id','$ps', '$dt_inicio','$dt_fim')";
    
} else if (isset($_GET['p']) && $_GET['p'] == "inserir") {
    $ps = $_POST['proc'];

    $aux = explode("/", $_POST['datai']);
    $dt_inicio = $aux[2] . '-' . $aux[1] . '-' . $aux[0];

    $aux = explode("/", $_POST['dataf']);
    $dt_fim = $aux[2] . '-' . $aux[1] . '-' . $aux[0];

    // monta a chamada 
    $sql = "call uspInserirProcSeletivo('$ps','$dt_inicio','$dt_fim')";
} else if (isset($_GET['p']) && $_GET['p'] == "remover") {
    $ps = $_POST['select-ps'];
    $sql = "call uspRemoverPS('$ps')";
}

$ok = mysql_query($sql);
if ($ok) {
    //echo "Cadastro efetuado com sucessso!";
    include('sucessoPS.php');
} else {
    //echo "Cadastro não efetuado";
    $query = "SELECT * FROM processo_seletivo WHERE processo='$ps'";
    $rs = mysql_query($query);
    if (mysql_num_rows($rs) != 0)
        header("location: procSeletivo.php?p=erroCadastro");
    else
        include('erro.php');
}

//fechar a conexao
mysql_close();
?>


