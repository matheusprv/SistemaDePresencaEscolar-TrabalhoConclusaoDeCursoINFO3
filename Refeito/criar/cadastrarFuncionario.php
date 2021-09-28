<?php
    include_once("../arquivosPHP/conexao.php");
    include_once ('../dados_login.php');
    $logged = $_SESSION['logged'] ?? null;
    if(!$logged){
        $logado =false;
    }
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Funcionário</title>


    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../pesquisa/pesquisa.css">
        
</head>

<body style="margin: 0;">
    <?php
        if($logado){
            include_once("../cabecalho/cabecalho_criar.php");
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

        <form action="../arquivosPHP/cadastrarFuncionario.php" method="POST">
            <label for="txtNome">Nome:</label>
            <input type="text" name="txtNome" id="txtNome" class="input-text" required>
            <br><br>

            <label for="txtEmail">Email:</label>
            <input type="email" name="txtEmail" id="txtEmail" class="input-text" required>
            <br><br>

            <label for="txtSenha">Senha:</label>
            <input type="password" name="txtSenha" id="txtSenha" class="input-text" style="margin-left: 10px; width: 86.7%;" required>
            <br><br>


            <div style="text-align: center;">
                <input type="submit" value="Adicionar" class="formBtn adicionar">
                <input type="reset" value="Limpar" class="formBtn limpar">
            </div>
            
        </form>

    </div>

</body>


</html>