<?php

require '../../../model/conexion.php';


class editarPerfil
{


    private $conexion;

    public function __construct()
    {

        $this->conexion = new conexion();
    }



    public function usuarioRepetidoCrecom($usuario)
    {

        $sentencia = $this->conexion->bd()->prepare("select * from funcionarioscrecom where usuario=?");

        $sentencia->bind_param('s', $usuario);

        $sentencia->execute();

        $registros = $sentencia->get_result();

        $registro = $registros->fetch_array();

        return $registro;
    }



    public function usuarioRepetidoFuncioQuick($usuario)
    {

        $sentencia = $this->conexion->bd()->prepare("select * from funcionariosquickcarry where usuario=?");

        $sentencia->bind_param('s', $usuario);

        $sentencia->execute();

        $registros = $sentencia->get_result();

        $registro = $registros->fetch_array();

        return $registro;
    }


    public function usuarioRepetidoChofer($usuario)
    {

        $sentencia = $this->conexion->bd()->prepare("select * from chofercamion where usuario=?");

        $sentencia->bind_param('s', $usuario);

        $sentencia->execute();

        $registros = $sentencia->get_result();

        $registro = $registros->fetch_array();

        return $registro;
    }




    public function comprobarUsuarioRepetidoClienteCrecom($usuario)
    {

        $seleccionUsuario = $this->conexion->bd()->prepare("select * from clientecrecom where usuario=?");
        $seleccionUsuario->bind_param("s", $usuario);
        $seleccionUsuario->execute();
        $registros = $seleccionUsuario->get_result();
        $regUsuario = $registros->fetch_array();


        return $regUsuario;
    }




    public function comprobarUsuarioActualizado($usuario, $id)
    {

        $repetido = false;

        $seleccionId = $this->conexion->bd()->prepare("select * from admin where id=?");
        $seleccionId->bind_param("i", $id);
        $seleccionId->execute();
        $registros = $seleccionId->get_result();
        $regId = $registros->fetch_array();

        if ($regId['usuario'] != $usuario) {

            $seleccionUsuario = $this->conexion->bd()->prepare("select * from admin where usuario=?");
            $seleccionUsuario->bind_param("s", $usuario);
            $seleccionUsuario->execute();
            $registros = $seleccionUsuario->get_result();
            $regUsuario = $registros->fetch_array();


            if ($regUsuario > 0) {

                $repetido = true;
            } else {

                $repetido = false;
            }


            return $repetido;
        }
    }

    public function comprobarCorreoActualizado($correo, $id)
    {

        $repetido = false;

        $seleccionId = $this->conexion->bd()->prepare("select * from admin where id=?");
        $seleccionId->bind_param("i", $id);
        $seleccionId->execute();
        $registros = $seleccionId->get_result();
        $regId = $registros->fetch_array();

        if ($regId['correo'] != $correo) {

            $seleccionUsuario = $this->conexion->bd()->prepare("select * from admin where correo=?");
            $seleccionUsuario->bind_param("s", $correo);
            $seleccionUsuario->execute();
            $registros = $seleccionUsuario->get_result();
            $regUsuario = $registros->fetch_array();


            if ($regUsuario > 0) {

                $repetido = true;
            } else {

                $repetido = false;
            }


            return $repetido;
        }
    }


    public function comprobarCorreoRepetidoCrecom($correo)
    {

        $seleccionUsuario = $this->conexion->bd()->prepare("select * from funcionarioscrecom where correo=?");
        $seleccionUsuario->bind_param("s", $correo);
        $seleccionUsuario->execute();
        $registros = $seleccionUsuario->get_result();
        $regUsuario = $registros->fetch_array();


        return $regUsuario;
    }


    public function comprobarCorreoRepetidoChofer($correo)
    {

        $seleccionUsuario = $this->conexion->bd()->prepare("select * from chofercamion where correo=?");
        $seleccionUsuario->bind_param("s", $correo);
        $seleccionUsuario->execute();
        $registros = $seleccionUsuario->get_result();
        $regUsuario = $registros->fetch_array();


        return $regUsuario;
    }

    public function comprobarCorreoRepetidoFuncioQuick($correo)
    {

        $seleccionUsuario = $this->conexion->bd()->prepare("select * from funcionariosquickcarry where correo=?");
        $seleccionUsuario->bind_param("s", $correo);
        $seleccionUsuario->execute();
        $registros = $seleccionUsuario->get_result();
        $regUsuario = $registros->fetch_array();


        return $regUsuario;
    }





    public function comprobarCorreoRepetidoClienteCrecom($correo)
    {

        $seleccionUsuario = $this->conexion->bd()->prepare("select * from clientecrecom where correo=?");
        $seleccionUsuario->bind_param("s", $correo);
        $seleccionUsuario->execute();
        $registros = $seleccionUsuario->get_result();
        $regUsuario = $registros->fetch_array();


        return $regUsuario;
    }




    public function modificarUsuario($nombre, $apellido, $usuario, $correo, $id)
    {


        $sentencia = $this->conexion->bd()->prepare("update admin set nombre=?,apellido=?
        ,usuario=?,correo=? where id=?");

        $sentencia->bind_param('ssssi', $nombre, $apellido, $usuario, $correo, $id);
        $sentencia->execute();


        return $sentencia;
    }
}
