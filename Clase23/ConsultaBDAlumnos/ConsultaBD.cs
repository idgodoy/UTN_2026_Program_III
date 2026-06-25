/*===============================================================================
PROGRAMACIÓN III Conexión Lineal a MySQL 
 
 ⚠️ Antes de correr el proyecto, se debe instalar el driver de MySQL.
 En VSCode ejecutar este comando por terminal:
 dotnet add package MySql.Data --source https://api.nuget.org/v3/index.json
En Visual Studio (Comunity, etc):
Ir a: Herramientas > Administrador de Paquetes NuGet > Administrar paquetes NuGet > MyDql.Data
===============================================================================*/
using System;
// Importamos los componentes del driver de MySQL.
using MySqlConnection = MySql.Data.MySqlClient.MySqlConnection;
using MySqlCommand = MySql.Data.MySqlClient.MySqlCommand;
using MySqlDataReader = MySql.Data.MySqlClient.MySqlDataReader;
using System.Diagnostics;
using System.Security.Cryptography.X509Certificates;

namespace ListaBDAlumnos
{
    class Program
    {
        public static bool Mostrar(string opcion, MySqlConnection conexion)
        {
            string consulta ="";
            bool salir = false;
            switch (opcion)
            {
                case "3": consulta = "SELECT legajo, nombre, apellido, email, carrera, turno FROM alumnos"; 
                          break;
                case "1": consulta ="SELECT legajo, nombre, apellido, email, carrera, turno FROM alumnos WHERE turno = 'noche'"; break;
                case "2": consulta ="SELECT legajo, nombre, apellido, email, carrera, turno FROM alumnos WHERE turno = 'mañana'"; break;
                case "0": return salir = true;
                default:  break;
            }

            using (MySqlCommand comando = new MySqlCommand(consulta, conexion))
            {
                using (MySqlDataReader lector = comando.ExecuteReader())
                {
                    Console.WriteLine("==========================================================================================================");
                    Console.WriteLine("                                           LISTADO DE ALUMNOS (LINEAL)                                    ");
                    Console.WriteLine("==========================================================================================================");
                    Console.WriteLine(string.Format("{0,-10} | {1,-12} | {2,-12} | {3,-32} | {4,-22} | {5,-8}", 
                    "Legajo", "Nombre", "Apellido", "Email", "Carrera", "Turno"));
                    Console.WriteLine("----------------------------------------------------------------------------------------------------------");

                          // Bloque iterativo: leemos fila por fila mientras el lector tenga datos
                    while (lector.Read())
                    {
                        string legajo = lector["legajo"].ToString()??"";
                        string nombre = lector["nombre"].ToString()??"";
                        string apellido = lector["apellido"].ToString()??"";
                        string email = lector["email"].ToString()??"";
                        string carrera = lector["carrera"].ToString()??"";
                        string turno = lector["turno"].ToString()??"";
                        Console.WriteLine(string.Format("{0,-10} | {1,-12} | {2,-12} | {3,-32} | {4,-22} | {5,-8}", 
                                   legajo, nombre, apellido, email, carrera, turno));
                                //Console.ReadLine();
                    }
                    Console.WriteLine("==========================================================================================================\n");
                          
                }
            }
            return salir;        
        }
        public static MySqlConnection CreaConexion()
        {
            string connectionString = "Server=127.0.0.1;Port=3306;Database=mibd;Uid=root;Pwd=root;";
            Console.WriteLine("Intentando conectar a la base de datos MySQL...");
            MySqlConnection conexion = new MySqlConnection(connectionString);
            return conexion;
        }
        
        
        static void Main(string[] args)
        {   
            bool salir = false;
            string opcion = "";
            // Cadena de conexión.
            
            // Abrimos la conexión asegurando el cierre de recursos con 'using'.
            using (MySqlConnection conexion = CreaConexion())
            { //conexion es un OJETO que prepara el canal TCP para conectar al servidor MySql.
                try
                {
                    conexion.Open(); //Aquí es dónde la conexión se abre. (Se cierra gracias a using)
                    // Biri Biri
                    Console.ForegroundColor = ConsoleColor.Green;
                    Console.WriteLine("¡Conexión exitosa al servidor de MySQL!\n");
                    Console.ResetColor();    
    
    
                    Mostrar("3", conexion); //Muestra Listado Completo.
                    while(!salir){
                    Console.WriteLine("Menú de Opciones");
                    Console.WriteLine("1. Mostrar alumnos turno noche");
                    Console.WriteLine("2. Mostrar alumnos turno mañana");
                    Console.WriteLine("\n0. Salir");
                    opcion = Console.ReadLine()??"";
                    salir = Mostrar(opcion, conexion);
                    }
                }
                catch (Exception ex)
                {
                    // Control de errores ante fallas de red, credenciales o servidor apagado
                    Console.ForegroundColor = ConsoleColor.Red;
                    Console.WriteLine("Ocurrió un error al intentar operar con la base de datos:");
                    Console.WriteLine(ex.Message);
                    Console.ResetColor();
                }
            }
 
            Console.WriteLine("Presione cualquier tecla para salir...");
            Console.ReadKey();
 
 
 
 
 
 
        }
    }
}