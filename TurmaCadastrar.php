<!DOCTYPE html>
<html lang="pt-Br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro das turmas</title>
    <link rel="stylesheet" href="geral.css">
    <link rel="stylesheet" href="cabecalho.css">
</head>
<body>
    <?php
        include_once("cabecalho.php");
    ?>

    <div class="divExterna">
        <div class="divInterna">
            <h2 style="width: 100%; text-align: center;">Cadastrar turma</h2>
            
            <form name= "cadastrarTurma" action="arquivosPHP/cadastrarTurma.php" method="POST">
                <div class="cadastro">
                    <label for="txtNome">Nome</label>
                    <input type="text" name="txtNome" style="width: 670px; cursor: text;" required>
                </div>
                <div class="cadastro"  style="padding-top: 10px;">
                    <label for="txtAno">Ano</label>
                    <input type="number" name="txtAno" style="width: 143px; cursor: text;" required>
                </div>   
                <div class="adicionarLimpar">
                    <input type="submit" name="btnSalvar" value="Adicionar">
                    <input type="reset" name="btnCancelar" value="Limpar">
                </div>           
            </form>

        </div>
    </div>

</body>
</html>