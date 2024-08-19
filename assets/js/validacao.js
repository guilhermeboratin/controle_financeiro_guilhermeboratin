function ValidarMeusDados(){
    var nome = document.getElementById("nome").value;
    var email = $("#email").val();

    if(nome.trim() == ''){
        alert("Preencher o campo NOME");
        $("#nome").focus();
        return false;
    }
    if(email.trim() == ''){
        alert("Preencher o campo EMAIL")
        $("#email").focus();
        return false;
    }

}

function ValidarCategoria(){ 
    if( $("#nomecategoria").val().trim() == ''){
        alert("Preencher o campo obrigatório NOME DA CATEGORIA");
        $("#nomecategoria").focus();
        return false;
    }
}

function ValidarEmpresa(){
    if($("#empresa").val().trim() == ''){
        alert("Preencher o campo obrigatório NOME DA EMPRESA");
        $("#empresa").focus();
        return false;
    }
    if($("#telefone").val().trim() == ''){
        alert("Preencher o campo obrigatório TELEFONE");
        $("#telefone").focus();
        return false;
    }
    if($("#endereco").val().trim() == ''){
        alert("Preencher o campo obrigatório ENDEREÇO");
        $("#endereco").focus();
        return false;
    }
}

function ValidarConta(){
    if($("#banco").val().trim() == ''){
        alert("Preencher o campo obrigatório NOME DO BANCO");
        $("#banco").focus();
        return false;
    }
    if($("#agencia").val().trim() == ''){
        alert("Preencher o campo obrigatório AGÊNCIA");
        $("#agencia").focus();
        return false;
    }
    if($("#numero").val().trim() == ''){
        alert("Preencher o campo obrigatório NÚMERO DA CONTA");
        $("#numero").focus();
        return false;
    }
    if($("#saldo").val().trim() == ''){
        alert("Preencher o campo obrigatório SALDO BANCÁRIO");
        $("#saldo").focus();
        return false;
    }
}

function ValidarMovimento(){
    if($("#tipo").val() == ''){
        alert("Selecione o TIPO DO MOVIMENTO");
        $("#tipo").focus();
        return false;
    }
    if($("#data").val().trim() == ''){
        alert("Preencher o campo DATA");
        $("#data").focus();
        return false;
    }
    if($("#valor").val().trim() == ''){
        alert("Preencher o campo VALOR DO MOVIMENTO");
        $("#valor").focus();
        return false;
    }
    if($("#categoria").val() == ''){
        alert("Selecione a CATEGORIA");
        $("#categoria").focus();
        return false;
    }
    if($("#empresa").val() == ''){
        alert("Selecione a EMPRESA");
        $("#empresa").focus();
        return false;
    }
    if($("#conta").val() == ''){
        alert("Selecione a CONTA");
        $("#conta").focus();
        return false;
    }
}

function ValidarConsultaPeriodo(){
    if($("#tipo").val() == ''){
        alert("Selecione o TIPO DO MOVIMENTO");
        $("#tipo").focus();
        return false;
    }
    if($("#data_inicial").val().trim() == ''){
        alert("Preencher o campo DATA INICIAL");
        $("#data_inicial").focus();
        return false;
    }
    if($("#data_final").val().trim() == ''){
        alert("Preencher o campo DATA FINAL");
        $("#data_final").focus();
        return false;
    }
}

function ValidarLogin(){
    if($("#email").val().trim() == ''){
        alert("Preencher o campo obrigatório E-MAIL");
        $("#email").focus();
        return false;
    }
    if($("#senha").val().trim() == ''){
        alert("Preencher o campo obrigatório SENHA");
        $("#senha").focus();
        return false;
    }
    if($("#senha").val().trim().length < 6 || $("#senha").val().trim().length > 8){
        alert("A Senha deve conter entre 6 e 8 caracteres!");
        $("#senha").focus();
        return false;
    }
}

function ValidarCadastro(){
    if($("#nome").val().trim() == ''){
        alert("Preencher o campo obrigatório NOME");
        $("#nome").focus();
        return false;
    }
    if($("#email").val().trim() == ""){
        alert("Preencher o campo obrigatório E-MAIL");
        $("#email").focus();
        return false;
    }
    if($("#senha").val().trim() == ''){
        alert("Preencher o campo obrigatório SENHA")
        $("#senha").focus();
        return false;
    }
    if($("#senha").val().trim().length < 6 || $("#senha").val().trim().length > 8){
        alert("A senha deverá conter entre 6 e 8 caracteres");
        $("#senha").focus();
        return false;
    }
    if($("#rsenha").val().trim() == ''){
        alert("Preencher o campo obrigatório REPETIR A SENHA");
        $("#rsenha").focus();
        return false;
    }
    if($("#senha").val().trim() != $("#rsenha").val().trim()){
        alert("O campo SENHA e REPETIR SENHA deverão ser iguais");
        $("#rsenha").focus();
        return false;
    }
}