<?php
    class Controller {
        
        
        public function renderView($view,$masterpage = true) {
            
            $view_address = "views/". str_replace("Controller","",get_class($this))."/".$view;
            
            if($masterpage) {
                require_once("views/_shared/master_page.php");
                return;
            }
            
            require_once($view_address);
            
            
        }
        
        
    }