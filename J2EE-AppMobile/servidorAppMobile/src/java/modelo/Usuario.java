/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package modelo;

/**
 *
 * @author Matheus Peixoto e Pedro Arthur
 */
public class Usuario {
    private String nome, emailMatricula, nomeTurma;
    private boolean aluno;
    private int id, idTurma, senhaAlterada;

    public Usuario(String nome, String emailMatricula, String nomeTurma, boolean aluno, int id, int idTurma, int senhaAlterada) {
        this.nome = nome;
        this.emailMatricula = emailMatricula;
        this.nomeTurma = nomeTurma;
        this.aluno = aluno;
        this.id = id;
        this.idTurma = idTurma;
        this.senhaAlterada = senhaAlterada;
    }

    public String getNome() {
        return nome;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }

    public String getEmailMatricula() {
        return emailMatricula;
    }

    public void setEmailMatricula(String emailMatricula) {
        this.emailMatricula = emailMatricula;
    }

    public String getNomeTurma() {
        return nomeTurma;
    }

    public void setNomeTurma(String nomeTurma) {
        this.nomeTurma = nomeTurma;
    }

    public boolean isAluno() {
        return aluno;
    }

    public void setAluno(boolean aluno) {
        this.aluno = aluno;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public int getIdTurma() {
        return idTurma;
    }

    public void setIdTurma(int idTurma) {
        this.idTurma = idTurma;
    }

    public int getSenhaAlterada() {
        return senhaAlterada;
    }

    public void setSenhaAlterada(int senhaAlterada) {
        this.senhaAlterada = senhaAlterada;
    }



    
    
    
    
    
    
}
