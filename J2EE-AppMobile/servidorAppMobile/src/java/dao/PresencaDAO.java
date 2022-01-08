/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package dao;

import ferramentas.FabricaConexao;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.swing.text.html.HTML;
import static javax.swing.text.html.HTML.Tag.SELECT;
import modelo.Aula;
import modelo.Disciplina;
import modelo.RetornarPresenca;

/**
 *
 * @author Matheus Peixoto e Pedro Arthur
 */
public class PresencaDAO {
    
    public static ArrayList<RetornarPresenca> listarPresenca(int idTurma, int matricula){
        
        String sqlDisciplinas = "SELECT DISTINCT Disciplina_idDisciplina FROM Aula WHERE Turma_idTurma = "+idTurma; 
        ArrayList<Disciplina> disciplinas = new ArrayList<>();
        
        //Procurando o id das disciplinas da turma
        ArrayList<Integer> idDisciplinas = new ArrayList<>();
        try(Connection con = FabricaConexao.criaConexao()){

            PreparedStatement consulta = con.prepareStatement(sqlDisciplinas);
            ResultSet tuplas = consulta.executeQuery();

            while(tuplas.next()){      
                int idDisciplina = tuplas.getInt("Disciplina_idDisciplina");
                idDisciplinas.add(idDisciplina);
            }   
            
            //Procurando o nome das disciplinas
            String sqlNomeDisciplinas = "SELECT nome, idDisciplina FROM Disciplina Where ";
            for(int i=0; i<idDisciplinas.size(); i++){
                if(i==0){
                    sqlNomeDisciplinas += " idDisciplina = "+idDisciplinas.get(i);
                }
                else{
                    sqlNomeDisciplinas += " OR idDisciplina = "+idDisciplinas.get(i);
                }
            }
            
            sqlNomeDisciplinas += " ORDER BY nome";
                        
            consulta = con.prepareStatement(sqlNomeDisciplinas);
            tuplas = consulta.executeQuery();
            
            while(tuplas.next()){
                String nome = tuplas.getString("nome");
                int idDisciplina = tuplas.getInt("idDisciplina");
                Disciplina temporario = new Disciplina(nome, idDisciplina);
                disciplinas.add(temporario);
            }
            

        }catch (SQLException ex) {
            System.out.println("Começo do erro na consulta de disciplinas");
            ex.printStackTrace();
            System.out.println("Fim do erro na consulta de disciplinas");
        }

        //Procurando presença do aluno na sua turma passada, já que podem haver registros de outras turmas
        String sqlMatricula = "SELECT * FROM Presenca WHERE Aluno_matricula="+matricula + " AND Turma_idTurma="+idTurma;
        ArrayList<Integer> resultPresenca = new ArrayList<>();
        try(Connection con = FabricaConexao.criaConexao()){
            PreparedStatement consulta = con.prepareStatement(sqlMatricula);
            ResultSet tuplas = consulta.executeQuery();
            while(tuplas.next()){
                int idDisciplina = tuplas.getInt("Disciplina_idDisciplina");               
                resultPresenca.add(idDisciplina);
            }
        }catch (SQLException ex) {
            System.out.println("Começo do erro na consulta da presença");
            ex.printStackTrace();
            System.out.println("Fim do erro na consulta da presença");
        }  
        
        ArrayList<RetornarPresenca> retornarPresenca = new ArrayList<>();
        //Adicionando 0 a todas as disciplinas para possiblitar a verificação e enviar todos os dados para o cliente
        for(int i=0; i<disciplinas.size(); i++){
            retornarPresenca.add(new RetornarPresenca(disciplinas.get(i).getId(),disciplinas.get(i).getNome(), 0));
        }
        //Contar as presenças
        for(int i=0; i< disciplinas.size(); i++){
            int totalPresenca =0;
            for(int x=0; x< resultPresenca.size(); x++ ){
                if(disciplinas.get(i).getId() == resultPresenca.get(x)){
                    totalPresenca++;
                }
            }
            retornarPresenca.get(i).setNumeroPresenca(totalPresenca);
        }

        return retornarPresenca;


    }

   
        
}
