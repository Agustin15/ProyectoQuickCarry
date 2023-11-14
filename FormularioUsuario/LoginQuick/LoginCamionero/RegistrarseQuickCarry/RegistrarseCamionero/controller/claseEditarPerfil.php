<?php

require '../../../../../../model/conexion.php';


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


    public function usuarioRepetidoCrecom($usuario)
    {

        $sentencia = $this->conexion->bd()->prepare("select * from funcionarioscrecom where usuario=?");

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

        $seleccionId = $this->conexion->bd()->prepare("select * from chofercamion where id=?");
        $seleccionId->bind_param("i", $id);
        $seleccionId->execute();
        $registros = $seleccionId->get_result();
        $regId = $registros->fetch_array();

        if ($regId['usuario'] != $usuario) {

            $seleccionUsuario = $this->conexion->bd()->prepare("select * from chofercamion where usuario=?");
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



    public function comprobarMatriculaActualizado($matricula, $id)
    {

        $repetido = false;

        $seleccionId = $this->conexion->bd()->prepare("select * from chofercamion where id=?");
        $seleccionId->bind_param("i", $id);
        $seleccionId->execute();
        $registros = $seleccionId->get_result();
        $regId = $registros->fetch_array();

        if ($regId['matricula'] != $matricula) {

            $seleccionUsuario = $this->conexion->bd()->prepare("select * from chofercamion where matricula=?");
            $seleccionUsuario->bind_param("s", $matricula);
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

    public function comprobarNumCamioneroActualizado($numChoferCamion, $id)
    {

        $repetido = false;

        $seleccionId = $this->conexion->bd()->prepare("select * from chofercamion where id=?");
        $seleccionId->bind_param("i", $id);
        $seleccionId->execute();
        $registros = $seleccionId->get_result();
        $regId = $registros->fetch_array();

        if ($regId['numChoferCamion'] != $numChoferCamion) {

            $seleccionUsuario = $this->conexion->bd()->prepare("select * from chofercamion where numChoferCamion=?");
            $seleccionUsuario->bind_param("i", $numChoferCamion);
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

        $seleccionId = $this->conexion->bd()->prepare("select * from chofercamion where id=?");
        $seleccionId->bind_param("i", $id);
        $seleccionId->execute();
        $registros = $seleccionId->get_result();
        $regId = $registros->fetch_array();

        if ($regId['cedula'] != $cedula) {

            $seleccionUsuario = $this->conexion->bd()->prepare("select * from chofercamion where cedula=?");
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

    


    public function comprobarCorreoActualizado($correo, $id)
    {

        $repetido = false;

        $seleccionId = $this->conexion->bd()->prepare("select * from chofercamion where id=?");
        $seleccionId->bind_param("i", $id);
        $seleccionId->execute();
        $registros = $seleccionId->get_result();
        $regId = $registros->fetch_array();

        if ($regId['correo'] != $correo) {

            $seleccionUsuario = $this->conexion->bd()->prepare("select * from chofercamion where correo=?");
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




    public function comprobarCedulaRepetidoCrecom($cedula)
    {

        $seleccionUsuario = $this->conexion->bd()->prepare("select * from funcionarioscrecom where cedula=?");
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


    public function comprobarCorreoRepetidoCrecom($correo)
    {

        $seleccionUsuario = $this->conexion->bd()->prepare("select * from funcionarioscrecom where correo=?");
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



    public function modificarUsuario($nombre, $apellido, $usuario, $numChoferCamion, $cedula, $correo, $id)
    {


        $sentencia = $this->conexion->bd()->prepare("update chofercamion set nombre=?,apellido=?,usuario=?,
        numChoferCamion=?,cedula=?,correo=? where id=?");

        $sentencia->bind_param(
            'sssissi',
            $nombre,
            $apellido,
            $usuario,
            $numChoferCamion,
            $cedula,
            $correo,
            $id
        );
        $sentencia->execute();


        return $sentencia;
    }
}
