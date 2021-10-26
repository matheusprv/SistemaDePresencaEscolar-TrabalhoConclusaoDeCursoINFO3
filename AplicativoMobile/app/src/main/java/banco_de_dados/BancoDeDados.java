package banco_de_dados;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteException;
import android.database.sqlite.SQLiteOpenHelper;

import java.util.Date;

import objetos.Usuario;

public class BancoDeDados extends SQLiteOpenHelper {

    private Context contexto;

    public BancoDeDados(Context cont){
        super(cont, "responsavelAluno", null, 1);
        contexto = cont;
    }

    @Override
    public void onCreate(SQLiteDatabase db) {
        final String criaTabelaResponsavel = "CREATE TABLE IF NOT EXISTS Responsavel(id INTEGER PRIMARY KEY AUTOINCREMENT, nome TEXT," +
                "email TEXT, senha TEXT)";
        db.execSQL(criaTabelaResponsavel);
/*
        final String criaTabelaAluno = "CREATE TABLE IF NOT EXISTS Aluno (matricula INTEGER PRIMARY KEY AUTOINCREMENT, nome TEXT," +
                "senha TEXT, FOREIGN KEY (Responsavel_id) REFERENCES Responsavel(id))";
        db.execSQL(criaTabelaAluno);*/
    }

    public void insereResponsavel(){

        try{
            SQLiteDatabase db = this.getWritableDatabase();

            ContentValues valores = new ContentValues();

            valores.put("nome", "Matheus");
            valores.put("email", "matheus@email.com");
            valores.put("senha", "123");

            db.insert("Responsavel", null, valores);

        }catch(SQLiteException ex){
            ex.printStackTrace();
        }

    }

    public void insereAluno(){
        try{
            SQLiteDatabase db = this.getWritableDatabase();

            ContentValues valores = new ContentValues();

            valores.put("nome", "Pedro");
            valores.put("Responsavel_id", "1");
            valores.put("senha", "123");

            db.insert("Aluno", null, valores);

        }catch(SQLiteException ex){
            ex.printStackTrace();
        }
    }


    public Usuario pesquisarResponsavel(String email, String senha){
        //System.out.println("Email: "+email+"  Senha: "+senha+" asadbajdsha");
        String sql = "SELECT * FROM Responsavel WHERE email = '"+email+"' AND senha = '"+senha+"'";

        Usuario usuario = null;

        try(SQLiteDatabase db = this.getReadableDatabase()) {
            Cursor tuplas = db.rawQuery(sql, null);
            if(tuplas.moveToFirst()){

                String nome = tuplas.getString(1);
                String emailUsuario = tuplas.getString(2);
                String senhaUsuario = tuplas.getString(3);

                usuario = new Usuario(nome,emailUsuario, senhaUsuario, false);
            }

        }catch(Exception ex){
            System.err.println("Erro na consulta SQL da busca de evento por id");
            ex.printStackTrace();
        }

        return usuario;
    }

    public Usuario pesquisarAluno(String matricula, String senha){
        String sql = "SELECT * FROM Aluno WHERE matricula = "+matricula+" AND senha = "+senha;

        Usuario usuario = null;

        try(SQLiteDatabase db = this.getWritableDatabase()) {
            Cursor tuplas = db.rawQuery(sql, null);
            if(tuplas.moveToFirst()){

                String nome = tuplas.getString(1);
                String senhaUsuario = tuplas.getString(2);

                usuario = new Usuario(nome,matricula, senhaUsuario, true);
            }

        }catch(Exception ex){
            System.err.println("Erro na consulta SQL da busca de evento por id");
            ex.printStackTrace();
        }

        return usuario;
    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {

    }
}
