package objetos;

public class Aula {
    private int idAula, diaSemana, idDisciplina, idTurma;
    private String horasInicio, horaFim;

    public Aula(int idAula, int diaSemana, int idDisciplina, int idTurma, String horasInicio, String horaFim) {
        this.idAula = idAula;
        this.diaSemana = diaSemana;
        this.idDisciplina = idDisciplina;
        this.idTurma = idTurma;
        this.horasInicio = horasInicio;
        this.horaFim = horaFim;
    }

    public int getIdAula() {
        return idAula;
    }

    public int getDiaSemana() {
        return diaSemana;
    }

    public int getIdDisciplina() {
        return idDisciplina;
    }

    public int getIdTurma() {
        return idTurma;
    }

    public String getHorasInicio() {
        return horasInicio;
    }

    public String getHoraFim() {
        return horaFim;
    }
}
