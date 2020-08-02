<?php
/*
 * Server search script
 * Made by starky
 * Made by http://cybersport.if.ua
*/

/* Script security */
if(!defined("MONENGINE")) {
	header("Location: index.php");
	exit();
}
/* Other code */

/* Search form */
if(count($_POST) == 0) {
	$page = 'advanced_search';
} elseif(isset($_POST['advanced_search'])) {
	$page = 'adv_search_results';
} elseif(isset($_POST['quick_search'])) {
	$page = 'quick_search';
} elseif(isset($_POST['allsearch']) || isset($_POST['pay_id'])) {
	$page = 'pay_bweb';
} else {
	$page = 'advanced_search';
}

if($page == 'advanced_search') {
	include(INCLUDES."countries.class.php");
	$countries = new countries;
	$servers = dbquery("SELECT `server_location` FROM `".DB_SERVERS."` WHERE `server_location` != ''");
	echo "
<div class='mytitle'><div>Подобрать сервер</div></div>
	<div class='cont'>
	
	
	<table width='100%' style='width: 50%; margin: 0 auto; text-align: center;'>
	
		<form method='POST'>
		</br>
		
			<tbody>
			
				<tr>
					<td>Строка поиска:</td>
					<td>
						<input type='text' class='searchfield' name='searchfield'>
						<div class='hint'>
							используйте rating:10 для вывода серверов с рейтином не менее 10,<br>
						</div>
					</td>
				</tr>
				
				<tr>
					<td>Карта:</td>
					<td>
						<input type='text' name='map' id='map' value='*'>
						<div class='hint'>
							несколько карт – через запятую, например: <a href='javascript://' onclick=\"document.getElementById('map').value='de_inferno, de_nuke, de_aztec';\">de_inferno, de_nuke, de_aztec</a><br>
							для любой карты – оставьте пустым или *
						</div>
					</td>
				</tr>
				
				<tr>
					<td>Свободных слотов:</td>
					<td>
						<input type='text' name='freeslots' id='freeslots' value='2'>
						<div class='hint'>
							для игнорирования данного поля, оставьте его пустым,<br>
							либо впишите *
						</div>
					</td>
				</tr>
				
				<tr>
					<td>Страна:</td>
					<td>
						";
						$countries->makeSelect($servers);
					echo "
					</td>
				</tr>
				
				<tr>
					<td></td>
					<td><br><input type='submit' name='advanced_search' value='Найти' style='width:120px;'></td>
				</tr>
			</tbody>
		
		</table>
		</form>
	
	</div>
	";
} elseif($page == 'adv_search_results') {
	$searchfield = mysql_real_escape_string(trim($_POST['searchfield']));
	$map = mysql_real_escape_string(trim($_POST['map']));
	$freeslots = trim($_POST['freeslots']);
	$country = mysql_real_escape_string(trim($_POST['country']));
	$query_params = Array();
	/* Search field */
	if(!empty($searchfield)) {
		if(mb_strpos($searchfield, '-steam', 0, "UTF-8") !== false) {
			$searchfield = mb_str_replace('-steam', '', $searchfield);
			$query_params[] = "`server_steam` == '0'";
		}
		if(!empty($searchfield)) {
			if(mb_strpos($searchfield, ' ', 0, 'UTF-8')) {
				$searchfield = explode(' ', $searchfield);
				foreach($searchfield as $searchfield) {
					list($key, $value) = explode(':', $searchfield);
					$key = trim($key);
					$value = trim($value);
					if($key == 'rating' and is_numeric($value)) {
						$query_params[] = "`votes` >= '$value'";
					}
				}
				
			} else {
				list($key, $value) = explode(':', $searchfield);
				$key = trim($key);
				$value = trim($value);
				if($key == 'rating' and is_numeric($value)) {
					$query_params[] = "`votes` >= '$value'";
				}				
			}
		}
	}
	/* Maps */
	if(!empty($map) and $map != '*') {
		if(mb_strpos($map, ',', 0, 'UTF-8') !== false) {
			$explode_maps = explode(',', $map);
			$map_params = '';
			foreach($explode_maps as $k => $map) {
				$map = trim($map);
				if($k == 0) $map_params .= '(';
				$map_params .= "`server_map` = '$map'";
				if($k != (count($explode_maps) - 1)) {
					$map_params .= ' OR ';
				} else {
					$map_params .= ')';
				}
			}
			$query_params[] = $map_params;
		} else {
			$map = trim($map);
			$query_params[]= "`server_map` = '$map'";
		}
	}
	/* Free slots */
	$freeslots = preg_replace("/\D/", "", $freeslots);
	if(!empty($freeslots) and $freeslots != '*') $query_params[] = "`server_maxplayers` - `server_players` = '$freeslots'";
	/* Country */
	if(!empty($country) and $country != 'all') $query_params[] = "`server_location` = '$country'";
}

////////////////////////////////////////////////////
/// Search results  ////////////////////////////////
////////////////////////////////////////////////////

