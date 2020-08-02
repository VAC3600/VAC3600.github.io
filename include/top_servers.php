
<div>
<?php
/*
 * Top servers display script
 * Made by starky
*/

/* Script security */
if(!defined("MONENGINE")) {
	header("Location: index.php");
	exit();
}
/* Other code */

if($settings['top_rows'] > 0) {
	$top_servers = dbquery("SELECT * FROM ".DB_SERVERS." WHERE server_new = '0' AND server_top != '0'");
	while($top_servers_array = dbarray($top_servers)) {
		$i = $top_servers_array['server_top'];
		foreach($top_servers_array as $k => $v) {
			$tops_array[$i][$k] = $v;
			
		}
        }
	// Максимальное кол-во строк с топ-серверами
	define("LINES_NUM", $settings['top_rows']);
	// Шаблон занятого места
	$template_got = '

<div>
<div class="unit">

<div class="month">
<div style="position:absolute;padding:0;margin:1px;z-index:1;opacity:0.8;display:block;width:16px;"><img src="/images/icons/{game}.gif"></div>

<div style="position:absolute;padding:0;margin: 77px 2 520 172;z-index:1;opacity:0.8;display:block;width:16px;"><img src="/images/flags/{location}.png"></div>

<div class="screen"><a href="/{id}"><img src="/images/maps/{game}/{map}.jpg" border: 1px solid #006E91; style="width:80px;height:60px;border: 1px solid #006E91;"></a></div>
<div class="vipmonth">
<div class="nowrap">
Карта:<br>{map}<br><br>
Игроки:<br>{players} / {players_max}</div></div><br>
<div class="nowrap"><a href="/{id}">{name}</a><br>




<span>{address}</span>
</div>
</div>


	';
	// Шаблон пустого места
	$template_free = '
<div>
<div class="unit">

<div class="month">
<div class="screen"><a href="/pay/"><img src="/images/top_free.png" border: 1px solid #006E91; style="width:80px;height:60px;border: 1px solid #006E91;"></a></div>
<div class="vipmonth">
Карта:<br>N/A<br><br>
Игроки:<br>N/A</div><br>
<div class="nowrap"><a href="/pay/">«Премиум место» свободно!</a><br>

<span>111.111.111.11:27777</span>
</div>
</div>

</div>
</div>


	';

	function use_top_tpl($tpl) {

	global $server_location;
	global $server_game;
	global $server_map;
	global $server_players_num;
	global $server_players_num_max;
	global $server_id;
	global $server_name;
	global $server_address;
	global $server_steam;

		$vars = Array(
		'{location}'    => $server_location,
		'{steam}'       => $server_steam,
		'{game}'		=> $server_game,
		'{map}'			=> $server_map,
		'{players}'		=> $server_players_num,
		'{players_max}'	=> $server_players_num_max,
		'{id}'			=> $server_id,
		'{name}'		=> $server_name,
		'{address}'		=> $server_address
		);
		$tpl = strtr($tpl, $vars);
		return $tpl;
	}

	// Строим топовые места
	$line = 0;
	for($i = 1; $i <= 5 * LINES_NUM; $i++) {
		if(@is_array($tops_array[$i])) {
			$server_id = $tops_array[$i]['server_id'];
			$server_name = $tops_array[$i]['server_name'];
			
			 
			if(mb_strlen($server_name, 'UTF-8') > 24) {
				$server_name = mb_substr($server_name, 0, 24, 'UTF-8')."...";
	

}




			
			$server_name = htmlspecialchars($server_name);
			$server_location = $tops_array[$i]['server_location'];
			$server_address = $tops_array[$i]['server_ip'];
			$server_players_num = $tops_array[$i]['server_players'];
			$server_players_num_max = $tops_array[$i]['server_maxplayers'];
			
			$server_steam="";
			if($tops_array[$i]['server_steam'] == 1) $server_steam = "<img src='/images/icon_steam.gif'/>";
			
			$server_map = $tops_array[$i]['server_map'];
			$server_game = $tops_array[$i]['server_game'];
			if($tops_array[$i]['server_off'] == 1) $server_address = "<span style='color:#789ABF;cursor:help;' title='Данный сервер заблокирован в мониторинге'>[Сервер заблокирован]</font></a>";
			if($tops_array[$i]['server_ipport_style']) {
				$grc = mysql_fetch_array(mysql_query("SELECT * FROM mon_rowstyles WHERE name='".$tops_array[$i]['server_ipport_style']."'"));
				$server_address = "<span style='".$grc['style']."'>$server_address</span>";
			}
			if($tops_array[$i]['server_status'] == 0) {
				$server_address .= " <span style='color:#789ABF;cursor:help;' title='Данный сервер выключен'>[</span><span style='color:#AAAAAA; cursor:help;' title='Данный сервер выключен'>OFF</font><span style='color:#789ABF; cursor:help;' title='Данный сервер выключен'>]";
				$server_players_num = "N";
				$server_players_num_max = "A";
				$server_map = "unknow";
				
			}
			$place_free = false;
		} else {
			$place_free = true;
		}
		
		if(($i - 1) % 5 == 0 or $i == 1) {
			$line++;
			$class = ($line % 2 == 0) ? '2' : '1';
			echo "\n";
		}

		if($place_free) {
			echo $template_free;
		} else {
			echo use_top_tpl($template_got);
		}

		if($i % 5 == 0) {
			echo "\n<div class='clearfix'></div>\n</div>\n";
		}
		if($i % 30 == 0) {
		$line++;
		$class = ($line % 2 == 0) ? '1' : '2';
			echo "\n";
			echo '
		
			';
		}
	}
}

?>

</div>
