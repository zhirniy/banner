<?php 
  namespace Banner\Model;
 //Класс соединения с базой данной
 //При создании объекта класса содаёться соединение с базой
   class Connect
  {

  public function __construct()
  {
     
    $this->dbn = new \PDO('mysql:host=localhost; dbname=stats', 'root', '12345678');
 
  }
    
 //Метод отправляет запрос к базе данных 
  public function execute($sql, $params = [])
  {
   $sth = $this->dbn->prepare($sql);
   $res = $sth->execute($params);
   return $res;
}
//Метод получает данные из базы данных
   public function query($sql, $params, $class)
   {

   $sth = $this->dbn->prepare($sql);
   $res = $sth->execute($params);
   if(false !== $res){
   	return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
   }
   return [];
  }

 
}



?>
