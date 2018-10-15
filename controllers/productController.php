<?php
require_once("core/controller.php");

class productController extends Controller {
    function indexAction() {
        $this->renderView("index.php");
    }
}