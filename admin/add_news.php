
<style type="text/css">
	
			@import url("template/css/bootstrap.css");
</style>
<!-- kkenchi -->
<?php
/*

*/

/* Script security */
if(!defined("MONENGINE")) {
	header("Location: index.php");
	exit();
}
require(INCLUDES."countries.class.php");
$countries = new countries;
$title = '';
$server_new = '0';
$message = '';
$about = '';
$about2 = '';
if(isset($_POST['submit_registration'])) {
	$title = mysql_real_escape_string($_POST['titles']);
	$errors = Array();
	$about = mysql_real_escape_string($_POST['server_about']);
	$about2 = mysql_real_escape_string($_POST['server_about2']);
	
	$regex_ipport = "[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\:[0-9]{1,5}";
	$regex_hostport = "[a-zA-Z0-9](-*[a-zA-Z0-9]+)*(\.[a-zA-Z0-9](-*[a-zA-Z0-9]+)*)+\:[0-9]{1,5}";
	if(empty($title)) {
		$errors[] = "Не заполнено обязательное поле \"Заголовок сервера\"";
	}
	
	if(count($errors) == 0) {
		$add_server_query = "INSERT INTO `".DB_DEMONEWS."` (
		`title`, 
		`about`,
		`about2`,
		`server_new`
		) 
		VALUES 
		(
		'{$title}', 
		'{$about}',
		'{$about2}',
		'0'
		)";
		
		$add_server = dbquery($add_server_query);
		if(!$add_server) $errors[] = "Ошибка записи в базу данных.";
	}
	
	if(count($errors) != 0) {
		$message = "<div class='message red'><span>{$errors[0]}</span></div>";
	} else {
		$message = "<div class='message green'><span><b>Успех</b>: новость была успешно добавлена.</span></div>";
	}
}
/* Other code */
echo "<div id='right'>
		<div class='section'>
			<div class='box'>
				<div class='title'>Добавление новости!<span class='hide'></span></div>
				<div class='content'>
					$message
					<form action='' method='POST'>
					<div class='row'>
						<label>Заголовок <font color='red'>*</font></label>
						<div class='right'>
							<input  type='text' name='titles' placeholder='Введите заголовок новости!' value='$title'>
						</div>
					</div>

					<div class='row'>
						<label>Краткое описание <font color='red'>*</font></label>
						<div class='right'>
							<textarea name='server_about' placeholder='Введите краткое описание!'>$about</textarea>
						</div>
					</div>
					
					<div class='row'>
						<label>Полное описание <font color='red'>*</font></label>
						<div class='right'>
							<textarea name='server_about2' placeholder='Введите полное описание!'>$about2</textarea>
						</div>
					</div>
										
					<div class='row'>
						<div class='right'>
							<button type='submit' name='submit_registration' class='btn btn-info'><span>Зарегистрировать</span></button>  
							<button type='button' onClick='window.location.href='index.php' class='btn btn-danger'><span>Отмена</span></button>
						</div>
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
";
?>