#include <stdio.h>
#include <stdlib.h>  /* For exit() function */
int main()
{
   char sentence[30000];
   FILE *fptr;

   fptr = fopen("user_1000.csv", "w");


   for(int i = 0; i < 1000 ; i++){
      fprintf(fptr,"1\n");
   }

   printf("The file is created.\n");

   fclose(fptr);

   return 0;
}
