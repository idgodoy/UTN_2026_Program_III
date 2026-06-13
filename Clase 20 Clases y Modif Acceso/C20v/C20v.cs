using System;
using System.Reflection.Metadata.Ecma335;

namespace C20v
{
    class Auto
    {
        private string _color = ""; //Atributo PRIVADO.
       // private string Marca = "";
        /*FORMAS DE ACCEDER AL ATRIBUTO _color PRIVADO.*/
        /* 1) Mediante método ( "setter" y "getter")*/
        public string GetColor(){ return _color;} //GETTER
        public void SetColor( string color){ _color = color;} //SETTER
        /* 2) Mediante Método constructor */
        public Auto (string color)
        {
            _color = color;
        }
        public Auto ()
        {
            _color = "ROJO (default)";
        }
      /* 3) Mediante PROPIEDADES*/
        public string Color { 
            get{ return _color;}
            set{ 
                if( string.IsNullOrEmpty(value) ) _color = "ROJO (defecto)"; 
                else _color = value;} 
        }
      /* 3.B) Mediante atributos autoimplementados*/
        public string Marca { get; set;}



        public string TocaBocina(){ return "Tuuuuuu"; }
    }


    class Program
    {
     
        static void Main(string[] args) //Método MAIN pert. a la clase Program.
        {   
            Auto miAuto1 = new Auto("ROJO");
            Auto miAuto2 = new Auto();
            Moto miMoto = new Moto();
           Console.WriteLine("\n=======================================");
           Console.WriteLine("Auto 1 Color Original: " + miAuto1.GetColor());//Accedo a atributos Públicos.
      
           miAuto1.SetColor("BLANCO");
           Console.WriteLine("Auto 1 Color Actual: " + miAuto1.GetColor());//Accedo a atributos Públicos.
           miAuto1.Color = "VERDE";
           Console.WriteLine("Auto 1 Color Actual (Propiedad): " + miAuto1.Color);
           Console.WriteLine("Auto 2 color: " + miAuto2.GetColor());
            miAuto1.Marca = "FORD";
           Console.WriteLine("Auto 1 Marca: " + miAuto1.Marca);
           Console.WriteLine("Pulse alguna tecla para finalizar."); 
           Console.ReadLine();
        }
          
    }
} 