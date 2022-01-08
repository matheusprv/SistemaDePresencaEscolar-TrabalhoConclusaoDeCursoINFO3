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

/**
 *
 * @author Matheus Peixoto e Pedro Arthur
 */
public class TurmaDAO {
        public static String nomeTurma(int idTurma){
        String sql = "SELECT nome FROM Turma WHERE idTurma="+idTurma;
        
        String nome =null;
        
        try(Connection con = FabricaConexao.criaConexao()){
            
            PreparedStatement consulta = con.prepareStatement(sql);
            ResultSet tuplas = consulta.executeQuery();
            
            while(tuplas.next()){
                nome = tuplas.getString("nome");
                
            }
            
        }catch(SQLException ex){
            System.out.println("Começo do erro na consulta de aulas");
            ex.printStackTrace();
            System.out.println("Fim do erro na consulta de aulas");
        }
        
        return nome;
    }
}
