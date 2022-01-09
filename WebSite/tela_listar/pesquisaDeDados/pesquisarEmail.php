<?php
    include_once("../../conexao.php");

    if($_POST["enviarDadosResponsavel"] == 1){
        $enviarDadosResponsavel = TRUE;
        $email = $_POST["email"];
        $destinatario = $email;
        $nome = $_POST["nome"];
        $sql = "SELECT senha FROM Responsavel WHERE email='$email'";
        
    }
    else{
        $enviarDadosResponsavel = FALSE;
        $matricula = $_POST["matricula"];
        $nome = $_POST['nome'];
        $destinatario = $_POST["emailResponsavel"];
        $nomeResponsavel = $_POST["nomeResponsavel"];
        $sql = "SELECT senha FROM Aluno WHERE matricula=$matricula";
        
    }
    $senhaRecuperada = $conn->query($sql);
    while($rowSenha = $senhaRecuperada->fetch_assoc()){
        $senha = $rowSenha["senha"];
    }
    include("../../criptografarSenha/descriptografarSeha.php");
    include("../../enviarEmail/enviarEmail.php");
    include_once("../respostasHorarios.php");



?>