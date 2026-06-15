// Clase Base (Padre)
public class Empleado
{
    public string Nombre { get; set; }
    public decimal SueldoBase { get; set; }

    // Constructor del padre
    public Empleado(string nombre, decimal sueldoBase)
    {
        Nombre = nombre;
        SueldoBase = sueldoBase;
    }

    public virtual decimal CalcularSueldo()
    {
        return SueldoBase;
    }
}

// Clase Hija
public class Gerente : Empleado
{
    public decimal Bono { get; set; }

    // Usamos 'base' para pasarle el nombre y el sueldo al constructor de Empleado
    public Gerente(string nombre, decimal sueldoBase, decimal bono) 
        : base(nombre, sueldoBase) 
    {
        // Solo nos ocupamos de lo que es propio del Gerente
        Bono = bono; 
    }
}