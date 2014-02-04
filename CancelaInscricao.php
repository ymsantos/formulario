<?php

include('conexao.php');
session_start();
?>


<?php

	function rrmdir($dir) { 
        if (is_dir($dir)) { 
            $objects = scandir($dir); 
            foreach ($objects as $object) { 
                if ($object != "." && $object != "..") { 
                    if (filetype($dir."/".$object) == "dir")
                        rrmdir($dir."/".$object);
                    else
                        unlink($dir."/".$object); 
                } 
            } 
            reset($objects); 
            rmdir($dir); 
        } 
    }

$id = $_SESSION['cpf'];
$sql = "DELETE FROM dados_aluno WHERE cpf_passaporte=$id";
$ok = mysql_query($sql);

if ($ok) {
	rrmdir("cartas/$id");
    include("sucessoRemocao.php");
} else {
    echo "Usuário não deletado!";
}

//fechar a conexao
mysql_close();
?>
