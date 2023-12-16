<?php

require '../../../../../../model/conexion.php';


class almacen
{


    private $conexion;

    public function __construct()
    {
        $this->conexion = new conexion();
    }

    //registrado



    public function traerListaPaquetes()
    {

        $registros = $this->conexion->bd()->prepare("select * from paquete");

        $registros->execute();

        $registro = $registros->get_result();


        return $registro;
    }


    public function traerPaquetes($estado)
    {

        $registros = $this->conexion->bd()->prepare("select * from paquete where estado=? and 
        numLote is null");
        $registros->bind_param("s",$estado);
        $registros->execute();

        $registro = $registros->get_result();


        return $registro;
    }





    public function masInfoPaquetes($idPaquete)
    {


        $registros = $this->conexion->bd()->prepare("select * from paquete where idPaquete=?");
        $registros->bind_param("i", $idPaquete);
        $registros->execute();

        $registro = $registros->get_result();

        $reg = $registro->fetch_array();

        return $reg;
    }

    public function traerLotes()
    {


        $registros = $this->conexion->bd()->prepare("select * from lotes");
        $registros->execute();

        $registro = $registros->get_result();


        return $registro;
    }



    public function traerLotesPorNumLote($numLote)
    {


        $registros = $this->conexion->bd()->prepare("select * from lotes where numLote=?");
        $registros->bind_param("i", $numLote);
        $registros->execute();

        $registro = $registros->get_result();


        return $registro;
    }

    public function eliminarLote($numLote)
    {

        $consulta = $this->conexion->bd()->prepare("delete from lotes where numLote=?");
        $consulta->bind_param("i", $numLote);
        $consulta->execute();


        return $consulta;
    }

    public function modificarLote($numLote, $matricula)
    {


        $sentencia = $this->conexion->bd()->prepare("update lotes 
        set matriculaCamioneta=?
         where numLote=?");
        $sentencia->bind_param('si', $matricula, $numLote);
        $sentencia->execute();

        return $sentencia;
    }

    public function comprobarLoteRepetido($numLote)
    {


        $sentencia = $this->conexion->bd()->prepare("select * from lotes where numLote=?");
        $sentencia->bind_param('i', $numLote);
        $sentencia->execute();


        $registros = $sentencia->get_result();
        $reg = $registros->fetch_array();



        return $reg;
    }



    public function agregarLote($numLote, $matricula)
    {

        $sentencia = $this->conexion->bd()->prepare("insert into lotes 
        (numLote,matriculaCamioneta)
        values(?,?)");

        $sentencia->bind_param('is', $numLote, $matricula);


        $sentencia->execute();

        return $sentencia;
    }

    public function paquetesDelLote($numLote)
    {


        $registros = $this->conexion->bd()->prepare("select * from paquete where numLote=?");
        $registros->bind_param("i", $numLote);
        $registros->execute();

        $registro = $registros->get_result();

        return $registro;
    }


    public function traerDatosCamioneta($matricula)
    {


        $registros = $this->conexion->bd()->prepare("select * from camionetas where matricula=?");
        $registros->bind_param("s", $matricula);
        $registros->execute();

        $registro = $registros->get_result();

        $reg = $registro->fetch_array();

        return $reg;
    }


    public function traerDatosVehiculo($matriculaCamioneta)
    {


        $registros = $this->conexion->bd()->prepare("select * from vehiculos where matricula=?");
        $registros->bind_param("s", $matriculaCamioneta);
        $registros->execute();

        $registro = $registros->get_result();

        $reg = $registro->fetch_array();

        return $reg;
    }



    public function camionetas()
    {


        $registros = $this->conexion->bd()->prepare("select * from camionetas");
        $registros->execute();

        $registro = $registros->get_result();


        return $registro;
    }

    public function modificarNumLotePaquete($numLote, $idPaquete)
    {

        $sentencia = $this->conexion->bd()->prepare("update paquete
            set numLote=? where idPaquete=?");
        $sentencia->bind_param('ii', $numLote, $idPaquete);
        $sentencia->execute();

        return $sentencia;
    }

    public function datosAlmacenPaquete($numAlmacen)
    {


        $registros = $this->conexion->bd()->prepare("select * from almacenes where numAlmacen=?");
        $registros->bind_param("i", $numAlmacen);
        $registros->execute();

        $registro = $registros->get_result();


        return $registro;
    }

    public function modificarEstadoPaquete($estado, $idPaquete)
    {

        $sentencia = $this->conexion->bd()->prepare("update paquete
        set estado=? where idPaquete=?");
        $sentencia->bind_param('si', $estado, $idPaquete);
        $sentencia->execute();

        return $sentencia;
    }


}
