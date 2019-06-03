#include <stdio.h>
#include <stdlib.h>  /* For exit() function */
int main()
{
   char sentence[1000];
   FILE *fptr;

   fptr = fopen("program2.csv", "w");
   
   for(int i = 0; i < 1000 ; i++){
      fprintf(fptr,"List3Person%d,mailme%d@gmail.com,password%d,password%d,%d,M,123456825%d,Address%d\n",i,i,i,i,i%10+1,i,i);
   }
   
   printf("The file is created.\n");

   fclose(fptr);

   return 0;
}