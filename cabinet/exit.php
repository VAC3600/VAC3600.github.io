<?php
	

//Запускаем Сессию
session_start();

//Уничтожаем переменные в сессиях
unset($_SESSION['password']);
unset($_SESSION['login']); 
unset($_SESSION['id']);

//Отправляем пользователя на главную страницу.
exit("<html><head><title>Загрузка..</title><meta http-equiv='Refresh' content='0; URL=/cabinet/'></head></html>");

?>