<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro das disciplinas</title>
    <link rel="stylesheet" href="geral.css">
    <link rel="stylesheet" href="cabecalho.css">
</head>
<body>
    <?php
        include_once("cabecalho.php");
    ?>

    <div class="divExterna">
        <div class="divInterna">
            <h2 style="width: 100%; text-align: center;">Disciplinas</h2>
            <form name="cadastrarDisciplina" action="arquivosPHP/cadastrarDisciplina.php" method="POST">
                <div class="cadastro">
                    <label for="txtNome">Nome</label>
                    <input type="text" name="txtNome" id="txtNome" style="margin-left: 42px; width: 610px; cursor: text;" required>
                </div>

                <div class="cadastro" style="padding-top: 10px;">
                    <label for="txtProf">Professor</label>
                    <input type="text" name="txtProf" id="txtProf" style="width: 610px; cursor: text;" required>

                </div>
                
                <div class="cadastro" style="padding-top: 10px;">
                    <label for="txtCodigo">Número de aulas</label>
                    <input type="number" name="txtCodigo" id="txtCodigo" style="margin-left: 30px; width: 610px; cursor: text;" required>
                    
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