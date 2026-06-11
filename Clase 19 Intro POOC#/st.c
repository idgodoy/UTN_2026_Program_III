#include <stdio.h>



void muestranombre(struct alumno *);

struct alumno {     //DEFINR LA CLASE
    char nombre[50];   //ATRIBUTOS
    char apellido[50];
    char email[50];
    int legajo;
    void (*muestraNombre)(struct alumno *)=muestranombre;  // METODOS
};

struct alumno JuanPerez;   //INSTANCIAR UN OBJETO.

void muestranombre(struct alumno *p){
    printf("%s", p.nombre);

}

int main (int argc, char ** argv){
    strcpy(JuanPerez.nombre, "Juan");
    strcpy(JuanPerez.apellido, "Perez");
    strcpy(JuanPerez.email,"jperez@f.com");
    JuanPerez.legajo = 100;
    
    printf("struct alumno acupa %d bytes \n", sizeof(struct alumno));
    printf("JuanPerez est%c en  %p", 160, JuanPerez);
    JuanPerez.muestraNombre(JuanPerez);    
    
        return 0;
}