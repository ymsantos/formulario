
/********************** FUNCOES PARA VALIDACOES *****************************/

function verifica(id,string,regex){
    if(string != null && string != ""){
        if(regex.test(string)){
            document.getElementById(id).style.color = "black";
            return true;
        }else{
            document.getElementById(id).style.color = "red";
            return false;
        }
    }
    return false;
}

function validaNumero(id,cpf){
    var regex = /^[0-9]+$/;
    return verifica(id,cpf,regex);
}

function validaSenha(id,senha){
    var regex = /^.{6,30}$/;
    return verifica(id,senha,regex);
}

function matchSenha(id,match){
    // Para ver se as duas senhas estao iguais

    var senha = document.getElementById("senha").value;

    if (senha == match){
        document.getElementById(id).style.color = "black";
        return true;
    }else{
        document.getElementById(id).style.color = "red";
        return false;
    }
    
}

function matchSenha2(id,match,senha){
    // Para ver se as duas senhas estao iguais

    if (senha == match){
        document.getElementById(id).style.color = "black";
        return true;
    }else{
        document.getElementById(id).style.color = "red";
        return false;
    }
    
}


function verificaCampos(){    
    
    if(!validaLetra("nome", document.getElementById("nome").value)){
        alert("Preencha nome corretamente - não use abreviações");
        return false;
    }
    
    if(!validaNumero("cpf", document.getElementById("cpf").value)){
        alert("Preencha o CPF/Passaporte corretamente");
        return false;
    }

    if(!validaSenha("senha", document.getElementById("senha").value)){
        alert("Preencha uma senha de 6 a 30 caracteres");
        return false;
    }

    if(!matchSenha("re-senha", document.getElementById("re-senha").value)){
        alert("As senhas não combinam");
        return false;
    }
    
    return true;
}

function verificaLogin(){
    
    if(!validaUser("cpf-login", document.getElementById("cpf-login").value)){
        alert("Preencha corretamente o campo Usuário");
        return false;
    }

    if(!validaSenha("senha-login", document.getElementById("senha-login").value)){
        alert("Digite a sua senha");
        return false;
    }

    return true;
}

function validaUser(id,user){
    var regex = /^[a-zA-Z0-9áéíóúÁÉÍÓÚâêôÂÊÔãõÃÕ ]+$/;
        
    if(regex.test(user)) 
        return true;
    else
        return false;
}

function validaLetra(id,nome){    
    var regex = /^[a-zA-ZáéíóúÁÉÍÓÚâêôÂÊÔãõÃÕç ]+$/;
    return verifica(id,nome,regex);

}

function validaIdentidade(id,identidade){
    // Considera que alguns RGs tem 'X'
    
    var regex = /^[0-9]+[x|X]{0,1}$/;
    return verifica(id,identidade,regex);
}

function validaData(id,data){
    var regex = /^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/;
    return verifica(id,data,regex);    
}

function validaEndereco(id,end){    
    var regex = /^[a-zA-Z0-9-, áéíóúÁÉÍÓÚâêôÂÊÔãõÃÕ]+$/;
    return verifica(id,end,regex);
}

function validaBairro(id,bairro){    
    var regex = /^[a-zA-Z0-9áéíóúÁÉÍÓÚâêôÂÊÔãõÃÕ ]+$/;
    return verifica(id,bairro,regex);
}

function validaEmail(id,email){
    var regex  = /^[\w-]+(\.[\w-]+)*@(([\w-]{2,63}\.)+[A-Za-z]{2,6}|\[\d{1,3}(\.\d{1,3}){3}\])$/;
    return verifica(id,email,regex);
}

function matchEmail(id,match){
    // Para ver se as duas senhas estao iguais

    var senha = document.getElementById("email").value;

    if (senha == match){
        document.getElementById(id).style.color = "black";
        return true;
    }else{
        document.getElementById(id).style.color = "red";
        return false;
    }
    
}

function validaNota(id,nota){
    var regex = /^(([0-9](,[0-9]){0,1})$)|(10(,0){0,1})$/;
    return verifica(id,nota,regex);
}

