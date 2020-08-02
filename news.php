<?php

include(INCLUDES."pagination.class.php");
$pagination = new pagination;

$page_num = 1;
if(isset($_GET['page_num'])) $page_num = $_GET['page_num'];
$needed_servers = dbquery("SELECT count(*) FROM ".DB_DEMONEWS . " WHERE server_new != 1");
$needed_servers = dbarray_fetch($needed_servers);
$needed_servers = $needed_servers[0];
$pg_info = $pagination->calculate_pages($needed_servers, $settings['servers_per_page'], $page_num);
$query_limit = $pg_info['limit'];

// Uncomment the next line for pagination debug
//print_r($pg_info);

$select_query = "SELECT * FROM ".DB_DEMONEWS . " 
WHERE 
server_new != 1
ORDER BY 
about DESC ".$query_limit
;


$servers = dbquery($select_query);



/*
	$locale['010']	Имя сервера
	$locale['011']	Адрес
	$locale['013']	Игроки
*/

/* TABLE HEAD */
echo '<center><font size="6"><font color="green"><b>НОВОСТИ ПРОЕКТА</b></font></font></center><br>
<div class="post games">
';
/*echo "
<div id='right'>
		<div class='section'>
			<div class='box'>
				<div class='content'>
	";*/

/* TABLE BODY */

if($servers_total !=0 ) {
while($r=dbarray_fetch($servers)) {
		
				
		?>

		<?
		$row = "				";
		
/*			$row.="
	
<img src='/templates/images/name_servers.png' width='120' height='20'> <font size='4'>{$r['server_name']}</font><br>
<img src='/templates/images/ip_servers.png' width='120' height='20'> <font size='4'>{$r['server_ip']}</font> <br>
<img src='/templates/images/maps_servers.png' width='120' height='20'> <font size='4'>{$r['server_map']}</font> <br><br><br>

";*/
			$row.="

<h2>{$r['title']} (22.11.12)</h2>
<p><b>{$r['about']}</b></br>
</br> 
<a title='Подробнее' class='learn-more' href='/news/{$r['news_id']}'>Подробнее</a></p>
					<br>		




";

		echo $row;
	}
	
} else {
	echo "						";
}
echo "</div>";
/* TABLE END */

/* PAGINATION */

/*if(count($pg_info['pages']) > 1) {
	echo "<div class='pagination' align='center' style='margin-bottom:10px; margin-top:10px;'>";
	if($pg_info['current'] == 1) {
		echo "<span>Назад</span>&nbsp;";
		echo "<span>1</span>";
	} else {
		echo "<a href='/all/{$pg_info['previous']}' rel='nofollow'>Назад</a>&nbsp;";
		echo "<a href='/all/1'>1</a>";
	}
	echo "&nbsp;";

	foreach($pg_info['pages'] as $k => $v) {
		if($v == 1 or $v == $pg_info['last']) continue; 
		if($v == $pg_info['current'] or $v == '...') {
			echo "<span>$v</span>";
		} else {
			echo "<a href='/all/$v' rel='nofollow'>$v</a>";
		}
		echo "&nbsp;";
	}

	if($pg_info['current'] == $pg_info['last']) {
		echo "<span>{$pg_info['last']}</span>&nbsp;";
		echo "<span>Вперёд</span>";
	} else {
		echo "<a href='/all/{$pg_info['last']}' rel='nofollow'>{$pg_info['last']}</a>&nbsp;";
		echo "<a href='/all/{$pg_info['next']}' rel='nofollow'>Вперёд</a>";
				echo "<div style='float:left;'><a title='Прокрутить сайт ввверх' href='/#top' rel='nofollow'>Вверх сайта</div></a>";
		echo "<div style='float:right;'><a title='Прокрутить сайт ввверх' href='/#top' rel='nofollow'>Вверх сайта</div></a>";
	}

	
	echo "</div>";
}*/
/* PAGINATION END */

?>