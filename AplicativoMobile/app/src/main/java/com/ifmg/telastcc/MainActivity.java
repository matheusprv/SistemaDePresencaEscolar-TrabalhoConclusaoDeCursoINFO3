package com.ifmg.telastcc;

import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.ActivityCompat;
import androidx.core.content.ContextCompat;

import android.Manifest;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.os.Bundle;
import android.view.KeyEvent;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.google.gson.JsonElement;
import com.google.gson.JsonParser;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.HashMap;
import java.util.Map;

import banco_de_dados.BancoDeDados;
import objetos.AlunosDoResponsavel;
import objetos.Usuario;

public class MainActivity extends AppCompatActivity {
    private Button login;
    private EditText emailMatricula, senhaUsuario;
    private String emailMatriculaStr, senhaStr;
    private ArrayList<Usuario> responsvaelAlunos = null;
    private Usuario usuario;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);


        if(ContextCompat.checkSelfPermission(getBaseContext(), Manifest.permission.INTERNET) != PackageManager.PERMISSION_GRANTED){
            ActivityCompat.requestPermissions(MainActivity.this, new String[] { Manifest.permission.INTERNET}, 0);
        }


        //Criando Link entre componentes java e XML
        emailMatricula = (EditText) findViewById(R.id.matriculaEmail);

        login = (Button) findViewById(R.id.login);

        senhaUsuario = (EditText) findViewById(R.id.senha);
        senhaStr = senhaUsuario.getText().toString().trim();

        //Implementa eventos dos botões
        eventos();
        //gerarDadosBD();
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
        emailMatriculaStr = emailMatricula.getText().toString().trim();
        senhaUsuario = (EditText) findViewById(R.id.senha);
        senhaStr = senhaUsuario.getText().toString().trim();

        String url = GlobalVar.urlServidor+"user";

        RequestQueue pilha= Volley.newRequestQueue(this);
        StringRequest requisicaoLogin = new StringRequest(Request.Method.POST, url, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                //Resultado do servidor para o aplicativo
                try {
                    JSONObject resposta = new JSONObject(response);

                    //Sucesso
                    if (resposta.getInt("cod") == 200) {
                        JSONObject userJson = resposta.getJSONObject("informacao");

                        String nome = userJson.getString("nome");
                        String email = userJson.getString("emailMatricula");
                        String nomeTurma = userJson.getString("nomeTurma");
                        boolean aluno = userJson.getBoolean("aluno");
                        int id = userJson.getInt("id");
                        int idTurma = userJson.getInt("idTurma");
                        int senhaAlterada = userJson.getInt("senhaAlterada");

                        usuario = new Usuario( nome,  email, nomeTurma,  aluno,  id,  idTurma);

                        //Caso o usuário não seja um aluno será pesquisado todos aqueles que estão relacionados ao Responsável
                        //Impedir que a próxima tela abra sem os receber os dados do aluno do responsável
                        if(!aluno){
                            alunosDoResponsavel(id, senhaAlterada);
                        }
                        else{
                            abrirFaltas(senhaAlterada);
                        }


                    } else if (resposta.getInt("cod") == 404) {
                        Toast.makeText(MainActivity.this, "Usuário ou senha inválidos", Toast.LENGTH_SHORT).show();
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
                Toast.makeText(MainActivity.this, "Cheque sua conexão", Toast.LENGTH_SHORT).show();
            }
        }){
            protected Map<String, String> getParams(){
                Map<String, String> parametros = new HashMap<>();

                //Caso no campo de email contenha o @, significa, então, que quem está tentando acessar é o responsavel
                if(emailMatriculaStr.contains("@")){
                    System.out.println("LOGIN Responsavel");
                    parametros.put("servico", "loginResponsavel");
                    parametros.put("email", emailMatriculaStr);
                    parametros.put("senha", senhaStr);
                }
                else{
                    System.out.println("LOGIN ALUNO");
                    parametros.put("servico", "loginAluno");
                    parametros.put("matricula", emailMatriculaStr);
                    parametros.put("senha", senhaStr);
                }

                return parametros;

            }
        };
        pilha.add(requisicaoLogin);


    }

    private boolean alunosDoResponsavel(int idResponsavel, int senhaAlterada){
        RequestQueue pilha = Volley.newRequestQueue(this);

        String url = GlobalVar.urlServidor+"alunosServlet";

        StringRequest requisicao = new StringRequest(Request.Method.POST, url, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                response = response.trim();
                //O parametro response é o resultado enviado do servidor para o aplicativo
                try {
                    JSONObject resposta = new JSONObject(response);

                    //200 indica sucesso
                    if (resposta.getInt("cod") == 200) {

                        JSONArray alunosDoResponsavel = resposta.getJSONArray("informacao");

                        ArrayList<AlunosDoResponsavel> alunosResposnavel = new ArrayList<>();

                        for(int i =0; i<alunosDoResponsavel.length(); i++){
                            JSONObject obj = alunosDoResponsavel.getJSONObject(i);

                            AlunosDoResponsavel temp = new AlunosDoResponsavel(obj.getString("nome"), obj.getString("nomeTurma"), obj.getInt("matricula"), obj.getInt("turma"));
                            alunosResposnavel.add(temp);
                        }

                        Usuario.alunos = alunosResposnavel;
                        abrirFaltas(senhaAlterada);

                    } else {
                        //algum problema foi relatado pelo servidor
                        Toast.makeText(MainActivity.this, resposta.getString("informacao"), Toast.LENGTH_SHORT).show();
                    }

                } catch (JSONException ex) {
                    Toast.makeText(MainActivity.this, "Erro no padrão do retorno", Toast.LENGTH_SHORT).show();
                    ex.printStackTrace();
                }

            }

        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                error.printStackTrace();
                Toast.makeText(MainActivity.this, "Verifique sua conexão", Toast.LENGTH_SHORT).show();
            }
        }){
            protected Map<String, String> getParams(){
                Map<String, String> parametros = new HashMap<>();

                parametros.put("idResponsavel", idResponsavel+"");

                return parametros;

            }
        };
        pilha.add(requisicao);

        return true;
    }

    private void abrirFaltas(int senhaAlterada){
        //Verificar se a senha padrão do usuário já foi atualizada, caso não, enviá-lo para a tela de atualizar
        if(senhaAlterada == 1){
            Intent abrir = new Intent(MainActivity.this, faltas.class);
            abrir.putExtra("usuario", usuario);
            startActivity(abrir);
        }
        else{
            Intent abrir = new Intent(MainActivity.this, usuario.class);
            abrir.putExtra("usuario", usuario);
            startActivity(abrir);
            Toast.makeText(MainActivity.this, "Sua senha ainda é a inicial. Por favor, altere-a", Toast.LENGTH_LONG).show();
        }
    }





}