
	<center><font size="6"><font color="green"><b>НОВОСТИ ПРОЕКТА</b></font></font></center><br>

	<?php
/*
 * Reply operations
 * Made by starky
*/

/* Script security */
if(!defined("MONENGINE")) {
	header("Location: index.php");
	exit();
}
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
									