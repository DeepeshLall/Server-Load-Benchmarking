# Server-Load-Benchmarking-And-Optimizability.
<pre>
This is a repository made for study and implemetation of server client connection improvement method.<br/>
Contents of the repository:-<br/>
1.) Apache benchmark and ping<br/>
    The file contains the required commands<br/>
    Apache bench mark<br/>
	    ab -k -n 500000 -c 1025 http://127.0.0.1/<br/>
    Ping<br/>
	    sudo ping -n -w 12000 -l 67000 localhost<br/>
    The statistics are contained in the files named ping_statistics and apache_statistics.<br/>
    
2.) Server Client<br/>
    This folder contains the codes and executables of activating chat-bot server and client server interaction.<br/>
    The commands are :<br/>
          ./echo_server 10000<br/>
    This command will start the server at the port number 10000<br/>
    Next, we need to get the IP of the server by running the command <br/>
         netstat -atpn<br/>
    Finally we can start the client by running <br/>
        ./client 0.0.0.0 10000<br/>
</pre>
