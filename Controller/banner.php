<?php 
namespace Banner\Controller;
require '/../autoload.php';

// Получаем IP-адрес посетителя и сохраняем текущую дату
$visitor_ip = $_SERVER['REMOTE_ADDR'];
date_default_timezone_set('UTC');
$date = date("Y-m-d");

// Создаём объект класса Banner с свойствами visit_id, date, hosts, views, ip_id, ip_address
//и константами названиеми таблиц visits и ips
// Создаём таблицу visits(visit_id, date, hosts, views,) - будет хранить инофрмацию по посещениям за всё время'
//Создаём таблицу ips(ip_id, ip_address) - удет хранить информацию по ip посетителей за сегодня
$baner = new \Banner\Model\Banner();
// Узнаем, были ли посещения за сегодня для этого отправляем запрос в таблицу visits и передаём текущую дату
$visit_id = $baner::property_visits('visit_id','date', $date);
//Если сегодня не было заходов на сайт - то очищаем таблицу ips и вносим в неё данные первого посетителя за сегодня. Также создаём завись в таблице visits с текущей датой
if(empty($visit_id)){
    $baner->delete('ips');
    $baner->insert_ips('ip_address', $visitor_ip);
    $baner->insert_visits('date', $date, 'hosts=1', 'views=1');
}
//Если сегодня уже были посетители
else{
    //отправлем запрс в таблицу ips и просим найти хранит ли она запись поситетиле идентичную нашей
    $second_visitor = $baner::property_ips('ip_id','ip_address', $visitor_ip);   
    //Если такая запись есть - то записываем +1 к колличеству посещений таблицы visits
    if(empty($second_visitor)){
      $baner->update_visits(null, 'views', 'date', $date);   
    }
    else{
     //Если такой записи нет - то носим её в таблицу ips 
     //Так же добавляем +1 к посещением и хостам таблицы visits   
      $baner->insert_ips('ip_address', $visitor_ip);  
      $baner->update_visits('hosts','views', 'date', $date);  
    }
}
//Получаем данные из таблицы visits по хостам и просмторам за сегодня
$result_day = $baner::property_visits('*','date', $date);
$result_day = $result_day[0];
$result_day_hosts;
$result_day_views;
foreach ($result_day as $key => $value) {
   if($key=='hosts'){
    $result_day_hosts = $value;
   }
   else if($key=='views'){
    $result_day_views = $value;
   }
}
//Если был запрос от пользователя то берём данные из таблицы по общему колличеству посещений за всё время
if ($_GET['days']=='all'){
    $result_week_views = $baner->count('views');
    $result_day_views = $result_week_views;
    $result_week_hosts = $baner->count('hosts');
    $result_day_hosts = $result_week_hosts;
}
//Если был запрос от пользователя то берём данные из таблицы по всем параметрам посещений за всё время
if($_GET['days']=='all_all'){
$result_all = $baner::property_visits('*',1,1);
$result_week_views = $baner->count('views');
$result_day_views = $result_week_views;
$result_week_hosts = $baner->count('hosts');
$result_day_hosts = $result_week_hosts;}
//Если был запрос от пользователя то берём данные из таблицы за сегдня по посетителям сайта
if($_GET['days']=='ip_all'){
$result_ips = $baner::property_ips('*',1,1);
}

?>