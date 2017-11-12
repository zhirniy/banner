<?php 
namespace Banner\Controller;
//При создании объекта класса Controler\Tasc автоматически создаётся объект класса Model\View  
// и на созданном объекте вызываем  функцию display 

class Task
{
	   
	   public function __construct()
	   {
	   	$this->view = new \MVC\Model\View();
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