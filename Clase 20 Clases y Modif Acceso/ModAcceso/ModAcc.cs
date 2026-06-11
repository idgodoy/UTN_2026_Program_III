using System;
namespace ModAcc
{
    class Auto
    {
        private string _color = "Amarillo";  // _color es un Atributo privado
        // Opción1: Método seter y geter
        public void SetColor( string color){  // Método Público (setter)
             _color = color; 
             }
        public string GetColor()
        {
            return _color;
        }
        //Opción 2: Usar un Método CONSTRUCTOR (se dispara con "new").
        public Auto (string color)
        {   
            if( string.IsNullOrWhiteSpace(color) || string.IsNullOrEmpty(color)) color = "GRIS";
            _color = color;
        }
        public Auto ()  // SOBRECARGAR EL MÉTODO CONSTRUCTOR
        {
            _color = "GRIS CLARITO";
        }
        public Auto (int num)  // SOBRECARGAR EL MÉTODO CONSTRUCTOR
        {
            _color = "UN Número no es un color";
        }
        // Opción 3: Usar PROPIEDADES
        public string Color     // PROPIEDAD (permite acceder a los atributos private)
                {
                    get { return _color; }
                    set 
                    {   // Filtro de seguridad: si viene vacío, ponemos un valor por defecto
                        if ( string.IsNullOrWhiteSpace(value) || string.IsNullOrEmpty(value) ) _color = "Gris muy clarito";
                        else _color = value;
                    }
                }
        public string ColorDirecto {get; set;}
    }
    class Program{ 
        static void Main(string[] args)
        {   
           Auto miAuto = new Auto("NEGRO");   
           Console.WriteLine("Auto fue instanciado como " + miAuto.GetColor());     // get
           miAuto.SetColor("Rosa");              // set
           Console.WriteLine("Auto ahora es (usé el método) " + miAuto.GetColor());     // get
           miAuto.Color = "Blanco";
           Console.WriteLine("Auto y ahora es (propiedad) " + miAuto.Color);     // get
           miAuto.ColorDirecto = "AZUL";
           Console.WriteLine("ColorDirecto " + miAuto.ColorDirecto);
           Console.WriteLine("Auto y ahora es (propiedad Color) " + miAuto.Color);     // get
           Console.WriteLine("Usando GetColor() da  " + miAuto.GetColor());     // get

        }
    }
}   
