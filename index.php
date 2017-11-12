<?php
//Приложение можно сразу запускать с View/index.php.
//Действия index->Tasc->View приняты только для реализации паттерна MVC
//Подключаем автозагрузку
require 'autoload.php';
//Создаём обёкт класса Tasc и передаём ему название файла который нужно загрузить 
//при переходе пользователем на главную страницу 
$controler = new Banner\Controller\Task();
$action = 'Index';
$controler->action($action);
?>

