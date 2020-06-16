<?php 

class CategoriesController extends AppController {

    public function index() {
     
        $fic = fopen("others/tree.php", "w") or die("fichier non ouvert!");
        fwrite($fic, Category::list());
        fclose($fic);
       $this->render('categories.index');
    }
    public function edit() {

        $_GET['id'] = (isset($_GET['id']) && is_numeric($_GET['id'])) ? $_GET['id'] : 1;

        $actualCat = array(null, null);
        $children = array();

        $_category = Category::search($_GET['id']);
        foreach($_category as $cat)$actualCat = array($_GET['id'], $cat->label);

        $_category = Category::getChildren($_GET['id']);
        foreach($_category as $cat)$children[$cat->idCat] = $cat->label;

        /**Get all plugs */
        $plugs = Category::getPlug($_GET['id']);

        $categories = array($actualCat, $children, $plugs);

        $this->render('categories.edit', compact('categories')); 
    }

    public function update() {
        /**@variables have to exist */
        $_GET['id'] = isset($_GET['id']) ? $_GET['id'] : null;
        $_GET['label'] = isset($_GET['id']) ? $_GET['label'] : null;

        $_category = new Category($_GET['id'], $_GET['label']);
        $_category->update();
        $this->edit();
    }

    public function delete() {

        if(isset($_GET['id']))
            Category::delete($_GET['id']);
        $this->index();
    }

    public function create() {
        
        if(isset($_GET['parent_id']) && isset($_GET['newcat'])) 
        {
            $cat = new Category($_GET['parent_id'], $_GET['newcat']);
            $cat->create();
        }
        $this->index();
    }
//Plug
    public function addPlug() {

        if(isset($_GET["label"]) && isset($_GET["description"])) {
            $plug = new Plug($_GET["label"], $_GET["description"], $_GET["id"]);
            $plug->create();
        }
        $this->edit();
    }
    
    
}
?> 