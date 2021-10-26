package com.ifmg.telastcc;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.text.Editable;
import android.text.TextWatcher;
import android.view.KeyEvent;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.Toast;

import banco_de_dados.BancoDeDados;
import objetos.Disciplina;
import objetos.Usuario;

public class MainActivity extends AppCompatActivity {
    private Button login, testarBD;
    private EditText emailMatricula, senhaUsuario;
    private String emailMatriculaStr, senhaStr;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        //Criando Link entre componentes java e XML
        emailMatricula = (EditText) findViewById(R.id.matriculaEmail);

        login = (Button) findViewById(R.id.login);
        testarBD = (Button) findViewById(R.id.testarBd);

        senhaUsuario = (EditText) findViewById(R.id.senha);
        senhaStr = senhaUsuario.getText().toString().trim();

        //Implementa eventos dos botões
        eventos();
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
        testarBD.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                BancoDeDados bd = new BancoDeDados(MainActivity.this);
                bd = new BancoDeDados(MainActivity.this);
                bd.insereResponsavel();
                bd.insereAluno();

                Toast.makeText(MainActivity.this, bd.getDatabaseName(), Toast.LENGTH_LONG).show();
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

        Usuario usuario = null;
        //Caso no campo de email contenha o @, significa, então, que quem está tentando acessar é o responsavel
        if(emailMatriculaStr.contains("@")){
            usuario = bd.pesquisarResponsavel(emailMatriculaStr, senhaStr);
        }
        else{
            usuario = bd.pesquisarAluno(emailMatriculaStr, senhaStr);
        }

        if(usuario == null){
            Toast.makeText(this, "usuário ou senha inválidos", Toast.LENGTH_LONG).show();
        }
        else{
            Intent abrir = new Intent(this, faltas.class);
            startActivity(abrir);
        }

    }
}