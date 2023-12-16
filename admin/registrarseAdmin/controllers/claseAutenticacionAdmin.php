<?php


require '../../../model/conexion.php';




class autenticacionAdmin
{


    private $conexion;

    public function __construct()
    {
        $this->conexion = new conexion();
    }

    public function obtenerUsuariosChoferCamion($usuario)
    {
        $consulta = $this->conexion->bd()->prepare("select * from chofercamion where usuario=?");
        $consulta->bind_param("s", $usuario);
        $consulta->execute();
        $registros = $consulta->get_result();

        $reg = $registros->fetch_array();


        return $reg;
    }

    public function obtenerUsuariosFuncionarioCrecom($usuario)
    {
        $consulta = $this->conexion->bd()->prepare("select * from funcionarioscrecom where usuario=?");
        $consulta->bind_param("s", $usuario);
        $consulta->execute();
        $registros = $consulta->get_result();

        $reg = $registros->fetch_array();


        return $reg;
    }


    public function obtenerUsuariosFuncionariosQuick($usuario)
    {
        $consulta = $this->conexion->bd()->prepare("select * from funcionariosquickcarry where usuario=?");
        $consulta->bind_param("s", $usuario);
        $consulta->execute();
        $registros = $consulta->get_result();

        $reg = $registros->fetch_array();


        return $reg;
    }


    public function obtenerUsuariosAdmin($usuario)
    {
        $consulta = $this->conexion->bd()->prepare("select * from admin where usuario=?");
        $consulta->bind_param("s", $usuario);
        $consulta->execute();
        $registros = $consulta->get_result();

        $reg = $registros->fetch_array();


        return $reg;
    }







    public function obtenerCorreoChoferCamion($correo)
    {
        $consulta = $this->conexion->bd()->prepare("select * from chofercamion where correo=?");
        $consulta->bind_param("s", $correo);
        $consulta->execute();
        $registros = $consulta->get_result();

        $reg = $registros->fetch_array();


        return $reg;
    }

    public function obtenerCorreoFuncionarioCrecom($correo)
    {
        $consulta = $this->conexion->bd()->prepare("select * from funcionarioscrecom where correo=?");
        $consulta->bind_param("s", $correo);
        $consulta->execute();
        $registros = $consulta->get_result();

        $reg = $registros->fetch_array();


        return $reg;
    }


    public function obtenerCorreoFuncionariosQuick($correo)
    {
        $consulta = $this->conexion->bd()->prepare("select * from funcionariosquickcarry where correo=?");
        $consulta->bind_param("s", $correo);
        $consulta->execute();
        $registros = $consulta->get_result();

        $reg = $registros->fetch_array();


        return $reg;
    }


    public function obtenerCorreoAdmin($correo)
    {
        $consulta = $this->conexion->bd()->prepare("select * from admin where correo=?");
        $consulta->bind_param("s", $correo);
        $consulta->execute();
        $registros = $consulta->get_result();

        $reg = $registros->fetch_array();


        return $reg;
    }


    //login
    public function registrado($nombre, $apellido, $usuario, $correo, $contrasenia)
    {

        $consulta = $this->conexion->bd()->prepare("insert into admin
        (nombre,apellido,usuario,correo,contrasenia) 
        values(?,?,?,?,?)");

        $consulta->bind_param("sssss", $nombre, $apellido, $usuario, $correo, $contrasenia);
        $consulta->execute();

        return $consulta;
    }



    public function consultaPorUsuarioExistente($usuario)
    {



        $consulta = $this->conexion->bd()->prepare("select * from admin where usuario=?");

        $consulta->bind_param("s", $usuario);
        $consulta->execute();
        $registros = $consulta->get_result();

        $reg = $registros->fetch_array();


        return $reg;
    }
}
