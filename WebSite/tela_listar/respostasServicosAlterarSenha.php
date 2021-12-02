<body onload="esconderResposta()"> 
<?php

    //Exibir mensagem de erro ou sucesso da inserção de um aluno
    if(isset($_GET["resposta"])){
        $resposta = $_GET["resposta"];

        if($resposta==1){
            ?>
                <div class="respostaAdicionar" name="adicionadoSucesso" id="adicionadoSucesso" style="background-color: #d7f8dc; padding: 15px; text-align: center;" >
                    <div style="margin-bottom: 0px; font-weight: bold;">Senha alterada com sucesso</div>
                </div>
            <?php
        }
        else if($resposta==2){
            ?>
                <div class="respostaAdicionar" name="adicionadoErro" id="adicionadoErro" style="background-color: #f8d7da; padding: 15px; text-align: center;" >
                    <div style="margin-bottom: 0px; font-weight: bold;">Senha atual incorreta</div>
                </div>
            <?php
        }
        else if($resposta==3){
            ?>
                <div class="respostaAdicionar" name="adicionadoErro" id="adicionadoErro" style="background-color: #f8d7da; padding: 15px; text-align: center;" >
                    <div style="margin-bottom: 10px; font-weight: bold;">Erro ao atualizar dados</div>
                    Verifique os dados e tente novamente mais tarde<br>
                </div>
            <?php
        }
        
        ?>
        <script>
                //Esconder a mensagem que diz se o aluno foi adicionado com sucesso ou se teve algum erro
                function esconderResposta(){
                    let esconder;
                    <?php
                        if($resposta == 1){
                            ?>
                                esconder = document.getElementById("adicionadoSucesso");
                            <?php
                        }
                        else{
                            ?>
                                esconder = document.getElementById("adicionadoErro");
                            <?php
                        }
                    ?>
                    setTimeout(function () {
                        esconder.style.display = "none";
                    }, 10000);
                                   
                }
            </script>
        <?php
    }

?>

</body>



