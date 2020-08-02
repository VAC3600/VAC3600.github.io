<center>
<html>
<head>

<!-- Put this script tag to the <head> of your page -->
<script type="text/javascript" src="//vk.com/js/api/openapi.js?115"></script>

<script type="text/javascript">
  VK.init({apiId: 4562607, onlyWidgets: true});
</script>


<meta http-equiv="content-type" content="text/html; charset=windows-1251" />
<title>Сервера CS 1.6, Мониторинг Серверов CS 1.6 | WWW.SM-SERVERS.RU</title>
<link href="/templates/css/bootstrap.min.css" media="screen" rel="stylesheet" type="text/css" />
<link href="/templates/css/main.css" rel="stylesheet" type="text/css" media="all">
<link href="/templates/css/header.css?4" media="screen" rel="stylesheet" type="text/css" />
<link href="/templates/css/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<link href="/templates/top.css" media="screen" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="http://cs-servera.net/favicon.ico" type="image/x-icon">

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
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>

</head>



<body>
<table cellspacing="0" cellpadding="0" width="1033px" height="100%"><tr><td valign="top">
<div class='box_1'>
<div style="border:1px solid rgba(255, 255, 255, 0.19);">
<div class="logo_stat">
	<div class="logoo">
		<div style="position:absolute;z-index:1;"><a href="/"><img src="/images/logo.png" width="150" height="41" /></a></div>
	</div>
<?
	$result_m = dbquery("SELECT server_map, COUNT(*) AS cnt FROM " . DB_SERVERS . " where server_status != 0 and server_new != 1 and server_off != 1 GROUP BY server_map  ORDER BY cnt  DESC  LIMIT 1");
		$row_map = dbrows($result_m);
		$data_map="";
		$i=0;
		while($r=dbarray_fetch($result_m)) {

			$data_map.= "".$r['server_map']."";
			if($i==0){$data_map.="";}else{$data_map.=".";}
				
			$i++;
	}
	list($weekserv) = dbarray_fetch(dbquery("SELECT Count(server_id) FROM `".DB_SERVERS . "` WHERE server_regdata > '" . (time()-86400) . "'"));
	$site = "cs-get.ru";
	$v = 0;
	for($i=0; $i<count($site); $i++)
	{
		$content = file_get_contents("http://www.liveinternet.ru/stat/".$site."/");
		if(strstr($content, 'need_password'))
		{
			echo "Для доступа к этому сайту необходимо ввести пароль";
		}
		else
		{
			$content = explode("\n", $content); 
			for($y=0; $y<count($content); $y++)
			{
				if(strstr($content[$y], "mins_vis.html"))
				{
					$v += strip_tags($content[$y+2]);
				}
			}
		}
		
	}
	echo '<div class="stat">Обновление выполнено '; echo time() - $settings['last_update']; echo' секунд назад,  В базе <span style="cursor:help;color:#BBBBBB;" title="за сегодня добавленно '.$weekserv.' сервера">'.$servers_online.' серверов</span> онлайн<br />Самая популярная карта ' .$data_map. '. Скачайте нашу версию CS 1.6 без рекламы <a href="https://cloud.mail.ru/CE42E2E2E95A49559814CDB6AEE0DFA1">cкачать</a></div>
	'; ?>
	

<div class="search">

<a href="skype:mon.sm-servers?add" class="skype-add" title="Нажмите что бы добавить MON.SM в Skype">Личный кабинет<span></span></a>

</div>


</div>

<div class="new_menu" align="center">
	<div class="ull">
		<ul class="top-navigation">
			<li class="top_menu vip"><a href="/pay/">Платные услуги</a></li>
			<li class="top_menu"><a href="/add/">Добавить сервер</a></li>
			<li class="top_menu"><a href="/edit/">Редактировать сервер</a></li>

			<li class="top_menu"><a href="/feedback/">Контакты</a></li>
			<li class="top_menu"><a href="/search/">Подобрать сервер</a></li>
			<li class="top_menu"><a href="/admin/login.php">Панель администрирования сайта</a></li>
		</ul>
	</div>

</div>



<center>
		<div class="clearfix"></div>

		<div id="top_servers">
</center>


