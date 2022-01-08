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
import modelo.Aluno;


/**
 *
 * @author Matheus Peixoto e Pedro Arthur
 */
public class AlunosDAO {
    
    
    public static ArrayList<Aluno> alunosDoResponsavel(int idResponsavel){
        
        String sql = "SELECT * FROM Aluno WHERE Responsavel_id="+idResponsavel;
        ArrayList<Aluno> alunos = new ArrayList<>();
        
        try(Connection con = FabricaConexao.criaConexao()){
            
            PreparedStatement consulta = con.prepareStatement(sql);
            ResultSet tuplas = consulta.executeQuery();
            
            while(tuplas.next()){
                int matricula = tuplas.getInt("matricula");
                String nome = tuplas.getString("nome");
                int turma = tuplas.getInt("Turma_idTurma");

                                                                     //Pegar o nome da turma para não ficar somente o ID
                Aluno temporario = new Aluno(nome, turma, matricula, TurmaDAO.nomeTurma(turma));
                alunos.add(temporario);
            }
            
        }catch(SQLException ex){
            System.out.println("Começo do erro na consulta dos alunos do responsável");
            ex.printStackTrace();
            System.out.println("Fim do erro na consulta dos alunos do responsável");
        }
        
        
        
        return alunos;
    }
}
