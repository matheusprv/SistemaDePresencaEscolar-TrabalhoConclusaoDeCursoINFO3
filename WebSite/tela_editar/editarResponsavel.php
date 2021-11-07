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
    <title>Editar Responsável</title>
    <link rel="icon" href="../imagens/icone_PrefeituraOuroBranco.png">

    <link rel="stylesheet" href="../css/style.css">
        
</head>
<body>

    <?php
            include_once("../cabecalho/cabecalho_listar.php");

            //busca dados do objeto no banco
            if(isset($_GET["id"])){
                $id = $_GET["id"];
                $sql = "SELECT * from Responsavel where id = $id"; 
                $consulta = $conn->query($sql);
                $exibir = $consulta->fetch_assoc();
            }

        ?>
        <h1 style="text-align: center; margin-top: 20px;">Editar Responsável</h1>
        <br>

            
        <div class="divCentralizada" style="width: 750px;">

        <form action="../php_atualizar/atualizarResponsavel.php?id=<?php echo $_GET['id'] ?>" method="POST">

            <label for="txtNome">Nome:</label>
            <input type="text" name="txtNome" id="txtNome" class="input-text" required value="<?php echo $exibir["nome"] ?>">
            <br><br>

            <label for="txtEmail">Email:</label>
            <input type="text" name="txtEmail" id="txtEmail" class="input-text" required value="<?php echo $exibir["email"] ?>">
            <br><br>

            <div style="text-align: center;">
                <input type="submit" value="Adicionar" class="formBtn adicionar">
                <input type="reset" value="Limpar" class="formBtn limpar">
            </div>
        

        </form>

    </div>


    </body>

</html>