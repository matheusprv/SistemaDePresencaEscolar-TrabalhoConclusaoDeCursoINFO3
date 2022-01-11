package com.ifmg.telastcc;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;

import java.util.ArrayList;

import objetos.Disciplina;

//define o comportamento e informações de cada um dos itens da lista de disciplinas e faltas
public class lista_presenca_disciplina extends ArrayAdapter<Disciplina> {

    private Context contextoPai;
    private ArrayList<Disciplina> disciplinas;


    private static class ViewHolder{
        private TextView nomeDisciplinaTxt;
        private TextView numeroFaltas;
    }

    public lista_presenca_disciplina (Context contexto, ArrayList<Disciplina> dados){
        super(contexto, R.layout.lista_presenca_disciplina, dados);

        this.contextoPai = contexto;
        this.disciplinas = dados;
    }

    @NonNull
    @Override
    public View getView(int indice, @Nullable View convertView, @NonNull ViewGroup parent) {
        //return super.getView(indice, convertView, parent);

        Disciplina disciplinaAtual = disciplinas.get(indice);
        ViewHolder novaView;

        final View resultado;

        //Lista está sendo montada pela 1ª vez
        if(convertView == null){
            novaView = new ViewHolder();

            LayoutInflater inflater = LayoutInflater.from(getContext());
            convertView = inflater.inflate(R.layout.lista_presenca_disciplina, parent, false);

            novaView.nomeDisciplinaTxt = (TextView) convertView.findViewById(R.id.nomeDisciplina);
            novaView.numeroFaltas = (TextView) convertView.findViewById(R.id.numeroFaltas);

            resultado = convertView;
            convertView.setTag(novaView);
        }
        //Quando um item é modificado
        else{
            novaView = (ViewHolder)  convertView.getTag();
            resultado = convertView;
        }

        //Setar valores de cada campo
        novaView.nomeDisciplinaTxt.setText((disciplinaAtual.getNome()));
        novaView.numeroFaltas.setText(disciplinaAtual.getFaltas()+"");

        return resultado;
    }
}
