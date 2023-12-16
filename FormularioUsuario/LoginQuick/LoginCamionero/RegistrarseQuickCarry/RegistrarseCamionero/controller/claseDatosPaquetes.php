<?php
require '../../../../../../model/conexion.php';

class datosPaquete
{


    private $conexion;

    public function __construct()
    {
        $this->conexion = new conexion();
    }

    //registrado





    public function comprobarMatriculaRepetida($matriculaCamion)
    {

        $consulta = $this->conexion->bd()->prepare("select * from chofercamion where 
        matriculaCamion=?");
        $consulta->bind_param("s", $matriculaCamion);
        $consulta->execute();
        $registro = $consulta->get_result();


        return $registro;
    }



    public function mostrarDatosPaquete($matriculaCamion, $estado)
    {

        $consulta = $this->conexion->bd()->prepare("select * from paquete where 
        matriculaCamion=? and estado=?");
        $consulta->bind_param("ss", $matriculaCamion, $estado);
        $consulta->execute();
        $registro = $consulta->get_result();


        return $registro;
    }



    public function detallesPaquete($idPaquete)
    {


        $registros = $this->conexion->bd()->prepare("select * from paquete where idPaquete=?");

        $registros->bind_param("i", $idPaquete);
        $registros->execute();
        $reg = $registros->get_result();


        return $reg;
    }



    public function actualizarEstadoPaquete($estadoPaquete, $idPaquete)
    {

        $consulta = $this->conexion->bd()->prepare("update paquete set estado=? where idPaquete=? ");
        $consulta->bind_param("si", $estadoPaquete, $idPaquete);
        $resultado = $consulta->execute();

        return $resultado;
    }



    public function choferPaquete($matriculaCamion, $idPaquete)
    {

        $consulta = $this->conexion->bd()->prepare("update paquete set matriculaCamion=? where idPaquete=? ");
        $consulta->bind_param("si", $matriculaCamion, $idPaquete);
        $resultado = $consulta->execute();

        return $resultado;
    }


    public function setMatriculachoferCamion($matriculaCamion, $idChoferCamion)
    {

        $consulta = $this->conexion->bd()->prepare("update chofercamion set matriculaCamion=? where
        idChoferCamion=? ");
        $consulta->bind_param("si", $matriculaCamion, $idChoferCamion);
        $resultado = $consulta->execute();

        return $resultado;
    }



    public function buscarAlmacen($numAlmacen)
    {

        $consulta = $this->conexion->bd()->prepare("select * from almacenes where numAlmacen=?");
        $consulta->bind_param("i", $numAlmacen);
        $consulta->execute();
        $registro = $consulta->get_result();
        $datos = $registro->fetch_array();

        return $datos;
    }



    public function buscarCamion($matricula)
    {

        $consulta = $this->conexion->bd()->prepare("select * from camiones where matricula=?");
        $consulta->bind_param("s", $matricula);
        $consulta->execute();
        $registro = $consulta->get_result();
        $datos = $registro->fetch_array();

        return $datos;
    }

    public function insertarDatosTareaCamion($matricula, $descripcion, $fechaInicio, $fechaFin)
    {



        $consulta = $this->conexion->bd()->prepare("insert into tarea 
        (matriculaCamion,descripcion,fechaInicio,fechaFin)
        values(?,?,?,?)");
        $consulta->bind_param("ssss", $matricula, $descripcion, $fechaInicio, $fechaFin);
        $resultado = $consulta->execute();


        return $resultado;
    }


    public function agregarVisita($matricula, $numAlmacen, $fechaVisita)
    {

        $consulta = $this->conexion->bd()->prepare("insert into visita 
        (matriculaCamionVisita,numAlmacen,fechaVisita)
        values(?,?,?)");
        $consulta->bind_param("sis", $matricula, $numAlmacen, $fechaVisita);
        $resultado = $consulta->execute();


        return $resultado;
    }


    public function getCamiones()
    {

        $consulta = $this->conexion->bd()->prepare("select * from camiones");

        $consulta->execute();
        $registro = $consulta->get_result();


        return $registro;
    }



    public function setTrayecto($matricula, $numAlmacen, $ruta, $fechaTrayecto)
    {

        $consulta = $this->conexion->bd()->prepare("insert into trayecto (matriculaCamion,
        numAlmacen,ruta,fechaTrayecto) values(?,?,?,?)");
        $consulta->bind_param("siis", $matricula, $numAlmacen, $ruta, $fechaTrayecto);
        $resultado = $consulta->execute();

        return $resultado;
    }




    public function getTrayecto($matriculaCamion)
    {


        $consulta = $this->conexion->bd()->prepare("select * from trayecto where matriculaCamion=?");
        $consulta->bind_param("s", $matriculaCamion);
        $consulta->execute();
        $registro = $consulta->get_result();


        return $registro;
    }

    public function updateRuta($ruta, $numAlmacen)
    {


        $consulta = $this->conexion->bd()->prepare("update trayecto set ruta=? where numAlmacen=?");
        $consulta->bind_param("si", $ruta, $numAlmacen);
        $resultado = $consulta->execute();

        return $resultado;
    }


    public function getVisita($matriculaCamion)
    {


        $consulta = $this->conexion->bd()->prepare("select * from visita where 
        matriculaCamionVisita=?");
        $consulta->bind_param("s", $matriculaCamion);
        $consulta->execute();
        $registro = $consulta->get_result();


        return $registro;
    }
    public function getTrayectoPorNumAlmacenYFecha($fechaTrayecto, $numAlmacen)
    {

        $consulta = $this->conexion->bd()->prepare("select * from trayecto where 
        DATE_FORMAT(fechaTrayecto,'%Y-%m-%d')=? and numAlmacen=?");
        $consulta->bind_param("si", $fechaTrayecto, $numAlmacen);
        $consulta->execute();
        $registro = $consulta->get_result();



        return  $registro->fetch_all(MYSQLI_ASSOC);
    }

    
    public function getVisitasPorNumAlmacenYFecha($fechaVisita,$numAlmacen)
    {

        $consulta = $this->conexion->bd()->prepare("select * from visita where 
        DATE_FORMAT(fechaVisita,'%Y-%m-%d')=? and numAlmacen=?");
        $consulta->bind_param("si", $fechaVisita, $numAlmacen);
        $consulta->execute();
        $registro = $consulta->get_result();



        return  $registro->fetch_all(MYSQLI_ASSOC);
    }

    

}
