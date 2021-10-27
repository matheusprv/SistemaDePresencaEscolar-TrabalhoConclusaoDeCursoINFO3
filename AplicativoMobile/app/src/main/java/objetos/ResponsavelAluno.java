package objetos;

import android.os.Parcel;
import android.os.Parcelable;

import java.io.Serializable;

public class ResponsavelAluno implements  Parcelable{
    private String nome, emailMatricula, senha;
    private boolean aluno;
    private int id;

    public ResponsavelAluno(String nome, String emailMatricula, String senha, boolean aluno, int id) {
        this.nome = nome;
        this.emailMatricula = emailMatricula;
        this.senha = senha;
        this.aluno = aluno;
        this.id = id;
    }


    protected ResponsavelAluno(Parcel in) {
        nome = in.readString();
        emailMatricula = in.readString();
        senha = in.readString();
        aluno = in.readByte() != 0;
        id = in.readInt();
    }

    public static final Creator<ResponsavelAluno> CREATOR = new Creator<ResponsavelAluno>() {
        @Override
        public ResponsavelAluno createFromParcel(Parcel in) {
            return new ResponsavelAluno(in);
        }

        @Override
        public ResponsavelAluno[] newArray(int size) {
            return new ResponsavelAluno[size];
        }
    };

    public String getNome() {
        return nome;
    }
    public String getEmailMatricula() {
        return emailMatricula;
    }
    public String getSenha() {
        return senha;
    }
    public boolean isAluno() {
        return aluno;
    }
    public int getId() {
        return id;
    }

    public void setSenha(String senha) {
        this.senha = senha;
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


    @Override
    public int describeContents() {
        return 0;
    }

    @Override
    public void writeToParcel(Parcel dest, int flags) {
        dest.writeString(nome);
        dest.writeString(emailMatricula);
        dest.writeString(senha);
        dest.writeByte((byte) (aluno ? 1 : 0));
        dest.writeInt(id);
    }
}
