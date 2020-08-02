<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en-US" xmlns="http://www.w3.org/1999/xhtml" dir="ltr">

<head>
	<title>AdrenaLine [Игровые сервера]</title>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	
        <meta name="description" content="Аренда игровых серверов по низким ценам в Украине, Качественный хостинг игровых серверов, Самые низкие цены на игровые сервера в Украине, хостинг от проекта игровые позитиф сервера"> 
        <meta name="Keywords" content="Украинский хостинг по низким ценам, удобная панель управления, скорость подключения порта 1 Гбит, Бесплатная быстрая загрузка, бесплатный амхбанс, защита от всех известных гадостей, как защитить свой сервер, проект позитиф, сервера от позитива, лучшая техническая поддержка, my-servak.com.ua, My-Servak.com.ua, www.my-servak.com.ua, хостинг игровых серверов от позитива, counter strike, сервера cs 1.6, игровые сервера, cs server, серваки контры, HLTV, аренда игровых серверов ,игровой хостинг, хостинг игровых серверов, лучший игровой хостинг хостинг, заказать сервер кс, аренда cs, серверов аренда, серверов кс ,аренда игровых серверов cs, игровой хостинг, дешевый хостинг серверов cs, украинский хостинг, хостинг в украине, нихкие цены на  хостинг в украине, бесплатный хостинг серверов cs">
        
        <link rel="shortcut icon" href="/templates/css/images/favicon.ico" />
	<link rel="stylesheet" href="/templates/css/style.css" type="text/css" media="all" />
	<link href="/templates/css/main.css" rel="stylesheet" type="text/css" media="all">

	<link rel="stylesheet" href="/templates/css/flexslider.css" type="text/css" media="all" />
	<link href="/cabinet/css/2.css" media="screen" rel="stylesheet" type="text/css" />
	<!--[if IE 6]>
		<link rel="stylesheet" href="css/ie6.css" type="text/css" media="all" />		
	<![endif]-->
	<link href='http://fonts.googleapis.com/css?family=Play:400,700&amp;subset=latin,cyrillic-ext,greek,greek-ext,latin-ext,cyrillic' rel='stylesheet' type='text/css' />
	<script src="/templates/js/jquery-1.7.1.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="/templates/js/jquery.jcarousel.js" type="text/javascript"></script>
	<script src="/templates/js/jquery.flexslider.js" type="text/javascript"></script>
	<script src="/templates/js/DD_belatedPNG-min.js" type="text/javascript"></script>
	<script src="/templates/js/functions.js" type="text/javascript" charset="utf-8"></script>

</head>
  <style>
   body {
    margin: 0;
   }
   .feedback {
border-radius: 0 3px 3px 0;
width: 150px;
background: #333;
color: #fff;
position: fixed;
min-height: 100px;
top: 42px;
left: -169px;
border-right: 20px solid #436EEE;
padding: 10px;
transition: left 1s;
}
   .feedback img {
    float: right;
    margin: 0 10px 0 0;
   }
   .feedback::after {
    content: 'Мини профиль'; /* Выводим текст */
    color: #fff; /* Цвет надписи */
	font-family: 'Play', sans-serif;
	font-size: 14px; /* Размер надписи*/
    position: absolute; /* Абсолютное позиционирование */
    right: -60px; bottom: 50px;
    transform: rotate(-90deg); /* Поворачиваем текст */
    -webkit-transform: rotate(-90deg);
   }
   .feedback:hover {
    left: 0; /* При наведении сдвигаем вправо */
   }

<body>
  </style>

