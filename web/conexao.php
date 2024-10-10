<?php

class Conexao
{
    protected function conectaBD(){
        try{
            $con = new PDO("mysql:host=localhost;dbname=crud", "root", "root");
            return $con;
        }catch(PDOException $error){
            return $error->getMessage();
        }
    }
}