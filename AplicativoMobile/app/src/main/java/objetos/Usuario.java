
package objetos;

import android.os.Parcel;
import android.os.Parcelable;

import java.io.Serializable;
import java.util.ArrayList;

public class Usuario implements  Parcelable{
    private String nome, emailMatricula, nomeTurma;
    private boolean aluno;
    private int id, idTurma;
    public static ArrayList<AlunosDoResponsavel> alunos;
    //Id turma será 0 caso o usuário é um responsável

    public Usuario(String nome, String emailMatricula, String nomeTurma,boolean aluno, int id, int idTurma) {
        this.nome = nome;
        this.emailMatricula = emailMatricula;
        this.nomeTurma = nomeTurma;
        this.aluno = aluno;
        this.id = id;

        if (aluno){
            this.idTurma=idTurma;
        }
        else{
            this.idTurma=0;
        }
        //System.out.println("TURMA: "+this.idTurma+" ALUNO: "+aluno);
    }


    protected Usuario(Parcel in) {
        nome = in.readString();
        emailMatricula = in.readString();
        nomeTurma = in.readString();
        aluno = in.readByte() != 0;
        id = in.readInt();
        idTurma = in.readInt();
    }

    public static final Creator<Usuario> CREATOR = new Creator<Usuario>() {
        @Override
        public Usuario createFromParcel(Parcel in) {
            return new Usuario(in);
        }

        @Override
        public Usuario[] newArray(int size) {
            return new Usuario[size];
        }
    };

    public String getNome() {
        return nome;
    }
    public String getEmailMatricula() {
        return emailMatricula;
    }
    public boolean isAluno() {
        return aluno;
    }
    public int getId() {
        return id;
    }
    public int getIdTurma() { return idTurma; }
    public String getNomeTurma() { return nomeTurma; }

    public static ArrayList<AlunosDoResponsavel> getAlunos() {
        return alunos;
    }

    @Override
    public String toString() {
        return "Usuario{" +
                "nome='" + nome + '\'' +
                ", emailMatricula='" + emailMatricula + '\'' +
                ", aluno=" + aluno +
                '}';
    }


    @Override
    public int describeContents() {
        return 0;
    }

    @Override
    public void writeToParcel(Parcel dest, int flags) {
        dest.writeString(nome);
        dest.writeString(emailMatricula);
        dest.writeString(nomeTurma);
        dest.writeByte((byte) (aluno ? 1 : 0));
        dest.writeInt(id);
        dest.writeInt(idTurma);
    }
}

