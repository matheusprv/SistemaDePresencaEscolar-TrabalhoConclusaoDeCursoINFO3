/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/JSP_Servlet/Servlet.java to edit this template
 */
package controler;

import dao.UsuarioDAO;
import ferramentas.Resposta;
import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import modelo.Usuario;

/**
 *
 * @author Matheus Peixoto e Pedro Arthur
 */
public class usuarioServlet extends HttpServlet {

    static String nomeDoServlet = "/user";
    /**
     * Processes requests for both HTTP <code>GET</code> and <code>POST</code>
     * methods.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    private void loginAluno(HttpServletRequest request, PrintWriter out){
        String matricula = request.getParameter("matricula");
        String senha = request.getParameter("senha");
        
        if(matricula == null || senha == null){
            out.println(new Resposta(403, "Para Login é necessário informar email e senha"));
        }
        else{
            Usuario temp =  UsuarioDAO.loginUsuario(matricula, senha, "Aluno");
            if(temp == null){
                out.println(new Resposta(404, "Usuário não cadastrado ou encontrado"));
            }else{
                out.println(new Resposta(200, temp));
            }
        }
    }
    
    private void loginResponsavel(HttpServletRequest request, PrintWriter out){
        String email = request.getParameter("email");
        String senha = request.getParameter("senha");
        
        if(email == null || senha == null){
            out.println(new Resposta(403, "Para Login é necessário informar email e senha"));
        }
        else{
            Usuario temp =  UsuarioDAO.loginUsuario(email, senha, "Responsavel");
            if(temp == null){
                out.println(new Resposta(404, "Usuário não cadastrado ou encontrado"));
            }else{
                out.println(new Resposta(200, temp));
            }
        }
    }
    
    
    private void atualizaUser(HttpServletRequest request, PrintWriter out){
        
        String senhaAntiga = request.getParameter("senhaAntiga");
        String senhaNova = request.getParameter("senhaNova");
        String matriculaEmail = request.getParameter("matriculaEmail");
        boolean aluno = Boolean.parseBoolean(request.getParameter("aluno"));
        
        int resposta = UsuarioDAO.alterarSenha(senhaAntiga, senhaNova, matriculaEmail, aluno);
        
        //Return: 1 -Sucesso || 2 - Senhas incompatíveis || 3 -Erro do SQL
        if(resposta == 1){
            out.println(new Resposta(200, "Senha alterada com sucesso"));
        }
        else if(resposta == 2){
            out.println(new Resposta(404, "Senhas atual incorreta"));
        }
        else{
            out.println(new Resposta(400, "Erro na alteração da senha"));
        }
        
    }
    
    
    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.setContentType("text/html;charset=UTF-8");
        try (PrintWriter out = response.getWriter()) {
            
            String servico = request.getParameter("servico");
            
            if(servico==null){
                //temos que enviar uma mensagem dizendo que o serviço não foi especificado
                out.println("Serviço não especificado");
            }
            else{
                switch(servico){
                    case "loginAluno":{
                        loginAluno(request, out);
                    }break;
                    case "loginResponsavel":{
                        loginResponsavel(request, out);
                    }break;
                    case "atualizacao":{
                        atualizaUser(request, out);
                    }break;
                    default:{
                        out.println("Serviço não disponivel para o usuario");
                    }
                }
            }
            
            
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