function validaDadosPessoais(){
    
    // nome
    if(!validaLetra("nome", document.getElementById("nome").value)){
        alert("Preencha nome corretamente - não use abreviações");
        return false;
    }
    
    // identidade
    if(!validaIdentidade("identidade", document.getElementById("identidade").value)){
        alert("Preencha a identidade corretamente - apenas números, ou 'X' quando houver");
        return false;
    }
    
    // data de nascimento
    if(!validaData("dtnascimento", document.getElementById("dtnascimento").value)){
        alert("Preencha a data de nascimento no formato dd/mm/aaaa");
        return false;
    }
    
    // nacionalidade
    if(!validaLetra("nacionalidade", document.getElementById("nacionalidade").value)){
        alert("Preencha a nacionalidade corretamente");
        return false;
    }
    
    // país de nascimento
    if(!validaLetra("pais", document.getElementById("pais").value)){
        alert("Preencha corretamente o país de nascimento");
        return false;
    }
    
    // sexo
    var flag = false;
    var i=0;
    radio = document.getElementsByName("sexo");
    for(i=0; i < radio.length;i++){
        if(radio[i].checked){
            flag = true;
        }
    }
    if(flag == false){
        alert("Selecione o sexo");
        return false;
    }
    
    // endereco
    if(!validaEndereco("endereco", document.getElementById("endereco").value)){
        alert("Preencha endereço corretamente");
        return false;
    }
    
    // bairro
    if(!validaBairro("bairro", document.getElementById("bairro").value)){
        alert("Preencha o bairro corretamente");
        return false;
    }
    
    // cep
    if(!validaNumero("cep", document.getElementById("cep").value)){
        alert("Preencha CEP corretamente - apenas números");
        return false;
    }
    
    // cidade
    if(!validaEndereco("cidade", document.getElementById("cidade").value)){
        alert("Preencha a cidade corretamente");
        return false;
    }
    
    // telfixo
    if(!validaNumero("telfixo", document.getElementById("telfixo").value)){
        alert("Preencha telefone corretamente - apenas números");
        return false;
    }
    
    // telcelular
    if(!validaNumero("telcelular", document.getElementById("telcelular").value)){
        alert("Preencha telefone celular corretamente - apenas números");
        return false;
    }
    
    // email
    if(!validaEmail("email", document.getElementById("email").value)){
        alert("Preencha email corretamente");
        return false;
    }
    
    // confere email
    if(!matchEmail("re-email", document.getElementById("re-email").value)){
        alert("Os e-mails não coincidem");
        return false;
    }
    
    // cor
    flag = false;
    radio = document.getElementsByName("raca");
    for(i=0; i < radio.length;i++){
        if(radio[i].checked){
            flag = true;
        }
    }
    if(flag == false){
        alert("Selecione a cor/raça");
        return false;
    }

    document.getElementById("form-inscricao").action = "RecebeDadosAlteracao.php?dados=dp";
    showDivMenu('fa');
    return true;
}


function validaFormacaoAcademica(){
    
    // curso graduacao
    if(!validaLetra("graduacao", document.getElementById("graduacao").value)){
        alert("Preencha corretamente o curso de graduação");
        return false;
    }
    
    // instituicao graduacao
    if(!validaLetra("instituicao-grad", document.getElementById("instituicao-grad").value)){
        alert("Preencha corretamente a instituição da graduação");
        return false;
    }    
    
    // data inicio graduacao
    if(!validaData("dtinicio-grad", document.getElementById("dtinicio-grad").value)){
        alert("Preencha a data de inicio da graduação no formato dd/mm/aaaa");
        return false;
    }
    
    // data fim graduacao
    if(!validaData("dtfim-grad", document.getElementById("dtfim-grad").value)){
        alert("Preencha a data de término da graduação no formato dd/mm/aaaa");
        return false;
    }
    
    // Se fez alguma especialização
    if(document.getElementsByName("radio-esp")[0].checked){
        // curso especializacao
        if(!validaLetra("especializacao", document.getElementById("especializacao").value)){
            alert("Preencha corretamente o curso de especialização");
            return false;
        }
    
        // instituicao especializacao
        if(!validaLetra("instituicao-esp", document.getElementById("instituicao-esp").value)){
            alert("Preencha corretamente a instituição da especialização");
            return false;
        }    
    
        // data inicio especializacao
        if(!validaData("dtinicio-esp", document.getElementById("dtinicio-esp").value)){
            alert("Preencha a data de inicio da especialização no formato dd/mm/aaaa");
            return false;
        }
    
        // data fim especializacao
        if(!validaData("dtfim-esp", document.getElementById("dtfim-esp").value)){
            alert("Preencha a data de término da especialiação no formato dd/mm/aaaa");
            return false;
        }
    } else {
        // para garantir que nenhum valor será colocado no bd:
        document.getElementById("especializacao").value = "";
        document.getElementById("instituicao-esp").value = "";
        document.getElementById("dtinicio-esp").value = "";
        document.getElementById("dtfim-esp").value = "";
    }
    
    // Se fez algum mestrado
    if(document.getElementsByName("radio-mest")[0].checked){
        // curso mestrado
        if(!validaLetra("mestrado", document.getElementById("mestrado").value)){
            alert("Preencha corretamente o curso de mestrado");
            return false;
        }
    
        // instituicao mestrado
        if(!validaLetra("instituicao-mest", document.getElementById("instituicao-mest").value)){
            alert("Preencha corretamente a instituição do mestrado");
            return false;
        }    
    
        // data inicio mestrado
        if(!validaData("dtinicio-mest", document.getElementById("dtinicio-mest").value)){
            alert("Preencha a data de inicio do mestrado no formato dd/mm/aaaa");
            return false;
        }
    
        // data fim mestrado
        if(!validaData("dtfim-mest", document.getElementById("dtfim-mest").value)){
            alert("Preencha a data de término do mestrado no formato dd/mm/aaaa");
            return false;
        }
    }else {
        // para garantir que nenhum valor será colocado no bd:
        document.getElementById("mestrado").value = "";
        document.getElementById("instituicao-mest").value = "";
        document.getElementById("dtinicio-mest").value = "";
        document.getElementById("dtfim-mest").value = "";
    }

    // link curriculo lattes
    // if(!validaLetra("cvlattes", document.getElementById("cvlattes").value)){
    //     alert("Preencha corretamente o link para o Currículo Lattes");
    //     return false;
    // }
    
    document.getElementById("form-inscricao").action = "RecebeDadosAlteracao.php?dados=fa";
    showDivMenu('dc');
    return true;
}

