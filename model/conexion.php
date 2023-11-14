<?php

class conexion{

private $conexion;
    public function bd(){
        $this->conexion = new mysqli('localhost','root','','php');  

       return $this->conexion;
    }

}

?>