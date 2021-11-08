<?php
    include_once 'dados_login.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presença escolar</title>
    <link rel="icon" href="imagens/icone_PrefeituraOuroBranco.png">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<!--Exibir a senha-->
<script>
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


<body style="background-color: #1D6AE3;">
    <?php
        if(!$_SESSION['logged']){

            $erro=0;
            if(isset($_GET["exibirErro"])){
                $erro = $_GET["exibirErro"];
            }
            
            ?>
                <div class="center" style="background-color: white;">
                    <img src="imagens/PresencaEscolar_PrefeituraOuroBranco.png" alt="Prefeitura de Ouro Branco" style="height: 300px;">
                    <br><br>
                    
                    <form action="dados_login.php" method="POST" style="text-align: center;" class="formulario">
                        <input class="inserir" type="text" name="txtUsuario" id="txtUsuario" required autofocus placeholder="Email"><br><br>
                        <!--
                        https://www.youtube.com/watch?v=kUpoxmSo82E&list=WL&index=8&ab_channel=CodingArtist
                        -->
                        <div class="wrapper">
                            <input class="inserir" type="password" name="txtSenha" id="txtSenha" placeholder="Senha">
                            <?php
                                //Ajustar a posição do icone de exibir senha
                                if($erro==0){
                                    ?>
                                        <span>
                                    <?php
                                }
                                else{
                                    ?>
                                        <span style="top: 69.3%">
                                    <?php
                                }
                            ?>
                                <i class="fa fa-eye" aria-hidden="true" id="eye" onclick="toggle()"></i>
                            </span>
                        </div>
                        <br><br>

                        <?php
                            if(isset($_GET["exibirErro"])){
                                $erro = $_GET["exibirErro"];
                                if($erro == 1){
                                    ?>
                                        <div style="color: red;">
                                            Email ou senha inválidos <br><br>
                                        </div>
                                    <?php
                                }
                            }
                        ?>
                    
                        <input class="botaoEntrar inserir" type="submit" name="Entrar" value="Entrar">
                    </form>
                    <br>
                    <div style="margin: 0 auto; text-align: center;">
                        <a href="tela_criar/cadastrarFuncionario.php">Cadastrar</a>
                    </div>
                </div>
                
            <?php
        
        }
        else{
            header("Location: menus.php");
            exit();
        }
        
    ?>
                

</body>
</html>