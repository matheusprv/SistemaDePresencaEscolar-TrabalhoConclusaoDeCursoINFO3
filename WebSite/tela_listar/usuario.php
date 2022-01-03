<?php
    include_once("../conexao.php");
    include_once ('../dados_login.php');
    $logged = $_SESSION['logged'] ?? null;
    if(!$logged){
        die(header("Location: ../index.php"));
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuário</title>
    <link rel="icon" href="../imagens/icone_PrefeituraOuroBranco.png">
    
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="../css/usuario.css">
</head>


<body>
    <?php
        include_once("../cabecalho/cabecalho_listar.php");
    ?>

    <h1 style="text-align: center; margin-top: 20px;"><?php echo "{$_SESSION['usuario']}"; ?></h1>
    <br>
    <form action="../php_atualizar/atualizarUsuario.php" method="POST">
        <div class="divCentralizada" style="width: 750px;">

            

            <label for="txtNome">Nome:</label>
            <input type="text" name="txtNome" id="txtNome" class="input-text" required value="<?php echo "{$_SESSION['usuario']}"; ?>" readonly>
            <br><br>

            <label for="txtEmail">Email:</label>
            <input type="email" name="txtEmail" id="txtEmail" class="input-text" required value="<?php echo "{$_SESSION['email']}"; ?>" readonly>
            <br><br>


            <label for="txtSenhaAtual">Senha atual:</label><br>
            <div class="wrapper">        
                <input type="password" name="txtSenhaAtual" id="txtSenhaAtual" class="input-text" style="width: 100%;" required value="" onkeyup="verificarSenhas()" maxlength="10" placeholder="Digite sua senha atual para alterá-la">
            </div>
            <br>

            <div class="respostasSenha" style="width: 102%;">O usuário saberá se a senha está correta<br></div>

            <?php
                include_once("respostasServicosAlterarSenha.php");
                echo "<br>";
            ?>

            <label for="txtSenha">Nova senha:</label><br>
            <label for="" style="font-size: medium; font-weight: bold;">Tamano máximo: 10 caracteres</label>
            <div class="wrapper">        
                <input type="password" name="txtSenha" id="txtSenha" class="input-text" style="width: 100%;" required value="" onkeyup="verificarSenhas()" maxlength="10">
                <span>
                    <i class="fa fa-eye" aria-hidden="true" id="eye" onclick="toggle()"></i>
                </span>
            </div>
                        
            <div class="txtSenhaConfirmar" >
                <label for="txtSenhaConfirmar">Confirmar senha:</label>
                <input type="password" name="txtSenhaConfirmar" id="txtSenhaConfirmar" class="input-text" style="width: 100%;" required value="" onkeyup="verificarSenhas()">
                <br><br>
            </div>

            <div style="text-align: center;">
                <input type="submit" value="Salvar" class="formBtn adicionar" disabled id="botaoSalvar">
            </div>
        </div>
        
    </form>


    </div>
    
    <script>
        
        //verifica se as senhas possuem os mesmos valores 
        function verificarSenhas(){
            var senhaAtual = document.querySelector("#txtSenhaAtual");
            var senha1 = document.querySelector("#txtSenha");
            var senha2 = document.querySelector("#txtSenhaConfirmar");
            var respostaSenha = document.querySelector(".respostasSenha");
            var btn = document.querySelector("#botaoSalvar");

            if(senha2.value.length >= 1){
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