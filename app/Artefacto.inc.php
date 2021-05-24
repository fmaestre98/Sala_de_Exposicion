<?php
/**
 * Created by PhpStorm.
 * User: Fabian
 * Date: 11/9/2020
 * Time: 11:09
 */

class Artefacto
{
private $id;
private $id_sala;
private $nombre;
private $nombre_ingles;
private $video;
private $imagen;
private $qr;
private $descripcion;
private $descripcion_ingles;
private $numero;
private $actualizado;

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
     * Artefacto constructor.
     * @param $id
     * @param $nombre
     * @param $video
     * @param $qr
     */
    public function __construct($id,$id_sala ,$nombre, $video, $qr=null,$descripcion,$descripcion_ingles,$nombre_ingles,$imagen,$numero,$actualizado)
    {
        $this->id = $id;
        $this->id_sala=$id_sala;
        $this->nombre = $nombre;
        $this->video = $video;
        $this->qr = $qr;
        $this->descripcion=$descripcion;
        $this->nombre_ingles=$nombre_ingles;
        $this->descripcion_ingles=$descripcion_ingles;
        $this->imagen=$imagen;
        $this->numero=$numero;
        $this->actualizado=$actualizado;
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
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * @param mixed $imagen
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
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
    public function getIdSala()
    {
        return $this->id_sala;
    }

    /**
     * @param mixed $id_sala
     */
    public function setIdSala($id_sala)
    {
        $this->id_sala = $id_sala;
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

    /**
     * @return mixed
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * @param mixed $video
     */
    public function setVideo($video)
    {
        $this->video = $video;
    }

    /**
     * @return mixed
     */
    public function getQr()
    {
        return $this->qr;
    }

    /**
     * @param mixed $qr
     */
    public function setQr($qr)
    {
        $this->qr = $qr;
    }


    public function getDescripcionResumida(){
        $cantidad_maxima_caracteres=50;
        $resultado="";

        if (strlen($this->descripcion)>$cantidad_maxima_caracteres){

              $resultado.=substr($this->descripcion,0,$cantidad_maxima_caracteres);
            $resultado.="...";
        }else{
            $resultado=$this->descripcion;
        }

        return $resultado;





    }



  /*  public function getNombreVideo(){
        $a=explode("/",$this->video);



        return $a[count($a)-1];

    }

    public function getNombreImagen(){
        $a=explode("/",$this->imagen);



        return $a[count($a)-1];

    }*/
}