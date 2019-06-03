#include <stdio.h>
#include <stdlib.h>  /* For exit() function */
int main()
{
   char sentence[1000];
   FILE *fptr;

   fptr = fopen("login.csv", "w");

   
   for(int i = 0; i < 10 ; i++){
      fprintf(fptr,"ListPerson%d,password%d\n",i,i);
   }
   
   printf("The file is created.\n");

   fclose(fptr);

   return 0;
}