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


        $registros = $this->conexion->bd()->prepare("select * from funcionarioscrecom");
        $registros->execute();

        $registro = $registros->get_result();


        return $registro;
    }

    public function eliminarUsuario($id)
    {

        $consulta = $this->conexion->bd()->prepare("delete from funcionarioscrecom where id=?");
        $consulta->bind_param('i', $id);
        $consulta->execute();


        return $consulta;
    }

    public function modificarUsuario($nombre, $apellido, $usuario, $numFuncio, $cedula, $correo, $id)
    {


        $sentencia = $this->conexion->bd()->prepare("update funcionarioscrecom set nombre=?,apellido=?,
        usuario=?,numFuncio=?,cedula=?,correo=? where id=?");

        $sentencia->bind_param('sssissi', $nombre, $apellido, $usuario, $numFuncio, $cedula, $correo, $id);
        $sentencia->execute();


        return $sentencia;
    }



    public function comprobarUsuarioActualizado($usuario, $id)
    {

        $repetido = false;

        $seleccionIdCrecom = $this->conexion->bd()->prepare("select * from funcionarioscrecom where id=?");
        $seleccionIdCrecom->bind_param("i", $id);
        $seleccionIdCrecom->execute();
        $registros = $seleccionIdCrecom->get_result();
        $regIdCrecom = $registros->fetch_array();

        if ($regIdCrecom['usuario'] != $usuario) {



            $seleccionUsuarioCrecom = $this->conexion->bd()->prepare("select * from funcionarioscrecom where usuario=?");
            $seleccionUsuarioCrecom->bind_param("s", $usuario);
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



    public function comprobarCedulaActualizado($cedula, $id)
    {

        $repetido = false;

        $seleccionIdCrecom =$this->conexion->bd()->prepare("select * from funcionarioscrecom where id=?");
        $seleccionIdCrecom->bind_param("i", $id);
        $seleccionIdCrecom->execute();
        $registros = $seleccionIdCrecom->get_result();
        $regIdCrecom = $registros->fetch_array();

        if ($regIdCrecom['cedula'] != $cedula) {


            $seleccionFuncioCrecom =$this->conexion->bd()->prepare("select * from funcionarioscrecom where cedula=?");
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

        $seleccionIdCrecom = $this->conexion->bd()->prepare("select * from funcionarioscrecom where id=?");
        $seleccionIdCrecom->bind_param("i", $id);
        $seleccionIdCrecom->execute();
        $registros = $seleccionIdCrecom->get_result();
        $regIdCrecom = $registros->fetch_array();

        if ($regIdCrecom['correo'] != $correo) {



            $seleccionUsuarioCrecom = $this->conexion->bd()->prepare("select * from funcionarioscrecom where correo=?");
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



    public function comprobarNumFuncioActualizado($numFuncio, $id)
    {

        $repetido = false;

        $seleccionIdCrecom = $this->conexion->bd()->prepare("select * from funcionarioscrecom where id=?");
        $seleccionIdCrecom->bind_param("i", $id);
        $seleccionIdCrecom->execute();
        $registros = $seleccionIdCrecom->get_result();
        $regIdCrecom = $registros->fetch_array();

        if ($regIdCrecom['numFuncio'] != $numFuncio) {


            $seleccionFuncioCrecom = $this->conexion->bd()->prepare("select * from funcionarioscrecom where numFuncio=?");
            $seleccionFuncioCrecom->bind_param("i", $numFuncio);
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


    public function agregarUsuario($nombre, $apellido, $usuario, $numFuncio, $cedula, $correo, $contrasenia)
    {

        $sentencia = $this->conexion->bd()->prepare("insert into funcionarioscrecom 
        (nombre,apellido,usuario,numFuncio,cedula,correo,contrasenia) 
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

        $seleccionUsuario = $this->conexion->bd()->prepare("select * from funcionarioscrecom where id=?");
        $seleccionUsuario->bind_param("i", $id);
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
    
    


    public function comprobarUsuarioRepetidoClienteCrecom($usuario)
    {

        $seleccionUsuario = $this->conexion->bd()->prepare("select * from clientecrecom where usuario=?");
        $seleccionUsuario->bind_param("s", $usuario);
        $seleccionUsuario->execute();
        $registros = $seleccionUsuario->get_result();
        $regUsuario = $registros->fetch_array();


        return $regUsuario;
    }




    public function comprobarNumFuncioRepetido($numFuncio)
    {

        $seleccionUsuario =$this->conexion->bd()->prepare("select * from funcionarioscrecom where numFuncio=?");
        $seleccionUsuario->bind_param("i", $numFuncio);
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



    public function comprobarUsuarioRepetidoFuncioQuick($usuario)
    {

        $seleccionUsuario = $this->conexion->bd()->prepare("select * from funcionariosquickcarry where usuario=?");
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


    public function comprobarCorreoRepetidoAdmin($correo)
    {

        $seleccionUsuario = $this->conexion->bd()->prepare("select * from admin where correo=?");
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
