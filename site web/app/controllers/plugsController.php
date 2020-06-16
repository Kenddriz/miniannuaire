<?php 

class PlugsController extends AppController {
    public function index() {
        
       $lists = Plug::list();
       $this->render('plugs.index', compact("lists"));
    }  

    public function update() {

        if(isset($_GET["id"]) && isset($_GET["label"]) && isset($_GET["description"])) {
            $plug = new Plug($_GET["label"], $_GET["description"], $_GET["id"]);
            $plug->update();
        }

        $this->index();
    }

    public function delete() {
        if(isset($_GET['id'])) {
            Plug::delete($_GET['id']);
        }
        
        $this->index();
    }
    
}
?> 