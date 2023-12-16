<?php

require '../../../../model/conexion.php';


class datosCamion
{


    private $conexion;

    public function __construct()
    {
        $this->conexion = new conexion();
    }


    public function traerDatosCamion()
    {


        $registros = $this->conexion->bd()->prepare("select * from camiones");
        $registros->execute();

        $registro = $registros->get_result();


        return $registro;
    }

    public function eliminarCamiones($idCamion)
    {

        $consulta = $this->conexion->bd()->prepare("delete from camiones where idCamion=?");
        $consulta->bind_param('i', $idCamion);
        $consulta->execute();


        return $consulta;
    }



    public function agregarCamion($matricula, $altura, $numRuedas, $peso)
    {

        $sentencia = $this->conexion->bd()->prepare("insert into camiones 
        (matricula,altura,numeroRuedas,peso) 
         values(?,?,?,?)");

        $sentencia->bind_param('sdid', $matricula, $altura, $numRuedas, $peso);

        $sentencia->execute();


        return $sentencia;
    }



    public function consultarMatriculaRepetida($matricula)
    {

        $consulta = $this->conexion->bd()->prepare("select * from camiones where matricula=?");
        $consulta->bind_param('s', $matricula);
        $consulta->execute();
        $registros = $consulta->get_result();

        $reg = $registros->fetch_array();

        return $reg;
    }

    public function traerVehiculos()
    {


        $consulta = $this->conexion->bd()->prepare("select * from vehiculos");
        $consulta->execute();
        $registros = $consulta->get_result();



        return $registros;
    }


    public function traerDatosVehiculosPorMatricula($matricula)
    {


        $consulta = $this->conexion->bd()->prepare("select * from vehiculos where matricula=?");
        $consulta->bind_param("s", $matricula);
        $consulta->execute();
        $registros = $consulta->get_result();
        $reg = $registros->fetch_array();


        return $reg;
    }

    public function datosCamion($idCamion)
    {


        $consulta = $this->conexion->bd()->prepare("select * from vehiculos where idCamion=?");
        $consulta->bind_param("i", $idCamion);
        $consulta->execute();
        $registros = $consulta->get_result();
        $reg = $registros->fetch_array();


        return $reg;
    }
}
