package banco_de_dados;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteException;
import android.database.sqlite.SQLiteOpenHelper;

import java.util.ArrayList;
import java.util.Random;

import objetos.Aula;
import objetos.Disciplina;
import objetos.Usuario;
import objetos.Turma;

public class BancoDeDados extends SQLiteOpenHelper {

    private Context contexto;

    public BancoDeDados(Context cont){
        super(cont, "responsavelAluno", null, 1);
        contexto = cont;
    }

    @Override
    public void onCreate(SQLiteDatabase db) {
        final String criarTabelaTurma = "CREATE TABLE IF NOT EXISTS Turma(idTurma INTEGER PRIMARY KEY AUTOINCREMENT, nome TEXT, ano INTEGER)";
        db.execSQL(criarTabelaTurma);

        final String criarTabelaDisciplina = "CREATE TABLE IF NOT EXISTS Disciplina(idDisciplina INTEGER PRIMARY KEY AUTOINCREMENT, nome TEXT, professor TEXT, numeroAulas INTEGER)";
        db.execSQL(criarTabelaDisciplina);

        final String criarTabelaAula = "CREATE TABLE IF NOT EXISTS Aula(idAula INTEGER PRIMARY KEY AUTOINCREMENT, horasInicio TEXT, horaFim TEXT, diaSemana INTEGER, idDisciplina INTEGER, idTurma INTEGER, " +
                "FOREIGN KEY (idDisciplina) REFERENCES Disciplina(idDisciplina), FOREIGN KEY (idTurma) REFERENCES Turma(idTurma))";
        db.execSQL(criarTabelaAula);

        final String criaTabelaResponsavel = "CREATE TABLE IF NOT EXISTS Responsavel(id INTEGER PRIMARY KEY AUTOINCREMENT, nome TEXT," +
                "email TEXT, senha TEXT)";
        db.execSQL(criaTabelaResponsavel);


        final String criaTabelaAluno = "CREATE TABLE IF NOT EXISTS Aluno (matricula INTEGER PRIMARY KEY AUTOINCREMENT, nome TEXT," +
                "senha TEXT, Responsavel_id INTEGER, idTurma INTEGER, FOREIGN KEY (Responsavel_id) REFERENCES Responsavel(id), FOREIGN KEY (idTurma) REFERENCES Turma(idTurma))";
        db.execSQL(criaTabelaAluno);


    }

    public void insereTurma(){
        String turmas[] = {"6 Ano", "7 Ano", "8 Ano", "9 Ano", "1 Ano EM", "2 Ano EM", "3 Ano EM"};
        try{
            SQLiteDatabase db = this.getWritableDatabase();
            for(int i=0; i< turmas.length; i++){
                ContentValues valores = new ContentValues();
                valores.put("nome", turmas[i]);
                valores.put("ano", 2021);
                db.insert("Turma", null, valores);
            }
        }catch(SQLiteException ex){
            ex.printStackTrace();
        }
    }

    public void insereDisciplina(){
        String disciplina[] = {"Biologia", "Ed Física", "Filosofia", "Física", "Geografia", "História", "Inglês", "Matemática", "Português"};
        String professor[] = {"Lenadro", "Marie", "Aurélio", "Toninho", "Letícia", "Rodolpho", "Mônica", "Alexandre", "Ana Paula"};
        try{
            SQLiteDatabase db = this.getWritableDatabase();
            for(int i=0; i< disciplina.length; i++){
                ContentValues valores = new ContentValues();
                valores.put("nome", disciplina[i]);
                valores.put("professor", professor[i]);
                valores.put("numeroAulas", 100);
                db.insert("Disciplina", null, valores);
            }
        }catch(SQLiteException ex){
            ex.printStackTrace();
        }
    }

