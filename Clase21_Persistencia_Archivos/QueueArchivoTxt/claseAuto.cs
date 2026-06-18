using System.Dynamic;

public class Auto
{
    public string Patente { get; set; } //PROPIEDAD.
    public string TipoCombustible { get; set; } //PROPIEDAD.

    public Auto(string patente, string tipoCombustible)  //MÉTODO CONSTRUCTOR.
    {
        Patente = patente;
        TipoCombustible = tipoCombustible;
    }

    // Sobrescribimos ToString para facilitar el mostrado en lista
    public override string ToString()  // HERENCIA Y POLIMORFISMO.Sobrecargo (override) el méetodo ToString().
    {
        return $"Patente: {Patente} | Combustible: {TipoCombustible}";
    }
}