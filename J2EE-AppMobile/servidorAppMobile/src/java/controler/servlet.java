/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/JSP_Servlet/Servlet.java to edit this template
 */
package controler;

import dao.TurmaDAO;
import ferramentas.FabricaConexao;
import java.io.IOException;
import java.io.PrintWriter;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Timestamp;
import java.util.Vector;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import modelo.Aluno;

/**
 *
 * @author Matheus Peixoto e Pedro Arthur
 */
public class servlet extends HttpServlet {

    /**
     * Processes requests for both HTTP <code>GET</code> and <code>POST</code>
     * methods.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.setContentType("text/html;charset=UTF-8");
        try (PrintWriter out = response.getWriter()) {
            /* TODO output your page here. You may use following sample code. */
            
            Connection com = FabricaConexao.criaConexao();
            
            
            out.println("<!DOCTYPE html>");
            out.println("<html>");
            out.println("<head>");
            out.println("<title>Servlet SERVLEEEEEET</title>");            
            out.println("</head>");
            out.println("<body>");
            
            try {
                if(com!=null && !com.isClosed()){
                    out.println("<h1>Sucesso</h1>");
                }
                else{
                     out.println("<h1>Erro</h1>");
                }
            } catch (SQLException ex) {
                Logger.getLogger(servlet.class.getName()).log(Level.SEVERE, null, ex);
            }
            
            
            
        Vector<Aluno> resultado = new Vector<>();
        String sql = "SELECT * FROM Aluno";
        Aluno temp = null;
        
        try(Connection con = FabricaConexao.criaConexao()){
                        
            PreparedStatement ps = con.prepareStatement("SELECT * FROM Aluno");
            
            ResultSet tuplas = ps.executeQuery();
            
            while(tuplas.next()){
                //String nome, String amtricula, String senha, int turma, int responsavel)
                String nome = tuplas.getString("nome");
                int matricula = tuplas.getInt("matricula");
                String senha = tuplas.getString("senha");
                int turma = tuplas.getInt("Turma_idTurma");
                int responsavel = tuplas.getInt("Responsavel_id");
                                
                temp = new Aluno(nome, matricula, turma, TurmaDAO.nomeTurma(turma));
                
                out.println("<br>");
                out.println(temp.toString());
                out.println("<br>");
            }            
        }catch(SQLException ex){
            System.err.println("Erro de execução na consulta de usuário");
        }
            
            
            
            
            out.println("</body>");
            out.println("</html>");
        }
    }

    // <editor-fold defaultstate="collapsed" desc="HttpServlet methods. Click on the + sign on the left to edit the code.">
    /**
     * Handles the HTTP <code>GET</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }

    /**
     * Handles the HTTP <code>POST</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }

    /**
     * Returns a short description of the servlet.
     *
     * @return a String containing servlet description
     */
    @Override
    public String getServletInfo() {
        return "Short description";
    }// </editor-fold>

}
