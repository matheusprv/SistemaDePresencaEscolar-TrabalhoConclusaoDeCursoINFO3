package com.ifmg.telastcc;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.*;

import objetos.ResponsavelAluno;

public class horarios extends AppCompatActivity {
    private TextView diaDaSemana, horario1, horario2, horario3, horario4, horario5, horario6;
    private ImageButton anteriorBtn, proxBtn, sairBtn;
    private Button faltasBtn, usuarioBtn;

    private ResponsavelAluno usuario =null;
    private TextView nomeUsuario;

    String vetorDiasDaSemana[] = {"Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira"};
    private int diaDaSemanaAtual=0;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_horarios);

        //Criando Link entre componentes java e XML
        diaDaSemana = (TextView) findViewById(R.id.diaDaSemana);

        horario1 = (TextView) findViewById(R.id.horario1);
        horario2 = (TextView) findViewById(R.id.horario2);
        horario3 = (TextView) findViewById(R.id.horario3);
        horario4 = (TextView) findViewById(R.id.horario4);
        horario5 = (TextView) findViewById(R.id.horario5);
        horario6 = (TextView) findViewById(R.id.horario6);

        anteriorBtn = (ImageButton) findViewById(R.id.anteriorBtn);
        proxBtn = (ImageButton) findViewById(R.id.proximoBtn);
        sairBtn = (ImageButton) findViewById(R.id.sairBtn);

        faltasBtn = (Button) findViewById(R.id.faltasBtn);
        usuarioBtn = (Button) findViewById(R.id.usuarioBtn);

        nomeUsuario = (TextView) findViewById(R.id.nomeUsuario);
        //Pegando dados dos usuario vindos do login e colocando o nome no canto superior direito
        usuario  = getIntent().getParcelableExtra("usuario");
        nomeUsuario.setText(usuario.getNome());

        //Implementa eventos dos botões
        eventos();
    }

    private void eventos(){
        //Sair do aplicativo
        sairBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                sair();
            }
        });

        //Próximo dia da semana
        anteriorBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                mudarDiaSemana(-1);
            }
        });
        //Dia da semana anterior
        proxBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                mudarDiaSemana(+1);
            }
        });
        //Ir para o menu de faltas
        faltasBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                abrirFaltas();
            }
        });
        //Ir para o menu do perfil do usuário
        usuarioBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                abrirUsuario();
            }
        });
    }
    //Sai do aplicativo
    private void sair(){
        Intent sair = new Intent(this, MainActivity.class);
        startActivity(sair);
    }

    //Altera os horários e dias da semana que estão sendo exibidos
    private void mudarDiaSemana(int ajuste){
        diaDaSemanaAtual+=ajuste;
        if(diaDaSemanaAtual<0){
            diaDaSemanaAtual=0;
        }
        else if(diaDaSemanaAtual>4){
            diaDaSemanaAtual=4;
        }
        diaDaSemana.setText(vetorDiasDaSemana[diaDaSemanaAtual]);
    }

    //Abre a tela de faltas
    private void abrirFaltas(){
        Intent abrir = new Intent(this, faltas.class);
        abrir.putExtra("usuario", usuario);
        startActivity(abrir);
    }
    //Abre a tela de perfil d usuário
    private void abrirUsuario(){
        Intent abrir = new Intent(this, usuario.class);
        abrir.putExtra("usuario", usuario);
        startActivity(abrir);
    }

}