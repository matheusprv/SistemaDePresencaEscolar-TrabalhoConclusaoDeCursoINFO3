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

    @Override
    public String toString() {
        return "Usuario{" +
                "nome='" + nome + '\'' +
                ", emailMatricula='" + emailMatricula + '\'' +
                ", senha='" + senha + '\'' +
                ", aluno=" + aluno +
                '}';
    }
}
