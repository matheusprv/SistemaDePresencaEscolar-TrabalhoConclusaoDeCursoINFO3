<?php
    include_once("../conexao.php");
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
    <title>Remover presença do aluno</title>
    <link rel="icon" href="../imagens/icone_PrefeituraOuroBranco.png">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/presencaParaAluno.css">

        
</head>

<body>
    <?php
        include_once("../cabecalho/cabecalho_listar.php");
    ?>
    <h1 style="text-align: center; margin-top: 20px;">Remover presença do aluno</h1>
    <br>



    <div class="divCentralizada" style="width: 750px;">

        <form action="../php_deletar/removerPresencaAluno.php" method="POST">
            
            <div>
                <ul>
                    <li style="display: inline-block; width: 20%; margin-right: 15px;" >
                        <label for="listAnoTurma">Ano:</label> <br>
                        <select name="listAnoTurma" id="listAnoTurma" required style="width: 100%;" onchange="listarRegistros()">
                            <?php
                                
                                $sql = "SELECT distinct ano from Turma ORDER BY ano DESC;";

                                $turma = $conn->query($sql);

                                while ($rowTurma = $turma->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $rowTurma["ano"]; ?>"><?php echo $rowTurma["ano"]; ?></option>
                                    <?php
                                }

                            ?>
                        </select>
                    </li>
                    <li style="display: inline-block; width: 77%;">
                        <div class="resultados-Turmas"></div>
                    </li>
                </ul>

            </div>

            <br>

            <input type="time" value="09:30" id="horas" name="horas" style="font-size: 1.3em; margin-right: 15px;" required>

            <?php
                date_default_timezone_set('America/Sao_Paulo');
                $dataAtual = date('Y-m-d');
            ?>

            <input id="data" name="data" type="date" value="<?php echo $dataAtual ?>" style="font-size: 1.3em;" required> 

            <br><br>
            <label for="txtAluno"><b>Aluno:</b></label>

            <p id="avisoAluno" style="color: red; margin-top: 7px;">Selecione uma turma para mostrar os alunos</p>
            <div class="resultados">
            </div>

            <br>

            

            <br><br>

            <div style="text-align: center;">
                <input type="submit" value="Remover" id="add" class="formBtn adicionar">
                <input type="reset" value="Limpar" id="limpar" class="formBtn limpar">
            </div>

            

        </form>

    </div>

    

</body>

<script>


    function pesquisar(){

        let turma = document.getElementById("listTurma");
        let pesquisa = turma.options[turma.selectedIndex].value;

        //let pesquisa = $("#listTurma").val();
        let dados = {
            pesquisa : pesquisa
        }

        $.post("pesquisaDeDados/pesquisarAlunos.php", dados, function(retorna){
            $(".resultados").html(retorna);
        });

        document.getElementById("avisoAluno").style.display = "none";
    }

    function listarRegistros() {
        let ano = $('#listAnoTurma').val();
        let dados = {
            anoTurma : ano
        }

        $.post("pesquisaDeDados/pesquisarTurmas-Presenca.php", dados, function(retorna) {
            $(".resultados-Turmas").html(retorna);
        });

    }

    $(document).ready(function(){
        listarRegistros(); // Chamar a função assim que carregar a página
    });
      
</script>

</html>