<?php
    //Incluindo arquivo de conexão com o banco de dados
    include_once("../conexao.php");
    include_once("../dados_login.php");

    $email = $_POST["txtEmail"];
    $senhaAtual = criptografarSenha($_POST["txtSenhaAtual"]);
    $novaSenha = criptografarSenha($_POST["txtSenha"]);
    $senhaConfirmada = criptografarSenha($_POST["txtSenhaConfirmar"]);

    //Verificar se a senha atual está correta
    if($senhaAtual == $_SESSION['senha']){
        
        //Executar sql
        $sql = "UPDATE Funcionario SET senha = '$novaSenha' WHERE email = '$email'";
        //echo $sql;
        //Executando o comando sql
        if($conn -> query($sql) === TRUE ){
            $_SESSION['senha'] = $novaSenha;
            ?>
                <script>
                    //alert("Senha alterada com sucesso");
                    window.location = "../tela_listar/usuario.php?resposta=1";
                </script>
            <?php
        }
        else{
            ?>
            <script>
                window.location = "../tela_listar/usuario.php?resposta=3";
            </script>
            
            <?php
        }
    }
    else{
        ?>
        <script>
            //alert("Senha atual incorreta");
            window.location = "../tela_listar/usuario.php?resposta=2";
            //window.history.back();
        </script>
        <?php
    }


    function criptografarSenha($senhaParaCriptografar){
        $caracteresASC  = array();
        $caracteresASC[0] = " ";
        for($i = 33; $i<=126; $i++){
            $caracteresASC[($i-33)+1] = chr($i);
        }
    
        $textoParaCodificar = $senhaParaCriptografar;
        $caracteres = str_split($textoParaCodificar);
    
        $posicoes = array();
        for($i=0; $i<count($caracteres); $i++){
            //Buscar posição do caracter no caracteresASC
            for($x = 0; $x < count($caracteresASC); $x++){
                if($caracteres[$i] == $caracteresASC[$x]){
                    array_push($posicoes, $x);
                    $x = count($caracteresASC);
                }
            }
        }
    
        //Codificar
        for($i=0; $i<count($caracteres); $i++){
            //Caso a posição do caracter supere o tamanho do vetor de caracteresASC, devemos voltar para o inicio dele e somar com o resto
            if( ($posicoes[$i]+13) > count($caracteresASC)){
                $posicoes[$i] = ($posicoes[$i]+13)-count($caracteresASC);
            }
            else{
                $posicoes[$i] += 13;
            }
            $caracteres[$i] = $caracteresASC[$posicoes[$i]];
        }
    
        //Juntando todos os caracteres em uma única String
        $senha = "";
        for($i=0; $i<count($caracteres); $i++){
            $senha .= $caracteres[$i];
        }
        return $senha;
    }
  


?>