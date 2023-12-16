<?php

require "../../model/conexion.php";

class paquete
{


    private $conexion;

    public function __construct()
    {
        $this->conexion = new conexion();
    }


    public function getPaquetesPorCliente($idCliente)
    {

        $sentencia = $this->conexion->bd()->prepare("select * from paquete where idCliente=?");
        $sentencia->bind_param("i", $idCliente);
        $sentencia->execute();

        $registros = $sentencia->get_result();

        return $registros;
    }

    public function detallesPaquete($idPaquete)
    {

        $sentencia = $this->conexion->bd()->prepare("select * from paquete where idPaquete=?");
        $sentencia->bind_param("i", $idPaquete);
        $sentencia->execute();

        $registros = $sentencia->get_result();

        return $registros;
    }

    public function almacen($numAlmacen)
    {

        $sentencia = $this->conexion->bd()->prepare("select * from almacenes where numAlmacen=?");
        $sentencia->bind_param("i", $numAlmacen);
        $sentencia->execute();

        $registros = $sentencia->get_result();

        return $registros;
    }

    public function getPaquetePorCodigo($codigo)
    {

        $sentencia = $this->conexion->bd()->prepare("select * from paquete where codigoRastreo=?");
        $sentencia->bind_param("s", $codigo);
        $sentencia->execute();

        $resultado = $sentencia->get_result();

        $registros = $resultado->fetch_array();
        return $registros;
    }

    
    public function getChofer($matriculaCamion)
    {

        $sentencia = $this->conexion->bd()->prepare("select * from chofercamion where matriculaCamion=?");
        $sentencia->bind_param("s", $matriculaCamion);
        $sentencia->execute();

        $resultado = $sentencia->get_result();

        $registros = $resultado->fetch_array();
        return $registros;
    }

}

