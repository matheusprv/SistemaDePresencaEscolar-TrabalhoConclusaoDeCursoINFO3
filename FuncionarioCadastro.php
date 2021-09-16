<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de funcionário</title>
    <link rel="stylesheet" href="FuncionarioCadastro.css">
    <link rel="stylesheet" href="geral.css">
    <link rel="stylesheet" href="cabecalho.css">
</head>

<body>
    <?php
        include_once("cabecalho.php");
    ?>

    <div class="divExterna">
        <div class="divInterna">

            <form name="cadastrarFuncionario" action="arquivosPHP/cadastrarFuncionario.php" method="POST">
                <div class="cadastro">
                    <p><b>Cadastro de funcionários</b></p>
                    <label for="txtNome">Nome</label>
                    <input type="text" name="txtNome" id="txtNome"
                        style=" margin-left: 5px; width: 617px; cursor: text;" required>
                </div>

                <div class="cadastro">
                    <label for="txtEmail">Email</label>
                    <input type="email" name="txtEmail" id="txtEmail"
                        style="margin-left: 10px; width: 617px; cursor: text;" required><br>
                </div>

                <div class="cadastro">

                    <label for="txtSenha">Senha</label>
                    <input type="text" name="txtSenha" id="txtSenha" style="width: 615px; cursor: text;" required>
                </div>

                <div class="adicionarLimpar">
                    <input type="submit" value="Adicionar">
                    <input type="reset" value="Limpar">
                </div>
            </form>


        </div>
    </div>
</body>

</html>