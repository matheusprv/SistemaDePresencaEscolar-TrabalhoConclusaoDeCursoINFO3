/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package ferramentas;

/**
 *
 * @author Matheus Peixoto e Pedro Arthur
 */
public class CriptografarSenha {
    public static String criptografar(String senha){
        char caracteresASC [] = new char [126-31];
        caracteresASC[0] = ' '; //Espaço
        for(int i=33; i<=126; i++){
            //Caracteres ASCII:   ! " # $ % & ' ( ) * + , - . / 0 1 2 3 4 5 6 7 8 9 : ; < = > ? @ A B C D E F G H I J K L M N O P Q R S T U V W X Y Z [ \ ] ^ _ ` a b c d e f g h i j k l m n o p q r s t u v w x y z { | }
            caracteresASC[(i-33)+1] = (char) i;
        }
        char caracteres[] = senha.toCharArray();
        int posicoes [] = new int [caracteres.length]; //Posição de cada caracter na tabela ASCII
        for(int i=0; i < caracteres.length; i++){
            //Buscar posição do caracter no caracteresASC
            for(int x=0; x<caracteresASC.length; x++){
                if(caracteres[i] == caracteresASC[x]){
                    posicoes[i] = x;
                    x = caracteresASC.length;
                }
            }
        }
        
        //Codificar
        for(int i=0; i<caracteres.length; i++){
            //Caso a posição do caracter supere o tamanho do vetor de caracteresASC, devemos voltar para o inicio dele e somar com o resto
            if( (posicoes[i]+13) > caracteresASC.length){
                posicoes[i] = (posicoes[i]+13)-caracteresASC.length;
            }
            else{
                posicoes[i] += 13;
            }
            caracteres[i] = caracteresASC[posicoes[i]];
        }
        
        //Juntando todos os caracteres em uma única String
        String senhaFinal = "";
        for(int i=0; i<caracteres.length; i++){
            senhaFinal += caracteres[i];
        }
        return senhaFinal;
    }
}
