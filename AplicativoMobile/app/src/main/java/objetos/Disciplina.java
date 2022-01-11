package objetos;

public class Disciplina {
    private String nome;
    private int faltas, idDisciplina, matricula;

    public Disciplina(String nome, int faltas, int idDisciplina, int matricula) {
        this.nome = nome;
        this.faltas = faltas;
        this.idDisciplina = idDisciplina;
        this.matricula = matricula;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }

    public void setFaltas(int faltas) {
        this.faltas = faltas;
    }

    public void setIdDisciplina(int idDisciplina) {
        this.idDisciplina = idDisciplina;
    }

    public void setMatricula(int matricula) {
        this.matricula = matricula;
    }

    public String getNome() {
        return nome;
    }

    public int getFaltas() {
        return faltas;
    }

    public int getIdDisciplina() {
        return idDisciplina;
    }

    public int getMatricula() {
        return matricula;
    }

    @Override
    public String toString() {
        return "Disciplina{" +
                "nome='" + nome + '\'' +
                ", faltas=" + faltas +
                ", idDisciplina=" + idDisciplina +
                ", matricula=" + matricula +
                '}';
    }
}


