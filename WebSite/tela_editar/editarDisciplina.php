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
    <title>Editar Disciplina</title>
    <link rel="icon" href="../imagens/icone_PrefeituraOuroBranco.png">

    <link rel="stylesheet" href="../css/style.css">
        
</head>

<body>
    <?php
        include_once("../cabecalho/cabecalho_listar.php");

        //Buscar dados do objeto a ser editado no banco
        if(isset($_GET["idDisciplina"])){
            $idDisciplina = $_GET["idDisciplina"];
            $sql = "SELECT * from Disciplina where idDisciplina = $idDisciplina"; 
            $consulta = $conn->query($sql);
            $exibir = $consulta->fetch_assoc();
        }
    ?>
    <h1 style="text-align: center; margin-top: 20px;">Editar disciplina</h1>
    <br>



    <div class="divCentralizada" style="width: 750px;">

        <form action="../php_atualizar/atualizarDisciplina.php?idDisciplina=<?php echo $_GET['idDisciplina'] ?>" method="POST">
            <label for="txtNome">Nome:</label>
            <input type="text" name="txtNome" id="txtNome" class="input-text" required value="<?php echo $exibir["nome"] ?>">
            <br><br>

            <label for="txtProf">Professor:</label>
            <input type="text" name="txtProf" id="txtProf" class="input-text" required value="<?php echo $exibir["professor"] ?>">
            <br><br>

            <label for="numAulas">Número de aulas:</label>
            <input type="number" name="numAulas" id="numAulas" class="input-text" style="margin-left: 10px; width: 69.5%;" required value="<?php echo $exibir["numeroAulas"] ?>">
            <br><br>


            <div style="text-align: center;">
                <input type="submit" value="Editar" class="formBtn adicionar">
                <input type="reset" value="Limpar" class="formBtn limpar">
            </div>
            

        </form>

    </div>

</body>


</html>