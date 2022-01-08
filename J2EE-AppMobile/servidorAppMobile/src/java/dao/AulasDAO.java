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
import modelo.Aula;
import modelo.Disciplina;

/**
 *
 * @author Matheus Peixoto e Pedro Arthur
 */
public class AulasDAO {
    
    
    public static ArrayList<Aula> listarAulas(int idTurma){
        
        String sql = "SELECT * FROM Aula WHERE Turma_idTurma="+idTurma;
        
        ArrayList<Aula> resultados = new ArrayList<>();
        
        try(Connection con = FabricaConexao.criaConexao()){
            
            PreparedStatement consulta = con.prepareStatement(sql);
            ResultSet tuplas = consulta.executeQuery();
            
            while(tuplas.next()){
                int idAula = tuplas.getInt("idAula");
                String horasInicio = tuplas.getString("horasInicio");
                String horaFim = tuplas.getString("horaFim");
                int diaSemana = tuplas.getInt("diaSemana");
                int idDisciplina = tuplas.getInt("Disciplina_idDisciplina");

                Aula temporario = new Aula(idAula,diaSemana, idDisciplina, idTurma, horasInicio, horaFim);
                resultados.add(temporario);
            }
            
        }catch(SQLException ex){
            System.out.println("Começo do erro na consulta de aulas");
            ex.printStackTrace();
            System.out.println("Fim do erro na consulta de aulas");
        }
        
        //Os valores que veem do BD seguem o primeiro horário de todos os dias, depois o segundo, etc.
        //No APP deve ser mostrado os valores somente do dia em que está sendo apresnetado, por isso deve ser organizado
        
        ArrayList<Aula> aulas = new ArrayList<>();
        for (int i=1; i<=resultados.size();i++){
            for(Aula organizadora : resultados){
                if (organizadora.getDiaSemana() == i){
                    aulas.add(organizadora);
                    
                }
            }
        }
        
        //Buscar os nomes das disciplinas no banco de dados
        //Criando uma única sql com todos os dados necessários
        String sqlDisciplinas = "SELECT * FROM Disciplina WHERE idDisciplina =";
        for(int i=0; i<aulas.size(); i++){
            if( i < aulas.size()-1){
                sqlDisciplinas += aulas.get(i).getIdDisciplina()+ " OR idDisciplina =";
            }
            else{
                sqlDisciplinas += aulas.get(i).getIdDisciplina();
            }
        }
        //Executando a SQL
        ArrayList<Disciplina> disciplinas = new ArrayList<>();
        
        try(Connection con = FabricaConexao.criaConexao()){
            PreparedStatement consulta = con.prepareStatement(sqlDisciplinas);
            ResultSet tuplas = consulta.executeQuery();
            
            while(tuplas.next()){
                Disciplina temp = new Disciplina(tuplas.getString("nome"), tuplas.getInt("idDisciplina"));
                disciplinas.add(temp);
            }
            
        }catch(SQLException ex){
            System.out.println("Começo do erro na consulta do nome das disciplinas");
            ex.printStackTrace();
            System.out.println("Fim do erro na consulta do nome das disciplinas");
        }
        //Salvando os nomes
        for(int i=0; i<aulas.size(); i++){
            for(Disciplina organizadora : disciplinas){
                if(organizadora.getId() == aulas.get(i).getIdDisciplina()){
                    aulas.get(i).setNomeDisciplina(organizadora.getNome());
                }
            }
            
        }
        
        return aulas;
        
    }
}
