<?php


require '../../../model/conexion.php';

class almacen
{

    private $conexion;

    public function __construct()
    {

        $this->conexion = new conexion();
    }




    public function traerAlmacenes()
    {


        $registros = $this->conexion->bd()->prepare("select * from almacenes");
        $registros->execute();

        $registro = $registros->get_result();


        return $registro;
    }

    public function almacenPorNumero($numAlmacen)
    {


        $registros = $this->conexion->bd()->prepare("select * from almacenes where numAlmacen=?");
        $registros->bind_param("i",$numAlmacen);
        $registros->execute();

        $registro = $registros->get_result();

       
        return $registro;
    }

    public function paquetesDelAlmacen($numAlmacen)
    {


        $registros = $this->conexion->bd()->prepare("select * from paquete where numAlmacen=?");
        $registros->bind_param("i",$numAlmacen);
        $registros->execute();

        $registro = $registros->get_result();

       
        return $registro;
    }

    public function detallesPaquete($idPaquete)
    {


        $registros = $this->conexion->bd()->prepare("select * from paquete where idPaquete=?");
        $registros->bind_param("i",$idPaquete);
        $registros->execute();

        $registro = $registros->get_result();

       
        return $registro;
    }

    public function choferCamion($matriculaCamion){

        
        $sentencia = $this->conexion->bd()->prepare("select * from chofercamion where matriculaCamion=?");
        $sentencia->bind_param("s", $matriculaCamion);
        $sentencia->execute();
        $resultado = $sentencia->get_result();

        $registros = $resultado->fetch_array();

        return $registros;



    }

    
    public function cliente($idCliente){

        
        $sentencia = $this->conexion->bd()->prepare("select * from clientecrecom where idCliente=?");
        $sentencia->bind_param("i", $idCliente);
        $sentencia->execute();
        $resultado = $sentencia->get_result();

        

        return $resultado;



    }

}
