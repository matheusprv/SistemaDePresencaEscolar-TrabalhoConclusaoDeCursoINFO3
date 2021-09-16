<?php
    include_once("arquivosPHP/conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Alunos</title>
    <link rel="stylesheet" href="geral.css">
    <link rel="stylesheet" href="cabecalho.css">

    <style>
        @media screen and (max-width:1000px) {
            #txtAluno {
                width: 700px !important;
            }
        }

        @media screen and (max-with:768px) {}
    </style>

</head>

<body>
    <?php
        include_once("cabecalho.php");
    ?>

    <div class="divExterna">
        <div class="divInterna">
            <h2 style="width: 100%; text-align: center;">Cadastrar alunos</h2>
            <form name="cadastrarAluno" action="arquivosPHP/cadastrarAluno.php" method="POST">
                <div class="cadastro">
                    <label for="txtNome">Nome do aluno: </label>
                    <input type="text" name="txtNome" id="txtNome" style="width: 850px; cursor: text;" required>
                </div>

                <div class="cadastro">

                    <label for="listTurma">Turma</label>
                    <select name="listTurma" id="listCurso" required>
                        <option value="" selected disabled hidden>Selecionar</option>
                        <?php
                            
                            $sql = "SELECT idTurma, nome FROM Turma";

                            $turma = $conn -> query($sql);

                            while ($rowTurma = $turma->fetch_assoc()) {
                                ?>
                                    <option value="<?php echo $rowTurma["idTurma"]; ?>"><?php echo $rowTurma["nome"]; ?></option>
                                <?php
                            }

                        ?>
                    </select>
                </div>

                <div class="cadastro">
                    <label for="txtResponsavel">Responsável</label>
                    <select name="txtResponsavel" id="txtResponsavel" style="width: 770px;" required>
                        <option value="" selected disabled hidden>Selecionar</option>
                        <?php
                            
                            $sql = "SELECT id, nome, email FROM Responsavel";

                            $dadosResponsavel = $conn -> query($sql);

                            while ($responsavel = $dadosResponsavel->fetch_assoc()) {
                                ?>
                                    <option value="<?php echo $responsavel["id"]; ?>"><?php echo $responsavel["nome"]; ?> - <?php echo $responsavel["email"]?></option>
                                <?php
                            }

                        ?>
                    </select>

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