<?php 
namespace Banner\Model;
//Функция display отображает главную страницу с папки Views/index.php 
class View implements \Countable
{
	public function render($url)
	{
		include $url;
	}
	public function display($url)
	{
		echo $this->render($url);
	}
	public function count()
	{
		return count($this->data);
	}
}
?>