/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package modelo;

/**
 *
 * @author Matheus Peixoto e Pedro Arthur
 */
public class Aula {
    private int idAula, diaSemana, idDisciplina, idTurma;
    private String horasInicio, horaFim, nomeDisciplina;

    

    public Aula(int idAula, int diaSemana, int idDisciplina, int idTurma, String horasInicio, String horaFim) {
        this.idAula = idAula;
        this.diaSemana = diaSemana;
        this.idDisciplina = idDisciplina;
        this.idTurma = idTurma;
        this.horasInicio = horasInicio;
        this.horaFim = horaFim;
    }

    public int getIdAula() {
        return idAula;
    }

    public void setIdAula(int idAula) {
        this.idAula = idAula;
    }

    public int getDiaSemana() {
        return diaSemana;
    }

    public String getNomeDisciplina() {
        return nomeDisciplina;
    }

    public void setNomeDisciplina(String nomeDisciplina) {
        this.nomeDisciplina = nomeDisciplina;
    }
    
    public void setDiaSemana(int diaSemana) {
        this.diaSemana = diaSemana;
    }

    public int getIdDisciplina() {
        return idDisciplina;
    }

    public void setIdDisciplina(int idDisciplina) {
        this.idDisciplina = idDisciplina;
    }

    public int getIdTurma() {
        return idTurma;
    }

    public void setIdTurma(int idTurma) {
        this.idTurma = idTurma;
    }

    public String getHorasInicio() {
        return horasInicio;
    }

    public void setHorasInicio(String horasInicio) {
        this.horasInicio = horasInicio;
    }

    public String getHoraFim() {
        return horaFim;
    }

    public void setHoraFim(String horaFim) {
        this.horaFim = horaFim;
    }

    @Override
    public String toString() {
        return "Aula{" + "idAula=" + idAula + ", diaSemana=" + diaSemana + ", idDisciplina=" + idDisciplina + ", idTurma=" + idTurma + ", horasInicio=" + horasInicio + ", horaFim=" + horaFim + ", nomeDisciplina=" + nomeDisciplina + '}';
    }

    
    
}
