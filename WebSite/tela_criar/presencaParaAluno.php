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
    <title>Presença para o aluno</title>
    <link rel="icon" href="../imagens/icone_PrefeituraOuroBranco.png">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/presencaParaAluno.css">

        
</head>

<body>
    <?php
        include_once("../cabecalho/cabecalho_listar.php");
    ?>
    <h1 style="text-align: center; margin-top: 20px;">Adicionar presença para o aluno</h1>
    <br>



    <div class="divCentralizada" style="width: 750px;">

        <form action="../php_adicionar/adicionarPresencaAluno.php" method="POST">
            
            <label for="listTurma">Turma do aluno:</label>
            <select name="listTurma" id="listTurma" required style="width: 100%;" onchange="pesquisar()">
                <option value="" selected disabled hidden>Selecionar</option>
                <?php
                    
                    $sql = "SELECT idTurma, nome FROM Turma ORDER BY nome";

                    $turma = $conn -> query($sql);

                    while ($rowTurma = $turma->fetch_assoc()) {
                        ?>
                            <option value="<?php echo $rowTurma["idTurma"]; ?>"><?php echo $rowTurma["nome"]; ?></option>
                        <?php
                    }

                ?>
            </select>

            <br><br>

            <label for="DiaSemana"><b>Dia da semana:</b></label><br>

            <ul class="dias">
                <li>
                    <input type="radio" class="radioBtn" name="DiaSemana" id="DiaSemana" value="1">
                    <label class="opcaoDiaSemana">Segunda-feira</label>
                </li>
                <li>
                    <input type="radio" class="radioBtn" name="DiaSemana" id="DiaSemana" value="2">
                    <label class="opcaoDiaSemana">Terça-feira</label>
                </li>
                <li>
                    <input type="radio" class="radioBtn" name="DiaSemana" id="DiaSemana" value="3">
                    <label class="opcaoDiaSemana">Quarta-feira</label>
                </li>
                <li>
                    <input type="radio" class="radioBtn" name="DiaSemana" id="DiaSemana" value="4">
                    <label class="opcaoDiaSemana">Quinta-feira</label>
                </li>
                <li>
                    <input type="radio" class="radioBtn" name="DiaSemana" id="DiaSemana" value="5">
                    <label class="opcaoDiaSemana">Sexta-feira</label>
                </li>
                <li>
                    <input type="radio" class="radioBtn" name="DiaSemana" id="DiaSemana" value="6">
                    <label class="opcaoDiaSemana">Dia Atual</label> 
                </li>
            </ul>

            <br>
            <label for="txtAluno"><b>Aluno:</b></label>

            <p id="avisoAluno" style="color: red; margin-top: 7px;">Selecione uma turma para mostrar os alunos</p>
            <div class="resultados">
            </div>

            <br><br>

            <div style="text-align: center;">
                <input type="submit" value="Adicionar" id="add" class="formBtn adicionar">
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

        $.post("buscaAlunos.php", dados, function(retorna){
            $(".resultados").html(retorna);
        });

        document.getElementById("avisoAluno").style.display = "none";
    }
      
</script>

</html>