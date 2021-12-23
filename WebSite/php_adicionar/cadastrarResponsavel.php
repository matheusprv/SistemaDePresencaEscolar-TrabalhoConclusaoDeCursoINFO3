<?php
    //Incluindo arquivo de conexão com o banco de dados
    include_once("../conexao.php");

    $nome = $_POST["txtNome"];
    $email = $_POST["txtEmail"];

    //Criar senha aleatoria
    $string = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $senha = substr(str_shuffle($string),0,10);


    //verificar se o emai já está cadastrado
    $sql = "SELECT * FROM Responsavel WHERE email = '$email' ";
    $responsavel = $conn->query($sql);
    $numeroDeResultados =  mysqli_num_rows($responsavel);

    if($numeroDeResultados>0){
        ?>
            <script>
                alert("ERRO! \nEmail já cadastrado");
                window.history.back();
                //const email = document.querySelector("#emailValidacao");
                //email.style.display = "block";
            </script>
        <?php
    }
    else{
        //Inserindo valores no banco
        $sql = "INSERT INTO Responsavel (nome, email, senha) VALUES ('$nome', '$email', '$senha')";

        //Executando o comando sql
        if($conn -> query($sql) === TRUE ){

            $resposta = 1;

            //Enviar email com acesso ao aplicativo
            $destinatario = $email;
            $enviarDadosResponsavel = TRUE; //TRUE envia para responsável e FALSE envia para Aluno
            include('../enviarEmail/enviarEmail.php');

            ?>
            <script>
                window.location = "../tela_listar/responsaveis.php?resposta="+ <?php echo $resposta ?>;
            </script>

            <?php
        }
        else{
            ?>
            <script>
                window.location = "../tela_listar/responsaveis.php?resposta=2";
            </script>
            
            <?php
        }
    }

    

?>