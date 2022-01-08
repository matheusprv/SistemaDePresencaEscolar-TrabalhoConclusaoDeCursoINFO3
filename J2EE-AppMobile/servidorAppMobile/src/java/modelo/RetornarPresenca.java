/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package modelo;

/**
 *
 * @author Matheus Peixoto e Pedro Arthur
 */
public class RetornarPresenca {
    
    int IdDisciplina;
    String nomeDisciplina;
    int numeroPresenca;

    public RetornarPresenca(int IdDisciplina, String nomeDisciplina, int numeroPresenca) {
        this.IdDisciplina = IdDisciplina;
        this.nomeDisciplina = nomeDisciplina;
        this.numeroPresenca = numeroPresenca;
    }

    public int getIdDisciplina() {
        return IdDisciplina;
    }

    public void setIdDisciplina(int IdDisciplina) {
        this.IdDisciplina = IdDisciplina;
    }

    public String getNomeDisciplina() {
        return nomeDisciplina;
    }

    public void setNomeDisciplina(String nomeDisciplina) {
        this.nomeDisciplina = nomeDisciplina;
    }

    public int getNumeroPresenca() {
        return numeroPresenca;
    }

    public void setNumeroPresenca(int numeroPresenca) {
        this.numeroPresenca = numeroPresenca;
    }

    @Override
    public String toString() {
        return "RetornarPresenca{" + "IdDisciplina=" + IdDisciplina + ", nomeDisciplina=" + nomeDisciplina + ", numeroPresenca=" + numeroPresenca + '}';
    }
    
    

}
