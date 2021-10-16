package com.ifmg.telastcc;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.ImageButton;

public class faltas extends AppCompatActivity {
    private Button horariosBtn, usuarioBtn;
    private ImageButton sairBtn;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_faltas);

        //Criando Link entre componentes java e XML
        horariosBtn = (Button) findViewById(R.id.horaiosBtn);
        usuarioBtn = (Button) findViewById(R.id.usuarioBtn);

        sairBtn = (ImageButton) findViewById(R.id.sairBtn);

        //Implementa eventos dos botões
        eventos();
    }
    private void eventos(){
        //Ir para a tela de horários
        horariosBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                abrirHorarios();
            }
        });
        //Ir para a tela do usuário
        usuarioBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                abrirUsuario();
            }
        });

        //Sair do aplicativo
        sairBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                sair();
            }
        });
    }

    //Abre a tela de horários
    private void abrirHorarios(){
        Intent abrir = new Intent(this, horarios.class);
        startActivity(abrir);
    }
    //Abre a tela de perfil do usuário
    private void abrirUsuario(){
        Intent abrir = new Intent(this, usuario.class);
        startActivity(abrir);
    }
    //Sai do aplicativo
    private void sair(){
        Intent sair = new Intent(this, MainActivity.class);
        startActivity(sair);
    }

}