function validaDadosComplementares(){
    
    // Area de interesse
    flag = false;
    radio = document.getElementsByName("interesse");
    for(i=0; i < radio.length;i++){
        if(radio[i].checked){
            flag = true;
        }
    }
    if(flag == false){
        alert("Selecione uma área de interesse");
        return false;
    }
        
    
    // Dedicacao ao curso
    flag = false;
    radio = document.getElementsByName("dedicacao");
    for(i=0; i < radio.length;i++){
        if(radio[i].checked){
            flag = true;
        }
    }
    if(flag == false){
        alert("Selecione o regime de dedicação ao curso");
        return false;
    }
    
    // Vinculo Empregaticio
    flag = false;
    radio = document.getElementsByName("vinculoemp");
    for(i=0; i < radio.length;i++){
        if(radio[i].checked){
            flag = true;
        }
    }
    if(flag == false){
        alert("Selecione a sua situação em termos de vínculo empregatício");
        return false;
    }
    
    // Interesse em bolsa de estudos
    flag = false;
    radio = document.getElementsByName("bolsa");
    for(i=0; i < radio.length;i++){
        if(radio[i].checked){
            flag = true;
        }
    }
    if(flag == false){
        alert("Selecione o seu interesse em bolsa de estudos");
        return false;
    }
    
    // Experiencia profissional - não precisa validar
    
    // Iniciacao Científica
    flag = false;
    radio = document.getElementsByName("ic");
    for(i=0; i < radio.length;i++){
        if(radio[i].checked){
            flag = true;
        }
    }
    if(flag == false){
        alert("Selecione uma opção sobre iniciação científica");
        return false;
    }
    
    
    // Experiencia IC
    if(!radio[2].checked){
        if(document.getElementById("experiencia-ic").value == "" ){
            alert("Preencha sua experiência de Iniciação Científica");
            return false;
        }
    }
    
    // Conhecimento de ingles
    flag = false;
    radio = document.getElementsByName("ingles");
    for(i=0; i < radio.length;i++){
        if(radio[i].checked){
            flag = true;
        }
    }
    if(flag == false){
        alert("Selecione uma opção sobre seu conhecimento de inglês");
        return false;
    }
    
    // Nota media da graduacao
    if(!validaNota('nota',document.getElementById("nota").value)){
        alert("Informe corretamente a nota media da sua graduação");
        return false
    }
    
    // Contato Previo - nao precisa validar

    // Prova de Ingresso
    if(document.getElementsByName("loc")[1].checked){
        // local da prova
        if(!validaLetra("provalocal", document.getElementById("provalocal").value)){
            alert("Preencha corretamente o local da prova");
            return false;
        }
    
        // encontrou professor?
        if(document.getElementsByName("profprova")[1].checked){
            // nome do professor
            if(!validaLetra("nomeprof", document.getElementById("nomeprof").value)){
                alert("Preencha corretamente a o nome do professor");
                return false;
            }    
    
            // instituicao do professor
            if(!validaLetra("instprof", document.getElementById("instprof").value)){
                alert("Preencha corretamente a instituição do professor");
                return false;
            }
    
            // email do professor
            if(!validaEmail("emailprof", document.getElementById("emailprof").value)){
                alert("Preencha corretamente o email do professor");
                return false;
            }
        }else {
            // para garantir que nenhum valor será colocado no bd:
            document.getElementById("nomeprof").value = "";
            document.getElementById("instprof").value = "";
            document.getElementById("emailprof").value = "";
        }
    }else {
        // para garantir que nenhum valor será colocado no bd:
        document.getElementById("provalocal").value = "";
        document.getElementById("nomeprof").value = "";
        document.getElementById("instprof").value = "";
        document.getElementById("emailprof").value = "";
    }
        
        
    document.getElementById("form-inscricao").action = "RecebeDadosAlteracao.php?dados=dc";
    showDivMenu('cr');
    return true;
}

