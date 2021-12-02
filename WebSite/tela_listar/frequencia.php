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
    <title>Frequência</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="icon" href="../imagens/icone_PrefeituraOuroBranco.png">

    <link rel="stylesheet" href="../css/style.css">
        
</head>

<body>
    <?php
        include_once("../cabecalho/cabecalho_listar.php");
    ?>
    <h1 style="text-align: center; margin-top: 20px;">Frequência</h1>
    <br>

    <?php
        //include_once("../pesquisa/pesquisa.html");
        //echo "<br>";
    ?>

    <div style="margin: 20px; text-align: center;">

        <div style="margin: 0 auto;">
            <label for="listTurma">Turma:</label>
            <select name="listTurma" id="listTurma" required style="margin-left: 5px;" onchange="pesquisar()">
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
        </div>

        <div id="avisoPresenca">
            <p style="color: red; margin-top: 10px; margin-bottom: 20px; font-size: 20px;" >Selecione uma turma para pesquisar a presença dos alunos</p>
        </div>

        <div class="resultados">
        </div>

        <br>

        <a href="../tela_criar/presencaParaAluno.php" style="margin-right:20px; font-size: 1.2em">Adicionar presença</a>

        <a href="../tela_criar/removerPresencaParaAluno.php" style="font-size: 1.2em">Remover presença</a>

</body>

<script>
    function pesquisar(){

        let turma = document.getElementById("listTurma");
        let pesquisa = turma.options[turma.selectedIndex].value;

        let dados = {
            pesquisa : pesquisa
        }

        $.post("frequenciaPesquisarDados.php", dados, function(retorna){
            $(".resultados").html(retorna);
        });

        document.getElementById("avisoPresenca").style.display = "none";
    }
      
</script>


</html>
