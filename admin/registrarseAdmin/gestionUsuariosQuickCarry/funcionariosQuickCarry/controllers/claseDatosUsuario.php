<?php

require '../../../../../model/conexion.php';

class datosUsuario
{


    private $conexion;

    public function __construct()
    {
        $this->conexion = new conexion();
    }


    public function traerDatos()
    {


        $registros = $this->conexion->bd()->prepare("select * from funcionariosquickcarry");
        $registros->execute();

        $registro = $registros->get_result();


        return $registro;
    }

    public function eliminarUsuario($id)
    {

        $consulta = $this->conexion->bd()->prepare("delete from funcionariosquickcarry where id=?");
        $consulta->bind_param('i', $id);
        $consulta->execute();


        return $consulta;
    }

    public function modificarUsuario($nombre, $apellido, $usuario, $numFuncio, $cedula, $correo, $id)
    {


        $sentencia = $this->conexion->bd()->prepare("update funcionariosquickcarry set 
        nombre=?,apellido=?,usuario=?,numFuncio=?,cedula=?,correo=? where id=?");

        $sentencia->bind_param('sssissi', $nombre, $apellido, $usuario, $numFuncio, $cedula, $correo, $id);
        $sentencia->execute();


        return $sentencia;
    }



    public function comprobarCedulaActualizado($cedula, $id)
    {

        $repetido = false;

        $seleccionIdCrecom = $this->conexion->bd()->prepare("select * from funcionariosquickcarry where id=?");
        $seleccionIdCrecom->bind_param("i", $id);
        $seleccionIdCrecom->execute();
        $registros = $seleccionIdCrecom->get_result();
        $regIdCrecom = $registros->fetch_array();

        if ($regIdCrecom['cedula'] != $cedula) {


            $seleccionFuncioCrecom = $this->conexion->bd()->prepare("select * from 
            funcionariosquickcarry where cedula=?");
            $seleccionFuncioCrecom->bind_param("i", $cedula);
            $seleccionFuncioCrecom->execute();
            $registros = $seleccionFuncioCrecom->get_result();
            $regFuncioCrecom = $registros->fetch_array();


            if ($regFuncioCrecom > 0) {

                $repetido = true;
            } else {

                $repetido = false;
            }
        }

        return $repetido;
    }




    public function comprobarCorreoActualizado($correo, $id)
    {

        $repetido = false;

        $seleccionIdCrecom = $this->conexion->bd()->prepare("select * from funcionariosquickcarry where id=?");
        $seleccionIdCrecom->bind_param("i", $id);
        $seleccionIdCrecom->execute();
        $registros = $seleccionIdCrecom->get_result();
        $regIdCrecom = $registros->fetch_array();

        if ($regIdCrecom['correo'] != $correo) {



            $seleccionUsuarioCrecom = $this->conexion->bd()->prepare("select *
             from funcionariosquickcarry where correo=?");
            $seleccionUsuarioCrecom->bind_param("s", $correo);
            $seleccionUsuarioCrecom->execute();
            $registros = $seleccionUsuarioCrecom->get_result();
            $regUsuarioCrecom = $registros->fetch_array();


            if ($regUsuarioCrecom > 0) {

                $repetido = true;
            } else {

                $repetido = false;
            }
        }

        return $repetido;
    }




    public function comprobarUsuarioActualizado($usuario, $id)
    {

        $repetido = false;

        $seleccionIdQuick = $this->conexion->bd()->prepare("select * from funcionariosquickcarry where id=?");
        $seleccionIdQuick->bind_param("i", $id);
        $seleccionIdQuick->execute();
        $registros = $seleccionIdQuick->get_result();
        $regIdQuick = $registros->fetch_array();

        if ($regIdQuick['usuario'] != $usuario) {



            $seleccionUsuarioQuick = $this->conexion->bd()->prepare("select * from funcionariosquickcarry where usuario=?");
            $seleccionUsuarioQuick->bind_param("s", $usuario);
            $seleccionUsuarioQuick->execute();
            $registros = $seleccionUsuarioQuick->get_result();
            $regUsuarioQuick = $registros->fetch_array();


            if ($regUsuarioQuick > 0) {

                $repetido = true;
            } else {

                $repetido = false;
            }
        }

        return $repetido;
    }


    public function comprobarNumFuncioActualizado($numFuncio, $id)
    {

        $repetido = false;

        $seleccionIdQuick = $this->conexion->bd()->prepare("select * from funcionariosquickcarry where id=?");
        $seleccionIdQuick->bind_param("i", $id);
        $seleccionIdQuick->execute();
        $registros = $seleccionIdQuick->get_result();
        $regIdQuick = $registros->fetch_array();

        if ($regIdQuick['numFuncio'] != $numFuncio) {


            $seleccionFuncioQuick = $this->conexion->bd()->prepare("select * from funcionariosquickcarry 
            where numFuncio=?");
            $seleccionFuncioQuick->bind_param("i", $numFuncio);
            $seleccionFuncioQuick->execute();
            $registros = $seleccionFuncioQuick->get_result();
            $regFuncioQuick = $registros->fetch_array();


            if ($regFuncioQuick > 0) {

                $repetido = true;
            } else {

                $repetido = false;
            }
        }

        return $repetido;
    }


    public function agregarUsuario($nombre, $apellido, $usuario, $numFuncio, $cedula, $correo, $contrasenia)
    {

        $sentencia = $this->conexion->bd()->prepare("insert into funcionariosquickcarry (nombre,
        apellido,usuario,numFuncio,cedula,correo,contrasenia) 
         values(?,?,?,?,?,?,?)");

        $sentencia->bind_param(
            'sssisss',
            $nombre,
            $apellido,
            $usuario,
            $numFuncio,
            $cedula,
            $correo,
            $contrasenia
        );

        $sentencia->execute();


        return $sentencia;
    }



    public function masInfoUsuario($id)
    {

        $seleccionUsuario = $this->conexion->bd()->prepare("select * from funcionariosquickcarry where id=?");
        $seleccionUsuario->bind_param("i", $id);
        $seleccionUsuario->execute();
        $registros = $seleccionUsuario->get_result();
        $regUsuario = $registros->fetch_array();


        return $regUsuario;
    }

    public function comprobarnumFuncioRepetido($numFuncio)
    {

        $seleccionUsuario = $this->conexion->bd()->prepare("select * from funcionariosquickcarry where numFuncio=?");
        $seleccionUsuario->bind_param("i", $numFuncio);
        $seleccionUsuario->execute();
        $registros = $seleccionUsuario->get_result();
        $regUsuario = $registros->fetch_array();


        return $regUsuario;
    }

    public function comprobarUsuarioRepetidoFuncioQuick($usuario)
    {

        $seleccionUsuario = $this->conexion->bd()->prepare("select * from  funcionariosquickcarry  where usuario=?");
        $seleccionUsuario->bind_param("s", $usuario);
        $seleccionUsuario->execute();
        $registros = $seleccionUsuario->get_result();
        $regUsuario = $registros->fetch_array();


        return $regUsuario;
    }

    public function comprobarUsuarioRepetidoChofer($usuario)
    {

        $seleccionUsuario = $this->conexion->bd()->prepare("select * from chofercamion where usuario=?");
        $seleccionUsuario->bind_param("s", $usuario);
        $seleccionUsuario->execute();
        $registros = $seleccionUsuario->get_result();
        $regUsuario = $registros->fetch_array();


        return $regUsuario;
    }

    public function comprobarUsuarioRepetidoCrecom($usuario)
    {

        $seleccionUsuario = $this->conexion->bd()->prepare("select * from funcionarioscrecom where usuario=?");
        $seleccionUsuario->bind_param("s", $usuario);
        $seleccionUsuario->execute();
        $registros = $seleccionUsuario->get_result();
        $regUsuario = $registros->fetch_array();


        return $regUsuario;
    }



    public function comprobarUsuarioRepetidoAdmin($usuario)
    {

        $seleccionUsuario = $this->conexion->bd()->prepare("select * from admin where usuario=?");
        $seleccionUsuario->bind_param("s", $usuario);
        $seleccionUsuario->execute();
        $registros = $seleccionUsuario->get_result();
        $regUsuario = $registros->fetch_array();


        return $regUsuario;
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



    public function comprobarCedulaRepetidoFuncioQuick($cedula)
    {

        $seleccionUsuario = $this->conexion->bd()->prepare("select * from funcionariosquickcarry where cedula=?");
        $seleccionUsuario->bind_param("s", $cedula);
        $seleccionUsuario->execute();
        $registros = $seleccionUsuario->get_result();
        $regUsuario = $registros->fetch_array();


        return $regUsuario;
    }
    public function comprobarCedulaRepetidoCrecom($cedula)
    {

        $seleccionUsuario = $this->conexion->bd()->prepare("select * from funcionarioscrecom where cedula=?");
        $seleccionUsuario->bind_param("s", $cedula);
        $seleccionUsuario->execute();
        $registros = $seleccionUsuario->get_result();
        $regUsuario = $registros->fetch_array();


        return $regUsuario;
    }



    public function comprobarCedulaRepetidoChofer($cedula)
    {

        $seleccionUsuario = $this->conexion->bd()->prepare("select * from chofercamion where cedula=?");
        $seleccionUsuario->bind_param("s", $cedula);
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



    public function comprobarCorreoRepetidoClienteCrecom($correo)
    {

        $seleccionUsuario = $this->conexion->bd()->prepare("select * from clientecrecom where correo=?");
        $seleccionUsuario->bind_param("s", $correo);
        $seleccionUsuario->execute();
        $registros = $seleccionUsuario->get_result();
        $regUsuario = $registros->fetch_array();


        return $regUsuario;
    }

}
