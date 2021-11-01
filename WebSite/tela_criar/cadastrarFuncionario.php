<?php
    include_once("../conexao.php");
    include_once ('../dados_login.php');
    $logged = $_SESSION['logged'] ?? null;
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Funcionário</title>
    <link rel="icon" href="../imagens/icone_PrefeituraOuroBranco.png">

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/funcionario.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
</head>

<body style="margin: 0;">
    <?php
        if(session_status() == PHP_SESSION_ACTIVE){
            include_once("../cabecalho/cabecalho_listar.php");
        }
        else{
            ?>
            <link rel="stylesheet" href="../css/menus.css">
            <nav>
                <img src="../imagens/logotipo.png" alt="Prefeitura de Ouro Branco" style="height: 80%;">
            </nav>
            <?php
        }
    ?>
    <h1 style="text-align: center; margin-top: 20px;">Cadastrar funcionário</h1>
    <br>



    <div class="divCentralizada" style="width: 750px;">

        <form action="../php_adicionar/cadastrarFuncionario.php" method="POST">
            <label for="txtNome">Nome:</label>
            <input type="text" name="txtNome" id="txtNome" class="input-text" required>
            <br><br>

            <label for="txtEmail">Email:</label>
            <input type="email" name="txtEmail" id="txtEmail" class="input-text" required>
            <label style="font-size: medium; color: red; display: none;" class="emailValidacao" id="emailValidacao">Email em uso</label>
            <br><br>

            <div class="respostasSenha">O usuário saberá se a senha está correta<br></div>
            
            <label for="txtSenha">Senha:</label>
            <br>
            <label for="" style="font-size: medium; font-weight: bold;">Tamano máximo: 10 caracteres</label>
            <div class="wrapper">        
                <input type="password" name="txtSenha" id="txtSenha" class="input-text" style="width: 100%;" required value="" onkeyup="senha1Escrita(); verificarSenhas()" maxlength="10">
                <span>
                    <i class="fa fa-eye" aria-hidden="true" id="eye" onclick="toggle()"></i>
                </span>
            </div>
 

            <label for="txtSenhaConfirmar">Confirmar senha:</label>
            <input type="password" name="txtSenhaConfirmar" id="txtSenhaConfirmar" class="input-text" style="width: 100%;" required disabled onkeyup="verificarSenhas()"> 
            <br><br>


            <div style="text-align: center;">
                <input type="submit" value="Adicionar" class="formBtn adicionarFunc" id="botaoAdicionar" disabled>
                <input type="reset" value="Limpar" class="formBtn limpar">
            </div>
            
        </form>
    </div>

    <script>
        //https://www.youtube.com/watch?v=J-P_rzGb9-A&t=0s&ab_channel=CodingNepal
        //https://www.youtube.com/watch?v=wqlxbPJV_NM&ab_channel=CodingNepal

        const senha1 = document.querySelector("#txtSenha");
        const senha2 = document.querySelector("#txtSenhaConfirmar");
        const respostaSenha = document.querySelector(".respostasSenha");
        const btn = document.querySelector("#botaoAdicionar");

        function senha1Escrita(){
            //Verifica se algo está escrito na primeira senha para depois liberar a escrita na segunda
            if(senha1.value.length >= 3){
                senha2.removeAttribute("disabled", "")
            }
            else{
                btn.setAttribute("disabled", "");
                btn.classList.remove("active");
                senha2.setAttribute("disabled", "");
            }
        }

        //verifica se as senhas possuem os mesmos valores 
        function verificarSenhas(){
            if(senha2.value.length >= 3){
                if(senha1.value == senha2.value){
                    //Habilita o botão de adicionar
                    btn.removeAttribute("disabled", "");
                    btn.classList.add('active');
                    respostaSenha.style.display = "block";
                    respostaSenha.style.backgroundColor = "#d7f8dc";
                    respostaSenha.textContent = "As senhas correspondem";

                }
                else{
                    //Desabilita o botão de adicionar
                    btn.setAttribute("disabled", "");
                    btn.classList.remove("active");
                    respostaSenha.style.display = "block";
                    respostaSenha.style.backgroundColor = "#f8d7da";
                    respostaSenha.textContent = "As senhas não correspondem";
                }
            }
            
        }

        //Ver senha
        var state = false;
        function toggle(){
            if(state){
                document.getElementById("txtSenha").setAttribute("type", "password");
                document.getElementById("eye").style.color="#7a797e";
                state = false;
            }
            else{
                document.getElementById("txtSenha").setAttribute("type", "text");
                document.getElementById("eye").style.color="#5887ef";
                state = true;
            }
        }
    </script>

</body>


</html>