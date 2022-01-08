/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package ferramentas;

import java.sql.Connection;
import java.sql.SQLException;
import javax.naming.Context;
import javax.naming.InitialContext;
import javax.naming.NamingException;
import javax.sql.DataSource;

/**
 *
 * @author Matheus Peixoto e Pedro Arthur
 */
public class FabricaConexao {
    private static Connection con;

    public static Connection criaConexao(){
        
        try{
            
            if(con != null && !con.isClosed()){
                return con;
            }
            
            Context contexto = new InitialContext();
            
            if(contexto == null){
                System.err.println("Erro de configuração no netbeans");
            }
            else{
                Context envContext = (Context) contexto.lookup("java:comp/env");
                DataSource ds = (DataSource) envContext.lookup("jdbc/presencaescolar");
                
                if(ds != null){
                    con = ds.getConnection();
                }
            }
            
        }catch(NamingException ex){
            System.err.println("Não existe o dataSource requisitado");
            ex.printStackTrace();
        }catch(SQLException ex){
            System.err.println("erro ao estabelecer conexão com o banco de dados");
        }
        
        return con;
        
    }
}
