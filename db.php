<?php
class db{
protected $connection;

function setconnection(){
    try{
        // Development connection
        // $this->connection=new PDO("mysql:host=localhost; dbname=library_managment","root","");

        // Remote database connection
        $this->connection=new PDO("mysql:host=remotemysql.com; dbname=Egqi5VWYI2","Egqi5VWYI2","8782gwAt1W");
        
        // echo "Done";
    }catch(PDOException $e){
        echo "Error";
        //die();

    }
}

}
