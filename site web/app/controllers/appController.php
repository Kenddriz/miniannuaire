<?php

class AppController extends Controller {
    
    protected $template;
    protected $viewPath;

     public function __construct() {
         $this->template = 'default';
         $this->viewPath = ROOT.'/app/views/';
     }
}
?>