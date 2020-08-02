



<?php

echo "<div class='mytitle'><div>Добавить сервер в мониторинг</div></div>";
if($settings['enable_registration'] == 0){
	
	displayMessage('<br>Регистрация серверов временно приостановлена.<br><br>', 'error');
} else {
	require(INCLUDES."countries.class.php");
	$countries = new countries;
	$countries = new countries;
	$address = '';
	$steam = 0;
	$game = '';
	$message = '';
	$email = '';
	$site = '';
	$icq = '';
	$location = '';
	$about = '';
	if(isset($_POST['submit_registration'])) {
		$address = mysql_real_escape_string($_POST['server_address']);
		$steam = 0;
		$errors = Array();
		if(isset($_POST['server_steam'])) $steam = 1;
		$game = mysql_real_escape_string($_POST['server_game']);
		$email = mysql_real_escape_string($_POST['server_email']);
		$site = mysql_real_escape_string($_POST['server_site']);
		$icq = mysql_real_escape_string($_POST['server_icq']);
		$location = mysql_real_escape_string($_POST['server_location']);
		$about = mysql_real_escape_string($_POST['server_about']);
		
		$regex_ipport = "[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\:[0-9]{1,5}";
		$regex_hostport = "[a-zA-Z0-9](-*[a-zA-Z0-9]+)*(\.[a-zA-Z0-9](-*[a-zA-Z0-9]+)*)+\:[0-9]{1,5}";
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errors[] = "Ошибка: Неправильный адрес электронной почты.";
			
								} elseif(empty($about)) {
			$errors[] = "Ошибка: Не заполнено обязательное поле описание сервера.";
		} elseif(empty($address)) {
			$errors[] = "Ошибка: Не заполнено обязательное поле \"Адрес сервера\"";
		} elseif(!preg_match("/$regex_ipport/", $address) and !preg_match("/$regex_hostport/i", $address)) {
			$errors[] = "Ошибка: Неверный формат адреса сервера.";
		} else {
			$check_server = mysql_query("SELECT * FROM `".DB_SERVERS."` WHERE `server_ip` = '{$address}'");
			if(mysql_num_rows($check_server) != 0) 
			$errors[] = "Данный сервер уже есть в базе.";
		}

		if(!array_key_exists($location, $countries->countries)) $errors[] = "Ошибка: Выбрана несуществующая локация сервера $location.";
		
		if(!empty($icq) and !is_numeric($icq)) {
			$errors[] = "Ошибка: Введите корректный ICQ.";
		} else {
			if(strlen($icq) > 9) $errors[] = "Ошибка: Введите корректный ICQ.";
		}
		
		if(!empty($site) and !isValidURL($site)) $errors[] = "Ошибка: Введите корректный адрес сайта.";
		
		if(!isset($_SESSION['captcha_keystring']) or $_SESSION['captcha_keystring'] != $_POST['keystring']){
			$errors[] = 'Ошибка: Введен неправильно код подтверждения';
		}
		
		if(count($errors) == 0) {
			$add_server_query = "INSERT INTO `".DB_SERVERS."` (
			`server_game`, 
			`server_ip`, 
			`server_location`, 
			`server_steam`, 
			`server_regdata`, 
			`server_email`, 
			`server_icq`, 
			`server_new`, 
			`server_site`, 
			`about`
			) 
			VALUES 
			(
			'{$game}', 
			'{$address}', 
			'{$location}', 
			'{$steam}', 
			'".time()."', 
			'{$email}', 
			'{$icq}', 
			'0', 
			'{$site}', 
			'{$about}'
			)";
			
			$add_server = dbquery($add_server_query);
			mysql_connect("46.254.21.136", "p150517_ms", "hesoyam");
			mysql_select_db("p150517_masterserver");
			if($game == "cs16") mysql_query("INSERT INTO master_server (`adress`,`type`,`time`,`round`,`pay`,`monitor`) VALUES ('{$address}','cs16',".time().",0,'free','mon_servers')");
			if(!$add_server) $errors[] = "Произошла ошибка записи в базу данных.";
		}
		
		if(count($errors) != 0) {
			$message = "<div class='msg redbg'>{$errors[0]}</div>";
		} else {
			$message = "<div class='msg greenbg'>Спасибо. Сервер будет добавлен в течение 3-ех минут.</div>";
		}
	}
