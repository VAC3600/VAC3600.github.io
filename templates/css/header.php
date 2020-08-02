					<div class="box">
						<div class="title">
							Последние добавленные сервера
							<span class="hide"></span>
						</div>
						<div class="content">

							<table cellspacing="0" cellpadding="0">
								<thead>
									<tr>
										<th>Название</th>
										<th>Статус</th>
									</tr>
								</thead>
								<tbody>
								
									<?php
										$servers_list_l = dbquery("SELECT * FROM `".DB_SERVERS."` ORDER BY `server_id` DESC LIMIT 5");
										while($server_l = dbarray_fetch($servers_list_l)) {
											if($server_l['server_off'] == 1) {
												$status = "<font color='gray'>Забанен</font>";
											} elseif($server_l['server_new'] == 1) {
												$status = "<font color='gray'><b>Не активирован</b></font>";
											} elseif($server_l['server_status'] == 1) {
												$status = "<font color='green'>Онлайн</font>";
											} elseif($server_l['server_status'] == 0) {
												$status = "<font color='red'>Оффлайн</font>";
											}
											echo "<tr>
											<td><a href='server/{$server_l['server_id']}'>{$server_l['server_name']}</a></td>
											<td>$status</td>
											</tr>";
											$i++;
										}										
									?>
								
								</tbody>
							</table>

						</div>
					</div>
				</div>

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
border-right: 20px solid #181818;
padding: 10px;
transition: left 1s;
}
   .feedback img {
    float: left;
    margin: 0 10px 0 0;
   }
   .feedback::after {
    content: 'Обратная связь'; /* Выводим текст */
    color: #D8D8D8; /* Цвет надписи */
    position: absolute; /* Абсолютное позиционирование */
    right: -60px; bottom: 50px;
    transform: rotate(-90deg); /* Поворачиваем текст */
    -webkit-transform: rotate(-90deg);
   }
   .feedback:hover {
    left: 0; /* При наведении сдвигаем вправо */
   }
  </style>
 </head>
 <body>
  <div class="feedback">

   Если у вас возникли вопросы:<br><br>
   Skype:<br>
   1.mon.sm-servers
   2.npocto_fraer<br>

  </div>



<center>
<html>
<head>




<meta http-equiv="content-type" content="text/html; charset=windows-1251" />
<title>Раскрутка сервера, Мониторинг игровых серверов CS 1.6, CS: GO</title>
<link href="/templates/css/bootstrap.min.css" media="screen" rel="stylesheet" type="text/css" />
<link href="/templates/css/main.css" rel="stylesheet" type="text/css" media="all">
<link href="/templates/css/header.css?4" media="screen" rel="stylesheet" type="text/css" />
<link href="/templates/css/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<link href="/templates/top.css" media="screen" rel="stylesheet" type="text/css" />
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
<script type='text/javascript' src='include/js/jquery-1.7.2.min.js'></script>
<script type='text/javascript' src='include/js/cookies.js'></script>
<script type='text/javascript' src='include/js/jquery.cookies.js'></script>
<script type='text/javascript' src='include/js/functions.js'></script>

<META NAME="webmoney.attestation.label" CONTENT="webmoney attestation label#2BBFD8D7-EC59-4DAD-B163-F280E5D7052C">





</head>



<body>



<table cellspacing="0" cellpadding="0" width="1033px" height="100%"><tr><td valign="top">

<CENTER>Внимание: Подключён мастер-сервер скачав и установив <a href="/download/SM.CSCLUB.rar">MasterServers.vdf</A> вы можете видеть сервера с мониторинга из CS 1.6. Запросы более 9030 уников</span></CENTER>
<BR>


 
<div class='box_1'>



<div style="border:10px solid rgba(0, 0, 0, 0.36);">



<div class="hbg">
<div class="hidden" style="height:124px;">
<a href="/" class="hlogo"></a>

 <div class="hbanka">

<div style="position:relative;width:468px;height:60px;display: inline-block;*display: inline; margin: 3px 0 0 34px; margin: 8px -3px 0 9;">

<div class="transparency">
<div id="linkslot_23099"></div><script src="http://linkslot.ru/bancode.php?id=23099" async></script>
 </div> </div>

 
</div>


 
</div>
</div>


<div class="new_menu" align="center">
	<div class="ull">
		<ul class="top-navigation">
			<li class="top_menu vip"><a href="/pay/">Наши платные услуги</a></li>
			<li class="top_menu"><a href="/add/">Добавить сервер</a></li>
			

			<li class="top_menu"><a href="/feedback/">Контакты</a></li>
			<li class="top_menu"><a href="/links/">Купить движки</a></li>

			<li class="top_menu"><a href="/admin/login.php" target="_blank" >Панель Управления сайтом</a></li>
<li class="top_menu">





Вы вошли как - 

 


<?php
                 session_start();
    // Проверяем, пусты ли переменные логина и id пользователя
    if (empty($_SESSION['login']) or empty($_SESSION['id']))
    {
    // Если пусты,
    echo "<a href='/edit/'>Гость</a>";
    }
    else
    {

    // Если не пусты :
    echo "<a href='/cabinet/profile.php'> ".$_SESSION['login']."</a>";
    }
    ?>







</a>




</li>
		</ul>
	</div>

</div>



<center>
		<div class="clearfix"></div>

		<div id="top_servers">
</center>



