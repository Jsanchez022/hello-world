<?php
    class Conexion {
        private static $conexion = null;

        public static function getConexion($servername = "localhost", $username = "root", $password = "", $dbname = "concesionario") {
            if (self::$conexion === null) {
                try {
                    self::$conexion = new PDO("mysql:host=$servername;port=3307;dbname=$dbname", $username, $password);
                    self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } catch (PDOException $e) {
                    echo "Error de conexión: " . $e->getMessage();
                }
            }
            return self::$conexion;
        }

        // CRUD concesionario
        public static function selectConcesionario() {
            try {
                $conexion = Conexion::getConexion();
                $sql = "SELECT * FROM concesionarios";
                $consulta = $conexion->prepare($sql);
                $consulta->execute();
                return $consulta->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $e) {
                echo "Error al obtener concesionarios: " . $e->getMessage();
            }
        }

        public static function selectConcesionarioPorCif(Concesionario $concesionario) {
            try {
                $conexion = Conexion::getConexion();
                $sql = "SELECT * FROM concesionarios WHERE cif = :cif";
                $consulta = $conexion->prepare($sql);
                $consulta->bindValue(":cif", $concesionario->getCif());
                $consulta->execute();
                return $consulta->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $e) {
                echo"Error al obtener concesionario por CIF: " . $e->getMessage();
            }
        }

        public static function updateConcesionario(Concesionario $concesionario) {
            $conexion = Conexion::getConexion();
            $sql = "UPDATE concesionarios SET nombre = :nombre, direccion = :direccion WHERE cif = :cif";

            try {
                $conexion->beginTransaction();
                $consulta = $conexion->prepare($sql);
                $consulta->bindValue(":nombre", $concesionario->getNombre());
                $consulta->bindValue(":direccion", $concesionario->getDireccion());
                $consulta->bindValue(":cif", $concesionario->getCif());
                $consulta->execute();

                if ($consulta->rowCount() === 0) {
                    echo"No se encontró ningún concesionario con el CIF proporcionado.";
                }

                return $conexion->commit();
            } catch (Exception $e) {
                $conexion->rollBack();
                echo"Error al actualizar concesionario: " . $e->getMessage();
            }
        }

        public static function insertConcesionario(Concesionario $concesionario) {
            $conexion = Conexion::getConexion();
            $sql = "INSERT INTO concesionarios (cif, nombre, direccion) VALUES (:cif, :nombre, :direccion)";

            try {
                $conexion->beginTransaction();
                $consulta = $conexion->prepare($sql);
                $consulta->bindValue(":cif", $concesionario->getCif());
                $consulta->bindValue(":nombre", $concesionario->getNombre());
                $consulta->bindValue(":direccion", $concesionario->getDireccion());
                $consulta->execute();
                return $conexion->commit();
            } catch (Exception $e) {
                $conexion->rollBack();
                echo"Error al insertar concesionario: " . $e->getMessage();
            }
        }

        public static function deleteConcesionario(Concesionario $concesionario) {
            $conexion = Conexion::getConexion();
            $sql = "DELETE FROM concesionarios WHERE cif = :cif";

            try {
                $conexion->beginTransaction();
                $consulta = $conexion->prepare($sql);
                $consulta->bindValue(":cif", $concesionario->getCif());
                $consulta->execute();

                if ($consulta->rowCount() === 0) {
                    echo"No se encontró ningún concesionario con el CIF proporcionado.";
                }

                return $conexion->commit();
            } catch (Exception $e) {
                $conexion->rollBack();
                echo "Error al eliminar concesionario: " . $e->getMessage();
            }
        }

        // CRUD coche
        public static function selectCoche() {
            try {
                $conexion = Conexion::getConexion();
                $sql = "SELECT * FROM coches";
                $consulta = $conexion->prepare($sql);
                $consulta->execute();
                return $consulta->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $e) {
                echo"Error al obtener coches: " . $e->getMessage();
            }
        }

        public static function selectCochePorMatricula(Coche $coche) {
            try {
                $conexion = Conexion::getConexion();
                $sql = "SELECT * FROM coches WHERE matricula = :matricula AND concesionario_cif = :cif";
                $consulta = $conexion->prepare($sql);
                $consulta->bindValue(":matricula", $coche->getMatricula());
                $consulta->bindValue(":cif", $coche->getCif());
                $consulta->execute();
                return $consulta->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $e) {
                echo"Error al obtener coche por matrícula: " . $e->getMessage();
            }
        }

        public static function selectCochePorCif($cif) {
            try {
                $conexion = Conexion::getConexion();
                $sql = "SELECT * FROM coches WHERE concesionario_cif = :concesionario_cif";
                $consulta = $conexion->prepare($sql);
                $consulta->bindValue(":concesionario_cif", $cif);
                $consulta->execute();
                return $consulta->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $e) {
                error_log("Error al obtener coches por CIF: " . $e->getMessage());
                return [];
            }
        }
        

        public static function updateCoche(Coche $coche) {
            $conexion = Conexion::getConexion();
            $sql = "UPDATE coches SET marca = :marca, modelo = :modelo, color = :color, concesionario_cif = :concesionario_cif, precio = :precio WHERE matricula = :matricula";

            try {
                $conexion->beginTransaction();
                $consulta = $conexion->prepare($sql);
                $consulta->bindValue(":marca", $coche->getMarca());
                $consulta->bindValue(":modelo", $coche->getModelo());
                $consulta->bindValue(":color", $coche->getColor());
                $consulta->bindValue(":concesionario_cif", $coche->getCif());
                $consulta->bindValue(":precio", $coche->getPrecio());
                $consulta->bindValue(":matricula", $coche->getMatricula());
                $consulta->execute();

                if ($consulta->rowCount() === 0) {
                    echo"No se encontró ningún coche con la matrícula proporcionada.";
                }

                return $conexion->commit();
            } catch (Exception $e) {
                $conexion->rollBack();
                echo "Error al actualizar coche: " . $e->getMessage();
            }
        }

        public static function insertCoche(Coche $coche) {
            $conexion = Conexion::getConexion();
            $sql = "INSERT INTO coches (matricula, marca, modelo, color, concesionario_cif, precio) VALUES (:matricula, :marca, :modelo, :color, :concesionario_cif, :precio)";

            try {
                $conexion->beginTransaction();
                $consulta = $conexion->prepare($sql);
                $consulta->bindValue(":matricula", $coche->getMatricula());
                $consulta->bindValue(":marca", $coche->getMarca());
                $consulta->bindValue(":modelo", $coche->getModelo());
                $consulta->bindValue(":color", $coche->getColor());
                $consulta->bindValue(":concesionario_cif", $coche->getCif());
                $consulta->bindValue(":precio", $coche->getPrecio());
                $consulta->execute();
                return $conexion->commit();
            } catch (Exception $e) {
                $conexion->rollBack();
                echo"Error al insertar coche: " . $e->getMessage();
            }
        }

        public static function deleteCoche(Coche $coche) {
            $conexion = Conexion::getConexion();
            $sql = "DELETE FROM coches WHERE matricula = :matricula";

            try {
                $conexion->beginTransaction();
                $consulta = $conexion->prepare($sql);
                $consulta->bindValue(":matricula", $coche->getMatricula());
                $consulta->execute();

                if ($consulta->rowCount() === 0) {
                    echo "DeleteCoche(). No se encontró ningún coche con la matrícula proporcionada.";
                }

                return $conexion->commit();
            } catch (Exception $e) {
                $conexion->rollBack();
                echo "Error al eliminar coche: " . $e->getMessage();
            }
        }
    }
?>
