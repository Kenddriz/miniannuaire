<?php
define('ROOT', dirname(__DIR__));

require "../app/app.php";
require "../core/controller/controller.php";
require "../app/models/category.php";
require "../app/models/plug.php";
require "../app/controllers/appController.php";
require "../app/controllers/categoriesController.php";
require "../app/controllers/plugsController.php";

$page = (isset($_GET['page'])) ? $_GET['page']:'index';
$page = str_replace('.php', '', $page);

//ob_start();//To storage witch will printed
switch($page) {

    case 'categories.edit': 
        $controller = new CategoriesController();
        $controller->edit();
        break;
    case 'categories.update': 
        $controller = new CategoriesController();
        $controller->update();
        break;
    case 'categories.delete': 
        $controller = new CategoriesController();
        $controller->delete();
        break;
    case 'categories.add': 
        $controller = new CategoriesController();
        $controller->create();echo 45;
        break;
    case 'plugs.addPlug': 
        $controller = new CategoriesController();
        $controller->addPlug();
        break;
    case 'plugs.index': 
        $plug = new PlugsController();
        $plug->index();
        break;
    case 'plugs.update': 
        $plug = new PlugsController();
        $plug->update();
        break;
    case 'plugs.delete': 
        $plug = new PlugsController();
        $plug->delete();
        break;
    
    default: 
        $controller = new CategoriesController();
        $controller->index();
        break;
        //require_once '../app/Views/home.php';
        
}
?>