package com.ifmg.telastcc;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.graphics.Color;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.ImageButton;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

import objetos.AlunosDoResponsavel;
import objetos.Aula;
import objetos.Disciplina;
import objetos.Turma;
import objetos.Usuario;

public class faltas extends AppCompatActivity {
    private Button horariosBtn, usuarioBtn;
    private ImageButton sairBtn;
    private Button anteriorBtn, proximoBtn;
    private ListView listaPresenca;
    private TextView nomeUsuario, nomeAluno, numeroMatricula, turma;

    private ArrayList<Disciplina> disciplinas;
    private ArrayList<Usuario>alunos;
    private Usuario usuario =null;
    private lista_presenca_disciplina adapter;

    private int totalAlunos;
    private int alunoAtual=0;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_faltas);

        //Criando Link entre componentes java e XML
        horariosBtn = (Button) findViewById(R.id.horaiosBtn);
        usuarioBtn = (Button) findViewById(R.id.usuarioBtn);
        listaPresenca = (ListView) findViewById(R.id.listaPresenca);
        sairBtn = (ImageButton) findViewById(R.id.sairBtn);
        anteriorBtn = (Button) findViewById(R.id.anteriorBtn);
        proximoBtn = (Button) findViewById(R.id.proximoBtn);
        nomeAluno = (TextView) findViewById(R.id.nomeAlunoTxt);
        numeroMatricula= (TextView) findViewById(R.id.matriculaTxt);
        turma = (TextView) findViewById(R.id.turmaTxt);

        nomeUsuario = (TextView) findViewById(R.id.nomeUsuario);
        //Pegando dados dos usuario vindos do login e colocando o nome no canto superior direito
        usuario  = getIntent().getParcelableExtra("usuario");
        nomeUsuario.setText(usuario.getNome());


        //Implementa eventos dos botões
        eventos();
        carregarDados();

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
        finish();
    }
    //Abre a tela de perfil do usuário
    private void abrirUsuario(){
        Intent abrir = new Intent(this, usuario.class);
        abrir.putExtra("usuario", usuario);
        startActivity(abrir);
        finish();

    }
    //Sai do aplicativo
    private void sair(){
        Intent sair = new Intent(this, MainActivity.class);
        startActivity(sair);
        finish();
    }

    //Carrega a lista de disciplinas do aluno
    private void carregaDisciplinasFaltas(){

    }

    //Busca os dados dos alunos no banco
    private void carregarDados(){
        //Verificar quantos alunos vão ter os horários mostrados
        alunos = new ArrayList<>();
        disciplinas = new ArrayList<>();

        if(!usuario.isAluno()){
            for(AlunosDoResponsavel converter : Usuario.alunos){
                //String nome, String emailMatricula String nomeTurma,boolean aluno, int id, int idTurma
                alunos.add(new Usuario(converter.getNome(), converter.getMatricula()+"", converter.getNomeTurma(), true, converter.getMatricula(), converter.getIdTurma()));
            }
            totalAlunos = alunos.size();

        }
        else{
            alunos.add(usuario);
            totalAlunos = 1;
            anteriorBtn.setVisibility(View.INVISIBLE);
            proximoBtn.setVisibility(View.INVISIBLE);
        }

        //Setando botões de aluno próximo e anterior como invisivel, já que não há necessidade de mudar de aluno se só há acesso a um
        if(totalAlunos==1){
            anteriorBtn.setVisibility(View.INVISIBLE);
            proximoBtn.setVisibility(View.INVISIBLE);
        }

        //Salvando os horários de todos os alunos em um único vetor e pegando os valores das turmas
        //Um request para cada aluno do responsável
        RequestQueue pilha= Volley.newRequestQueue(this);
        for (int cont=0; cont<totalAlunos; cont++){
            final int  repetidor = cont;
            String url = GlobalVar.urlServidor+"Presenca";
            StringRequest requisicaoHorario = new StringRequest(Request.Method.POST, url, new Response.Listener<String>() {
                @Override
                public void onResponse(String response) {
                    //Resultado do servidor para o aplicativo
                    try {
                        JSONObject resposta = new JSONObject(response);
                        //Sucesso
                        if (resposta.getInt("cod") == 200) {

                            JSONArray dadosJSON = resposta.getJSONArray("informacao");

                            int idTurma = 0;
                            for(int i =0; i<dadosJSON.length(); i++){
                                JSONObject obj = dadosJSON.getJSONObject(i);

                                int idDisciplina = obj.getInt("idDisciplina");
                                String nomeDisciplina = obj.getString("nomeDisciplina");
                                int numeroPresenca = obj.getInt("numeroPresenca");

                                //Dados gerados para teste da lista de disciplinas e faltas
                                disciplinas.add(new Disciplina (nomeDisciplina, numeroPresenca, idDisciplina, alunos.get(repetidor).getId()));

                            }
                            //turmas.add(new Turma(idTurma, 2021,  alunos.get(repetidor).getNomeTurma()));

                            //Exibe os dados do primeiro aluno
                            if(repetidor == totalAlunos-1){
                                numeroMatricula.setText(alunos.get(0).getEmailMatricula());
                                turma.setText(alunos.get(0).getNomeTurma());
                                nomeAluno.setText(alunos.get(0).getNome());
                                exibirAluno(0);
                            }

                        } else if (resposta.getInt("cod") == 404) {
                            Toast.makeText(faltas.this, "Nenhum dado encontrado", Toast.LENGTH_SHORT).show();
                        }


                    } catch (JSONException ex) {
                        ex.printStackTrace();
                        //Erro no formato JSON enviado pelo servidor
                    }
                }
            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    error.printStackTrace();
                    Toast.makeText(faltas.this, "Cheque sua conexão", Toast.LENGTH_SHORT).show();
                }
            }){
                protected Map<String, String> getParams(){
                    Map<String, String> parametros = new HashMap<>();
                    parametros.put("idTurma", alunos.get(repetidor).getIdTurma()+"");
                    parametros.put("matricula", alunos.get(repetidor).getEmailMatricula()+"");
                    return parametros;

                }
            };
            pilha.add(requisicaoHorario);
        }

    }

    private void exibirAluno(int opcao){
        // 1 --> Próximo aluno  | -1 --> Aluno anteriror
        if(opcao==1 && alunoAtual<totalAlunos-1){
            alunoAtual++;
        }
        else if (opcao==-1 && alunoAtual>0){
            alunoAtual--;
        }

        //Mudar a cor dos botões para indicar o limite
        if(alunoAtual==0){
            //CINZA
            anteriorBtn.setBackgroundColor(Color.rgb(89,97,88));
        }
        else{
            //VERDE
            anteriorBtn.setBackgroundColor(Color.rgb(50,146,36));
        }
        if(alunoAtual == (totalAlunos-1)){
            //CINZA
            proximoBtn.setBackgroundColor(Color.rgb(89,97,88));
        }
        else{
            //VERDE
            proximoBtn.setBackgroundColor(Color.rgb(50,146,36));
        }


        nomeAluno.setText(alunos.get(alunoAtual).getNome());
        numeroMatricula.setText(alunos.get(alunoAtual).getEmailMatricula());
        turma.setText(alunos.get(alunoAtual).getNomeTurma());

        exibirPresenca();
    }

    private void exibirPresenca(){
        //Listar as disciplinas com base no aluno atual selecionado

        ArrayList<Disciplina>presencaDisciplinasExibir = new ArrayList<>();
        for(int i=0; i<disciplinas.size(); i++){
            if(disciplinas.get(i).getMatricula() == alunos.get(alunoAtual).getId()){
                presencaDisciplinasExibir.add(disciplinas.get(i));
            }
        }
        adapter = new lista_presenca_disciplina(getApplicationContext(), presencaDisciplinasExibir);
        listaPresenca.setAdapter(adapter);
    }

}