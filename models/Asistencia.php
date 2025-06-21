<?php
class Asistencia extends Conectar {
    
    public function insert_asistencia($usu_id, $fecha, $foto, $latitud, $longitud, $hora) {
        $conectar = parent::conexion();
        parent::set_names();
    
        $sql = "INSERT INTO asistencia (usu_id, fecha, foto, latitud, longitud, hora, est)
            VALUES (?, ?, ?, ?, ?, ?, 1)";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_id);
        $sql->bindValue(2, $fecha);
        $sql->bindValue(3, $foto);
        $sql->bindValue(4, $latitud);
        $sql->bindValue(5, $longitud);
        $sql->bindValue(6, $hora);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function update_asistencia($id_asistencia, $usu_id, $fecha, $foto, $latitud, $longitud, $hora) {
        $conectar = parent::conexion();
        parent::set_names();
        
        $sql = "UPDATE asistencia
                SET
                    usu_id = ?,
                    fecha = ?,
                    foto = ?,
                    latitud = ?,
                    longitud = ?,
                    hora = ?
                WHERE
                    id_asistencia = ?";
        
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_id);
        $sql->bindValue(2, $fecha);
        $sql->bindValue(3, $foto);
        $sql->bindValue(4, $latitud);
        $sql->bindValue(5, $longitud);
        $sql->bindValue(6, $hora); // Asegúrate de incluir la hora correctamente
        $sql->bindValue(7, $id_asistencia); // Corregir el índice de la última variable
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function delete_asistencia($id_asistencia) {
        $conectar = parent::conexion();
        parent::set_names();
        
        $sql = "UPDATE asistencia
                SET
                    est = 0
                WHERE
                    id_asistencia = ?";
        
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $id_asistencia);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function get_asistencia($usu_id) {
        $conectar = parent::conexion();
        parent::set_names();
        
        $sql = "SELECT 
                    asistencia.id_asistencia,
                    asistencia.fecha,
                    asistencia.hora,
                    asistencia.foto,
                    asistencia.latitud,
                    asistencia.longitud,
                    tm_usuario.usu_nom,
                    tm_usuario.usu_apep,
                    tm_usuario.usu_apem,
                    tm_usuario.usu_correo
                FROM asistencia
                INNER JOIN tm_usuario ON asistencia.usu_id = tm_usuario.usu_id
                WHERE asistencia.est = 1 AND tm_usuario.est = 1 AND asistencia.usu_id = ?";
        
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_id); // Filtrar por el usuario seleccionado
        $sql->execute();
        return $sql->fetchAll();
    }

    public function get_asistencia_id($id_asistencia) {
        $conectar = parent::conexion();
        parent::set_names();
        
        $sql = "SELECT * FROM asistencia WHERE est = 1 AND id_asistencia = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $id_asistencia);
        $sql->execute();
        
        return $sql->fetchAll();
    }

    public function get_usuarios() {
        $conectar = parent::conexion();
        parent::set_names();
        
        $sql = "SELECT usu_id, usu_nom, usu_apep, usu_apem FROM tm_usuario WHERE est = 1";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        
        return $sql->fetchAll();
    }
    
}
?>