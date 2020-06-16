<?php

    class Plug {
        private $label;
        private $description;
        private $idPlug;
        public function __construct($label, $description, $idPlug)
		{
            $this->label = $label;
            $this->description = $description;
            $this->idPlug = $idPlug;
        }

        public static function list() {
            $req = App::getDb()->query('SELECT plugs.*,categories.label as catLab FROM plugs, categories WHERE plugs.idCat=categories.idCat ORDER BY idPlug');
            return $req->fetchAll(PDO::FETCH_OBJ);
        }
        
        public function create() {
            try {
                $req = App::getDb()->prepare("INSERT INTO plugs VALUES(?, ?, ?, ?)");
                $req->execute([$this->newId(), $this->label, $this->description, $this->idPlug]);
            } catch (PDOException $e) {
                die($e->getMessage());
            } 
        }

        public function update() {
            try {
                $req = App::getDb()->prepare("UPDATE plugs SET label=?, description=? WHERE idPlug=?");
                $req->execute([$this->label,$this->description, $this->idPlug]);
            } catch (\PDOException $e) {
                die($e->getMessage());
            }

        }

        public static function delete($id) {
            try {
                /**All children will be deleted*/
                $req = App::getDb()->prepare("DELETE FROM plugs WHERE idPlug=?");
                $req->execute([$id]);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        private function newId() {
            $exist_nums = App::getDb()->query('SELECT idPlug FROM plugs ORDER BY idPlug');
            $exist_nums = $exist_nums->fetchAll(PDO::FETCH_OBJ);
            $new_id = 1;
            foreach($exist_nums as $nums) {
                if($nums->idPlug != $new_id) break;
                $new_id++;
            }
            return $new_id;
        }
    }
?>