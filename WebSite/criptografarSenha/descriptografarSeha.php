<?php

    $caracteresASC  = array();
    $caracteresASC[0] = " ";
    for($i = 33; $i<=126; $i++){
        $caracteresASC[($i-33)+1] = chr($i);
    }

    //Decodificar
    $caracteresDecodificar = str_split($senha);
    $posicaoDecodificar = array();
    for($i=0; $i < count($caracteresDecodificar); $i++){
        //Buscar posição do caracter no caracteresASC
        for($x=0; $x<count($caracteresASC); $x++){
            if($caracteresDecodificar[$i] == $caracteresASC[$x]){
                $posicaoDecodificar[$i] = $x;
                $x = count($caracteresASC);
            }
        }
    }
                    
    for($i=0; $i<count($caracteresDecodificar); $i++){
        //Caso a posição do caractere seja menor do que zero, deve-se ir até o final do array e começar a contar novamente ao contrário
        if( ($posicaoDecodificar[$i]-13) < 0){
            $posicaoDecodificar[$i] = ($posicaoDecodificar[$i]-13)+count($caracteresASC);
        }
        else{
            $posicaoDecodificar[$i] -= 13;
        }
        $caracteresDecodificar[$i] = $caracteresASC[$posicaoDecodificar[$i]];
    }
    
    $textoFinalDecodificado = "";
    for($i=0; $i<count($caracteresDecodificar); $i++){
        $textoFinalDecodificado .= $caracteresDecodificar[$i];
    }
    $senhaEnviar = $textoFinalDecodificado;


?>