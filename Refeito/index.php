<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/index.css">
    
</head>
<body style="background-color: #1D6AE3;">

    <div class="center" style="background-color: white;">
        <img src="imagens/logo_PrefeituraOuroBranco.png" alt="Prefeitura de Ouro Branco" style="height: 300px;">
        <br><br>
        
        <form action="menus.php" method="POST" style="text-align: center;">
            <input class="inserir" type="text" name="txtUsuario" id="txtUsuario" required autofocus placeholder="Email"><br><br>
            <input class="inserir" type="password" name="txtSenha" id="txtSenha" required placeholder="Senha"><br><br>

            <input class="botaoEntrar inserir" type="submit" value="Entrar">
        </form>
    </div>

</body>
</html>