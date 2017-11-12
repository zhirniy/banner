<?php  

 namespace Banner\Model;
//Класс Banner\Model содержит методы обработки запросов Controller/banner.php

abstract class Model
{
	const TABLE_IPS ='';
    const TABLE_VISITS ='';
	
//Получение необходим значений из базы visits по параметрам
    public static function property_visits(...$params)
    {
        $dbn1 = new Connect();
        return $dbn1->query('SELECT '.$params[0].' FROM '. static::TABLE_VISITS .' WHERE '. $params[1].'='.'"'.$params[2].'"', [], static::class);  
    }
    
//Удаление данных из таблицы ips
     public  function delete($table)
    {
            $sql = 'DELETE FROM '.$table;
            $dbn1 = new Connect();
            $dbn1->execute($sql);
    }
//Добавление данных в таблицу ips по параметрам
    public  function insert_ips(...$params)
    {        
            $sql = 'INSERT INTO '.static::TABLE_IPS.' SET '.$params[0].' = '.'"'.$params[1].'"';
            $dbn1 = new Connect();
            $dbn1->execute($sql);
    }

//Добавление данных в таблицу visits по параметрам
         public  function insert_visits(...$params)
    {
            $sql = 'INSERT INTO '.static::TABLE_VISITS.' SET '.$params[0].' = '.'"'.$params[1].'"'.', '.$params[2].', '.$params[3];
            $dbn1 = new Connect();
            $dbn1->execute($sql);
    }
//Получение данных из таблицы ips по параметрам
    public static function property_ips(...$params)
    {
  
            $sql = 'SELECT '.$params[0].' FROM '. static::TABLE_IPS .' WHERE '. $params[1].'='.'"'.$params[2].'"';
            $dbn1 = new Connect();
            return $dbn1->query($sql, [], static::class);  
   
    }
//Обновление данных в таблице visits согласно параметров
    public  function update_visits(...$params)
    {
    
        if($params[0] !=null){
            $dbn1 = new Connect();
            $dbn1->execute("UPDATE ".static::TABLE_VISITS." SET `$params[1]`=`$params[1]`+1 WHERE `$params[2]`='$params[3]'");}
        else{
            $dbn1 = new Connect();
            $dbn1->execute("UPDATE ".static::TABLE_VISITS." SET `$params[0]`=`$params[0]`+1,`$params[1]`=`$params[1]`+1 WHERE `$params[2]`='$params[3]'");

        }

          }
//Получение суммы ячеек из таблицы согласно запроса
    public static function count(...$params)
    {
      
        $dbn1 = new Connect();
       
        $result = $dbn1->query('SELECT SUM('.$params[0].') FROM '.static::TABLE_VISITS, [],
        static::class);
        $result = $result[0];
        $posts;
              foreach ($result as $key => $value) {
                   if ($value === null) continue;
                   else{$posts = intval($value);}
              }
        return $posts;
    
}

	}
?>