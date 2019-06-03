#include <stdio.h>
#include <stdlib.h>  /* For exit() function */
int main()
{
   char sentence[1000];
   FILE *fptr;

   fptr = fopen("login1.csv", "w");

   
   for(int i = 0; i < 100 ; i++){
      fprintf(fptr,"List1Person%d,password%d\n",i,i);
   }
   
   printf("The file is created.\n");

   fclose(fptr);

   return 0;
}