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
    <title>Cadastrar Aluno</title>
    <link rel="icon" href="../imagens/icone_PrefeituraOuroBranco.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/style.css">
        
</head>

<body>
    <?php
        include_once("../cabecalho/cabecalho_listar.php");
    ?>
    <h1 style="text-align: center; margin-top: 20px;">Cadastrar aluno</h1>
    <br>



    <div class="divCentralizada" style="width: 750px;">

        <form action="../php_adicionar/cadastrarAluno.php" method="POST">
            <label for="txtNome">Nome do aluno:</label>
            <input type="text" name="txtNome" id="txtNome" class="input-text" required>
            <br><br>

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
                        <div class="resultados"></div>
                    </li>
                </ul>

            </div>

            
            <br>

            <label for="txtResponsavel">Responsável</label>
            <select name="txtResponsavel" id="txtResponsavel" style="width: 100%;" required>
                <option value="" selected disabled hidden>Selecionar</option>
                <?php
                    
                    $sql = "SELECT id, nome, email FROM Responsavel ORDER BY nome";

                    $dadosResponsavel = $conn -> query($sql);

                    while ($responsavel = $dadosResponsavel->fetch_assoc()) {
                        ?>
                            <option value="<?php echo $responsavel["id"]; ?>"><?php echo $responsavel["nome"]; ?> - <?php echo $responsavel["email"]?></option>
                        <?php
                    }

                ?>
            </select>
            <br><br>

            <label for="cartaoRFID">Cartões disponíveis</label>
            <select name="cartaoRFID" id="cartaoRFID" style="width: 100%;">
                <option value="" selected disabled hidden>Selecionar</option>
                <?php
                    
                    $sql = "SELECT * FROM Cartao WHERE disponivel = 1";

                    $dadosCartoes = $conn -> query($sql);

                    if(mysqli_num_rows($dadosCartoes)>0){
                        while ($cartoes = $dadosCartoes->fetch_assoc()) {
                            ?>
                                <option value="<?php echo $cartoes["uid"]; ?>"><?php echo $cartoes["uid"]; ?></option>
                            <?php
                        }
                    }                    

                ?>
                <option value="0" >Nenhum cartão</option>
            </select>

            <br><br>
            <input type="checkbox" id="enviarEmail" name="enviarEmail">
            <label for="enviarEmail" style="font-size: 1em;">Enviar email de acesso ao app</label>
            <br><br>


            <div style="text-align: center;">
                <input type="submit" value="Adicionar" class="formBtn adicionar">
                <input type="reset" value="Limpar" class="formBtn limpar">
            </div>
            

        </form>

    </div>

</body>
<script>
    $(document).ready(function(){
        listarRegistros(); // Chamar a função assim que carregar a página
    });

    function listarRegistros() {
        let ano = $('#listAnoTurma').val();
        let dados = {
            anoTurma : ano
        }

        $.post("pesquisaDeDados/pesquisarTurmas.php", dados, function(retorna) {
            $(".resultados").html(retorna);
        });

    }
</script>

</html>