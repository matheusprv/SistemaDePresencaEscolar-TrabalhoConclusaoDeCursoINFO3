package com.ifmg.telastcc;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.ImageButton;
import android.widget.ListView;
import android.widget.TextView;

import java.util.ArrayList;

import objetos.Disciplina;
import objetos.ResponsavelAluno;

public class faltas extends AppCompatActivity {
    private Button horariosBtn, usuarioBtn;
    private ImageButton sairBtn;
    private ListView listaPresenca;
    private TextView nomeUsuario;

    private ArrayList<Disciplina> disciplinas;
    private ResponsavelAluno usuario =null;
    private lista_presenca_disciplina adapter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_faltas);

        //Criando Link entre componentes java e XML
        horariosBtn = (Button) findViewById(R.id.horaiosBtn);
        usuarioBtn = (Button) findViewById(R.id.usuarioBtn);
        listaPresenca = (ListView) findViewById(R.id.listaPresenca);
        sairBtn = (ImageButton) findViewById(R.id.sairBtn);

        nomeUsuario = (TextView) findViewById(R.id.nomeUsuario);
        //Pegando dados dos usuario vindos do login e colocando o nome no canto superior direito
        usuario  = getIntent().getParcelableExtra("usuario");
        nomeUsuario.setText(usuario.getNome());


        //Implementa eventos dos botões
        eventos();
        carregaDisciplinasFaltas();
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
        abrir.putExtra("usuario", usuario);
        startActivity(abrir);
    }
    //Abre a tela de perfil do usuário
    private void abrirUsuario(){
        Intent abrir = new Intent(this, usuario.class);
        abrir.putExtra("usuario", usuario);
        startActivity(abrir);
    }
    //Sai do aplicativo
    private void sair(){
        Intent sair = new Intent(this, MainActivity.class);
        startActivity(sair);
    }

    private void carregaDisciplinasFaltas(){
        disciplinas = new ArrayList<>();

        disciplinas.add(new Disciplina ("Matemática", 0));
        disciplinas.add(new Disciplina ("Português", 1));
        disciplinas.add(new Disciplina ("História", 2));
        disciplinas.add(new Disciplina ("Geografia", 0));
        disciplinas.add(new Disciplina ("Inglês", 1));
        disciplinas.add(new Disciplina ("Filosofia", 2));

        adapter = new lista_presenca_disciplina(getApplicationContext(), disciplinas);
        listaPresenca.setAdapter(adapter);

    }

}