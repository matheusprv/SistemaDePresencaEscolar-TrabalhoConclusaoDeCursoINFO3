<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de responsável</title>
    <link rel="stylesheet" href="geral.css">
    <link rel="stylesheet" href="cabecalho.css">

</head>

<body>
    <?php
        include_once("cabecalho.php");
    ?>
    
    <div class="divExterna">
        <div class="divInterna">
            <h2 style="width: 100%; text-align: center;">Responsáveis</h2>
            
            <form name="cadastrarResponsavel" action="arquivosPHP/cadastrarResponsavel.php" method="POST">
                <div class="cadastro">
                    <label for="txtNome">Nome:</label>
                    <input type="text" name="txtNome" id="txtNome" style="width: 615px; margin-left: 6px; cursor: text;"
                        required>
                </div>
                <div class="cadastro">
                    <label for="txtEmail">Email:</label>
                    <input type="email" name="txtEmail" id="txtEmail"
                        style="width: 615px; margin-left: 10px; cursor: text;" required>

                </div>
                <div class="cadastro">
                    <label for="txtSenha">Senha:</label>
                    <input type="password" name="txtSenha" id="txtSenha" style="width: 615px; cursor: text;" required>
                </div>

                <div class="adicionarLimpar">
                    <input type="submit" value="Adicionar">
                    <input type="reset" value="Limpar">
                </div>
                </div>
            </form>

        </div>
    </div>
</body>

</html>