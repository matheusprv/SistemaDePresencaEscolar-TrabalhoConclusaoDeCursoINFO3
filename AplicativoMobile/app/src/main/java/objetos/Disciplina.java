package objetos;

public class Disciplina {
    private String nome;
    private int faltas;

    public Disciplina(String nome, int faltas) {
        this.nome = nome;
        this.faltas = faltas;
    }

    public String getNome() {
        return nome;
    }

    public int getFaltas() {
        return faltas;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }

    public void setFaltas(int faltas) {
        this.faltas = faltas;
    }
}
