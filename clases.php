<?php
interface  Detalle{
    public function obtenerDetallesEspecificos():string;
}

abstract class Entrada extends  Detalle {

    public $id;
    public $fecha_creacion;
    public $tipo;
    public $titulo;
    public $descripcion;

    public function __construct($datos = []) {
        foreach ($datos as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}

class EntradaUnaColumna extends Entrada {

    public function __construct($datos = []) {
        parent::__construct($datos);
        $this->titulo='titulo';
        $this->descripcion='descripcion';
    }

}

class EntradaDosColumnas extends Entrada {
    public function __construct($datos = []) {
        $titulo1='titulo1';
        $descripcion1='descripcion1';
        $titulo2='titulo2';
        $descripcion2='descripcion2';
        parent::__construct($datos);
    }
}

class EntradaTresColumnas extends Entrada {
    public function __construct($datos = []) {
        $titulo1='titulo1';
        $descripcion1='descripcion1';
        $titulo2='titulo2';
        $descripcion2='descripcion2';
        $titulo3='titulo3';
        $descripcion3='descripcion3';
        parent::__construct($datos);
    }
}

class GestorBlog {
    private $entradas = [];

    public function cargarEntradas() {
        if (file_exists('blog.json')) {
            $json = file_get_contents('blog.json');
            $data = json_decode($json, true);
            foreach ($data as $entradaData) {
                $this->entradas[] = new Entrada($entradaData);
            }
        }

    }

    public function guardarEntradas() {
        $data = array_map(function($entrada) {
            return get_object_vars($entrada);
        }, $this->entradas);
        file_put_contents('blog.json', json_encode($data, JSON_PRETTY_PRINT));
    }

    public function obtenerEntradas() {
        return $this->entradas;
    }
}   