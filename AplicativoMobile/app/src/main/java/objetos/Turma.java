package objetos;

public class Turma {
    private int id, ano;
    private String nome;

    public Turma(int id, int ano, String nome) {
        this.id = id;
        this.ano = ano;
        this.nome = nome;
    }

    public int getId() {
        return id;
    }

    public int getAno() {
        return ano;
    }

    public String getNome() {
        return nome;
    }
}
