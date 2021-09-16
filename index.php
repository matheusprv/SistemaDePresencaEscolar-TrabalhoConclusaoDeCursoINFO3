<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela inicial</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="cabecalho.css">
</head>

<body>
    <!--
    <div class= cabecalho>
        
    </div>
-->

    <div class="container">
        <div class="box">
            <div style="margin: 20px;">
                <h1 style="text-align: center;">Login</h2>

                <form action="" method="POST">
                    <label for="txtUsuario" style="font-size: 1.3em;">Email: </label><br>
                    <input type="text" name="txtUsuario" id="txtUsuario" required><br><br>

                    <label for="txtSenha" style="font-size: 1.3em;">Senha:</label><br>
                    <input type="password" name="txtSenha" id="txtSenha" required><br><br>

                    <input class="botaoEntrar" type="submit" value="Entrar">
                </form>
                
                <div style="width: 100%;">
                    <p style="text-align: center;"><a href="FuncionarioCadastro.php" style="text-decoration: none;"><u>Se cadastrar como funcionário</u></a></p>
                    
                </div>
                
            </div>
            
        </div>
    </div>

</body>

</html>