echo "
$message

<div class='cont'>
	<br><br>
<CENTER><B>Внимание:</B> введите в новую вкладку: http://sm.csclub.kz/cron.php - чтобы обновить информацию о вашем сервере в ручном режиме...</CENTER>
<br><br>


<form action='' method='POST'>
		<table width='100%' class='regform'>

			<tr>

			</tr>
			
			<tr>
<td align='right'><b>*Тип:&nbsp;</b></td>
				<td>
<select style='width:200px;' name='server_game' value='{$game}'>
     <option value='cs16'>Counter-Strike</option> 
	 <option value='csgo'>Counter-Strike: Global Offensive</option> 
     </select></td>	</tr>

	 		<tr>
				<td align='right' style='height:30px;'>STEAM?</td>
				<td style='height:30px;'><input type='checkbox' style='background:#FFF;' name='server_steam' value='1' class='checkbox'".(($steam == 1) ? " checked='checked'" : "")."></td>
			</tr>
	 
			<tr>

				<td align='right'><b><font size='2' color='red'>*</font>Адрес сервера:</b></td>
				<td><input type='text' name='server_address' value='{$address}' size='30' /></td>
			</tr>
			
			
			<tr>
				<td align='right'>Сайт </td>
				<td><input type='text' type='url' name='server_site' value='{$site}' size='30' /></td>
			</tr>
			<tr>
				<td align='right'><b>*Электропочта:</b></td>
				<td><input type='text' name='server_email' value='{$email}' size='30' /></td>
			</tr>
			<tr>
				<td align='right'>ICQ</td>
				<td><input type='text' name='server_icq' value='{$icq}' size='30' /></td>
			</tr>
			<tr>
				<td align='right'>Пару слов о сервере:</td>
				<td><textarea name='server_about' rows='4' cols='30'>{$about}</textarea></td>
			</tr>
			<tr>
				<td align='right'><b>Локация сервера:</b></td>
				<td>
				<select style='width:200px;' name='server_location'>
				";
				foreach($countries->countries as $country_code => $country_name) {
					echo "<option value='{$country_code}'".(($country_code == $location) ? " selected='selected'" : "").">{$country_name}</option>";
				}
		
echo "
				</select>
				</td>
			</tr>
			<tr>
				<td align='right'><b>*Подтверждение кода безопасности:</b></td>
				<td><img src='/cap/index.php?".session_name()."=".session_id()."'></td>
			</tr>
			<tr>
				<td align='right'>&nbsp;</td>
				<td><input type='text' style='width:160px;' name='keystring' /></td>
			</tr>
			<tr>
			<td colspan='2' align='center'>
					<div style='padding-bottom:10px;'>
					
					<input type='checkbox' name='terms' value='' checked style='vertical-align:middle;' onChange='this.checked=true;'> При нажатии кнопки &laquo;Добавить&raquo; вы&nbsp;соглашаетесь с&nbsp;нашими правилами и&nbsp;условиями
					
					</div>
					<input type='hidden' name='submit_registration' value='1'>
					<input class='btn' type='submit' value='Добавить cервер!'>
					<div style='padding-top:15px;'>

				</td>
			</tr>
		</table>
		</form>";
		unset($_SESSION['captcha_keystring']);
		}
if (isset($_POST['step']) && $_POST['step'] == "2") {
	$error = "";
	$gametype = stripinput($_POST['server_game']); 
	$server_ip = stripinput($_POST['server_ip']);
	$server_port = stripinput($_POST['server_port']);
    $email=stripinput($_POST['email']);
    $icq=stripinput($_POST['icq']);
	$www=stripinput($_POST['www']);
	$result="SELECT * FROM ".DB_SERVERS." WHERE server_ip = '".$server_ip.":".$server_port."'";
	$dbresult=mysql_query($result);
	$n=mysql_num_rows($dbresult);
	if($n) {$error .=$locale['reg021']."<br><br>\n";}

}
 echo "</div>";
 include ('templates/footer.php');
?>