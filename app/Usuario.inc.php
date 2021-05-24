<?php
/**
 * Created by PhpStorm.
 * User: Fabian
 * Date: 10/9/2020
 * Time: 21:39
 */

class Usuario
{
private $id;
private $usuario;
private $contrasenia;

    /**
     * Usuario constructor.
     * @param $id
     * @param $usuario
     * @param $contrasenia
     */
    public function __construct($id=null, $usuario, $contrasenia)
    {
        $this->id = $id;
        $this->usuario = $usuario;
        $this->contrasenia = $contrasenia;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param mixed $usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * @return mixed
     */
    public function getContrasenia()
    {
        return $this->contrasenia;
    }

    /**
     * @param mixed $contrasenia
     */
    public function setContrasenia($contrasenia)
    {
        $this->contrasenia = $contrasenia;
    }

}