<?php
    include_once("../conexao.php");
    include_once ('../dados_login.php');
    $logged = $_SESSION['logged'] ?? null;
    $logado = true;
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
    <title>Editar Funcionário</title>
    <link rel="icon" href="../imagens/icone_PrefeituraOuroBranco.png">

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/funcionario.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        #botaoAdicionar{
            cursor: pointer;
        }
    </style>
    
</head>

<body style="margin: 0;">
    <?php
        if($logado){
            include_once("../cabecalho/cabecalho_listar.php");
        }
        else{
            ?>
            <link rel="stylesheet" href="../css/menus.css">
            <nav>
                <img src="../imagens/logotipo.png" alt="Prefeitura de Ouro Branco" style="height: 80%;">
            </nav>
            <?php
        }
    ?>
    <h1 style="text-align: center; margin-top: 20px;">Editar funcionário</h1>
    <br>

    <?php
        //Buscar dados do objeto a ser editado no banco
        if(isset($_GET["id"])){
            $id = $_GET["id"];
            $sql = "SELECT * from Funcionario where id = $id"; 
            $consulta = $conn->query($sql);
            $exibir = $consulta->fetch_assoc();
        }
    ?>


    <div class="divCentralizada" style="width: 750px;">

        <form action="../php_atualizar/atualizarFuncionario.php?id=<?php echo $_GET['id'] ?>" method="POST">
            <label for="txtNome">Nome:</label>
            <input type="text" name="txtNome" id="txtNome" class="input-text" required value="<?php echo $exibir["Nome"] ?>">
            <br><br>

            <!--
            <label for="txtEmail">Email:</label>
            <input type="email" name="txtEmail" id="txtEmail" class="input-text" required value="<?php echo $exibir["email"] ?>">
            <label style="font-size: medium; color: red; display: none;" class="emailValidacao" id="emailValidacao">Email em uso</label>
            <br><br>
            -->
        
            <div style="text-align: center;">
                <input type="submit" value="Editar" class="formBtn adicionarFunc" id="botaoAdicionar">
                <input type="reset" value="Limpar" class="formBtn limpar">
            </div>
            
        </form>
    </div>

</body>


</html>