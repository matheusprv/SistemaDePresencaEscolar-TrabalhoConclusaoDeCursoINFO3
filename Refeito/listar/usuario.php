<?php
    include_once("../arquivosPHP/conexao.php");
    include_once ('../dados_login.php');
    $logged = $_SESSION['logged'] ?? null;
    if(!$logged){
        die(header("Location: /..index"));
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funcionários</title>

    
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../pesquisa/pesquisa.css">
    <link rel="stylesheet" href="../cabecalho/styleCabecalho.css">
    
</head>

<body>
    <?php
        include_once("../cabecalho/cabecalho_listar.php");
    ?>

    <h1 style="text-align: center;"><?php echo "{$_SESSION['usuario']}"; ?></h1>
    <br>
    <form action="">
        <div class="divCentralizada" style="width: 750px;">
            <label for="txtNome">Nome:</label>
            <input type="text" name="txtNome" id="txtNome" class="input-text" required value="<?php echo "{$_SESSION['usuario']}"; ?>">
            <br><br>

            <label for="txtEmail">Email:</label>
            <input type="email" name="txtEmail" id="txtEmail" class="input-text" required value="<?php echo "{$_SESSION['email']}"; ?>">
            <br><br>

            <label for="txtSenha">Senha:</label>
            <input type="password" name="txtSenha" id="txtSenha" class="input-text" style="width: 100%;" required value="<?php echo "{$_SESSION['senha']}"; ?>">
            <br><br>


            <div style="text-align: center;">
                <input type="submit" value="Salvar" class="formBtn adicionar">
                <input type="reset" value="Limpar" class="formBtn limpar">
            </div>
        </div>
        
    </form>
    </div>
    

</body>


</html>