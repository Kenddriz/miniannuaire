<?php 

/**
 * Category class model allowe us to manipulate category table
 */
	class Category
	{

		public function __construct($idCat, $label)
		{
            $this->idCat = $idCat;
            $this->label = $label;
        }
        public function create() {
            try {
                $req = App::getDb()->prepare("INSERT INTO categories VALUES(?, ?, ?)");
                $req->execute([$this->newId(), $this->label, $this->idCat]);
            } catch (PDOException $e) {
                die($e->getMessage());
            } 
        }
        public function update() {
            try {
                $req = App::getDb()->prepare("UPDATE categories SET label=? WHERE idCat=?");
                $req->execute([$this->label, $this->idCat]);
            } catch (PDOException $e) {
                die($e->getMessage());
            }

        }
        public static function delete($id) {
            try {
                /**All children will be deleted*/
                $req = App::getDb()->prepare("DELETE FROM categories WHERE idCat=? OR idCat2=?");
                $req->execute([$id, $id]);
            } catch (\PDOException $e) {
                die($e->getMessage());
            }
        }
        /**@params integer $id */
        public static function search($id){
            $req =  App::getDb()->query("SELECT label FROM categories WHERE idCat=".$id.' LIMIT 1');
            return $req->fetchAll(PDO::FETCH_OBJ);
        }

        public static function getChildren($id) {
            $req =  App::getDb()->query("SELECT idCat, label FROM categories WHERE idCat2=".$id);
            return $req->fetchAll(PDO::FETCH_OBJ);
        }
        /**Get all plug */
        public static function getPlug($id){
            $req =  App::getDb()->query("SELECT idPlug, label FROM plugs WHERE idCat=".$id);
            return $req->fetchAll();
        }

        public static function list() {
            return json_encode(array_values(self::get_node_data(0)));/** 0 means that operation begins from parents */
        }
        //make a newly category id
        private function newId() {
            $exist_nums = App::getDb()->query('SELECT idCat FROM categories ORDER BY idCat');
            $exist_nums = $exist_nums->fetchAll(PDO::FETCH_OBJ);
            $new_id = 1;
            foreach($exist_nums as $nums) {
                if($nums->idCat != $new_id) break;
                $new_id++;
            }
            return $new_id;
        }
        private static function get_node_data($parent_id) {
            $req = App::getDb()->prepare("SELECT * FROM categories WHERE idCat2=?");
            $req->execute([$parent_id]);
            $res = $req->fetchAll();
            $output = array();

            foreach($res as $row) {
                $sub_cat = array();
                $sub_cat["text"] = $row["label"];
                $sub_cat["id"] = $row["idCat"];
                $sub_cat["selectedIcon"] = "glyphicon glyphicon-stop";
                $nodes = array_values(self::get_node_data($row["idCat"]));
                if(sizeof($nodes) > 0)$sub_cat['nodes']  = $nodes;
                $sub_cat["tags"] = [sizeof($nodes)];
                $output[] = $sub_cat;
            }
            return $output;
        }

	};
?>