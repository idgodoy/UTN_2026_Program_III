using System;
using System.Collections.Generic;
using System.IO; // Para manejar archivos (File.Exists, File.WriteAllLines, File.ReadAllLines)

class Program
{
    // Cambiamos la extensión del archivo a .txt
    private static readonly string ArchivoTexto = "listaLavadero.txt"; //Ruta del archivo.
    // Definimos un delimitador claro para separar los atributos
    private static readonly char Delimitador = ';';

    static void Main(string[] args)
    {
        // Inicializamos la cola cargando los datos previos (si existen)
        Queue<Auto> filaAutos = CargarDatos();  // TIPO FIFO. Recibe datos del MÉTODO CargarDatos();
        bool salir = false;  // Bandera booleana para terminar la app.

        while (!salir)  //Cilco principal del programa.
        {
            Console.Clear();
            Console.WriteLine("=== ESTACIÓN DE SERVICIO (CON PERSISTENCIA TXT) ===");
            Console.WriteLine("1. Registrar llegada de auto (Encolar y Guardar)");
            Console.WriteLine("2. Atender auto (Desencolar y Guardar)");
            Console.WriteLine("3. Mostrar cantidad de autos en espera");
            Console.WriteLine("4. Mostrar lista de autos en espera");
            Console.WriteLine("5. Salir");
            Console.Write("Seleccione una opción: ");
            
            string opcion = Console.ReadLine()??"";

            switch (opcion)
            {
                case "1":
                    Console.Write("Ingrese la patente: ");
                    string patente = Console.ReadLine()??"";
                    Console.Write("Ingrese el tipo de combustible: ");
                    string combustible = Console.ReadLine()??"";
                    
                    Auto nuevoAuto = new Auto(patente, combustible);
                    filaAutos.Enqueue(nuevoAuto);
                    
                    // Guardamos el estado actual en el archivo
                    GuardarDatos(filaAutos);
                    Console.WriteLine("\nAuto registrado y guardado en TXT con éxito.");
                    break;

                case "2":
                    if (filaAutos.Count > 0)
                    {
                        Auto autoAtendido = filaAutos.Dequeue();
                        
                        // Como la cola cambió, actualizamos el archivo inmediatamente
                        GuardarDatos(filaAutos);
                        Console.WriteLine($"\nAtendiendo al auto -> {autoAtendido}");
                    }
                    else
                    {
                        Console.WriteLine("\nNo hay autos en la fila.");
                    }
                    break;

                case "3":
                    Console.WriteLine($"\nCantidad de autos esperando: {filaAutos.Count}");
                    break;

                case "4":
                    Console.WriteLine("\n--- Autos en espera ---");
                    if (filaAutos.Count == 0)
                    {
                        Console.WriteLine("La fila está vacía.");
                    }
                    else
                    {
                        foreach (var auto in filaAutos)
                        {
                            Console.WriteLine(auto);
                        }
                    }
                    break;

                case "5":
                    salir = true;
                    Console.WriteLine("\nSaliendo del sistema...");
                    break;

                default:
                    Console.WriteLine("\nOpción no válida.");
                    break;
            }

            if (!salir)
            {
                Console.WriteLine("\nPresione cualquier tecla para continuar...");
                Console.ReadKey();
            }
        }
    }

    // ==========================================
    // MÉTODOS DE PERSISTENCIA (TEXTO PLANO)
    // ==========================================

    private static void GuardarDatos(Queue<Auto> cola)
    {
        try
        {
            // Creamos una lista de strings donde cada elemento representa un auto formateado
            List<string> lineas = new List<string>();

            foreach (var auto in cola)
            {
                // Suponiendo que la clase Auto tiene las propiedades públicas Patente y Combustible.
                // Guardamos en formato: "AAA123;Nafta"
                lineas.Add($"{auto.Patente}{Delimitador}{auto.TipoCombustible}");
            }

            // Escribe todas las líneas de golpe, pisando el archivo anterior
            File.WriteAllLines(ArchivoTexto, lineas);
        }
        catch (Exception ex)
        {
            Console.WriteLine($"\nError al guardar los datos: {ex.Message}");
        }
    }
    /*==================================================================*/
    /* MÉTODO DE CLASE (Static), acceso Private, devuelve una COLA de elementos AUTO*/
    private static Queue<Auto> CargarDatos()
    {
        // Si el archivo no existe, devolvemos una cola vacía
        if (!File.Exists(ArchivoTexto))
        {
            return new Queue<Auto>();  //Si no existe listaLavadero.txt devuelvo una cola vacía.
        }

        Queue<Auto> colaCargada = new Queue<Auto>();

        try
        {
            // Leemos todas las líneas del archivo
            string[] lineas = File.ReadAllLines(ArchivoTexto);

            foreach (string linea in lineas)
            {
                // Evitamos procesar líneas vacías que puedan corromper el parseo
                if (!string.IsNullOrWhiteSpace(linea))
                {
                    // Separamos los datos usando el delimitador
                    string[] partes = linea.Split(Delimitador);

                    // Validamos que la línea tenga exactamente los dos componentes esperados
                    if (partes.Length == 2)
                    {
                        string patente = partes[0];
                        string combustible = partes[1];

                        Auto auto = new Auto(patente, combustible);
                        colaCargada.Enqueue(auto);  //Agrego Auto a la cola de autos.
                    }
                }
            }
            return colaCargada;  // Devuelvo la cola de autos ya cargada.
        }
        catch (Exception ex)
        {
            Console.WriteLine($"\nError al cargar el archivo de texto: {ex.Message}");
            Console.WriteLine("Se iniciará con una cola vacía. Presione una tecla para continuar...");
            Console.ReadKey();
        }

        return new Queue<Auto>();
    }
}