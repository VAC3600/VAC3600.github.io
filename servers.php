<?php

include(INCLUDES."pagination.class.php");
$pagination = new pagination;

$page_num = 1;
if(isset($_GET['page_num'])) $page_num = $_GET['page_num'];
$needed_servers = dbquery("SELECT count(*) FROM ".DB_SERVERS . " WHERE server_new != 1 AND server_status != 0 AND server_off != 1");
$needed_servers = dbarray_fetch($needed_servers);
$needed_servers = $needed_servers[0];
$pg_info = $pagination->calculate_pages($needed_servers, $settings['servers_per_page'], $page_num);
$query_limit = $pg_info['limit'];

// Uncomment the next line for pagination debug
//print_r($pg_info);

$select_query = "SELECT * FROM ".DB_SERVERS . " 
WHERE 
server_new != 1 AND 
server_status != 0 AND 
server_off != 1 
ORDER BY 
server_vip DESC, votes DESC ".$query_limit
;


$servers = dbquery($select_query);



/*
	$locale['010']	Имя сервера
	$locale['011']	Адрес
	$locale['013']	Игроки
*/

/* TABLE HEAD */
echo '<center><font size="6"><font color="green"><b>ИГРОВЫЕ СЕРВЕРА</b></font></font></center><br>
<h2></h2>
';

/* TABLE BODY */

if($servers_total !=0 ) {
	while($r=dbarray_fetch($servers)) {
		$players = $r['server_players']."&nbsp;/&nbsp;".$r['server_maxplayers'];
		$server_location = $r['server_location'];
		if(empty($server_location)) $server_location = 'undefined';
				if(array_key_exists($r['server_row_style'], $styles)) {
			$row = "<tr style='{$styles[$r['server_row_style']]['style']}'>";
						} else {
		
		



if($r['server_players'] == $r['server_maxplayers'])
{ $players = "".$r['server_players']."&nbsp;/&nbsp;".$r['server_maxplayers']."";}

		if($r['server_status'] ==1)
{ $server_full=floor(($r['server_players'] / $r['server_maxplayers']) * 100); }

else
{ $server_full="0"; }
if($server_full=='0') $la = "la0";
if($server_full<='20' and $server_full>'0') $la = "la1";
if($server_full<='40' and $server_full>'20') $la = "la2";
if($server_full<='60' and $server_full>'40') $la = "la3";
if($server_full<='80' and $server_full>'60') $la = "la4";
if($server_full<='100' and $server_full>'80') $la = "la5";

		}
		?>

		<?
		$row = "				";
		
/*			$row.="
	
<img src='/templates/images/name_servers.png' width='120' height='20'> <font size='4'>{$r['server_name']}</font><br>
<img src='/templates/images/ip_servers.png' width='120' height='20'> <font size='4'>{$r['server_ip']}</font> <br>
<img src='/templates/images/maps_servers.png' width='120' height='20'> <font size='4'>{$r['server_map']}</font> <br><br><br>

";*/
			$row.="
	
<font size='3'><font color='red'>НАЗВАНИЕ СЕРВЕРА:</font></font> <font size='3'>{$r['server_name']}</font><br>
<font size='3'><font color='red'>IP СЕРВЕРА:</font></font> <font size='3'>{$r['server_ip']}</font> <br>
<font size='3'><font color='red'>КАРТА СЕРВЕРА:</font></font> <font size='3'>{$r['server_map']}</font> <br><br><br>

";

		echo $row;
	}
	
} else {
	echo "";
}

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