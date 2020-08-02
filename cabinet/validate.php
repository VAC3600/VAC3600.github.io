
<html><head></head><body>﻿﻿
<a onclick="javascript:$('html, body').animate({ scrollTop: $('html').offset().top}, 1100 ); return false;" href="#up" <div="" class="scrolltotop" style="display: block;"><div class="scrolltotop__side"></div><div class="scrolltotop__arrow"></div></a>






<center>






<meta http-equiv="content-type" content="text/html; charset=windows-1251">
<title>Сервера CS 1.6, Мониторинг Серверов CS 1.6 | WWW.SM-SERVERS.RU</title>
<link href="/templates/css/bootstrap.min.css" media="screen" rel="stylesheet" type="text/css">
<link href="/templates/css/main.css" rel="stylesheet" type="text/css" media="all">
<link href="/templates/css/header.css?4" media="screen" rel="stylesheet" type="text/css">
<link href="/templates/css/facebox.css" media="screen" rel="stylesheet" type="text/css">
<link href="/templates/top.css" media="screen" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="/CS2.ico" type="image/x-icon">

<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<meta name="keywords" content="мониторинг, игровые сервера, сервера, серверы, рейтинг игровых серверов, онлайн мониторинг игровых серверов, cs сервера, counter-strike, cs, cs мониторинг, cs 1.6 сервер, сервер кс, counter-strike: source, css, half-life, hl, half-life 2, hl 2, hl2, team fortress 2, tf 2, tf2, q3, quake III, quake 3, quake, steam, nosteam">
<meta name="description" content="Мониторинг игровых серверов - Counter-Strike 1.6, Half-Life, Half-Life 2: Death Match, Team Fortress 2, Quake III">
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/jquery.cookie.js"></script>
<script type="text/javascript" src="/js/functions.js"></script>
<script type="text/javascript" src="/js/facebox.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>
<script type="text/javascript" src="include/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="include/js/cookies.js"></script>
<script type="text/javascript" src="include/js/jquery.cookies.js"></script>
<script type="text/javascript" src="include/js/functions.js"></script>

<meta name="webmoney.attestation.label" content="webmoney attestation label#2BBFD8D7-EC59-4DAD-B163-F280E5D7052C">



<?php

//Reg 'login'
    if (isset($_POST['login'])) 
    { 
		$login = $_POST['login']; 
		if ($login == '') 
		{ 
			unset($login);
		}
	} //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
//Profile 'Pass'
 if (isset($_POST['password'])) 
    {
        $password=$_POST['password'];
		if ($password =='') 
		{
			unset($password);
		}
	}
//Profile 'Имя'			 
	if (isset($_POST['name'])) 
    {
		$name=$_POST['name'];
		if ($name =='') 
		{
			unset($name);
		}
	}
//Profile 'Фамилия'			 
	if (isset($_POST['names'])) 
    {
		$names=$_POST['names'];
		if ($names =='') 
		{
			unset($name);
		}
	}
//Profile 'Email'			 
	if (isset($_POST['email'])) 
    {
		$email=$_POST['email'];
		if ($email =='') 
		{
			unset($email);
		}
	}
    //заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную
 if (empty($login) or empty($password) or empty($name) or empty($names) or empty($email)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
    {
    exit ("<center><br><br><br><br><br><br>Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
    }
    //если логин и пароль введены, то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
    $login = stripslashes($login);
    $login = htmlspecialchars($login);
	$password = stripslashes($password);
    $password = htmlspecialchars($password);
 //удаляем лишние пробелы
    $login = trim($login);
    $password = trim($password);
	$name = trim($name);
	$names = trim($names);
	$email = trim($email);
 // подключаемся к базе
    include ("db.php");// файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь 
 // проверка на существование пользователя с таким же логином
    $result = mysql_query("SELECT id FROM users WHERE login='$login'",$db);
    $myrow = mysql_fetch_array($result);
    if (!empty($myrow['id'])) {
    exit ("<center><br><br><br><br><br><br><br>Извините, введённый вами логин уже зарегистрирован. Введите другой логин.");
    }
 // если такого нет, то сохраняем данные
    $result2 = mysql_query ("INSERT INTO users (login,password,name,names,email) VALUES('$login','$password','$name','$names','$email')");
    // Проверяем, есть ли ошибки
    if ($result2=='TRUE')
    {
    echo "<center><br><br><br><br><br><br><br>Вы успешно зарегистрированы! Теперь вы можете зайти на сайт. <a href='/cabinet'>Главная страница</a><center>";
    }
 else {
    echo "Ошибка! Не удалось подключится к бд!.";
    }
    ?>