function validaCartasRecomendacao(){
    
    // Nome recomendante 1
    if(!validaLetra("nome-r1", document.getElementById("nome-r1").value)){
        alert("Preencha o nome do recomendante 1 corretamente");
        return false;
    }
    
    // Email recomendante 1
    if(!validaEmail("email-r1", document.getElementById("email-r1").value)){
        alert("Preencha o e-mail do recomendante 1 corretamente");
        return false;
    }
    
    // Relacao com recomendante 1
    flag = false;
    radio = document.getElementsByName("recom1[]");
    for(i=0; i < radio.length;i++){
        if(radio[i].checked){
            flag = true;
        }
    }
    if(flag == false){
        alert("Selecione uma opção sobre seu relacionamento com o recomendante 1");
        return false;
    }

    // Carta recomendante 1
    if(document.getElementById("temcarta1").value == "" && document.getElementById("letterfile1").value == ""){
        alert("Selecione a carta do recomendante 1 (em .jpg ou .pdf) para fazer upload");
        return false;
    }
    
    if(document.getElementById("letterfile1").value != ""){
        var vExt = document.getElementById("letterfile1").value;
        vExt = vExt.toLowerCase();
        var vExtension = vExt.split(".");
        vExtension = vExtension.reverse();

        if(vExtension[0] != "pdf" && vExtension[0] != "jpg"){
            alert("A carta do recomendante 1 deve estar no formato pdf ou jpg");
            return false;
        }
    }
    
    if(radio[radio.length-1].checked){
        // se escolheu a opcao outro e nao preencheu
        if(document.getElementById("outro-r1").value == ""){
            alert("Preencha o campo da opção 'outro' do recomendante 1");
            return false;
        }
    }
    
    
    // Nome recomendante 2
    if(!validaLetra("nome-r2", document.getElementById("nome-r2").value)){
        alert("Preencha o nome do recomendante 2 corretamente");
        return false;
    }
    
    // Email recomendante 2
    if(!validaEmail("email-r2", document.getElementById("email-r2").value)){
        alert("Preencha o e-mail do recomendante 2 corretamente");
        return false;
    }
    
    // Relacao com recomendante 2
    flag = false;
    radio = document.getElementsByName("recom2[]");
    for(i=0; i < radio.length;i++){
        if(radio[i].checked){
            flag = true;
        }
    }
    if(flag == false){
        alert("Selecione uma opção sobre seu relacionamento com o recomendante 2");
        return false;
    }

    // Carta recomendante 2
    if(document.getElementById("temcarta2").value == "" && document.getElementById("letterfile2").value == ""){
        alert("Selecione a carta do recomendante 2 (em .jpg ou .pdf) para fazer upload");
        return false;
    }

    if(document.getElementById("letterfile2").value != ""){
        var vExt2 = document.getElementById("letterfile2").value;
        vExt2 = vExt2.toLowerCase();
        var vExtension2 = vExt2.split(".");
        vExtension2 = vExtension2.reverse();

        if(vExtension2[0] != "pdf" && vExtension2[0] != "jpg"){
            alert("A carta do recomendante 2 deve estar no formato pdf ou jpg");
            return false;
        }
    }
    
    if(radio[radio.length-1].checked){
        // se escolheu a opcao outro e nao preencheu
        if(document.getElementById("outro-r2").value == ""){
            alert("Preencha o campo da opção 'outro' do recomendante 2");
            return false;
        }
    }
    
    document.getElementById("form-inscricao").action = "RecebeDadosAlteracao.php?dados=cr";
    return true
}

