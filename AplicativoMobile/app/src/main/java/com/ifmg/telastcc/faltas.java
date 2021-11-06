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

import banco_de_dados.BancoDeDados;
import objetos.Disciplina;
import objetos.ResponsavelAluno;

public class faltas extends AppCompatActivity {
    private Button horariosBtn, usuarioBtn;
    private ImageButton sairBtn, anteriorBtn, proximoBtn;
    private ListView listaPresenca;
    private TextView nomeUsuario, nomeAluno, numeroMatricula, turma;

    private ArrayList<Disciplina> disciplinas;
    private ArrayList<ResponsavelAluno> alunos;
    private ResponsavelAluno usuario =null;
    private lista_presenca_disciplina adapter;

    private int alunoAtual=0;
    private int totalDeAlunos=0;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_faltas);

        //Criando Link entre componentes java e XML
        horariosBtn = (Button) findViewById(R.id.horaiosBtn);
        usuarioBtn = (Button) findViewById(R.id.usuarioBtn);
        listaPresenca = (ListView) findViewById(R.id.listaPresenca);
        sairBtn = (ImageButton) findViewById(R.id.sairBtn);
        anteriorBtn = (ImageButton) findViewById(R.id.anteriorBtn);
        proximoBtn = (ImageButton) findViewById(R.id.proximoBtn);
        nomeAluno = (TextView) findViewById(R.id.nomeAlunoTxt);
        numeroMatricula= (TextView) findViewById(R.id.matriculaTxt);
        turma = (TextView) findViewById(R.id.turmaTxt);

        nomeUsuario = (TextView) findViewById(R.id.nomeUsuario);
        //Pegando dados dos usuario vindos do login e colocando o nome no canto superior direito
        usuario  = getIntent().getParcelableExtra("usuario");
        nomeUsuario.setText(usuario.getNome());


        //Implementa eventos dos botões
        eventos();
        carregaDisciplinasFaltas();
        carregarDadosUsuario();

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

        proximoBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                exibirAluno(1);
            }
        });
        anteriorBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                exibirAluno(-1);
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

    //Carrega a lista de disciplinas do aluno
    private void carregaDisciplinasFaltas(){
        disciplinas = new ArrayList<>();
        //Dados gerados para teste da lista de disciplinas e faltas
        disciplinas.add(new Disciplina (0,"Matemática", 0));
        disciplinas.add(new Disciplina (0,"Português", 1));
        disciplinas.add(new Disciplina (0,"História", 2));
        disciplinas.add(new Disciplina (0,"Geografia", 0));
        disciplinas.add(new Disciplina (0,"Inglês", 1));
        disciplinas.add(new Disciplina (0,"Filosofia", 2));

        adapter = new lista_presenca_disciplina(getApplicationContext(), disciplinas);
        listaPresenca.setAdapter(adapter);
    }

    //Carrega as informações do usuario e os alunos referentes a ele, se for responsavel
    private void carregarDadosUsuario(){
        anteriorBtn.setVisibility(View.INVISIBLE);
        proximoBtn.setVisibility(View.INVISIBLE);
        //Se o usuário for um aluno somente seus dados precisam ser carregados, caso contrário, é necessário pegar os dados dos alunos relacionados
        if(usuario.isAluno()){
            nomeAluno.setText(usuario.getNome());
            numeroMatricula.setText(usuario.getEmailMatricula());
            turma.setText(usuario.getIdTurma()+"");
        }

        else{
            BancoDeDados bd = new BancoDeDados(faltas.this);
            alunos = bd.alunosDoResponsvel(usuario.getId());
            totalDeAlunos = alunos.size()-1;
            nomeAluno.setText(alunos.get(0).getNome());
            turma.setText(alunos.get(0).getIdTurma()+"");
            numeroMatricula.setText(alunos.get(0).getEmailMatricula());

            if(totalDeAlunos>1){
                anteriorBtn.setVisibility(View.INVISIBLE);
                proximoBtn.setVisibility(View.VISIBLE);
            }

        }
    }

    private void exibirAluno(int opcao){
        // 1 --> Próximo aluno  | -1 --> Aluno anteriror
        if(opcao==1 && alunoAtual<totalDeAlunos){
            alunoAtual++;
        }
        else if (opcao==-1 && alunoAtual>0){
            alunoAtual--;
        }

        //Visualizar botões de aluno anterior e próximo
        if(alunoAtual ==0){
            anteriorBtn.setVisibility(View.INVISIBLE);
        }
        else{
            anteriorBtn.setVisibility(View.VISIBLE);
        }
        if(alunoAtual == totalDeAlunos){
            proximoBtn.setVisibility(View.INVISIBLE);
        }
        else{
            proximoBtn.setVisibility(View.VISIBLE);
        }


        nomeAluno.setText(alunos.get(alunoAtual).getNome());
        numeroMatricula.setText(alunos.get(alunoAtual).getEmailMatricula());
        turma.setText(alunos.get(alunoAtual).getIdTurma()+"");

    }

}