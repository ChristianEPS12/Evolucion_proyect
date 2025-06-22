<?php

class Usuario extends Conectar {

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

    public function login() {
        if (!isset($_POST["enviar"])) return;

        $correo = $_POST["usu_correo"];
        $pass = $_POST["usu_pass"];

        if (empty($correo) || empty($pass)) {
            header("Location:" . Conectar::ruta() . "index.php?m=2");
            exit();
        }

        $sql = "SELECT * FROM tm_usuario WHERE usu_correo=? AND usu_pass=? AND est=1";
        $resultado = $this->execute_query($sql, [$correo, $pass])[0] ?? null;

        if (is_array($resultado)) {
            $_SESSION = array_merge($_SESSION, [
                "usu_id" => $resultado["usu_id"],
                "usu_nom" => $resultado["usu_nom"],
                "usu_ape" => $resultado["usu_ape"],
                "usu_correo" => $resultado["usu_correo"],
                "rol_id" => $resultado["rol_id"]
            ]);

            $redirectPath = $resultado["rol_id"] == 1 ? "view/AdminAsistencia/index2.php" : "view/UsuHome/";
            header("Location:" . Conectar::ruta() . $redirectPath);
            exit();
        }

        header("Location:" . Conectar::ruta() . "index.php?m=1");
        exit();
    }

    public function get_cursos_x_usuario($usu_id) {
        return $this->getCursosQuery("WHERE td_curso_usuario.usu_id = ?", [$usu_id]);
    }

    public function get_cursos_x_usuario_top10($usu_id) {
        return $this->getCursosQuery("WHERE td_curso_usuario.usu_id = ? AND td_curso_usuario.est = 1 LIMIT 10", [$usu_id]);
    }

    public function get_cursos_usuario_x_id($cur_id) {
        return $this->getCursosQuery("WHERE tm_curso.cur_id = ? AND td_curso_usuario.est = 1", [$cur_id]);
    }

    public function get_curso_x_id_detalle($curd_id) {
        $sql = "SELECT td_curso_usuario.curd_id, tm_curso.cur_id, tm_curso.cur_nom, tm_curso.cur_descrip, 
                       tm_curso.cur_fechini, tm_curso.cur_fechfin, tm_usuario.usu_id, tm_usuario.usu_nom, 
                       tm_usuario.usu_apep, tm_usuario.usu_apem, tm_instructor.inst_id, tm_instructor.inst_nom, 
                       tm_instructor.inst_apep, tm_instructor.inst_apem
                FROM td_curso_usuario
                INNER JOIN tm_curso ON td_curso_usuario.cur_id = tm_curso.cur_id
                INNER JOIN tm_usuario ON td_curso_usuario.usu_id = tm_usuario.usu_id
                INNER JOIN tm_instructor ON tm_curso.inst_id = tm_instructor.inst_id
                WHERE td_curso_usuario.curd_id = ?";

        return $this->execute_query($sql, [$curd_id]);
    }

    private function getCursosQuery($whereClause, $params) {
        $sql = "SELECT td_curso_usuario.curd_id, tm_curso.cur_id, tm_curso.cur_nom, tm_curso.cur_descrip, 
                       tm_curso.cur_fechini, tm_curso.cur_fechfin, tm_usuario.usu_id, tm_usuario.usu_nom, 
                       tm_usuario.usu_apep, tm_instructor.inst_id, tm_instructor.inst_nom, tm_instructor.inst_apep
                FROM td_curso_usuario
                INNER JOIN tm_curso ON td_curso_usuario.cur_id = tm_curso.cur_id
                INNER JOIN tm_usuario ON td_curso_usuario.usu_id = tm_usuario.usu_id
                INNER JOIN tm_instructor ON tm_curso.inst_id = tm_instructor.inst_id
                $whereClause";
        return $this->execute_query($sql, $params);
    }

    public function get_total_cursos_x_usuario($usu_id) {
        return $this->execute_query("SELECT COUNT(*) AS total FROM td_curso_usuario WHERE usu_id=?", [$usu_id]);
    }

    public function get_usuario_x_id($usu_id) {
        return $this->execute_query("SELECT * FROM tm_usuario WHERE est=1 AND usu_id=?", [$usu_id]);
    }

    public function update_usuario_perfil($usu_id, $usu_nom, $usu_apep, $usu_apem, $usu_pass, $usu_sex, $usu_telf) {
        $sql = "UPDATE tm_usuario SET usu_nom=?, usu_apep=?, usu_apem=?, usu_pass=?, usu_sex=?, usu_telf=? WHERE usu_id=?";
        return $this->execute_query($sql, [$usu_nom, $usu_apep, $usu_apem, $usu_pass, $usu_sex, $usu_telf, $usu_id]);
    }

    public function insert_usuario($usu_nom, $usu_apep, $usu_apem, $usu_correo, $usu_pass, $usu_sex, $usu_telf, $rol_id) {
        $sql = "INSERT INTO tm_usuario (usu_id, usu_nom, usu_apep, usu_apem, usu_correo, usu_pass, usu_sex, usu_telf, rol_id, fech_crea, est)
                VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, now(), '1');";
        return $this->execute_query($sql, [$usu_nom, $usu_apep, $usu_apem, $usu_correo, $usu_pass, $usu_sex, $usu_telf, $rol_id]);
    }

    public function update_usuario($usu_id, $usu_nom, $usu_apep, $usu_apem, $usu_correo, $usu_pass, $usu_sex, $usu_telf, $rol_id) {
        $sql = "UPDATE tm_usuario SET usu_nom=?, usu_apep=?, usu_apem=?, usu_correo=?, usu_pass=?, usu_sex=?, usu_telf=?, rol_id=? WHERE usu_id=?";
        return $this->execute_query($sql, [$usu_nom, $usu_apep, $usu_apem, $usu_correo, $usu_pass, $usu_sex, $usu_telf, $rol_id, $usu_id]);
    }

    public function delete_usuario($usu_id) {
        return $this->execute_query("UPDATE tm_usuario SET est = 0 WHERE usu_id = ?", [$usu_id]);
    }

    public function get_usuario() {
        return $this->execute_query("SELECT * FROM tm_usuario WHERE est = 1");
    }

    public function get_usuario_modal($cur_id) {
        $sql = "SELECT * FROM tm_usuario WHERE est = 1 AND usu_id NOT IN (SELECT usu_id FROM td_curso_usuario WHERE cur_id=? AND est=1)";
        return $this->execute_query($sql, [$cur_id]);
    }
}