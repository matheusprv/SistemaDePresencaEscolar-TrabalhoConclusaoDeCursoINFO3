package com.ifmg.telastcc;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageButton;
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

import java.util.HashMap;
import java.util.Map;

import objetos.Disciplina;
import objetos.Usuario;

public class usuario extends AppCompatActivity {
    private Button faltasBtn, horariosBtn, salvarBtn;
    private ImageButton sairBtn;
    private EditText senhaTxt, novaSenhaTxt,confirmarSenhaTxt;
    private TextView nomeTxt,emailTxt;

    private Usuario usuario =null;
    private TextView nomeUsuario;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_usuario);

        //Criando Link entre componentes java e XML
        faltasBtn = (Button) findViewById(R.id.faltasBtn);
        horariosBtn = (Button) findViewById(R.id.horaiosBtn);
        salvarBtn = (Button) findViewById(R.id.salvarBtn);
        sairBtn = (ImageButton) findViewById(R.id.sairBtn);

        nomeUsuario = (TextView) findViewById(R.id.nomeUsuario);
        //Pegando dados dos usuario vindos do login e colocando o nome no canto superior direito
        usuario  = getIntent().getParcelableExtra("usuario");
        nomeUsuario.setText(usuario.getNome());

        nomeTxt = (TextView)findViewById(R.id.nomeTxt);
        emailTxt = (TextView) findViewById(R.id.emailTxt);
        nomeTxt.setText(usuario.getNome());
        emailTxt.setText(usuario.getEmailMatricula());

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

        //Ir para a tela de faltas
        faltasBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                abrirFaltas();
            }
        });
        //Ir para a tela de horários
        horariosBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                abrirHorarios();
            }
        });

        //Salvar informações alteradas
        salvarBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                salvar();
            }
        });


    }
    //Sai do aplicativo
    private void sair(){
        Intent sair = new Intent(this, MainActivity.class);
        startActivity(sair);
        finish();
    }

    //Abre a tela de faltas
    private void abrirFaltas(){
        Intent abrir = new Intent(this, faltas.class);
        abrir.putExtra("usuario", usuario);
        startActivity(abrir);
        finish();
    }
    //Abre a tela de horários
    private void abrirHorarios(){
        Intent abrir = new Intent(this, horarios.class);
        abrir.putExtra("usuario", usuario);
        startActivity(abrir);
        finish();
    }

    //Salvar informações alteradas
    private void salvar(){
        //O link é feito aqui para que, caso o usuário reescreva os dados, eles sejam devidamente atualizados
        senhaTxt = (EditText) findViewById(R.id.senhaTxt);
        novaSenhaTxt = (EditText) findViewById(R.id.novaSenhaTxt);
        confirmarSenhaTxt = (EditText) findViewById(R.id.confirmarSenhaTxt);

        String senhaAtual = senhaTxt.getText().toString().trim();
        String novaSenha = novaSenhaTxt.getText().toString().trim();
        String confirmarNovaSenha = confirmarSenhaTxt.getText().toString().trim();

        //Verificar se os campos estão nulos
        if(senhaAtual.length()==0 || novaSenha.length()==0 || confirmarNovaSenha.length()==0){
            Toast.makeText(this, "Preencha todos os campos de senha", Toast.LENGTH_LONG).show();
        }
        else{

            //Verificar se a nova senha e a sua confirmação são compatíveis
            if(novaSenha.equals(confirmarNovaSenha)){
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
                                Toast.makeText(usuario.this, "Senha alterada com sucesso", Toast.LENGTH_LONG).show();

                            } else if (resposta.getInt("cod") == 404) {
                                Toast.makeText(usuario.this, "Senhas atual incorreta", Toast.LENGTH_LONG).show();
                            }
                            else if (resposta.getInt("cod") == 400) {
                                Toast.makeText(usuario.this, "Erro na alteração da senha", Toast.LENGTH_LONG).show();
                            }
                            senhaTxt.setText("");
                            novaSenhaTxt.setText("");
                            confirmarSenhaTxt.setText("");

                        } catch (JSONException ex) {
                            ex.printStackTrace();
                            //Erro no formato JSON enviado pelo servidor
                        }
                    }
                }, new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        error.printStackTrace();
                        Toast.makeText(usuario.this, "Cheque sua conexão", Toast.LENGTH_SHORT).show();
                    }
                }){
                    protected Map<String, String> getParams(){
                        Map<String, String> parametros = new HashMap<>();
                        parametros.put("servico", "atualizacao");
                        parametros.put("matriculaEmail", usuario.getEmailMatricula());
                        parametros.put("senhaAntiga", senhaAtual);
                        parametros.put("senhaNova", novaSenha);
                        parametros.put("aluno", usuario.isAluno()+"");

                        return parametros;

                    }
                };
                pilha.add(requisicaoLogin);
            }
            else{
                Toast.makeText(this, "Novas senhas incompatíveis", Toast.LENGTH_LONG).show();


            }


        }

    }

}