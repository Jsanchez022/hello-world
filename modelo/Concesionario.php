<?php
    class Concesionario {
        private $cif;
        private $nombre;
        private $direccion;

        // Constructor
        public function __construct($cif, $nombre, $direccion) {
            $this->cif = $cif;
            $this->nombre = $nombre;
            $this->direccion = $direccion;
        }

        // Getters
        public function getCif() {
            return $this->cif;
        }

        public function getNombre() {
            return $this->nombre;
        }

        public function getDireccion() {
            return $this->direccion;
        }

        // Setters
        public function setCif($cif) {
            $this->cif = $cif;
        }

        public function setNombre($nombre) {
            $this->nombre = $nombre;
        }

        public function setDireccion($direccion) {
            $this->direccion = $direccion;
        }

        // toString
        public function __toString() {
            return "Concesionario [CIF: " . $this->cif . ", Nombre: " . $this->nombre . ", Dirección: " . $this->direccion . "]";
        }
    }
?>
