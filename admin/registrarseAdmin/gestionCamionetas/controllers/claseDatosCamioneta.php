<?php

require '../../../../model/conexion.php';



class datosCamioneta
{


    private $conexion;

    public function __construct()
    {
        $this->conexion = new conexion();
    }


    public function traerDatosCamioneta()
    {


        $registros = $this->conexion->bd()->prepare("select * from camionetas");
        $registros->execute();

        $registro = $registros->get_result();


        return $registro;
    }

    public function eliminarCamioneta($matricula)
    {

        $consulta = $this->conexion->bd()->prepare("delete from camionetas where matricula=?");
        $consulta->bind_param('s', $matricula);
        $consulta->execute();


        return $consulta;
    }


    public function agregarCamioneta($matricula)
    {

        $sentencia = $this->conexion->bd()->prepare("insert into camionetas (matricula) 
         values(?)");

        $sentencia->bind_param('s', $matricula);

        $sentencia->execute();


        return $sentencia;
    }



    public function consultarMatriculaRepetida($matricula)
    {

        $consulta = $this->conexion->bd()->prepare("select * from camionetas where matricula=?");
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
}
