<?php 
//Класс Banner содержит навзвание констант таблиц и их свойств
namespace Banner\Model;
use Banner\Model\Connect;
use Banner\Model\Model;

class Banner extends Model
{
const TABLE_IPS ='ips';
const TABLE_VISITS ='visits';
public $ip_id;
public $ip_address;
public $visit_id;
public $date;
public $hosts;
public $views;
}





 ?>