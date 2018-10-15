<?php
require_once("core/controller.php");

class homeController extends Controller {
    function indexAction() {
        $this->renderView("index.php");
    }
    
    function testAction() {
        $this->renderView("test.php");
    }
}