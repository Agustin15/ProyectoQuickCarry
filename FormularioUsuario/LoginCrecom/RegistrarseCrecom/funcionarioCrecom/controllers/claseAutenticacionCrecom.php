<?php


require "../../../../../model/conexion.php";

class autenticacionCrecom
{


    private $conexion;

    public function __construct()
    {
        $this->conexion = new conexion();
    }

    //registrado

    public function obtenerNumFuncionarioCrecom($numFuncio)
    {
        $consulta = $this->conexion->bd()->prepare("select * from funcionarioscrecom where numFuncio=?");
        $consulta->bind_param("i", $numFuncio);
        $consulta->execute();
        $registros = $consulta->get_result();

        $reg = $registros->fetch_array();


        return $reg;
    }

    public function obtenerUsuariosCamioneros($usuario)
    {
        $consulta = $this->conexion->bd()->prepare("select * from chofercamion where usuario=?");
        $consulta->bind_param("s", $usuario);
        $consulta->execute();
        $registros = $consulta->get_result();

        $reg = $registros->fetch_array();


        return $reg;
    }

    public function obtenerUsuariosFuncioQuick($usuario)
    {
        $consulta = $this->conexion->bd()->prepare("select * from funcionariosquickcarry where usuario=?");
        $consulta->bind_param("s", $usuario);
        $consulta->execute();
        $registros = $consulta->get_result();

        $reg = $registros->fetch_array();


        return $reg;
    }

    public function obtenerUsuariosCrecom($usuario)
    {
        $consulta = $this->conexion->bd()->prepare("select * from funcionarioscrecom where usuario=?");
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


    public function obtenerCedulaCamioneros($cedula)
    {
        $consulta = $this->conexion->bd()->prepare("select * from chofercamion where cedula=?");
        $consulta->bind_param("s", $cedula);
        $consulta->execute();
        $registros = $consulta->get_result();

        $reg = $registros->fetch_array();


        return $reg;
    }

    public function obtenerCedulaCrecom($cedula)
    {
        $consulta = $this->conexion->bd()->prepare("select * from funcionariosCrecom where cedula=?");
        $consulta->bind_param("s", $cedula);
        $consulta->execute();
        $registros = $consulta->get_result();

        $reg = $registros->fetch_array();


        return $reg;
    }

    public function obtenerCedulaFuncioQuick($cedula)
    {
        $consulta = $this->conexion->bd()->prepare("select * from funcionariosquickcarry where cedula=?");
        $consulta->bind_param("s", $cedula);
        $consulta->execute();
        $registros = $consulta->get_result();

        $reg = $registros->fetch_array();


        return $reg;
    }





    public function obtenerCorreoCamioneros($correo)
    {
        $consulta = $this->conexion->bd()->prepare("select * from chofercamion where correo=?");
        $consulta->bind_param("s", $correo);
        $consulta->execute();
        $registros = $consulta->get_result();

        $reg = $registros->fetch_array();


        return $reg;
    }

    public function obtenerCorreoCrecom($correo)
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


    public function registrado($nombre, $apellido, $usuario, $numFuncio, $cedula, $correo, $contrasenia)
    {

        $consulta = $this->conexion->bd()->prepare("insert into funcionarioscrecom
        (nombre,apellido,usuario,numFuncio,cedula,correo,contrasenia) 
        values(?,?,?,?,?,?,?)");

        $consulta->bind_param("sssisss", $nombre, $apellido, $usuario, $numFuncio, $cedula, $correo, $contrasenia);
        $consulta->execute();

        return $consulta;
    }
    //login


    public function consultaPorUsuarioExistente($usuario)
    {
        $consulta = $this->conexion->bd()->prepare("select * from funcionarioscrecom where usuario=?");

        $consulta->bind_param("s", $usuario);
        $consulta->execute();
        $registros = $consulta->get_result();
        $reg = $registros->fetch_array();

        return $reg;
    }
}
