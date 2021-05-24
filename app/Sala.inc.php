<?php
/**
 * Created by PhpStorm.
 * User: Fabian
 * Date: 11/9/2020
 * Time: 11:08
 */

class Sala
{
private $id;
private $nombre;
private $nombre_ingles;
private $descripcion;
private $descripcion_ingles;
private $numero;
private $actualizado;

    /**
     * Sala constructor.
     * @param $id
     * @param $nombre
     */
    public function __construct($id, $nombre,$nombre_ingles,$numero,$actualizado)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->nombre_ingles=$nombre_ingles;
        $this->numero=$numero;
        $this->actualizado=$actualizado;
    }

    /**
     * @return mixed
     */
    public function getActualizado()
    {
        return $this->actualizado;
    }

    /**
     * @param mixed $actualizado
     */
    public function setActualizado($actualizado)
    {
        $this->actualizado = $actualizado;
    }

    /**
     * @return mixed
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @param mixed $numero
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }


    /**
     * @return mixed
     */
    public function getNombreIngles()
    {
        return $this->nombre_ingles;
    }

    /**
     * @param mixed $nombre_ingles
     */
    public function setNombreIngles($nombre_ingles)
    {
        $this->nombre_ingles = $nombre_ingles;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @return mixed
     */
    public function getDescripcionIngles()
    {
        return $this->descripcion_ingles;
    }

    /**
     * @param mixed $descripcion_ingles
     */
    public function setDescripcionIngles($descripcion_ingles)
    {
        $this->descripcion_ingles = $descripcion_ingles;
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
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }


}