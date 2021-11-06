package com.ifmg.telastcc;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.KeyEvent;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import java.util.ArrayList;

import banco_de_dados.BancoDeDados;
import objetos.ResponsavelAluno;

public class MainActivity extends AppCompatActivity {
    private Button login;
    private EditText emailMatricula, senhaUsuario;
    private String emailMatriculaStr, senhaStr;
    private ArrayList<ResponsavelAluno> responsvaelAlunos = null;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        //Criando Link entre componentes java e XML
        emailMatricula = (EditText) findViewById(R.id.matriculaEmail);

        login = (Button) findViewById(R.id.login);

        senhaUsuario = (EditText) findViewById(R.id.senha);
        senhaStr = senhaUsuario.getText().toString().trim();

        //Implementa eventos dos botões
        eventos();
        gerarDadosBD();
    }

    private void eventos(){
        login.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                //Inicia a próxima tela
                abrirPresenca();
            }
        });
        senhaUsuario.setOnKeyListener(new View.OnKeyListener() {
            @Override
            public boolean onKey(View v, int keyCode, KeyEvent event) {
                if (event.getKeyCode()==66){
                    abrirPresenca();
                }
                return false;
            }
        });

    }

    private void abrirPresenca(){
        BancoDeDados bd = new BancoDeDados(MainActivity.this);

        //O link é feito aqui para que, caso o usuário reescreva os dados, eles sejam atualizados
        emailMatricula = (EditText) findViewById(R.id.matriculaEmail);
        emailMatriculaStr = emailMatricula.getText().toString().trim();
        senhaUsuario = (EditText) findViewById(R.id.senha);
        senhaStr = senhaUsuario.getText().toString().trim();

        ResponsavelAluno usuario = null;
        //Caso no campo de email contenha o @, significa, então, que quem está tentando acessar é o responsavel
        if(emailMatriculaStr.contains("@")){
            usuario = bd.pesquisarResponsavelLogin(emailMatriculaStr, senhaStr);
        }
        else{
            usuario = bd.pesquisarAlunoLogin(emailMatriculaStr, senhaStr);
        }

        if(usuario == null){
            Toast.makeText(this, "Usuário ou senha inválidos", Toast.LENGTH_SHORT).show();
        }
        else{
            Intent abrir = new Intent(this, faltas.class);
            abrir.putExtra("usuario", usuario);
            startActivity(abrir);
        }
    }

    //Gera dados no banco de dados local para fim de testes
    private void gerarDadosBD(){
        BancoDeDados bd;
        bd = new BancoDeDados(MainActivity.this);

        //Verifica se há algum dado no BD, se não possuir, eles são criados
        ArrayList<ResponsavelAluno> teste = bd.alunosDoResponsvel(1);
        if(teste.size() !=0){
            Toast.makeText(MainActivity.this, "Dados cadastrados previamente", Toast.LENGTH_SHORT).show();
        }
        else{
            bd.insereTurma();
            bd.insereDisciplina();
            bd.inserirHorarioAula();
            bd.insereResponsavel();
            bd.insereAluno();

            Toast.makeText(MainActivity.this, bd.getDatabaseName(), Toast.LENGTH_SHORT).show();

            ResponsavelAluno teste2 = bd.pesquisarResponsavelLogin("matheus@email.com", "123");
            System.out.println(teste2.toString());

            Toast.makeText(MainActivity.this, "Novos dados criados", Toast.LENGTH_SHORT).show();
        }

    }

}