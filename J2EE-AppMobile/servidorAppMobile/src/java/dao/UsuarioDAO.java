/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package dao;

import ferramentas.CriptografarSenha;
import ferramentas.FabricaConexao;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import javax.swing.JOptionPane;
import modelo.Usuario;

/**
 *
 * @author Matheus Peixoto e Pedro Arthur
 */
public class UsuarioDAO {
    
    public static Usuario loginUsuario(String matriculaEmail, String senha, String tabela){
        senha = CriptografarSenha.criptografar(senha); // Criptografar a senha para verificar com o banco
        String sql;
        if(tabela.equals("Aluno")){
            sql = "SELECT * FROM "+tabela+" WHERE matricula ="+matriculaEmail+" AND senha = '"+senha+"'";
        }
        else{
            sql = "SELECT * FROM "+tabela+" WHERE email = '"+matriculaEmail+"' AND senha = '"+senha+"'";
        }
        
        
        Usuario temp = null;
        
        try(Connection con = FabricaConexao.criaConexao()){
                        
            PreparedStatement trans = con.prepareStatement(sql);            
            
            ResultSet tuplas = trans.executeQuery();
            
            while(tuplas.next()){
                //Verfica s eo usuário pe um aluno
                if(tabela.equals("Aluno")){
                    String nome = tuplas.getString("nome");
                    String matricula = tuplas.getString("matricula");
                    int turma = tuplas.getInt("Turma_idTurma");
                    int senhaAlterada = tuplas.getInt("senhaAlterada");

                    //String nome, String emailMatricula, String senha, String nomeTurma, boolean aluno, int id, int idTurma
                    temp = new Usuario(nome, matricula, TurmaDAO.nomeTurma(turma), true, Integer.parseInt(matricula), turma, senhaAlterada);
                }
                else{
                    String nome = tuplas.getString("nome");
                    String email = tuplas.getString("email");
                    int id = tuplas.getInt("id");
                    int senhaAlterada = tuplas.getInt("senhaAlterada");
                    //String nome, String emailMatricula, String senha, boolean aluno, int id, int idTurma
                    temp = new Usuario(nome, email, null, false, id, 0, senhaAlterada);
                }
                                
            }      
        }catch(SQLException ex){
            System.err.println("Erro de execução na consulta de usuário");
            ex.printStackTrace();
        }
        return temp;
    }
    
    public static int alterarSenha (String senhaAntiga, String senhaNova, String matriculaEmail, boolean aluno){
        
        //Return: 1 -Sucesso || 2 - Senhas incompatíveis || 3 -Erro do SQL
        
        senhaAntiga = CriptografarSenha.criptografar(senhaAntiga);
        senhaNova = CriptografarSenha.criptografar(senhaNova);
        String sql ="";
        
        //Criando dois SELECT diferentes, um para aluno e um para responsavel 
        //Pesquisar no banco se a senha corresponde àquela informada
        if(aluno){
            sql = "SELECT senha FROM Aluno WHERE matricula='"+matriculaEmail+"' AND senha='"+senhaAntiga+"'";
        }
        else{
            sql = "SELECT senha FROM Responsavel WHERE email='"+matriculaEmail+"' AND senha='"+senhaAntiga+"'";
        }
        //Procurando no banco a senha atual do usuário
        try(Connection con = FabricaConexao.criaConexao()){
            PreparedStatement ps = con.prepareStatement(sql);
            ResultSet rs = ps.executeQuery();
            
            String senhaNoBanco=null;
            while(rs.next()){
                senhaNoBanco = rs.getString("senha");
            }
            if(senhaNoBanco == null){
                return 2;
            }
            
            //Atualizar senha 
            if(aluno){
                sql = "UPDATE Aluno SET senhaAlterada= 1, senha='"+senhaNova+"' WHERE matricula='"+matriculaEmail+"'";
            }
            else{
                sql = "UPDATE Responsavel SET senhaAlterada= 1, senha='"+senhaNova+"' WHERE email='"+matriculaEmail+"'";
            }
            
            ps = con.prepareStatement(sql);
            ps.executeUpdate();
            
            return 1;
            
        }catch(SQLException ex){
            ex.printStackTrace();
            return 3;
        }        
        
    }
    
}
