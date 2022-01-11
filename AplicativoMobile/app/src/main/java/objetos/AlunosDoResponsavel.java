package objetos;

public class AlunosDoResponsavel {
    private String nome, nomeTurma;
    private int matricula, idTurma;

    public AlunosDoResponsavel(String nome, String nomeTurma, int matricula, int idTurma) {
        this.nome = nome;
        this.nomeTurma = nomeTurma;
        this.matricula = matricula;
        this.idTurma = idTurma;
    }

    public String getNome() {
        return nome;
    }

    public String getNomeTurma() {
        return nomeTurma;
    }

    public int getMatricula() {
        return matricula;
    }

    public int getIdTurma() {
        return idTurma;
    }

    @Override
    public String toString() {
        return "AlunosDoResponsavel{" +
                "nome='" + nome + '\'' +
                ", nomeTurma='" + nomeTurma + '\'' +
                ", matricula=" + matricula +
                ", idTurma=" + idTurma +
                '}';
    }
}