/*
function validaForm(){
    
    // Dados Pessoais
    if(!validaDadosPessoais()){
        //alert("Verifique os dados pessoais");
        showDivMenu('dp');
        return false;
    }
    
    // Formação Academica
    if(!validaFormacaoAcademica()){
        //alert("Verifique os dados da formação acadêmica");
        showDivMenu('fa');
        return false;
    }
    
    // Dados Complementares
    if(!validaDadosComplementares()){
        //alert("Verifique os dados complementares");
        showDivMenu('dc');
        return false;
    }
    
    // Cartas de Recomendacao
    if(!validaCartasRecomendacao()){
        //alert("Verifique os dados das cartas de recomendação");
        showDivMenu('cr');
        return false;
    }
    
    return true;
    
}
*/


function validaNovaSenha(){
   
    if(!validaSenha("senha", document.getElementById("senha").value)){
        alert("A nova senha deve ter de 6 a 30 caracteres");
        return false;
    }

    if(!matchSenha("re-senha", document.getElementById("re-senha").value)){
        alert("As senhas não combinam");
        return false;
    }
    
    return true;
}

function validaFormAlteracoes(){
    
    // Dados Pessoais
    if(!validaDadosPessoais()){
        //alert("Verifique os dados pessoais");
        showDivMenu('dp');
        return false;
    }
    
    // Formação Academica
    if(!validaFormacaoAcademica()){
        //alert("Verifique os dados da formação acadêmica");
        showDivMenu('fa');
        return false;
    }
    
    // Dados Complementares
    if(!validaDadosComplementares()){
        //alert("Verifique os dados complementares");
        showDivMenu('dc');
        return false;
    }
    
    // Cartas de Recomendacao
    if(!validaCartasRecomendacao()){
        //alert("Verifique os dados das cartas de recomendação");
        showDivMenu('cr');
        return false;
    }
    
    return true;
    
}

function confirma(){
    
    document.getElementById('form-inscricao').action = "RecebeDadosAlteracao.php?dados=fim";
    
    if(validaFormAlteracoes()){
        var confirmaFim = confirm("Deseja finalizar a inscrição no processo seletivo?");
        if (confirmaFim == true) return true;
    }
    
    return false;
}


function finaliza(param){
    
    var $msg="";
    
    if(param == "nova-inscricao") $msg = "Deseja salvar seus dados e finalizar a inscrição?";
    else if (param == "salvar-alteracoes") $msg = "Deseja salvar as alterações feitas nos seus dados?";
    
    if(validaFormAlteracoes()){
        var confirmaFim = confirm($msg);
        if (confirmaFim == true) return true;
    }
    
    return false;
}

function confirmaRemocaoPS(){
    var confirmaFim = confirm("Deseja reamente remover este Processo Seletivo?");
    if (confirmaFim == true) return true;
    
    return false;
}

function validaPS(proc,ini,fim, param){
    if(document.getElementById(proc).value=="") {
        alert("Preencha o campo do Processo Seletivo");
        return false;
    }
    
    if(!validaData(ini,document.getElementById(ini).value)) {
        //alert("Preencha o campo do Processo Seletivo");
        return false;
    }
    
    if(!validaData(fim,document.getElementById(fim).value)) {
        //alert("Preencha o campo do Processo Seletivo");
        return false;
    }
    
    var confirmaFim = confirm("Deseja salvar processo seletivo?");
    if (confirmaFim == true) return true;
   
    return false;
}

/*****************************************************************************/

function showDivMenu( idName ){
    objDiv = document.getElementById( idName );
    
    // coloca todas as divs como 
    //  document.getElementById( "iniCad" ).style.display="none";
    // document.getElementById("m-iniCad").className="";
    document.getElementById( "dp" ).style.display="none";
    document.getElementById("m-dp").className="";
    document.getElementById( "fa" ).style.display="none";
    document.getElementById("m-fa").className="";
    document.getElementById( "dc" ).style.display="none";
    document.getElementById("m-dc").className="";
    document.getElementById( "cr" ).style.display="none";
    document.getElementById("m-cr").className="";
    
    
    // deixa visvel a div que foi passada como parametro
    document.getElementById(idName).style.display="";
    document.getElementById("m-"+idName).className="active";
}

function showDiv(id){
    document.getElementById(id).style.display = "";
}

function hideDiv(id){
    document.getElementById(id).style.display='none';
}

function showAndHide(id){
    if(document.getElementById(id).style.display == "") hideDiv(id);
    else showDiv(id);
}

function MyAlert(p){
    alert(p)
}

function cancelaInscricao() {
   
    //var id = document.getElementById('cpf').value;
    
    var confirmaFim = confirm("Atenção, isto apagará todos os seus dados!\nDeseja realmente cancelar a sua inscriação?");
    if (confirmaFim == true){
        location.href = "CancelaInscricao.php";
        return true;
    }
    
    return false;
}