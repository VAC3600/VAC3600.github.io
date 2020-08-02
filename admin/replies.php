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
$get_replies = dbquery("SELECT * FROM `".DB_NEWS."` WHERE `type` = '1' ORDER BY `id` ASC");
$replies_num = mysql_num_rows($get_replies);
echo "<div id='right'>
		<div class='section'>
			<div class='box'>
				<div class='title'>Неподтверждённые новости (<span id='not_approved'>$replies_num</span>)<span class='hide'></span></div>
				<div class='content'>
				";
			if($replies_num == 1) {
				echo "	<div class='row'>
							<center>Нет непромодерированных новостей.</center>
						</div>
					";
			} else {
				echo "<table cellspacing='0' cellpadding='0' width='100%'>
								<thead>
									<tr>
										<th>Текст комментария</th>
										<th>Подтвердить</th>
									</tr>
								</thead>
								<tbody>
								

					";
				while($reply = dbarray_fetch($get_replies)) {
					echo "	<tr id='reply_{$reply['id']}'>
								<td>{$reply['text']}</td>
								<td>
									<button type='button' class='green' onClick=\"approveReply('{$reply['id']}', '0');\"><span>Добавить</span></button> 
									<button type='button' class='red' onClick=\"approveReply('{$reply['id']}', '1');\"><span>Отменить</span></button>
								</td>
							</tr>
						";
				}
							
				echo "</tbody></table></div>";
			}
echo "		</div>
		</div>
	</div>";

?>