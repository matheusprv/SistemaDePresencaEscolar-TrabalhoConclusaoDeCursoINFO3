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

public class MainActivity extends AppCompatActivity {
    private Button login;
    private EditText emailMatricula, senhaUsuario;
    private String email, senhaStr;

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
        //O link é feito aqui para que, caso o usuário reescreva os dados, eles sejam atualizados
        emailMatricula = (EditText) findViewById(R.id.matriculaEmail);
        email = emailMatricula.getText().toString().trim();
        senhaUsuario = (EditText) findViewById(R.id.senha);
        senhaStr = senhaUsuario.getText().toString().trim();

        //Verifica se os dados nao sao nulos
        if(email.length()==0 || senhaStr.length()==0){
            Toast.makeText(this, "Preencha os campos corretamente", Toast.LENGTH_LONG).show();
        }
        else{
            Intent abrir = new Intent(this, faltas.class);
            startActivity(abrir);
        }

    }
}