
<?php
    
    //Exibir mensagem de erro ou sucesso da inserção de um aluno
    if(isset($_GET["resposta"])){
        echo '<body onload="esconderResposta()"> ';
        $resposta = $_GET["resposta"];
        /*
          AÇÃO      SUCESSO   INSUCESSO
        Inserção       1          2
        Atualização    3          4
        Deletar        5          6 

        */
        if($resposta==1){
            ?>
                <br>
                <div class="respostaAdicionar" name="adicionadoSucesso" id="adicionadoSucesso" style="background-color: #d7f8dc; padding: 15px;" >
                    <div style="margin-bottom: 0px; font-weight: bold; text-align: center;">Adição de dados bem sucedida</div>
                </div>
            <?php
        }
        else if($resposta==2){
            ?>
                <br>
                <div class="respostaAdicionar" name="adicionadoErro" id="adicionadoErro" style="background-color: #f8d7da; padding: 15px;" >
                    <div style="margin-bottom: 0px; font-weight: bold; text-align: center;">Erro ao adicionar dados</div>
                    Verifique os dados e tente novamente mais tarde<br>
                </div>
            <?php
        }
        else if($resposta==3){
            ?>
                <br>
                <div class="respostaAdicionar" name="adicionadoSucesso" id="adicionadoSucesso" style="background-color: #d7f8dc; padding: 15px;" >
                    <div style="margin-bottom: 0px; font-weight: bold;">Atualização de dados bem sucedida</div>
                </div>
            <?php
        }
        else if($resposta==4){
            ?>
                <br>
                <div class="respostaAdicionar" name="adicionadoErro" id="adicionadoErro" style="background-color: #f8d7da; padding: 15px;" >
                    <div style="margin-bottom: 10px; font-weight: bold;">Erro ao atualizar dados</div>
                    Verifique os dados e tente novamente mais tarde<br>
                </div>
            <?php
        }
        else if($resposta==5){
            ?>
                <br>
                <div class="respostaAdicionar" name="adicionadoSucesso" id="adicionadoSucesso" style="background-color: #d7f8dc; padding: 15px;" >
                    <div style="margin-bottom: 0px; font-weight: bold;">Remoção de dados bem sucedida</div>
                </div>
            <?php
        }
        else if($resposta==6){
            ?>
                <br>
                <div class="respostaAdicionar" name="adicionadoErro" id="adicionadoErro" style="background-color: #f8d7da; padding: 15px;" >
                    <div style="margin-bottom: 10px; font-weight: bold;">Erro ao remover dados</div>
                    Verifique se os dados a serem deletados não estão sendo usados em outras áreas do programa<br>
                </div>
            <?php
        }
        else if($resposta==7){
            ?>
                <br>
                <div class="respostaAdicionar" name="adicionadoErro" id="adicionadoErro" style="background-color: #f8d7da; padding: 15px;" >
                    <div style="margin-bottom: 10px; font-weight: bold;">Erro ao enviar email</div>
                    Remova os dados do usuário cadastrado e tente novamente<br>
                </div>
            <?php
        }
        ?>
        <script>
                //Esconder a mensagem que diz se o aluno foi adicionado com sucesso ou se teve algum erro
                function esconderResposta(){
                    let esconder;
                    <?php
                        if($resposta == 1 || $resposta == 3 || $resposta == 5){
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
        echo '</body>';
    }

?>





