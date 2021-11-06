package com.ifmg.telastcc;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.graphics.Color;
import android.os.Bundle;
import android.view.View;
import android.widget.*;

import java.util.ArrayList;

import banco_de_dados.BancoDeDados;
import objetos.Aula;
import objetos.Disciplina;
import objetos.ResponsavelAluno;
import objetos.Turma;

public class horarios extends AppCompatActivity {
    private TextView diaDaSemana, turmaTxt;
    private TextView disciplinasHorario [] = new TextView[5];
    private TextView horasTextView[] = new TextView[5];
    private ImageButton anteriorBtn, proxBtn, sairBtn;
    private Button faltasBtn, usuarioBtn, proximoAlunoBtn, anteriorAlunoBtn;

    private ResponsavelAluno usuario =null;
    private TextView nomeUsuario;

    private ArrayList<ResponsavelAluno>alunos;

    private ArrayList<Aula> horarios;
    private ArrayList< ArrayList<Aula> > todosHorarios; //Vetor do ArrayList de horarios
    private ArrayList<Turma>turmas;
    //private Turma todasTurmas[]; //Vetor do ArrayList de turmas

    private ArrayList<Disciplina> disciplinas;


    private int totalAlunos;
    private int alunoAtual=0;

    String vetorDiasDaSemana[] = {"Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira"};
    private int diaDaSemanaAtual=0;


    private boolean maisDeUmHorario = false;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_horarios);

        //Criando Link entre componentes java e XML
        diaDaSemana = (TextView) findViewById(R.id.diaDaSemana);
        turmaTxt = (TextView) findViewById(R.id.turmaTxt);

        disciplinasHorario[0] = (TextView) findViewById(R.id.horario1);
        disciplinasHorario[1] = (TextView) findViewById(R.id.horario2);
        disciplinasHorario[2] = (TextView) findViewById(R.id.horario3);
        disciplinasHorario[3] = (TextView) findViewById(R.id.horario4);
        disciplinasHorario[4] = (TextView) findViewById(R.id.horario5);
        horasTextView[0] = (TextView) findViewById(R.id.horas1);
        horasTextView[1] = (TextView) findViewById(R.id.horas2);
        horasTextView[2] = (TextView) findViewById(R.id.horas3);
        horasTextView[3] = (TextView) findViewById(R.id.horas4);
        horasTextView[4] = (TextView) findViewById(R.id.horas5);

        anteriorBtn = (ImageButton) findViewById(R.id.anteriorBtn);
        //Deixar o botao invisivel
        anteriorBtn.setVisibility(View.INVISIBLE);
        proxBtn = (ImageButton) findViewById(R.id.proximoBtn);
        sairBtn = (ImageButton) findViewById(R.id.sairBtn);

        faltasBtn = (Button) findViewById(R.id.faltasBtn);
        usuarioBtn = (Button) findViewById(R.id.usuarioBtn);
        anteriorAlunoBtn = (Button) findViewById(R.id.anteriorAlunoBtn);
        proximoAlunoBtn = (Button) findViewById(R.id.proximoAlunoBtn);

        nomeUsuario = (TextView) findViewById(R.id.nomeUsuario);
        //Pegando dados dos usuario vindos do login e colocando o nome no canto superior direito
        usuario  = getIntent().getParcelableExtra("usuario");



        nomeUsuario.setText(usuario.getNome());

        //Implementa eventos dos botões
        buscarDados();
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

        //Ir para o aluno anterior
        anteriorAlunoBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                mudarAluno(-1);
            }
        });

        //Ir para o próximo aluno
        proximoAlunoBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
               mudarAluno(1);
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
        //deixar setas invisiveis
        if(diaDaSemanaAtual != 0 && diaDaSemanaAtual != 4 ){
            proxBtn.setVisibility(View.VISIBLE);
            anteriorBtn.setVisibility(View.VISIBLE);
        }
        else{
            if(diaDaSemanaAtual== 0){
                anteriorBtn.setVisibility(View.INVISIBLE);
            }
            else{
                proxBtn.setVisibility(View.INVISIBLE);
            }
        }
        diaDaSemana.setText(vetorDiasDaSemana[diaDaSemanaAtual]);
        exibirHorarios();
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

    private void buscarDados(){
        BancoDeDados bd = new BancoDeDados(horarios.this);
        disciplinas = bd.listarDisciplinas();

        //Verificar quantos alunos vão ter os horários mostrados
        alunos = new ArrayList<>();
        turmas = new ArrayList<>();

        if(!usuario.isAluno()){
            alunos=bd.alunosDoResponsvel(usuario.getId());
            totalAlunos = alunos.size();

            //Mudar a cor dos botões de alterar o aluno
            proximoAlunoBtn.setBackgroundColor(Color.rgb(50,146,36));
            anteriorAlunoBtn.setBackgroundColor(Color.rgb(89,97,88));
        }
        else{
            alunos.add(usuario);
            totalAlunos = 1;
            anteriorAlunoBtn.setVisibility(View.INVISIBLE);
            proximoAlunoBtn.setVisibility(View.INVISIBLE);
        }
        todosHorarios = new ArrayList<>();

        //Salvando os horários de todos os alunos em um único vetor e pegando os valores das turmas
        for (int i=0; i<totalAlunos; i++){
            horarios = bd.listarAulas(alunos.get(i).getIdTurma());
            todosHorarios.add(horarios);

            turmas.add(bd.listarTurma(alunos.get(i).getIdTurma()));
            turmaTxt.setText(turmas.get(alunoAtual).getNome());
        }

        //Setando botões de aluno próximo e anterior como invisivel, já que não há necessidade de mudar de aluno se só há acesso a um
        if(totalAlunos==1){
            anteriorAlunoBtn.setVisibility(View.INVISIBLE);
            proximoAlunoBtn.setVisibility(View.INVISIBLE);
        }

        exibirHorarios();

    }

    private void exibirHorarios(){
        //O cont seguirá um fluxo normal de 0 a 5 enquanto o i iráa seguir um fluxo de acordo com o intervalo do horário em que será exibido
        int cont=0;
        for(int i=(diaDaSemanaAtual*5); i < (5+(diaDaSemanaAtual*5)); i++){
            horasTextView[cont].setText(todosHorarios.get(alunoAtual).get(i).getHorasInicio());

            String nomeDisciplina = null;
            for (Disciplina procurarNome: disciplinas){
                if(procurarNome.getIdDisciplina() == todosHorarios.get(alunoAtual).get(i).getIdDisciplina() ){
                    nomeDisciplina = procurarNome.getNome();
                }
            }
            disciplinasHorario[cont].setText(nomeDisciplina);
            cont++;
        }

    }

    private void mudarAluno(int opcao){
        if(opcao == 1 && alunoAtual<(totalAlunos-1)){
            alunoAtual++;
        }
        else if(opcao == -1 && alunoAtual>0){
            alunoAtual--;
        }

        //Mudar a cor dos botões para indicar o limite
        if(alunoAtual==0){
            //CINZA
            anteriorAlunoBtn.setBackgroundColor(Color.rgb(89,97,88));
        }
        else{
            //VERDE
            anteriorAlunoBtn.setBackgroundColor(Color.rgb(50,146,36));
        }
        if(alunoAtual == (totalAlunos-1)){
            //CINZA
            proximoAlunoBtn.setBackgroundColor(Color.rgb(89,97,88));
        }
        else{
            //VERDE
            proximoAlunoBtn.setBackgroundColor(Color.rgb(50,146,36));
        }

        //Exibir o nome correto da turma
        turmaTxt.setText(turmas.get(alunoAtual).getNome());

        exibirHorarios();
    }



}