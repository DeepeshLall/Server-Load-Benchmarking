# server_client_management
This is a repository made for study and implemetation of server client connection improvement method.

Contents of the repository:-
1.) Apache benchmark and ping
    The file contains the required commands 
    Apache bench mark
	    ab -k -n 500000 -c 1025 http://127.0.0.1/
    Ping
	    sudo ping -n -w 12000 -l 67000 localhost
    The statistics are contained in the files named ping_statistics and apache_statistics.
    
2.) Server Client  
    This folder contains the codes and executables of activating chat-bot server and client server interaction.
    The commands are :
          ./echo_server 10000
    This command will start the server at the port number 10000
    Next, we need to get the IP of the server by running the command 
         netstat -atpn
    Finally we can start the client by running 
        ./client 0.0.0.0 10000
