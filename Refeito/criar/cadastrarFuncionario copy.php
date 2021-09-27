<?php
    include_once("../arquivosPHP/conexao.php");
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

<body>
    <?php
        include_once("../cabecalho/cabecalho_criar.html");
    ?>
    <h1 style="text-align: center; margin-top: 20px;">Cadastrar funcionário</h1>
    <br>



    <div class="divCentralizada" style="width: 750px;">

        <form action="">
            <label for="txtNome">Nome do aluno:</label>
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