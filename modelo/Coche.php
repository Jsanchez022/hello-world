<?php
    class Coche {
        private $matricula;
        private $marca;
        private $modelo;
        private $color;
        private $cif;
        private $precio;

        // Constructor
        public function __construct($matricula, $marca, $modelo, $color, $cif, $precio) {
            $this->matricula = $matricula;
            $this->marca = $marca;
            $this->modelo = $modelo;
            $this->color = $color;
            $this->cif = $cif;
            $this->precio = $precio;
        }

        // Getters
        public function getMatricula() {
            return $this->matricula;
        }

        public function getMarca() {
            return $this->marca;
        }

        public function getModelo() {
            return $this->modelo;
        }

        public function getColor() {
            return $this->color;
        }

        public function getCif() {
            return $this->cif;
        }

        public function getPrecio() {
            return $this->precio;
        }

        // Setters
        public function setMatricula($matricula) {
            $this->matricula = $matricula;
        }

        public function setMarca($marca) {
            $this->marca = $marca;
        }

        public function setModelo($modelo) {
            $this->modelo = $modelo;
        }

        public function setColor($color) {
            $this->color = $color;
        }

        public function setCif($cif) {
            $this->cif = $cif;
        }

        public function setPrecio($precio) {
            $this->precio = $precio;
        }

        // toString
        public function __toString() {
            return "Coche [matricula=" . $this->matricula . ", marca=" . $this->marca . ", modelo=" . $this->modelo . 
                ", color=" . $this->color . ", cif=" . $this->cif . ", precio=" . $this->precio . "]";
        }
    }
?>
