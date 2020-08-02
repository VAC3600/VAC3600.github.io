 <?php

require_once LOCALE.LOCALESET."serv.php";


$server_id = $_GET['id'];
	
$take_server = dbquery("SELECT * FROM ".DB_SERVERS." WHERE server_id = ".mysql_real_escape_string($server_id)."");
$server_data = dbarray_fetch($take_server);
if(mysql_num_rows($take_server) == 0) {
	displayMessage('Выбранный сервер не существует, либо был удалён.', 'error');
}
else if($server_data['server_off'] == 1)
{
	include("banned.php");
}
 else {
	$site = "";	
	if($server_data['server_site'] !="") {
		$site = "<a href='http://".$server_data['server_site']."' target='_blank'>".$server_data['server_site']." </a>";
	}

		
	$icq = "";
	if($server_data['server_icq'] !="") {
		$icq = $server_data['server_icq']."";
	}
	$status="<font color='#B53333'><b>Offline</b></font>";
	if($server_data['server_status'] == 1) $status = "<font color='#6e8d4c'><b>Online</b></font>";
	
	
	$top="";
	if($server_data['server_top']) $top="<b>ТОП кончиться  ".formatDate("d.m.Y H:i:s",$server_data['server_top_time'])."</b></br>";
	$vip="";
	if($server_data['server_vip']) $vip="<b>VIP кончиться ".formatDate("d.m.Y H:i:s",$server_data['server_vip_time'])."</b></br>";
	
	
	
	
	$last_update = $settings['last_update'];
	$time_diff = time() - $last_update;
	
	if($time_diff >= 60) {
		$time_lasted = floor($time_diff / 60)." минуту назад";
	} else {
		$time_lasted = $time_diff." секунду назад";
	}
	
	
	$percent_loaded = floor(($server_data['server_players'] / $server_data['server_maxplayers']) * 100);
	
	switch($percent_loaded) {
		case ($percent_loaded <= 40):
			$load_color = 'green';
			break;
		case ($percent_loaded <= 80):
			$load_color = 'yellow';
			break;
		case ($percent_loaded <= 100):
			$load_color = 'red';
			break;
		default:
			$load_color = 'green';
			break;
	}
	if(is_file("images/maps/{$server_data['server_game']}/{$server_data['server_map']}.jpg")) {
		$monitor_url = "monitor/cs16/{$server_data['server_map']}.jpg";
	} else {
		$monitor_url = "maps/monitor_nomap.gif";
	}

	echo "<div class='server_name'><div>Сервер: <strong>{$server_data['server_name']}</strong></div></div>
<div class='cont'>

	<table cellpadding='0' cellspacing='0' width='100%' height='400'>
		<tr>


			<td valign='top' width='340' style='padding-bottom:20px;'>
				<div><img src='/images/".$monitor_url."' style='width:297px;height:202px;' alt='{$server_data['server_map']}' /></div>
				<div style='text-align:center;padding-right:50px;'>
					<table align='center' cellpadding='0' cellspacing='0' width='236' height='30'><tr><td class='load_bar load_$load_color' width='".(($percent_loaded == 0) ? "1" : "$percent_loaded")."%' valign='middle'><div style='position:absolute;'><nobr>Загруженность сервера $percent_loaded%</nobr></div>&nbsp;</td><td>&nbsp;</td></tr></table>
				</div>
				<div class='block_line''>
					<div class='block ipport'>
						<div class='t'>Адрес сервера:</div>
						<div class='block_line_small'>{$server_data['server_ip']}</div>
					</div>
				</div>				
				<div class='block_line'>
					<div class='block map'>
						<div class='t'>Текущая карта:</div>
						<div class='block_line_small'>{$server_data['server_map']}</div>
					</div>
				</div>
				
				<div class='block_line'>
					<div class='block players'>
						<div class='t'>Игроки:</div>
						<div class='block_line_small'>{$server_data['server_players']}/{$server_data['server_maxplayers']}</div>
					</div>
				</div>
				
				<div class='block_line'>
					<div class='block votes'>
						<div class='t'>Голосов за сервер:</div>
						<div class='block_line_small'>
						<span class='votes_count' id='votes_count_{$server_data['server_id']}' >".$server_data['votes']."</span>
						<span class='vote_buttons' id='vote_buttons_{$server_data['server_id']}'>
						<a href='javascript://' onClick=\"rating({$server_data['server_id']}, 'up', '".md5("m0n3ng1ne.s4lt:P{]we{$server_data['server_id']}@._)%;")."');\" class='voteup' id='{$server_data['server_id']}'></a>
						<a href='javascript://' onClick=\"rating({$server_data['server_id']}, 'down', '".md5("m0n3ng1ne.s4lt:P{]we{$server_data['server_id']}@._)%;")."');\" class='votedown' id='{$server_data['server_id']}'></a>
						</span>
						</div>
					</div>


				


				</div>";
				if(!empty($site)) {
		echo "
			<div class='block_line' style='margin-bottom:0;'><div class='block site'><div class='t'>Сайт сервака:</div><small>".$server_data['server_site']."</small></div></div>
			</td>
			";
			}
				$com_error = '';
	$errors = Array();
	if(count($_POST)>0){
		$com_name = $_POST['com_name'];
		if(empty($com_name)) {
			$com_name = '';
			$errors[] = 'Вы не ввели своё имя.';
		} elseif(strlen($com_name) < 2 or strlen($com_name) > 12) {
			$com_name = '';
			$errors[] = 'Длина имени должна составлять от 2-х до 12-ти символов.';
		}
		
		$com_text = $_POST['com_text'];
		
		if(empty($com_text)) {
			$com_text = '';
			$errors[] = 'Вы не ввели текст комментария.';
		} elseif(strlen($com_text > 300)) {
			$com_text = '';
			$errors[] = 'Максимальная длина комментария 300 символов.';
		}
		
		if(!isset($_SESSION['captcha_keystring']) or $_SESSION['captcha_keystring'] != $_POST['com_captcha']){
			$errors[] = 'Вы неверно ввели текст с картинки.';
		}
		
		
		if(count($errors) != 0) {
			$com_error = "<div style='font-size: 13px;color:white;padding: 5px;margin-bottom:7px;border: 1px solid#BC2E2E;background:#522828;text-align: left;'>".$errors[0]."</div>";

			
		} else {
			$server_id = mysql_real_escape_string($server_id);
			$com_name = mysql_real_escape_string(htmlspecialchars($com_name));
			$com_text = mysql_real_escape_string(htmlspecialchars($com_text));
			$result = mysql_query("INSERT INTO ".DB_COMMENTS." (server_id, username, text, date) VALUES ('$server_id', '$com_name', '$com_text', '".time()."')");
				$message = "<div style='font-size: 13px;color:white;padding: 5px;margin-bottom:7px;border: 1px solid#108014;background:#3A4337;text-align: left;'>Спасибо! Ваш комментарий будет добавлен после модерации.</div>";
		}
	}
			echo "
			

        

<td valign='top' class='comments'>


    <div class='box_1'>
				<b class='ugolki r4'></b>
				<b class='ugolki r3'></b>
				<b class='ugolki r2'></b>
				<b class='ugolki r1'></b>
				<b class='ugolki r1'></b>
				<div class='box_bg1'>
				<div class='box_title'>Юзербары сервера:</div>
                                 <div class='box_bg1'>
				<br>
				<center> 


<center> 


<img src='/banner/userbar.png?serv={$server_data['server_ip']}'><br><br>
<textarea rows='1' cols='70' style='margin: 0px; height: 59px; width: 361px;'><a href='http://sm.csclub.kz/{$server_data['server_id']}/'><img src='http://sm.csclub.kz/banner/userbar.png?serv={$server_data['server_ip']}'></a></textarea>
                                </center>
                                </center>
</br>
</div>



</div>
				<b class='ugolki r1'></b>
				<b class='ugolki r1'></b>
				<b class='ugolki r2'></b>
				<b class='ugolki r3'></b>
				<b class='ugolki r4'></b></div></div>

<br>


				<form method='POST' class='comments'>
				$message
				".((!empty($com_error)) ? "$com_error" : '')."
				<input type='hidden' name='action' value='addcomment' />
					<div class='box_1'>
					<b class='ugolki r4'></b><b class='ugolki r3'></b><b class='ugolki r2'></b><b class='ugolki r1'></b><b class='ugolki r1'></b></div>
					<div style='padding:10px;background:#363636;'>
						<div style='font-size: 14px;color:#EEEEEE;padding-bottom:5px;'>Оставьте отзыв о сервере:</div>	
						<div style='padding-bottom:5px;'>Ваш ник:&nbsp;&nbsp;<input type='text' name='com_name'".((!empty($com_name)) ? " value='$com_name'" : '')."></div>
						<div style='padding-bottom:3px;'><textarea cols='40' rows='2' id='postsender' name='com_text' onChange='ch_lth();' onkeyup='ch_lth();'>".((!empty($com_text)) ? "$com_text" : '')."</textarea></div>
						<div style='padding-bottom: 10px;'>
							<p style='float:left;padding:0;margin:0;'><span style='font-size:15px;color:#4B4B4B;font-weight:bold;' id='postcounter'>300</span></p>
						
<p style='float:right;padding:0;margin:0;'><input type='submit' class='button' value='Добавить отзыв' /></p>
							<br style='clear:both;' />
						</div>
	<center>					
<div style='padding-bottom:5px;'><b>Подтверждите код:</b></div>
						<div style='padding-bottom:5px;'><img src='/cap/index.php?".session_name()."=".session_id()."' style='width:160px;height:72px;' /></div>
						<div><input type='text' value='' name='com_captcha' style='width:160px;' /></div>
			</center>			
					</div>
					<div class='box_1'><b class='ugolki r1'></b><b class='ugolki r1'></b><b class='ugolki r2'></b><b class='ugolki r3'></b><b class='ugolki r4'></b></div></div></div>
	



			</form>
				
				";
				
				unset($_SESSION['captcha_keystring']);
				
				echo "
				
				<br />
	<div class='box_1'><b class='ugolki r4'></b><b class='ugolki r3'></b><b class='ugolki r2'></b><b class='ugolki r1'></b><b class='ugolki r1'></b>
					<div class='box_bg1'>
				<div style='font-size: 14px;'>Отзывы о сервере ".$server_data['server_name']."</div>
				<div class='scomments'>
				";
				$get_comments = mysql_query("SELECT * FROM ".DB_COMMENTS." WHERE server_id='$server_id' and type!='0'");
				if(mysql_num_rows($get_comments) != 0) {
				while($comments = mysql_fetch_assoc($get_comments)) {
		
				echo "
				<div class='post' onmouseover='this.className='post post_hl';' onmouseout='this.className='post';'>
				<div class='posttext'>
				<span class='postname'>{$comments['username']}</span> {$comments['text']}</div>
				<p class='posttime'>".@date("d.m.Y H:i", $comments['date'])."</p>
				<p class='positivepost'>".(($comments['type'] == 1) ? "Позитивный отзыв" : "<span style='color: #993336;'>Негативный отзыв</span>")."</p>
				<br /></div>
				";
				}
				
				} else {
				echo "
				<div class='post' onmouseover='this.className='post post_hl';' onmouseout='this.className='post';'>
				<div class='posttext'>Этот сервер не имеет пока что отзывов</div>
				</div>";
				}
				
				echo "



					</div>
				<b class='ugolki r1'></b><b class='ugolki r1'></b><b class='ugolki r2'></b><b class='ugolki r3'></b><b class='ugolki r4'></b></div></div></div>

	<b class='ugolki r1'></b>
				<b class='ugolki r1'></b>
				<b class='ugolki r2'></b>
				<b class='ugolki r3'></b>
				<b class='ugolki r4'></b>
	
				<div style='padding:4px;text-align:center;'>
					
				</div>


                    

			
</td>


			<td valign='top' width='300' style='padding:10px;padding-top:20px;'>
				


<div class='box_1'><b class='ugolki r4'></b><b class='ugolki r3'></b><b class='ugolki r2'></b><b class='ugolki r1'></b><b class='ugolki r1'></b>
					<div class='box_bg1'>
						<div class='box_title'>Дополнительная информация:</div>
						id сервера: {$server_data['server_id']}<br />
						Статус сервера: ".$status."<br />
						
						
						".$top."
						".$vip."
						".$color."
					
						
						<div><a href='/pay/{$server_data['server_id']}/' target='_blank'>Продлить платные услуги</a></div>
                                                <div><a href='http://cs-servera.net/gmap/frame/{$server_data['server_id']}/' rel='map' >Расположение сервера на карте</a></div>
						Дата добавления: <b>".@date("d.m.Y H:i", $server_data['server_regdata'])."</b><br />
						".(($server_data['server_status'] == 1) ? "Работает" : "Не работает").": ".@date("d.m.Y H:i", $server_data['status_change'])." </br>
						
						Обновлён: $time_lasted<br />
	
						
					</div>
				<b class='ugolki r1'></b><b class='ugolki r1'></b><b class='ugolki r2'></b><b class='ugolki r3'></b><b class='ugolki r4'></b></div>
				<div style='padding:4px;text-align:center;'>
					
				</div>
				".(!empty($server_data['about']) ? "
				<div class='box_1'>
				<b class='ugolki r4'></b>
				<b class='ugolki r3'></b>
				<b class='ugolki r2'></b>
				<b class='ugolki r1'></b>
				<b class='ugolki r1'></b>
				<div class='box_bg1'>
				<div class='box_title'>Мини мониторинг на ваш сайт:</div>
<div class='box_bg1'>
				
				<center> <iframe style='border: 0px solid #7D7D7D;' src='/webbanner.php?id={$server_data['server_id']}' width='235' height='246' scrolling='no'></iframe> <br> <textarea rows='5' cols='30' style='margin-left: 0px; margin-right: 0px; width: 228px;'><iframe src='http://sm.csclub.kz/webbanner.php?id={$server_data['server_id']}' frameborder='0' width='235' height='246' scrolling='no'></iframe></textarea> <br></center></div>
</div>
				<b class='ugolki r1'></b>
				<b class='ugolki r1'></b>
				<b class='ugolki r2'></b>
				<b class='ugolki r3'></b>
				<b class='ugolki r4'></b></div></div>" : "")."
			</td>
		</tr>
	</table>
</div>";
	
}

?>

