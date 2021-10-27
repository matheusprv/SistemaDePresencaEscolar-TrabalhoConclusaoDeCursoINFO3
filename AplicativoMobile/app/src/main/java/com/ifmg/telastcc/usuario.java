package com.ifmg.telastcc;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.graphics.Paint;
import android.os.Bundle;
import android.view.KeyEvent;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;

import banco_de_dados.BancoDeDados;
import objetos.ResponsavelAluno;

public class usuario extends AppCompatActivity {
    private Button faltasBtn, horariosBtn, salvarBtn;
    private ImageButton sairBtn;
    private EditText senhaTxt, novaSenhaTxt,confirmarSenhaTxt;
    private TextView nomeTxt,emailTxt;

    private ResponsavelAluno usuario =null;
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
    }

    //Abre a tela de faltas
    private void abrirFaltas(){
        Intent abrir = new Intent(this, faltas.class);
        abrir.putExtra("usuario", usuario);
        startActivity(abrir);
    }
    //Abre a tela de horários
    private void abrirHorarios(){
        Intent abrir = new Intent(this, horarios.class);
        abrir.putExtra("usuario", usuario);
        startActivity(abrir);
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
            //Verificar se a senha atual está correta
            if(!senhaAtual.equals(usuario.getSenha())){
                Toast.makeText(this, "Senha atual incorreta", Toast.LENGTH_LONG).show();
            }
            else{
                //Verificar se a nova senha e a sua confirmação são compatíveis
                if(!novaSenha.equals(confirmarNovaSenha)){
                    Toast.makeText(this, "Novas senhas incompatíveis", Toast.LENGTH_LONG).show();
                }
                else{
                    BancoDeDados bd = new BancoDeDados(usuario.this);
                    usuario.setSenha(novaSenha);
                    //Verificar se é aluno ou responsavel
                    if (!usuario.isAluno()){
                        bd.updateSenhaResponsavel(usuario.getId(), usuario.getSenha());
                    }
                    else{
                        bd.updateSenhaAluno(usuario.getEmailMatricula(), usuario.getSenha());
                    }
                    Toast.makeText(this, "Senha alterada com sucesso!", Toast.LENGTH_LONG).show();
                    senhaTxt.setText("");
                    novaSenhaTxt.setText("");
                    confirmarSenhaTxt.setText("");
                }
            }
        }

    }
}