<?php 
namespace Banner\Controller;
require '/../autoload.php';
//При создании объекта класса Controler\Tasc автоматически создаётся объект класса Model\View  
// и на созданном объекте вызываем  функцию display 

class Task
{
	   
	   public function __construct()
	   {
	   	$this->view = new \Banner\Model\View();
	   }
        
        public function action($action)
        {
            
            $metodName = 'action'.$action;
            return $this->$metodName();	
        	
            
        }
      
		protected function actionIndex()
		{
		$this->view->display('View/index.php');}
		

	    	
		
	    
}


?>