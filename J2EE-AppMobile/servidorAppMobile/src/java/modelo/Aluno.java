/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package modelo;

/**
 *
 * @author Matheus Peixoto e Pedro Arthur
 */
public class Aluno {
    private String nome, nomeTurma;
    private int turma, matricula;

    public Aluno(String nome, int turma, int matricula, String nomeTurma) {
        this.nome = nome;
        this.turma = turma;
        this.matricula = matricula;
        this.nomeTurma = nomeTurma;
    }

    public String getNome() {
        return nome;
    }

    public int getTurma() {
        return turma;
    }

    public int getMatricula() {
        return matricula;
    }

    public String getNomeTurma() {
        return nomeTurma;
    }

    @Override
    public String toString() {
        return "Aluno{" + "nome=" + nome + ", nomeTurma=" + nomeTurma + ", turma=" + turma + ", matricula=" + matricula + '}';
    }
    
    
    
}
