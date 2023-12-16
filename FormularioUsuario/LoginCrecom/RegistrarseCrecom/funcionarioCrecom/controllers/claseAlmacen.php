<?php

require "../../../../../model/conexion.php";

class almacen
{


    private $conexion;

    public function __construct()
    {
        $this->conexion = new conexion();
    }

    //registrado


    
    public function getPaquetesArmados($estado)
    {


        $consulta = $this->conexion->bd()->prepare("select * from paquete where estado!=?");
        $consulta->bind_param('s',$estado);
        
        $consulta->execute();

        $registro = $consulta->get_result();


        return $registro;
    }
    public function getHistorialPaquetes()
    {


        $consulta = $this->conexion->bd()->prepare("select * from paquete");
  
        $consulta->execute();

        $registro = $consulta->get_result();


        return $registro;
    }

    public function getPaquetesPendientes($estado)
    {


        $consulta = $this->conexion->bd()->prepare("select * from paquete where estado=?");
        $consulta->bind_param('s',$estado);
    
        $consulta->execute();
        $registro = $consulta->get_result();

        return $registro;

        
    }


    public function eliminarPaquete($idPaquete,$estado)
    {

        $sentencia = $this->conexion->bd()->prepare("update paquete set estado=?,fechaEntrega=null,
        codigoRastreo=null,matriculaCamion=null where idPaquete=?");
        $sentencia->bind_param('si', $estado,$idPaquete);
        $sentencia->execute();


        return $sentencia;
    }

    public function agregarPaquete($nombre,$estado,$numAlmacen,$matriculaCamion, 
    $destino, $fechaEntrega, $codigoRastreo,$idPaquete)
    {
             
         
        $sentencia = $this->conexion->bd()->prepare("update paquete set nombre=?,estado=?,numAlmacen=?,
         matriculaCamion=?,destino=?,fechaEntrega=?,codigoRastreo=? where idPaquete=?");
        $sentencia->bind_param('ssissssi', $nombre,$estado,$numAlmacen,$matriculaCamion,
        $destino, $fechaEntrega, $codigoRastreo,$idPaquete);
        $sentencia->execute();

        return $sentencia;
    }

    public function modificarPaquete($nombre,$estado,$numAlmacen,$matriculaCamion,
     $destino, $fechaEntrega, $idPaquete)
    {


        $sentencia = $this->conexion->bd()->prepare("update paquete set nombre=?,estado=?,numAlmacen=?,
        matriculaCamion=?,destino=?,fechaEntrega=? where idPaquete=?");
        $sentencia->bind_param('ssisssi', $nombre,$estado,$numAlmacen,$matriculaCamion,$destino,
        $fechaEntrega, $idPaquete);
        $sentencia->execute();

        return $sentencia;
    }

public function codigoRastreoRepetido($codigoRastreo){

    
        $consulta = $this->conexion->bd()->prepare("select * from paquete where codigoRastreo=?");
        $consulta->bind_param('s', $codigoRastreo);
        $consulta->execute();

        $consulta->execute();

        $resultado = $consulta->get_result();

        $registro=$resultado->fetch_array();

        return $registro;
    


}

public function buscarAlmacenPorNumero($numAlmacen){


    
    $consulta = $this->conexion->bd()->prepare("select * from almacenes where numAlmacen=?");
    $consulta->bind_param('i', $numAlmacen);
    $consulta->execute();

    $consulta->execute();

    $resultado = $consulta->get_result();

    $registro=$resultado->fetch_array();

    return $registro;
}

public function getDatosCliente($idCliente){

 
    $consulta = $this->conexion->bd()->prepare("select * from clientecrecom where idCliente=?");
    $consulta->bind_param('i', $idCliente);
    $consulta->execute();

    $consulta->execute();

    $resultado = $consulta->get_result();

    $registro=$resultado->fetch_array();

    return $registro;

}

public function getDatosPaquete($idPaquete){

 
    $consulta = $this->conexion->bd()->prepare("select * from paquete where idPaquete=?");
    $consulta->bind_param('i', $idPaquete);
    $consulta->execute();

    $consulta->execute();

    $resultado = $consulta->get_result();

    $registro=$resultado->fetch_array();

    return $registro;

}


}