if($page == 'adv_search_results' or $page == 'quick_search') {
	echo "<table class='servers' cellpadding='0' cellspacing='0' border='0'>";

	/* TABLE HEAD */
	echo "
		<table class='serverlist'><tr class='serverlisttitle'>
	<td style='padding-left: 45px;'>Название сервера</td>
	<td>Сервер</td>
	<td>Карта</td>
	<td align='center'>Игроков</td>
	<td align='center'>Рейтинг</td>
	<td align='center' style='padding-right: 20px;'>Статус</td>
</tr>

<tr>
		";

	/* TABLE BODY */
	echo "<tbody>";
	if(count($query_params) == 0) {
		echo "<tr><td colspan='6' class='noservincat'>Задан пустой поисковый запрос</td></tr>";
	} else {
		//print_r($query_params); // *Debug*
		/* Building the query */
		$search_query = "SELECT * FROM `".DB_SERVERS."` WHERE ";
		foreach($query_params as $k => $v) {
			$search_query .= $v;
			if($k != (count($query_params) - 1)) $search_query .= " AND ";
		}
		$search_query .= " ORDER BY `server_vip` DESC, `votes` DESC LIMIT 100";
		//echo $search_query; // *Debug*
		$servers = dbquery($search_query);
		
		if(mysql_num_rows($servers) != 0) {
			while($r=dbarray_fetch($servers)) {
				$players = $r['server_players']."/".$r['server_maxplayers'];
				
				$server_location = $r['server_location'];
				if(empty($server_location)) $server_location = 'undefined';
				if($r['server_off'] == 1) {
					$status = "<span class='banned'>Banned</span>";
				} elseif($r['server_status'] == 1) {
					$status = "<span class='online'>Online</span>";
				} elseif($r['server_status'] == 0) {
					$status = "<span class='offline'>Offline</span>";
				}
				
				$row = "
	<td class='server' onmouseover='lightRow(this);' onmouseout='darkRow(this);' style='padding-left: 20px;'><img src='/images/flags/{$r['server_location']}.png' style='width:16px;11px;'/>&nbsp;&nbsp;&nbsp;<a href='/{$r['server_id']}/' title='' style='cursor:pointer'>{$r['server_name']}</a></td>
	<td class='server' onmouseover='lightRow(this);' onmouseout='darkRow(this);'><a href='/{$r['server_game']}/'><img src='/images/icons/{$r['server_game']}.gif' style='width:16px;heigth:16px;' alt='{$r['server_game']} сервер' align='left' /></a>&nbsp;{$r['server_ip']} ".(($r['server_steam'] == '1') ? '<img src=\'images/icon_steam.gif\'>' : '')."</td>
	<td class='server' onmouseover='lightRow(this);' onmouseout='darkRow(this);'>{$r['server_map']}</td>
	<td class='server' onmouseover='lightRow(this);' onmouseout='darkRow(this);' align='center'>{$r['server_players']}&nbsp;/&nbsp;{$r['server_maxplayers']}</td>
	<td class='server' onmouseover='lightRow(this);' onmouseout='darkRow(this);' align='center'><span id='r{$r['server_id']}'>{$r['votes']}</span></td>
	<td class='server' onmouseover='lightRow(this);' onmouseout='darkRow(this);' align='center' style='padding-right: 20px;'>$status</td>
	</tr>
	";
				
				echo $row;
			}
			
		} else {
			echo "<tr><td colspan='6' class='noservincat'>Ничего не найдено</td></tr>";
		}
	}
	/* TBODY END */
	echo "</tbody></table>";
	/* TABLE END */
}

if($page == "pay_bweb")
{
	echo "<table class='serverlist'><tr class='serverlisttitle'>
	<td style='padding-left: 45px;'>Название сервера</td>
	<td>Сервер</td>
	<td>Карта</td>
	<td align='center'>Игроков</td>
	<td align='center'>Рейтинг</td>
	<td align='center' style='padding-right: 20px;'>Выбор</td>
</tr>

<tr>";
	/* TABLE BODY */
	echo "<tbody>";
	/* TBODY END */
	$pay_query = mysql_query('SELECT * FROM mon_servers WHERE `server_ip` = "'.$_POST['allsearch'].'" OR `server_id` = "'.$_POST['pay_id'].'"');
	while($r = mysql_fetch_array($pay_query))
	{
		$row = "<td class='server' onmouseover='lightRow(this);' onmouseout='darkRow(this);' style='padding-left: 20px;'><img src='/images/flags/{$r['server_location']}.png' style='width:16px;11px;'/>&nbsp;&nbsp;&nbsp;<a href='/pay/{$r['server_id']}/' title='' style='cursor:pointer'>{$r['server_name']}</a></td>
	<td class='server' onmouseover='lightRow(this);' onmouseout='darkRow(this);'><a href='/{$r['server_game']}/'><img src='/images/icons/{$r['server_game']}.gif' style='width:16px;heigth:16px;' alt='{$r['server_game']} сервер' align='left' /></a>&nbsp;{$r['server_ip']} ".(($r['server_steam'] == '1') ? '<img src=\'images/icon_steam.gif\'>' : '')."</td>
	<td class='server' onmouseover='lightRow(this);' onmouseout='darkRow(this);'>{$r['server_map']}</td>
	<td class='server' onmouseover='lightRow(this);' onmouseout='darkRow(this);' align='center'>{$r['server_players']}&nbsp;/&nbsp;{$r['server_maxplayers']}</td>
	<td class='server' onmouseover='lightRow(this);' onmouseout='darkRow(this);' align='center'><span id='r{$r['server_id']}'>{$r['votes']}</span></td>
	<td class='server' onmouseover='lightRow(this);' onmouseout='darkRow(this);' align='center' style='padding-right: 20px;'><a href='/pay/{$r['server_id']}/' style='color:#3B8CAA;'>Выбрать сервер</a></td>
	</tr>";
		
		echo $row;
	}
	echo "</tbody></table>";
	/* TABLE END */
}

?>