<!-- Wrapper -->
	<div id="wrapper">
		<!-- Shell -->
		<div class="shell">
			<div class="socials">
				<a title="Facebook" class="facebook" href="#">facebook</a>
				<a title="Twitter" class="twitter" href="#">twitter</a>
				<a title="RSS" class="rss" href="#">rss</a>				
			</div>
								<?php
	@session_start();
    // Проверяем, пусты ли переменные логина и id пользователя
    if (empty($_SESSION['login']) or empty($_SESSION['id']))
    {
    // Если пусты,
    echo "<p id='top-navigation'><a title='Войти?' href='/cabinet'><b>Войти?</b></a><span>|</span><a title='Регистрация' href='/cabinet/reg.php'><b>Регистрация</b></a><span></p>";
    }
    else
    {

    // Если не пусты :
    echo "
	<p id='top-navigation'><a title='Мой профиль' href='/cabinet/profile.php'><b>Мой профиль</b></a><span>|</span><a title='Выход' href='/cabinet/exit.php'><b>Выход</b></a><span></p>

	
	";
    }
    ?>
			
			<div class="cl"></div>
			<!-- Header -->
			<div id="header">
				<!-- Logo -->
				<div id="logo">
					<h1><a href="/" title="AdrenaLine [Игровые сервера]">AdrenaLine [Игровые сервера]</a></h1>
					<p class="slogan">игровой проект counter-strike 1.6</p>
				</div>
				<!-- END Logo -->
				<!-- Search -->
		<div id="search">
					<form action="" method="post">
						<input type="text" class="field" value="Поиск ..." title="Search here ..." />
						<input type="submit" value="" class="submit-button" />
					</form>
				</div>
<!-- END Search -->
				<div class="cl"></div>
			</div>
			<!-- END Header -->
			<!-- Navigation -->
			<div id="navigation">
				<ul>
					<li class="first"><a title="Главная" href="/">Главная&nbsp;</a></li>
					<li><a title="Новости" href="/news">Новости&nbsp; &nbsp;</a></li>
					<li><a title="Дополнительные услуги" href="/services">Доп. услуги</a></li>
					<li><a title="Мониторинг арендуемых серверов" href="#">Мониторинг</a></li>

					
				</ul>
				<div class="cl"></div>
			</div>
			    <div class="feedback">
												<?php
	@session_start();
    // Проверяем, пусты ли переменные логина и id пользователя
    if (empty($_SESSION['login']) or empty($_SESSION['id']))
    {
    // Если пусты,
    echo "Внимание!Для просмотра этой информации необходимо пройти авторизацию или зарегистрироваться!<br>
	<center>
	<a href='/cabinet/'>Войти?</a><br>
	<a href='/cabinet/reg.php'>Регистрация</a>
	</center>";
    }
    else
    {

    // Если не пусты :
    echo "<center>
	<img src='/images/no_ava.png'><br>
	<font color='white'>Приветствуем вас</font> <br><font color='red'><b>".$_SESSION['login']." </b></font><br>
	<b>
	<a href='/cabinet/profile.php'>Мой профиль</a><br>
	<a href='/cabinet/main_news.php'>Мои новости (0)</a><br>
	<a href='/cabinet/servers.php'>Мои сервера(0)</a><br>
	<a href='/cabinet/support.php'>Тех. поддержка</a><br>
	<a href='/cabinet/exit.php'>Выход</a><br>
	</b>
	</center>
	";
    }
    ?>
				</div>
			<!-- END Navigation -->
		<!-- Slider 
			<div id="slider" class="flexslider">
				<ul class="slides">
					<li>
						<img src="templates/css/images/slide.png" alt="1 слот от 4 грн (16 руб.) в месяц" />
						<div class="caption">
							<p>Counter Strike 1.6<span>Сервера от 40 грн (160 руб.) в месяц</span><a class="watch-now" title="Заказать игровой сервер Counter Strike 1.6" href="cs.html">Заказать!</a></p>			
						</div>
                                        </li>
				
                                         <li>
						<img src="templates/css/images/slide3.png" alt="1 слот от 5 грн (20 руб.) в месяц" />
						<div class="caption">
							<p>Team Fortress 2 и CS:Source<span>Сервера от 50 грн (200 руб.) в месяц</span><a class="watch-now" title="Заказать игровой сервер Counter Strike 1.6" href="servers.html">Заказать!</a></p>			
						</div>
                                        </li>
				</ul>				
			</div>
			END Slider -->
			<!-- Main -->
			<div id="main">
				<div id="main-top"></div>
				<div id="main-middle">
								<!-- Content -->
					<div id='content'>
						
						<div class='post games'>