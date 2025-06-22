<?php
class Curso extends Conectar {

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

    public function insert_curso($cat_id, $cur_nom, $cur_descrip, $cur_fechini, $cur_fechfin, $inst_id) {
        $sql = "INSERT INTO tm_curso (cur_id, cat_id, cur_nom, cur_descrip, cur_fechini, cur_fechfin, inst_id, fech_crea, est)
                VALUES (NULL, ?, ?, ?, ?, ?, ?, now(), '1');";
        return $this->execute_query($sql, [$cat_id, $cur_nom, $cur_descrip, $cur_fechini, $cur_fechfin, $inst_id]);
    }

    public function update_curso($cur_id, $cat_id, $cur_nom, $cur_descrip, $cur_fechini, $cur_fechfin, $inst_id) {
        $sql = "UPDATE tm_curso
                SET cat_id = ?, cur_nom = ?, cur_descrip = ?, cur_fechini = ?, cur_fechfin = ?, inst_id = ?
                WHERE cur_id = ?";
        return $this->execute_query($sql, [$cat_id, $cur_nom, $cur_descrip, $cur_fechini, $cur_fechfin, $inst_id, $cur_id]);
    }

    public function delete_curso($cur_id) {
        $sql = "UPDATE tm_curso SET est = 0 WHERE cur_id = ?";
        return $this->execute_query($sql, [$cur_id]);
    }

    public function get_curso() {
        $sql = "SELECT tm_curso.cur_id, tm_curso.cur_nom, tm_curso.cur_descrip, tm_curso.cur_fechini, tm_curso.cur_fechfin,
                       tm_curso.cat_id, tm_categoria.cat_nom, tm_curso.inst_id, tm_instructor.inst_nom,
                       tm_instructor.inst_apep, tm_instructor.inst_apem, tm_instructor.inst_correo,
                       tm_instructor.inst_sex, tm_instructor.isnt_telf
                FROM tm_curso
                INNER JOIN tm_categoria ON tm_curso.cat_id = tm_categoria.cat_id
                INNER JOIN tm_instructor ON tm_curso.inst_id = tm_instructor.inst_id
                WHERE tm_curso.est = 1";
        return $this->execute_query($sql);
    }

    public function get_curso_id($cur_id) {
        $sql = "SELECT * FROM tm_curso WHERE est = 1 AND cur_id = ?";
        return $this->execute_query($sql, [$cur_id]);
    }

    public function delete_curso_usuario($curd_id) {
        $sql = "UPDATE td_curso_usuario SET est = 0 WHERE curd_id = ?";
        return $this->execute_query($sql, [$curd_id]);
    }

    public function insert_curso_usuario($cur_id, $usu_id) {
        $conectar = parent::conexion();
        parent::set_names();

        $sql = "INSERT INTO td_curso_usuario (curd_id, cur_id, usu_id, fech_crea, est)
                VALUES (NULL, ?, ?, now(), 1);";
        $stmt = $conectar->prepare($sql);
        $stmt->bindValue(1, $cur_id);
        $stmt->bindValue(2, $usu_id);
        $stmt->execute();

        $sql1 = "SELECT last_insert_id() AS curd_id";
        $stmt1 = $conectar->prepare($sql1);
        $stmt1->execute();
        return $stmt1->fetch(PDO::FETCH_ASSOC);
    }
}
?>