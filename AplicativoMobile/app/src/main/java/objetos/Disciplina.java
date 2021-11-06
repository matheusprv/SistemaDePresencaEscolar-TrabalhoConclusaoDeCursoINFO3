package objetos;

public class Disciplina {
    private String nome;
    private int faltas, idDisciplina;

    public Disciplina(int idDisciplina, String nome, int faltas) {
        this.idDisciplina = idDisciplina;
        this.nome = nome;
        this.faltas = faltas;
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

    public void setNome(String nome) {
        this.nome = nome;
    }

    public void setFaltas(int faltas) {
        this.faltas = faltas;
    }
}


