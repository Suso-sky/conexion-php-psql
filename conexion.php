<?php
class Conexion{

    public static function  conexionBD(){

        $host = "localhost";
        $dbname = "datos";
        $username = "postgres";
        $password = "postgres";
        

        try{
            $conexion = new PDO("pgsql:host = $host dbname= $dbname", $username, $password);
            return $conexion;
        }
        catch(Exception $error){
            die("La razon es: ".$error->getMessage());
        }
    }
    

    public function conectar(){
        $objeto = new Conexion();
        $conexion = $objeto->conexionBD();
        return $conexion;
    } 
        
    public function create($nombre_tabla,$nombre_columna,$valor){

        $consulta = "INSERT INTO $nombre_tabla ($nombre_columna) VALUES ('$valor');";
        $resultado = Conexion::conectar()->prepare($consulta);
        $resultado->execute();
        Conexion::read($nombre_tabla);
    }

    public function read($nombre_tabla){
        
        #preparar el comando SQL para mostrar, y ejecutarlo 
        $consulta = "select * from $nombre_tabla order by id;";
        $resultado = Conexion::conectar()->prepare($consulta);
        $resultado->execute();
        $datos = $resultado->fetchAll();

        echo "<table><h1><tr><td>id</td><td>nombre</td></tr></h1>";
        #mostrar datos
        foreach ($datos as $dato){
            echo "<h2><tr><td>".$dato['id']."</td><td>".$dato['nombre']."</td></tr></h2>";
        }
        
        echo "</table>";

    }

    public function update($nombre_tabla,$nombre_columna,$valor_antiguo,$valor_actual){
        
        $consulta = "UPDATE $nombre_tabla SET $nombre_columna = ('$valor_actual') WHERE $nombre_columna = ('$valor_antiguo');";
        $resultado = Conexion::conectar()->prepare($consulta);
        $resultado->execute();
        Conexion::read($nombre_tabla);
    }

    public function delete($nombre_tabla,$nombre_columna,$valor){
    
        $consulta = "DELETE FROM $nombre_tabla WHERE $nombre_columna = ('$valor');";
        $resultado = Conexion::conectar()->prepare($consulta);
        $resultado->execute();
        Conexion::read($nombre_tabla);
    }
}

?>