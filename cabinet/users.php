<?php
//Шаблон Личного Кабинета!
include ('templates/header.php');

    //  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!
    //Старт сессии :)
    session_start();
    
    // Проверяем, пусты ли переменные логина и id пользователя
    if (empty($_SESSION['login']) or empty($_SESSION['id']))
    {
    // Если пусты, то мы не выводим ссылку
    echo ' 
	<br>
	<center><font size="6"><font color="red"><b>ОШИБКА!!!</b></font></font></center> 
	<h2></h2><br>
	<center>
		<a class="btn btn-danger">
		<span class="glyphicon glyphicon-off"></span>
		Внимание!Для просмотра этой информации необходимо пройти авторизацию!
		</a><br>
		</center>
	';
    }
    else
    {

    // Если не пусты, то мы выводим ссылку
	include ('templates/menu_profile.php');
   /* echo '
<br>
<center><font size="6"><font color="red"><b>В РАЗРАБОТКЕ!!!</b></font></font></center> ';*/
   ?>
	<?php

/* Other code */
$get_replies = dbquery("SELECT * FROM `".DB_NEWS."` WHERE `type` = '0' ORDER BY `id` ASC");
$replies_num = mysql_num_rows($get_replies);
echo "<div id='right'>
		<div class='section'>
			<div class='box'>
				<div class='title'>Всего новостей (<span id='not_approved'>$replies_num</span>)<span class='hide'></span></div>
				<div class='content'>
				";
			if($replies_num == 0) {
				echo "	<div class='row'>
							<center>Нет непромодерированных новостей.</center>
						</div>
					";
			} else {

				while($reply = dbarray_fetch($get_replies)) {
					echo "
<h2></h2>
						<div class='post games'>
						<h2>{$reply['username']} (".@date("d.m.Y H:i", $comments['date']).")</h2>
						<p><b>{$reply['text']}</b></br>
						</br> 
						</div>
						";
				}
							
				echo "</tbody></table></div>";
			}
echo "		</div>
		</div>
	</div>";

?>

    
    
    <?php
	 }
//Footer
	include ('templates/footer.php');
?>