    public void inserirHorarioAula(){

        int idDisciplina[] = {1, 2, 3, 4, 5, 6, 7, 8, 9};
        int idTurma=1;
        String horarioInicio[] = {"7:00", "7:50", "8:40", "9:50", "10:40"};
        String horarioFim[] = {"7:50", "8:40", "9:30", "10:40", "11:30"};

        try{
            SQLiteDatabase db = this.getWritableDatabase();
            Random aleatorio = new Random();

            for(int turma=1; turma<=2; turma++){
                int disciplinaAleatoria;
                for (int i=0;i<5;i++) {
                    for (int x = 0; x < 5; x++) {
                        do{
                            disciplinaAleatoria = aleatorio.nextInt(9);
                        }while(disciplinaAleatoria==0);
                        ContentValues valores = new ContentValues();
                        valores.put("idDisciplina", idDisciplina[disciplinaAleatoria]);
                        valores.put("horasInicio", horarioInicio[x]);
                        valores.put("horaFim", horarioFim[x]);
                        valores.put("diaSemana", i+1);
                        valores.put("horaFim", 1);
                        valores.put("idTurma", turma);
                        db.insert("Aula", null, valores);
                    }
                }
            }
        }catch(SQLiteException ex){
            ex.printStackTrace();
        }

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
            valores.put("idTurma", 1);
            db.insert("Aluno", null, valores);

            valores = new ContentValues();
            valores.put("nome", "Matheus");
            valores.put("Responsavel_id", "1");
            valores.put("senha", "123");
            valores.put("idTurma", 2);
            db.insert("Aluno", null, valores);

            valores = new ContentValues();
            valores.put("nome", "João");
            valores.put("Responsavel_id", "1");
            valores.put("senha", "123");
            valores.put("idTurma", 1);
            db.insert("Aluno", null, valores);

            valores = new ContentValues();
            valores.put("nome", "José");
            valores.put("Responsavel_id", "2");
            valores.put("senha", "123");
            valores.put("idTurma", 2);
            db.insert("Aluno", null, valores);

        }catch(SQLiteException ex){
            ex.printStackTrace();
        }
    }

    //Pesquisa no banco de dados informações para Login de um responsavel
    public Usuario pesquisarResponsavelLogin(String email, String senha){
        String sql = "SELECT * FROM Responsavel WHERE email = '"+email+"' AND senha = '"+senha+"'";

        Usuario usuario = null;

        try(SQLiteDatabase db = this.getReadableDatabase()) {
            Cursor tuplas = db.rawQuery(sql, null);
            if(tuplas.moveToFirst()){

                int id = tuplas.getInt(0);
                String nome = tuplas.getString(1);
                String emailUsuario = tuplas.getString(2);
                String senhaUsuario = tuplas.getString(3);

                usuario = new Usuario(nome,emailUsuario, null,  false, id, 0);
            }

        }catch(Exception ex){
            System.err.println("Erro na consulta SQL da busca de evento por id");
            ex.printStackTrace();
        }

        return usuario;
    }

    //Pesquisa no banco de dados informações para Login de um aluno
    public Usuario pesquisarAlunoLogin(String matricula, String senha){
        String sql = "SELECT * FROM Aluno WHERE matricula = "+matricula+" AND senha = "+senha;

        Usuario usuario = null;

        try(SQLiteDatabase db = this.getWritableDatabase()) {
            Cursor tuplas = db.rawQuery(sql, null);
            if(tuplas.moveToFirst()){

                String nome = tuplas.getString(1);
                String senhaUsuario = tuplas.getString(2);
                int idTurma = tuplas.getInt(4);
                usuario = new Usuario(nome,matricula, null, true, Integer.parseInt(matricula), idTurma);
            }

        }catch(Exception ex){
            System.err.println("Erro na consulta SQL da busca de evento por id");
            ex.printStackTrace();
        }

        return usuario;
    }

    //Pesquisa no banco de dados alunos relacionados ao responsavel
    public ArrayList<Usuario> alunosDoResponsvel(int idResponsavel){
        ArrayList<Usuario> resultados = new ArrayList<>();

        String sql = "SELECT * FROM Aluno WHERE Responsavel_id ="+idResponsavel;

        try(SQLiteDatabase db = this.getWritableDatabase()) {
            Cursor tuplas = db.rawQuery(sql, null);
            if(tuplas.moveToFirst()){
                do{
                    int matricula = tuplas.getInt(0);
                    String nome = tuplas.getString(1);
                    String senhaUsuario = tuplas.getString(2);
                    int idTurma = tuplas.getInt(4);

                    Usuario temporario = new Usuario(nome,matricula+"", null,true, matricula, idTurma);
                    resultados.add(temporario);

                }while(tuplas.moveToNext());
            }

        }catch (SQLiteException e){
            System.err.println("Ocorreu um erro");
            e.printStackTrace();
        }

        return resultados;
    }

    //Pesquisa no banco de dados os horários de determinada turma
    public ArrayList<Aula> listarAulas(int idTurma){
        ArrayList<Aula> resultados = new ArrayList<>();

        String sql = "SELECT * FROM Aula WHERE idTurma="+idTurma;
        try(SQLiteDatabase db = this.getWritableDatabase()) {
            Cursor tuplas = db.rawQuery(sql, null);
            if(tuplas.moveToFirst()){
                do{
                    int idAula = tuplas.getInt(0);
                    String horasInicio = tuplas.getString(1);
                    String horaFim = tuplas.getString(2);
                    int diaSemana = tuplas.getInt(3);
                    int idDisciplina = tuplas.getInt(4);

                    //int idAula, int diaSemana, int idDisciplina, int idTurma, String horasInicio, String horaFim
                    Aula temporario = new Aula(idAula,diaSemana, idDisciplina, idTurma, horasInicio, horaFim, null);
                    resultados.add(temporario);

                }while(tuplas.moveToNext());
            }

        }catch (SQLiteException e){
            System.err.println("Ocorreu um erro");
            e.printStackTrace();
        }
        //Os valores que veem do BD seguem o primeiro horário de todos os dias, depois o segundo, etc.
        //No APP deve ser mostrado os valores somente do dia em que está sendo apresnetado, por isso deve ser organizado

        ArrayList<Aula> resultadosOrganizado = new ArrayList<>();
        for (int i=1; i<=25;i++){
            for(Aula organizadora : resultados){
                if (organizadora.getDiaSemana() == i){
                    resultadosOrganizado.add(organizadora);
                }
            }
        }
        return resultadosOrganizado;

    }

    //Pesquisar no banco de dados as disciplinas
    public ArrayList<Disciplina> listarDisciplinas(){

        ArrayList<Disciplina> resultados = new ArrayList<>();
        String sql = "SELECT * FROM Disciplina ";

        try(SQLiteDatabase db = this.getWritableDatabase()) {
            Cursor tuplas = db.rawQuery(sql, null);
            if(tuplas.moveToFirst()){
                do{
                    int idDisciplina = tuplas.getInt(0);
                    String nome = tuplas.getString(1);

                    Disciplina temporario = new Disciplina(null, 0, 0, 0);
                    resultados.add(temporario);

                }while(tuplas.moveToNext());
            }

        }catch (SQLiteException e){
            System.err.println("Ocorreu um erro");
            e.printStackTrace();
        }

        return resultados;
    }

    //Pesquisar turmas
    public Turma listarTurma(int idTurma){
        String sql = "SELECT * FROM Turma WHERE idTurma = "+idTurma;

        Turma turma = null;

        try(SQLiteDatabase db = this.getWritableDatabase()) {
            Cursor tuplas = db.rawQuery(sql, null);
            if(tuplas.moveToFirst()){

                String nome = tuplas.getString(1);
                int ano = tuplas.getInt(2);

                turma = new Turma(idTurma,ano, nome);
            }

        }catch(Exception ex){
            System.err.println("Erro na consulta SQL da busca de evento por id");
            ex.printStackTrace();
        }

        return turma;
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