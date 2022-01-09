<?php
    //Criptografar senhas com base no sistema ROT13

    $caracteresASC  = array();
    $caracteresASC[0] = " ";
    for($i = 33; $i<=126; $i++){
        $caracteresASC[($i-33)+1] = chr($i);
    }

    $textoParaCodificar = $senha;
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
?>