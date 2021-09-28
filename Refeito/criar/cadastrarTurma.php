<?php
    include_once("../arquivosPHP/conexao.php");
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
    <title>Cadastrar Turmas</title>


    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../pesquisa/pesquisa.css">
        
</head>

<body>
    <?php
        include_once("../cabecalho/cabecalho_criar.php");
    ?>
    <h1 style="text-align: center; margin-top: 20px;">Cadastrar turma</h1>
    <br>



    <div class="divCentralizada" style="width: 750px;">

        <form action="">
            <label for="txtNome">Nome:</label>
            <input type="text" name="txtNome" id="txtNome" class="input-text" required>
            <br><br>

            
            <label for="txtAno">Ano:</label>
            <input type="number" name="txtAno" id="txtAno" class="input-text" required>
            <br><br>
            


            <div style="text-align: center;">
                <input type="submit" value="Adicionar" class="formBtn adicionar">
                <input type="reset" value="Limpar" class="formBtn limpar">
            </div>
            

        </form>

    </div>

</body>


</html>