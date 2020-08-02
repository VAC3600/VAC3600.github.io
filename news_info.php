 <?php

require_once LOCALE.LOCALESET."serv.php";


$server_id = $_GET['id'];
	
$take_server = dbquery("SELECT * FROM ".DB_DEMONEWS." WHERE news_id = ".mysql_real_escape_string($server_id)."");
$server_data = dbarray_fetch($take_server);
if(mysql_num_rows($take_server) == 0) {
	displayMessage('Выбраня новость не существует, либо была удалена.', 'error');
}

 else {

	$last_update = $settings['last_update'];
	$time_diff = time() - $last_update;
	
	if($time_diff >= 60) {
		$time_lasted = floor($time_diff / 60)." минуту назад";
	} else {
		$time_lasted = $time_diff." секунду назад";
	}
echo "<center><font size='6'><font color='green'><b>НОВОСТИ ПРОЕКТА</b></font></font></center><br>
<div class='post games'>

<h2>{$server_data['title']} (22.11.12)</h2>
<p><b>{$server_data['about2']}</b></br>
</div>
";

echo "
<font class='right'><a title='Назад' class='learn-more' href='/news'>Назад</a></font></p>
";
}

?>

