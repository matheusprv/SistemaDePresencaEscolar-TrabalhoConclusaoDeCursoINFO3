package objetos;

public class Usuario  {
    private String nome, emailMatricula, senha;
    private boolean aluno;

    public Usuario(String nome, String emailMatricula, String senha, boolean aluno) {
        this.nome = nome;
        this.emailMatricula = emailMatricula;
        this.senha = senha;
        this.aluno = aluno;
    }

}
