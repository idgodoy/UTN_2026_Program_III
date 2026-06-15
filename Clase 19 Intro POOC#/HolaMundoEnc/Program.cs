using System;

namespace ClaseEvolutiva
{
    class Mensajero
    {
        // El dato real está oculto y protegido
   /*    public string Texto2 {get; set;}
         Texto2 será una PROPIEDAD que solo lee lo que contine un atributo y solo asigna value al atributo.
        */
        private string _texto;  //ATRIBUTO.
        public string Texto     // PROPIEDAD (permite acceder a los atributos private)
        {
            get { return _texto; }
            set 
            {   // Filtro de seguridad: si viene vacío, ponemos un valor por defecto
                if ( string.IsNullOrWhiteSpace(value) || string.IsNullOrEmpty(value) ) _texto = "Hola";
                else _texto = value;
            }
        }

        /* Constructor para inicializar el objeto:
            Utilizamos el método Mensajero SOBRECARGADO (un único nombre, diferentes 
            métodos según los parámetros que lleguen).
        */
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
            //Instancio unnOBJETO llamado miMensajero, pert. a la clase Mensajero.
            Mensajero miMensajero = new Mensajero();
            miMensajero.EnviarSaludo();  //Invoca al MÉTODO EnviarSaludo()

            // Prueba de encapsulamiento: intentamos romperlo mandando un vacío
            // miMensajero.Texto = "   "; 
            // miMensajero.EnviarSaludo(); // Va a decir "¡Hola, mundo!" gracias al filtro
        }
    }
}