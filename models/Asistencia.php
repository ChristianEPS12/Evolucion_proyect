<?php
class Asistencia extends Conectar {

    private function execute_query($sql, $params = []) {
        $conectar = parent::conexion();
        parent::set_names();
        $stmt = $conectar->prepare($sql);

        foreach ($params as $index => $value) {
            $stmt->bindValue($index + 1, $value);
        }

        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function insert_asistencia($usu_id, $fecha, $foto, $latitud, $longitud, $hora) {
        $sql = "INSERT INTO asistencia (usu_id, fecha, foto, latitud, longitud, hora, est)
                VALUES (?, ?, ?, ?, ?, ?, 1)";
        return $this->execute_query($sql, [$usu_id, $fecha, $foto, $latitud, $longitud, $hora]);
    }

    public function update_asistencia($id_asistencia, $usu_id, $fecha, $foto, $latitud, $longitud, $hora) {
        $sql = "UPDATE asistencia
                SET usu_id = ?, fecha = ?, foto = ?, latitud = ?, longitud = ?, hora = ?
                WHERE id_asistencia = ?";
        return $this->execute_query($sql, [$usu_id, $fecha, $foto, $latitud, $longitud, $hora, $id_asistencia]);
    }

    public function delete_asistencia($id_asistencia) {
        $sql = "UPDATE asistencia SET est = 0 WHERE id_asistencia = ?";
        return $this->execute_query($sql, [$id_asistencia]);
    }

    public function get_asistencia($usu_id) {
        $sql = "SELECT asistencia.id_asistencia, asistencia.fecha, asistencia.hora, asistencia.foto,
                       asistencia.latitud, asistencia.longitud, tm_usuario.usu_nom, tm_usuario.usu_apep,
                       tm_usuario.usu_apem, tm_usuario.usu_correo
                FROM asistencia
                INNER JOIN tm_usuario ON asistencia.usu_id = tm_usuario.usu_id
                WHERE asistencia.est = 1 AND tm_usuario.est = 1 AND asistencia.usu_id = ?";
        return $this->execute_query($sql, [$usu_id]);
    }

    public function get_asistencia_id($id_asistencia) {
        $sql = "SELECT * FROM asistencia WHERE est = 1 AND id_asistencia = ?";
        return $this->execute_query($sql, [$id_asistencia]);
    }

    public function get_usuarios() {
        $sql = "SELECT usu_id, usu_nom, usu_apep, usu_apem FROM tm_usuario WHERE est = 1";
        return $this->execute_query($sql);
    }
}
?>