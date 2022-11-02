<?php
//variables for a host name, user name, password, and database name   
        $hostname = "geogws003.ad.umd.edu";              
        $username = "cjycathy";             
        $pwd = "user1#db";              
        $dbname = "cjycathy";

    //make a connection to the MySQL server            
        $con= mysqli_connect($hostname, $username, $pwd, $dbname);

        if(!$con){
            die("Database connection error".mysqli_connect_error());
        }
  
?> 

