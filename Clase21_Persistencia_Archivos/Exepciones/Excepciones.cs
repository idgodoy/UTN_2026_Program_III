using System;

namespace MyApplication
{
  class Program
  {
    static void Main(string[] args)
    {
     int[] myNumbers = {1, 2, 3};
     int valor;
     try
     {
     	valor = myNumbers[456];
        Console.WriteLine("valor: " + valor);
      }
     catch (Exception e)
     {
//        Console.WriteLine(e.Message);
		valor = myNumbers[0];
        Console.WriteLine("Indice incorrecto. Asigna Valor por defecto\n");
     }    
      
      Console.Write("El programa continua ");
      Console.WriteLine("con valor = " + valor);
    }
  }
}