using System;

namespace ClaseEvolutiva
{
    class Mensajero
    {
        // El dato real está oculto y protegido

        public string Texto2 {get; set;}
        /*
        Texto2 será una PROPIEDAD que solo lee lo que contine un atributo y solo asigna value al atributo.
        */


        private string _texto;

        public string Texto
        {
            get { return _texto; }
            set 
            {  // _texto = value;
                // Filtro de seguridad: si viene vacío, ponemos un valor por defecto
                if ( string.IsNullOrWhiteSpace(value) || string.IsNullOrEmpty(value) ) _texto = "Hola";
                else _texto = value;
            }
        }

        // Constructor para inicializar el objeto
        public Mensajero(string textoInicial)
        {
            Texto = textoInicial;
        }
        public Mensajero(int elGilipollasPusoUnInt)
        {
            Texto = "Hola";
        }
        public Mensajero()
        {
            Texto = "Hola sin argumentos";
        }



        // Método de instancia común
        public void EnviarSaludo()
        {
            Console.WriteLine($"¡{Texto}, mundo!");
        }
    }

    class Program
    {
        static void Main(string[] args)
        {
            Mensajero miMensajero = new Mensajero();
            miMensajero.EnviarSaludo();

            // Prueba de encapsulamiento: intentamos romperlo mandando un vacío
            // miMensajero.Texto = "   "; 
            // miMensajero.EnviarSaludo(); // Va a decir "¡Hola, mundo!" gracias al filtro
        }
    }
}