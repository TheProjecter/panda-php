<?php 

class Panda_Framework_View {
    
    public function render()
    {
        $controller = Panda_Framework_Controller::getControllerName();
        $action = Panda_Framework_Controller::getActionName();
        
        include 
            PANDA_PROJECT_DIR . DIRECTORY_SEPARATOR . 
            'views' . DIRECTORY_SEPARATOR . 
            $controller . DIRECTORY_SEPARATOR . 
            "$action.html";
    }
    
}

?>