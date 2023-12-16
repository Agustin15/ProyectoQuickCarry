<?php

require "../../../../../model/conexion.php";

class editarPerfil
{


    private $conexion;

    public function __construct()
    {
        $this->conexion = new conexion();
    }




    public function usuarioRepetidoAdmin($usuario)
    {

        $sentencia = $this->conexion->bd()->prepare("select * from admin where usuario=?");

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

        $seleccionId = $this->conexion->bd()->prepare("select * from funcionarioscrecom where id=?");
        $seleccionId->bind_param("i", $id);
        $seleccionId->execute();
        $registros = $seleccionId->get_result();
        $regId = $registros->fetch_array();

        if ($regId['usuario'] != $usuario) {

            $seleccionUsuario = $this->conexion->bd()->prepare("select * from funcionarioscrecom where usuario=?");
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


    public function comprobarCedulaActualizado($cedula, $id)
    {

        $repetido = false;

        $seleccionId = $this->conexion->bd()->prepare("select * from funcionarioscrecom where id=?");
        $seleccionId->bind_param("i", $id);
        $seleccionId->execute();
        $registros = $seleccionId->get_result();
        $regId = $registros->fetch_array();

        if ($regId['cedula'] != $cedula) {

            $seleccionUsuario = $this->conexion->bd()->prepare("select * from funcionarioscrecom where cedula=?");
            $seleccionUsuario->bind_param("s", $cedula);
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

    public function comprobarNumFuncioActualizado($numFuncio, $id)
    {

        $repetido = false;

        $seleccionId = $this->conexion->bd()->prepare("select * from funcionarioscrecom where id=?");
        $seleccionId->bind_param("i", $id);
        $seleccionId->execute();
        $registros = $seleccionId->get_result();
        $regId = $registros->fetch_array();

        if ($regId['numFuncio'] != $numFuncio) {

            $seleccionUsuario = $this->conexion->bd()->prepare("select * from funcionarioscrecom where numFuncio=?");
            $seleccionUsuario->bind_param("i", $numFuncio);
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

        $seleccionId = $this->conexion->bd()->prepare("select * from funcionarioscrecom where id=?");
        $seleccionId->bind_param("i", $id);
        $seleccionId->execute();
        $registros = $seleccionId->get_result();
        $regId = $registros->fetch_array();

        if ($regId['correo'] != $correo) {

            $seleccionUsuario = $this->conexion->bd()->prepare("select * from funcionarioscrecom where correo=?");
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

    public function comprobarCedulaRepetidoChofer($cedula)
    {

        $seleccionUsuario = $this->conexion->bd()->prepare("select * from chofercamion where cedula=?");
        $seleccionUsuario->bind_param("i", $cedula);
        $seleccionUsuario->execute();
        $registros = $seleccionUsuario->get_result();
        $regUsuario = $registros->fetch_array();


        return $regUsuario;
    }

    public function comprobarCedulaRepetidoFuncioQuick($cedula)
    {

        $seleccionUsuario = $this->conexion->bd()->prepare("select * from funcionariosquickcarry where cedula=?");
        $seleccionUsuario->bind_param("s", $cedula);
        $seleccionUsuario->execute();
        $registros = $seleccionUsuario->get_result();
        $regUsuario = $registros->fetch_array();


        return $regUsuario;
    }


    public function comprobarCorreoRepetidoAdmin($correo)
    {

        $seleccionUsuario = $this->conexion->bd()->prepare("select * from admin where correo=?");
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

    


    public function modificarUsuario($nombre, $apellido, $usuario, $numFuncio, $cedula, $correo, $id)
    {


        $sentencia = $this->conexion->bd()->prepare("update funcionarioscrecom set 
        nombre=?,apellido=?,usuario=?,numFuncio=?,cedula=?,correo=? where id=?");

        $sentencia->bind_param('sssissi', $nombre, $apellido, $usuario, $numFuncio, $cedula, $correo, $id);
        $sentencia->execute();


        return $sentencia;
    }
}
