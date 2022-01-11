package com.ifmg.telastcc;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.graphics.Color;
import android.os.Bundle;
import android.view.View;
import android.widget.*;

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

import banco_de_dados.BancoDeDados;
import objetos.AlunosDoResponsavel;
import objetos.Aula;
import objetos.Disciplina;
import objetos.Usuario;
import objetos.Turma;

public class horarios extends AppCompatActivity {
    private TextView diaDaSemana, turmaTxt, nomeAlunoTxt;
    private TextView disciplinasHorario [] = new TextView[5];
    private TextView horasTextView[] = new TextView[5];
    private ImageButton anteriorBtn, proxBtn, sairBtn;
    private Button faltasBtn, usuarioBtn, proximoAlunoBtn, anteriorAlunoBtn;

    private Usuario usuario =null;
    private TextView nomeUsuario;

    private ArrayList<Usuario>alunos;

    private ArrayList<Aula> horarios;
    private ArrayList<Turma>turmas;


    private int totalAlunos;
    private int alunoAtual=0;

    String vetorDiasDaSemana[] = {"Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira"};
    private int diaDaSemanaAtual=0;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_horarios);

        //Criando Link entre componentes java e XML
        diaDaSemana = (TextView) findViewById(R.id.diaDaSemana);
        turmaTxt = (TextView) findViewById(R.id.turmaTxt);
        nomeAlunoTxt = (TextView) findViewById(R.id.nomeAlunoTxt);

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
        finish();
    }
    //Abre a tela de perfil d usuário
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

    private void buscarDados(){
        //Verificar quantos alunos vão ter os horários mostrados
        alunos = new ArrayList<>();
        turmas = new ArrayList<>();
        horarios = new ArrayList<>();

        if(!usuario.isAluno()){
            for(AlunosDoResponsavel converter : Usuario.alunos){
                //String nome, String emailMatricula String nomeTurma,boolean aluno, int id, int idTurma
                alunos.add(new Usuario(converter.getNome(), converter.getMatricula()+"", converter.getNomeTurma(), true, converter.getMatricula(), converter.getIdTurma()));
            }
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

        //Setando botões de aluno próximo e anterior como invisivel, já que não há necessidade de mudar de aluno se só há acesso a um
        if(totalAlunos==1){
            anteriorAlunoBtn.setVisibility(View.INVISIBLE);
            proximoAlunoBtn.setVisibility(View.INVISIBLE);
        }


        //Salvando os horários de todos os alunos em um único vetor e pegando os valores das turmas
        //Um request para cada aluno do responsável
        RequestQueue pilha= Volley.newRequestQueue(this);
        for (int cont=0; cont<totalAlunos; cont++){
            final int  repetidor = cont;
            String url = GlobalVar.urlServidor+"horariosServlet";
            StringRequest requisicaoHorario = new StringRequest(Request.Method.POST, url, new Response.Listener<String>() {
                @Override
                public void onResponse(String response) {
                    //Resultado do servidor para o aplicativo
                    try {
                        JSONObject resposta = new JSONObject(response);
                        //Sucesso
                        if (resposta.getInt("cod") == 200) {

                            JSONArray dadosJSON = resposta.getJSONArray("informacao");

                            int idTurma =0;
                            for(int i =0; i<dadosJSON.length(); i++){
                                JSONObject obj = dadosJSON.getJSONObject(i);
                                String nomeDisciplina = obj.getString("nomeDisciplina");
                                String horasInicio = obj.getString("horasInicio");
                                String horaFim = obj.getString("horaFim");
                                int idAula = obj.getInt("idAula");
                                int diaSemana = obj.getInt("diaSemana");
                                int idDisciplina = obj.getInt("idDisciplina");
                                idTurma = obj.getInt("idTurma");

                                //Remover os segundos das horas e diminuir o nome das disciplinas
                                horasInicio = horasInicio.substring(0, 5);
                                horaFim = horaFim.substring(0, 5);
                                /*
                                if(nomeDisciplina.length()>11){
                                    nomeDisciplina = nomeDisciplina.substring(0, 12);
                                }
                                */
                                Aula temp = new Aula(idAula, diaSemana, idDisciplina, idTurma, horasInicio, horaFim, nomeDisciplina);
                                horarios.add(temp);

                            }
                            System.out.println("alunos.get(repetidor).getNomeTurma(): "+alunos.get(repetidor).getNomeTurma());
                            turmas.add(new Turma (idTurma, 2021,  alunos.get(repetidor).getNomeTurma()));

                            //Exibe os dados do primeiro aluno
                            if(repetidor == totalAlunos-1){
                                turmaTxt.setText(turmas.get(0).getNome());
                                nomeAlunoTxt.setText(alunos.get(0).getNome());
                                exibirHorarios();
                            }


                        } else if (resposta.getInt("cod") == 404) {
                            Toast.makeText(horarios.this, "Nenhum dado encontrado", Toast.LENGTH_SHORT).show();
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
                    Toast.makeText(horarios.this, "Cheque sua conexão", Toast.LENGTH_SHORT).show();
                }
            }){
                protected Map<String, String> getParams(){
                    Map<String, String> parametros = new HashMap<>();
                    parametros.put("idTurma", alunos.get(repetidor).getIdTurma()+"");
                    return parametros;

                }
            };
            pilha.add(requisicaoHorario);
        }




    }

    private void exibirHorarios(){

        //O cont seguirá um fluxo normal de 0 a 5 enquanto o i irá seguir um fluxo de acordo com o intervalo do horário em que será exibido
        int cont=0;
        /*
        Cada dia da semana possui 5 horários. Então, para achar o horário do primeiro valor da repetição, faz-se a multiplicação
        Para o limite da repetição, precisamos que ela percorra ao total cinco elementos, e o seu valor é descoberto da mesma maneira que para o início da repetição.

        Ex: Loop para definir os dados que serão exibidos na Quarta-Feira
            diaDaSemanaAtual = 3;
            i = 3*5 = 15 --> Procurar dados a partir da posição 15
            Limite = 5+(3*5) = 20 --> Procurar somente até a posição 20

         */
        for(int i=(diaDaSemanaAtual*5); i < (5+(diaDaSemanaAtual*5)); i++){
            //O ArrayList horarios possui todos os dados, então usamos a operação matemática "i+(25*alunoAtual)" para encontrar os dados corretos,
            // somando ao indice desejado 25 vezes o número do aluno, caso seja o primeiro aluno do vetor,
            // a multiplicação zera e então pegamos os valores do primeiro aluno
            horasTextView[cont].setText(horarios.get(i+(25*alunoAtual)).getHorasInicio());
            String nomeDisciplina = horarios.get(i+(25*alunoAtual)).getNomeDisciplina();
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
        nomeAlunoTxt.setText(alunos.get(alunoAtual).getNome());

        exibirHorarios();
    }



}