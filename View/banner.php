<?php
//Обробочткой колличества посещений будет заниматься файл Controler/banner.php. 
//Файл view/banner.php у нас активный шаблон, который выводит колличества посещений
//за день или общее за всё время в зависимости от пожеланий пользователя. Все данные берутся 
//из файла Controler/banner.php
include '\..\Controller\banner.php';

echo '<div class="image" style="border: solid 10px green; width: 250px;">';
echo '<img src = "img/baner.jpg" alt = "счетчик" style="max-width: 100%;"/>';
echo '<h4>Уникальных посетителей: ' . $result_day_hosts . '<br />';
echo 'Просмотров: ' . $result_day_views . '</h4>';
echo '</div>';
echo '<p><a href=".">За сегодня</a>&#8195<a href="?days=all">За всё время</a></p>';
echo '<p><a href="?days=ip_all">Подробная информация посетителей за сегодня</a>';
echo '<p><a href="?days=all_all">Подробная информация за всё время</a>';
echo "<br>";
?>
<?php
//Так же шаблон выводит данные об общем колличестве поещений за всё время
if($result_all !== null):

foreach ($result_all as $row):
	
    echo "<br>";
   	echo "<label>Номер:".$row->visit_id."</label>&#8195";
    echo "<label>Дата:".$row->date."</label>&#8195";
	echo "<label>Хосты:".$row->hosts."</label>&#8195";
	echo "<label>Просмотры:".$row->views."</label>";
	
endforeach;

endif;

//Или данные ip пользователей за сегодня
if($result_ips !== null):

foreach ($result_ips as $row):
	
    echo "<br>";
   	echo "<label>Номер:".$row->ip_id."</label>&#8195";
    echo "<label>DNS:".$row->ip_address."</label>&#8195";
	
endforeach;

endif;


?>