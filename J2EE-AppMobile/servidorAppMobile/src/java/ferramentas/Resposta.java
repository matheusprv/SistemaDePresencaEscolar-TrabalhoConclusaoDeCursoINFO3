/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package ferramentas;

import com.fasterxml.jackson.core.JsonProcessingException;
import com.fasterxml.jackson.databind.ObjectMapper;

/**
 *
 * @author Matheus Peixoto e Pedro Arthur
 */
public class Resposta {
    private int cod;
    private Object informacao;

    public Resposta(int cod, Object informacao) {
        this.cod = cod;
        this.informacao = informacao;
    }

    public int getCod() {
        return cod;
    }

    public void setCod(int cod) {
        this.cod = cod;
    }

    public Object getInformacao() {
        return informacao;
    }

    public void setInformacao(Object informacao) {
        this.informacao = informacao;
    }
    
    public String toString(){
        ObjectMapper mascara = new ObjectMapper();
        
        try{
            return mascara.writeValueAsString(this);
        }catch(JsonProcessingException ex){
            System.out.println("Erro do JSON");
            ex.printStackTrace();
            return "{\"cod\":500, \"informacao\":\"erro no JSON\" }";
        }
    }
}
