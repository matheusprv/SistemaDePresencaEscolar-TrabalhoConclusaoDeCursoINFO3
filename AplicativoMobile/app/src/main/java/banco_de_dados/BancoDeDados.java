package banco_de_dados;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteException;
import android.database.sqlite.SQLiteOpenHelper;

import java.util.ArrayList;

import objetos.ResponsavelAluno;

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


        final String criaTabelaAluno = "CREATE TABLE IF NOT EXISTS Aluno (matricula INTEGER PRIMARY KEY AUTOINCREMENT, nome TEXT," +
                "senha TEXT, Responsavel_id INTEGER, FOREIGN KEY (Responsavel_id) REFERENCES Responsavel(id))";
        db.execSQL(criaTabelaAluno);


    }

    //Dados ficticios para responsavel
    public void insereResponsavel(){

        try{
            SQLiteDatabase db = this.getWritableDatabase();

            ContentValues valores = new ContentValues();
            valores.put("nome", "Matheus");
            valores.put("email", "matheus@email.com");
            valores.put("senha", "123");
            db.insert("Responsavel", null, valores);

            valores = new ContentValues();
            valores.put("nome", "Pedro");
            valores.put("email", "pedro@email.com");
            valores.put("senha", "123");
            db.insert("Responsavel", null, valores);

        }catch(SQLiteException ex){
            ex.printStackTrace();
        }

    }
    //Dados ficticios para aluno
    public void insereAluno(){
        try{
            SQLiteDatabase db = this.getWritableDatabase();

            ContentValues valores = new ContentValues();
            valores.put("nome", "Pedro");
            valores.put("Responsavel_id", "1");
            valores.put("senha", "123");
            db.insert("Aluno", null, valores);

            valores = new ContentValues();
            valores.put("nome", "Matheus");
            valores.put("Responsavel_id", "1");
            valores.put("senha", "123");
            db.insert("Aluno", null, valores);

            valores = new ContentValues();
            valores.put("nome", "João");
            valores.put("Responsavel_id", "2");
            valores.put("senha", "123");
            db.insert("Aluno", null, valores);

        }catch(SQLiteException ex){
            ex.printStackTrace();
        }
    }

    //Pesquisa no banco de dados informações para Login de um responsavel
    public ResponsavelAluno pesquisarResponsavelLogin(String email, String senha){
        String sql = "SELECT * FROM Responsavel WHERE email = '"+email+"' AND senha = '"+senha+"'";

        ResponsavelAluno usuario = null;

        try(SQLiteDatabase db = this.getReadableDatabase()) {
            Cursor tuplas = db.rawQuery(sql, null);
            if(tuplas.moveToFirst()){

                int id = tuplas.getInt(0);
                String nome = tuplas.getString(1);
                String emailUsuario = tuplas.getString(2);
                String senhaUsuario = tuplas.getString(3);

                usuario = new ResponsavelAluno(nome,emailUsuario, senhaUsuario, false, id);
            }

        }catch(Exception ex){
            System.err.println("Erro na consulta SQL da busca de evento por id");
            ex.printStackTrace();
        }

        return usuario;
    }
    //Pesquisa no banco de dados informações para Login de um aluno
    public ResponsavelAluno pesquisarAlunoLogin(String matricula, String senha){
        String sql = "SELECT * FROM Aluno WHERE matricula = "+matricula+" AND senha = "+senha;

        ResponsavelAluno usuario = null;

        try(SQLiteDatabase db = this.getWritableDatabase()) {
            Cursor tuplas = db.rawQuery(sql, null);
            if(tuplas.moveToFirst()){

                String nome = tuplas.getString(1);
                String senhaUsuario = tuplas.getString(2);

                usuario = new ResponsavelAluno(nome,matricula, senhaUsuario, true, Integer.parseInt(matricula));
            }

        }catch(Exception ex){
            System.err.println("Erro na consulta SQL da busca de evento por id");
            ex.printStackTrace();
        }

        return usuario;
    }

    //Pesquisa no banco de dados alunos relacionados ao responsavel
    public ArrayList<ResponsavelAluno> alunosDoResponsvel(int idResponsavel){
        ArrayList<ResponsavelAluno> resultados = new ArrayList<>();

        String sql = "SELECT * FROM Aluno WHERE Responsavel_id ="+idResponsavel;

        try(SQLiteDatabase db = this.getWritableDatabase()) {
            Cursor tuplas = db.rawQuery(sql, null);
            if(tuplas.moveToFirst()){
                do{
                    int matricula = tuplas.getInt(0);
                    String nome = tuplas.getString(1);
                    String senhaUsuario = tuplas.getString(2);

                    ResponsavelAluno temporario = new ResponsavelAluno(nome,matricula+"", senhaUsuario, true, matricula);
                    resultados.add(temporario);

                }while(tuplas.moveToNext());
            }

        }catch (SQLiteException e){
            System.err.println("Ocorreu um erro");
            e.printStackTrace();
        }

        return resultados;
    }

    //Altera a senha do responsavel conectado
    public void updateSenhaResponsavel(int id, String senha){
        try(SQLiteDatabase db = this.getWritableDatabase()){

            ContentValues valores = new ContentValues();
            valores.put("senha", senha);

            db.update("Responsavel", valores, "id = ?", new String []{id + ""});

        }catch (SQLiteException ex){
            System.err.println("Erro na atualização");
            ex.printStackTrace();
        }
    }
    //Altera a senha do aluno  conectado
    public void updateSenhaAluno(String matricula, String senha){
        try(SQLiteDatabase db = this.getWritableDatabase()){

            //String sql = "UPDATE Aluno SET senha = "+ senha+" WHERE matricula = "+ matricula;
            //db.execSQL(sql);

            ContentValues valores = new ContentValues();
            valores.put("senha", senha);

            db.update("Aluno", valores, "matricula = ?", new String []{matricula + ""});


        }catch (SQLiteException ex){
            System.err.println("Erro na atualização");
            ex.printStackTrace();
        }
    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {

    }
}
